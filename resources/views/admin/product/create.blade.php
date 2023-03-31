@extends('admin.layout.main')
@push('css')
    <style>
        .error {
            color: red !important;
        }
    </style>
@endpush
@section('content')
    <div class="app-main__inner">

        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="bi bi-ticket-perforated"></i>
                    </div>
                    <div>
                        Product
                        <div class="page-title-subheading">
                            View, create, update, delete and manage.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data" action="{{ route('admin.product.store') }}">
                            @csrf
                            <div class="position-relative row form-group">
                                <label for="brand_id" class="col-md-3 text-md-right col-form-label">Nhãn hàng</label>
                                <div class="col-md-9 col-xl-8">
                                    <select required name="brand_id" id="brand_id" class="form-control">
                                        <option value="">-- Brand --</option>
                                        @forelse ($brands as $item)
                                            <option value={{ $item['id'] }}
                                                {{ old('brand_id') == $item['id'] ? 'selected' : '' }}>{{ $item['name'] }}
                                            </option>
                                        @empty
                                        @endforelse
                                    </select>
                                    <p>
                                        @if ($errors->has('brand_id'))
                                            <div class="error">{{ $errors->first('brand_id') }}</div>
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <div class="position-relative row form-group">
                                <label for="product_category_id" class="col-md-3 text-md-right col-form-label">Phân
                                    loại</label>
                                <div class="col-md-9 col-xl-8">
                                    <select required name="cat_id" id="product_category_id" class="form-control">
                                        <option value="">-- Category --</option>
                                        @forelse ($categories as $item)
                                            <option data-parent="{{ $item['parent_id'] }}" value="{{ $item['id'] }}"
                                                {{ old('cat_id') == $item['id'] ? 'selected' : '' }}>{{ $item['name'] }}
                                            </option>
                                        @empty
                                        @endforelse
                                        {{-- {!! dataTree($categories, 0, intval(old('cat_id'))) !!} --}}
                                    </select>
                                    <p>
                                        @if ($errors->has('cat_id'))
                                            <div class="error">{{ $errors->first('cat_id') }}</div>
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <div class="position-relative row form-group">
                                <label for="name" class="col-md-3 text-md-right col-form-label">Tên sản phẩm</label>
                                <div class="col-md-9 col-xl-8">
                                    <input required name="name" id="name" placeholder="Tên" type="text"
                                        class="form-control" value="{{ old('name') }}">
                                    <p>
                                        @if ($errors->has('name'))
                                            <div class="error">{{ $errors->first('name') }}</div>
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <div class="position-relative row form-group">
                                <label for="content" class="col-md-3 text-md-right col-form-label">Mô tả</label>
                                <div class="col-md-9 col-xl-8">
                                    <textarea required name="description" id="content" placeholder="Mô tả" type="text" class="form-control">{{ old('description') }}</textarea>
                                    <p>
                                        @if ($errors->has('description'))
                                            <div class="error">{{ $errors->first('description') }}</div>
                                        @endif
                                    </p>
                                </div>
                            </div>
                            {{-- <div id="listPrice" style="display: none">
                                <input type="hidden" value="1" name="isAccessory" disabled>
                                <div class="position-relative row form-group">
                                    <label for="content" class="col-md-3 text-md-right col-form-label">Giá nhập</label>
                                    <div class="col-md-9 col-xl-8">
                                        <input name="price_import" id="content" placeholder="Giá nhập" type="text"
                                            class="form-control" disabled>
                                        <p>
                                            @if ($errors->has('price_import'))
                                                <div class="error">{{ $errors->first('price_import') }}</div>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <div class="position-relative row form-group">
                                    <label for="content" class="col-md-3 text-md-right col-form-label">Giá nhập</label>
                                    <div class="col-md-9 col-xl-8">
                                        <input name="price_sell" id="content" placeholder="Giá bán" type="text"
                                            class="form-control" disabled>
                                        <p>
                                            @if ($errors->has('price_sell'))
                                                <div class="error">{{ $errors->first('price_sell') }}</div>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div> --}}
                            {{-- <div class="position-relative row form-group">
                            <label for="slug" class="col-md-3 text-md-right col-form-label">Slug</label>
                            <div class="col-md-9 col-xl-8">
                                <input required name="slug" id="discount" placeholder="Slug" type="text"
                                    class="form-control" value="">
                            </div>
                        </div> --}}
                            <div class="position-relative row form-group">
                                <label for="content" class="col-md-3 text-md-right col-form-label">Ảnh đại diện</label>
                                <div class="col-md-3">
                                    <input name="img" id="imageUpload" type="file" class="form-control">
                                    <p>
                                        @if ($errors->has('img'))
                                            <div class="error">{{ $errors->first('img') }}</div>
                                        @endif
                                    </p>
                                </div>
                                <div class="col-md-3">
                                    <div id="imagePreview" style="width: 100%;height: 100%;" style="overflow: hidden">
                                        <img id="output" />
                                    </div>
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <div class="col-md-3"></div>
                                <div class="form-check">
                                    <input class="form-check-input" name="is_outstanding" value="1" type="checkbox"
                                        id="is_outstanding">
                                    <label class="form-check-label" for="is_outstanding">
                                        Nổi bật
                                    </label>
                                </div>
                                <div class="form-check ml-4">
                                    <input class="form-check-input" type="checkbox" name="is_selling" value="1"
                                        id="is_selling">
                                    <label class="form-check-label" for="is_selling">
                                        Bán chạy
                                    </label>
                                </div>
                                <div class="form-check ml-4">
                                    <input class="form-check-input" type="checkbox" name="status" value="1"
                                        id="status">
                                    <label class="form-check-label" for="status">
                                        Hiện
                                    </label>
                                </div>
                            </div>
                            <div class="position-relative row form-group mb-1 mt-2">
                                <div class="col-md-9 col-xl-8 offset-md-2">
                                    <a href="#" class="border-0 btn btn-outline-danger mr-1">
                                        <span class="btn-icon-wrapper pr-1 opacity-8">
                                            <i class="bi bi-x-lg"></i>
                                        </span>
                                        <span>Hủy</span>
                                    </a>

                                    <button type="submit" class="btn-shadow btn-hover-shine btn btn-primary">
                                        <span class="btn-icon-wrapper pr-2 opacity-8">
                                            <i class="bi bi-download"></i>
                                        </span>
                                        <span>Lưu</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#product_category_id').on('change', function() {
                console.log($('#product_category_id'))
            })
            $('#brand_id').on('change', function() {
                console.log($('#brand_id'))
            })
            $('#imageUpload').on('change', function() {
                var output = document.getElementById('output');
                output.src = URL.createObjectURL(event.target.files[0]);
                output.onload = function() {
                    URL.revokeObjectURL(output.src) // free memory
                }
            })

            // $('#product_category_id').on('change', function() {
            //     console.log('chay nhaa cac nha', parseInt($(this).find('option:selected').attr(
            //         'data-parent')))
            //     if (parseInt($(this).find('option:selected').attr('data-parent')) != 0) {
            //         $('#listPrice').show()
            //         $('#listPrice').find('input').attr('disabled', false)
            //     } else {
            //         $('#listPrice').hide()
            //         $('#listPrice').find('input').attr('disabled', true)
            //     }
            // })
        });
    </script>
@endpush
