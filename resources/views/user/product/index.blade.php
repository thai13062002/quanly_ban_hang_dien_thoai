@extends('user.layout.main')
@push('css')
    <style>
        .product-item .pi-pic ul li a {
            padding: 7px 12px 5px 11px;
        }

        .fw-brand-check li {
            list-style: none;
        }

        #pagination ul {
            display: flex;
        }

        #pagination ul li {
            list-style: none;
            padding: 5px 10px 5px 10px;
            margin-left: 5px;
            background-color: #e7ab3c;
        }

        #pagination ul li a {
            color: black;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
        }

        #pagination ul li.active a {
            color: white;
            cursor: pointer;
        }

        .paginationjs-pages {
            display: flex;
            justify-content: center;
        }
    </style>
@endpush
@section('content')
    <!-- Breadcrumb Section Begin -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="index.html">Home</a>
                        <span>Shop</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- End -->

    <!-- Product Shop Section Begin-->
    <section class="product-shop spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-8 order-2 order-lg-1 produts-sidebar-filter">
                    <div class="filter-widget">
                        <h4 class="fw-title">Categories</h4>
                        <div class="fw-brand-check">
                            <li>
                                <input type="radio" class="mr-2 category" name="categories" value=""
                                    id="category-all">
                                <label for="category-all">Tất cả</label>
                            </li>
                            {!! menuMultipleLevel($categories, 0) !!}
                        </div>
                    </div>
                    <div class="filter-widget">
                        <h4 class="fw-title">Brand</h4>
                        <div class="fw-brand-check">
                            @forelse ($brands as $item)
                                <div class="bc-item">
                                    <label for="bc-{{ $item['id'] }}">
                                        {{ $item['name'] }}
                                        <input type="checkbox" id="bc-{{ $item['id'] }}" class="brand"
                                            value="{{ $item['id'] }}">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            @empty
                            @endforelse
                        </div>
                    </div>

                </div>
                <div class="col-lg-9 order-1 order-lg-2">
                    {{-- <div class="product-show-option">
                        <div class="row">
                            <div class="col-lg-7 col-md-7">
                                <div class="select-option">
                                    <select class="sorting">
                                        <option value="">Default Sorting</option>
                                    </select>
                                    <select class="p-show">
                                        <option value="">Show:</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-5 text-right">
                                <p>Show 01-09 Of 36 Product</p>
                            </div>
                        </div>
                    </div> --}}
                    <div class="product-list">
                        <div class="row list-product">
                            {{-- @foreach ($listProduct as $item)
                                <div class="col-lg-4 col-sm-6">
                                    <div class="product-item">
                                        <div class="pi-pic">
                                            <img src="{{ asset('storage/Product' . '/' . $item['img'][0]['path']) }}"
                                                alt="">
                                            <ul class="mb-2">
                                                <li class="w-icon active"><a href="#"><i class="bi bi-cart"></i></a>
                                                </li>
                                                <li class="quick-view"><a href="product.html">+ Quick View</a></li>
                                            </ul>
                                        </div>
                                        <div class="pi-text">
                                            <div class="catagory-name">
                                                {{ implode('GB,', array_column($item['product_detail'], 'capacity')) }}GB
                                            </div>
                                            <a href="#">
                                                <h5>{{ $item['name'] }}</h5>
                                            </a>
                                            <div class="product-price">
                                                {{ number_format($item['product_detail'][0]['price_sell'], 0, ',', ',') }} Đ
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach --}}

                        </div>
                    </div>
                    <div class="col-12 pb-1" id="pagination">

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End -->
@endsection
@push('js')
    <script src={{ asset('js/pagination.js') }}></script>
    <script>
        $(document).ready(function() {
            var listBrand = '';
            var listCategories = '';
            showProduct()
            $(document).on('change', '.category', function() {
                listCategories = $('.category:checked').val()
                showProduct()
            })
            $(document).on('change', '.brand', function() {
                listBrand = ''
                let i = 0;
                $(".brand:checked").each(function() {
                    if (i == 0) {
                        listBrand += $(this).val()
                        i++;
                    } else
                        listBrand += "-" + $(this).val()

                });
                showProduct()
            })

            function showProduct() {
                $.ajax({
                    url: "{{ route('user.product.list_product') }}" + "?brands=" + listBrand +
                        "&categories=" + listCategories,
                    type: 'GET',
                    success: function(result) {
                        console.log(result);
                        $('#pagination').pagination({
                            dataSource: result,
                            pageSize: 6,
                            formatResult: function(data) {

                            },
                            callback: function(list, pagination) {
                                let inner = ''
                                console.log(result)
                                list.forEach(element => {
                                    let name = element.name;
                                    let id = element.id
                                    let price = Intl.NumberFormat('en-VN').format(
                                        element.product_detail[0].price_sell)
                                    let img = element.img[0].path;
                                    let capacitys = element.product_detail.map(a =>
                                        a.capacity).join('GB, ');
                                    let ProductDetailFirst = element.product_detail[
                                        0].id;
                                    var url =
                                        `product/${id}/product-detail-${ProductDetailFirst}`
                                    inner += `<div class="col-lg-4 col-sm-6">
                                    <div class="product-item">
                                        <div class="pi-pic">
                                            <img src="{{ asset('storage/Product') }}/${img}"
                                                alt="">
                                            <ul class="mb-2">
                                                <li class="w-icon active"><a href="#"><i class="bi bi-cart"></i></a>
                                                </li>
                                                <li class="quick-view"><a href=${url}>Chi Tiết</a></li>
                                            </ul>
                                        </div>
                                        <div class="pi-text">
                                            <div class="catagory-name">
                                                ${capacitys}GB
                                            </div>
                                            <a href="#">
                                                <h5>${name}</h5>
                                            </a>
                                            <div class="product-price">
                                                ${price} Đ
                                            </div>
                                        </div>
                                    </div>
                                </div>`
                                });
                                $('.list-product').empty()
                                $('.list-product').append(inner);
                            }
                        })
                    },
                    error: function(error) {
                        console.log('www', error);
                    }
                })
            }

        });
    </script>
@endpush
