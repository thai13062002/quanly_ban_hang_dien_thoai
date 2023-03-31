    $(document).ready(function() {

            //preview img
            // $('#imageUpload').on('change', function() {
            //     var output = document.getElementById('output');
            //     output.src = URL.createObjectURL(event.target.files[0]);
            //     output.onload = function() {
            //         URL.revokeObjectURL(output.src) // free memory
            //     }
            // })
            // $('#photo').on('change', function() {
            //     console.log('nhaaa')
            //     var output = document.getElementById('output');
            //     readURLWeekly($('#photo'))
            // })

            var imagesPreview = function(input, placeToInsertImagePreview) {

                if (input.files) {
                    var filesAmount = input.files.length;

                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();

                        reader.onload = function(event) {
                            $($.parseHTML('<img class="col-2 img-product mt-2 mb-2">')).attr('src', event
                                    .target
                                    .result)
                                .appendTo(
                                    placeToInsertImagePreview);
                        }

                        reader.readAsDataURL(input.files[i]);
                    }
                }

            };

            $('#imageUpload').on('change', function() {
                $('div.listphoto').empty()
                imagesPreview(this, 'div.listphoto');
            });



            //gửi request tạo sản phẩm trong bảng productdetail
            $('#save').on('click', function() {
                const obj = $('#formdata');
                const formData = new FormData(obj[0]);
                $.ajax({
                    url: obj.attr('action'),
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    async: false,
                    cache: false,
                    enctype: 'multipart/form-data',
                    success: function(result) {
                        $('.emty-data').remove()
                        $('#notdata').remove()
                        console.log('gia tri nhan duwojc sau kho goi view: ', result)
                        $('#list').append(result);
                        $('#formdata').find('.input').val(null);
                        $('#formdata').find('.error').text('')
                        // document.getElementById('output').src = '';
                        $('div.listphoto').empty()
                        Swal.fire({
                            icon: 'success',
                            title: 'Thêm thành công',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    },
                    error: function(error) {
                        console.log('www', error);
                        object = error.responseJSON ? error.responseJSON.errors : {}
                        for (const property in object) {
                            $('#formdata').find('.error-' + property).text(object[property][0])
                            console.log(`${property}: ${object[property][0]}`);
                        }
                    }
                })
            })


            //thêm màu và số lượng cho tưng chi tiết sản phẩm
            $('#savecolor').on('click', function() {
                console.log('co chay nha')
                const obj = $('#formcolor');
                const formData = new FormData(obj[0]);
                $.ajax({
                    url: obj.attr('action'),
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    async: false,
                    cache: false,
                    enctype: 'multipart/form-data',
                    success: function(result) {
                        let quantityClass = '.quantity-' + $('#productid').val();
                        let quanitty = parseInt($(quantityClass).text()) + parseInt($(
                            '#quantity').val())
                        $(quantityClass).text(quanitty)
                        $('#formcolor').find('.input').val(null);
                        $('#formcolor').find('select').val(null);
                        $('#formcolor').find('.error').text('')
                        $('.listphoto').empty();
                        Swal.fire({
                            icon: 'success',
                            title: 'Thêm thành công',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        $('#closeColor').trigger('click')
                    },
                    error: function(error) {
                        console.log('www', error);
                        object = error.responseJSON ? error.responseJSON.errors : {}
                        for (const property in object) {
                            $('#formcolor').find('.error-' + property).text(object[property][0])
                        }

                    }
                })
            })

            //thay đổi product_id trong form thêm màu cho chi tiết sản phẩm
            $(document).on('click', '.add-color', function(event) {
                let id = $(this).attr('data-id')
                $('#productid').val(parseInt(id))
            })
            //lấy chi tiết sản phẩm
            $(document).on('click', '.list-color', function() {
                console.log('co chay nha')
                let id = $(this).attr('data-id')
                $('#productIdColor').val(id)
                var url =`/admin/product/${id}/list-color-product`;
                // url = url.replace(':id', id);
                console.log(url);
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(result) {
                        $('#listColor').empty();
                        $('#listColor').append(result);
                    },
                    error: function(error) {
                        console.log('ww444w', error);
                    }
                })
            })
            //remove color
            $(document).on('click', '.delete-color', function() {
                console.log('co chay nha')
                let product_id = $('#productIdColor').val()
                let color_id = $(this).attr('data-id')
                console.log('color_id', color_id)
                let obj = $(this);
                $.ajax({
                    url:'/admin/product/delete-color-product',
                    type: 'DELETE',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        product_id: product_id,
                        color_id: color_id
                    },
                    success: function(result) {
                        console.log(result)
                        obj.closest('tr').remove()
                        Swal.fire({
                            icon: 'success',
                            title: 'Xóa thành công',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        let quantity = parseInt($('.quantity-' + product_id).text())
                        $('.quantity-' + product_id).text(quantity - parseInt(result.quantity))
                        $('#closeUpdateColor').trigger('click')
                    },
                    error: function(error) {
                        console.log('www', error);
                    }
                })
            })

            $(document).on('change', '.quantity-product-color', function() {
                $(this).parent().next().find('.update-color').attr('disabled', false)
            })

            $(document).on('click', '.update-color', function() {
                let product_id = $('#productIdColor').val()
                let color_id = $(this).attr('data-id')
                let quantity = $(this).parent().prev().find('.quantity-product-color').val()
                let obj = $(this)
                $.ajax({
                    url:'/admin/product/update-color-product',
                    type: 'PUT',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        product_id: product_id,
                        color_id: color_id,
                        quantity: quantity
                    },
                    success: function(result) {
                        console.log($('.quantity' + product_id), result['quantity'])
                        obj.attr('disabled', true)
                        $('.quantity-' + product_id).text(result['quantity'])
                        Swal.fire({
                            icon: 'success',
                            title: 'Cập nhật thành công',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    },
                    error: function(error) {
                        console.log('www', error);
                    }
                })
            })
            //update detail
            $(document).on('click', '.update-detail', function() {

                let id = $(this).attr('data-id')
                var url =`/admin/product/${id}/product-detail`;
                // url = url.replace(':id', id);
                console.log(url)
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(result) {
                        $('.form-update-detail').empty();
                        $('.form-update-detail').append(result);
                    },
                    error: function(error) {
                        console.log('www', error);
                    }
                })
            })

            function removeImg(id, obj) {
                console.log('chayj nhasssss')
                $.ajax({
                    url: `/admin/product/delete-img-product-detail`,
                    type: 'DELETE',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id: id,
                    },
                    success: function(result) {
                        console.log('ddd', result);
                        obj.closest('div').remove()
                        Swal.fire({
                            icon: 'success',
                            title: 'Xóa thành công',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    },
                    error: function(error) {
                        console.log('www', error);
                    }
                })
            }
            $(document).on('click', '.remove-img', function() {
                removeImg(parseInt($(this).attr('data-id')), $(this))
            })
            $(document).on('click', '#update', function() {
                console.log('co chay nha')
                const obj = $('#formProductDetail');
                let id = obj.find('.id-product').val()
                const formData = new FormData(obj[0]);
                $.ajax({
                    url: obj.attr('action'),
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    async: false,
                    cache: false,
                    enctype: 'multipart/form-data',
                    success: function(result) {
                        $('#item-' + id).find('.item-capacity').text(obj.find(
                                '.capacity-update')
                            .val())
                        $('#item-' + id).find('.item-price_import').text(obj.find(
                            '.price_import-update').val())
                        $('#item-' + id).find('.item-price_sell').text(obj.find(
                            '.price_sell-update').val())
                        Swal.fire({
                            icon: 'success',
                            title: 'Cập nhật thành công',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        $('#closeDetial').trigger('click')
                    },
                    error: function(error) {
                        console.log('www', error);
                    }
                })
            })

            //remove product detail item
            $(document).on('click', '.remove', function() {

                const obj = $(this);
                let id = obj.attr('data-id')
                console.log('co chay nha', id)
                $.ajax({
                    url:`/admin/product/delete-product-detail`,
                    type: 'DELETE',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id: id
                    },
                    success: function(result) {
                        obj.closest('tr').remove()
                        console.log(result)
                        Swal.fire({
                            icon: 'success',
                            title: 'Xóa thành công',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    },
                    error: function(error) {
                        console.log('www', error);
                    }
                })
            })
        })
