@extends('admin.layout.main')
@push('css')
    <style>
        .error {
            color: red !important;
        }

        .img-product {
            width: 100px;
            height: 100%;
        }

        .list-img {
            overflow-x: auto;
            overflow-y: hidden;
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
                        <form method="post" id="formdata" enctype="multipart/form-data"
                            action="{{ route('admin.product.store_detail') }}">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $id }}">
                            <div class="position-relative row form-group">
                                <label for="name" class="col-md-3 text-md-right col-form-label">Dung lượng</label>
                                <div class="col-md-9 col-xl-8">
                                    <select required name="capacity" id="capacity" placeholder="Dung lượng điện thoại"
                                        type="number" class="form-control input">
                                        <option value="">--Chọn--</option>
                                        <option value="32">32GB</option>
                                        <option value="64">64GB</option>
                                        <option value="128">128GB</option>
                                        <option value="256">256GB</option>
                                        <option value="512">512GB</option>
                                    </select>
                                    <p>
                                    <div class="error error-capacity"></div>
                                    </p>
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label for="name" class="col-md-3 text-md-right col-form-label">Giá nhập</label>
                                <div class="col-md-9 col-xl-8">
                                    <input required name="price_import" id="price_import" placeholder="Giá nhập"
                                        type="number" class="form-control input">
                                    <p>
                                    <div class="error error-price_import"></div>
                                    </p>
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label for="name" class="col-md-3 text-md-right col-form-label">Giá bán</label>
                                <div class="col-md-9 col-xl-8">
                                    <input required name="price_sell" id="price_sell" placeholder="Giá bán" type="number"
                                        class="form-control input">
                                    <p>
                                    <div class="error error-price_sell"></div>
                                    </p>
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label for="content" class="col-md-3 text-md-right col-form-label">Ảnh đại diện</label>
                                <div class="col-md-3">
                                    <input name="img[]" id="imageUpload" type="file" multiple
                                        class="form-control input">
                                    <p>
                                    <div class="error error-img"></div>
                                    </p>
                                </div>
                                <div class="col-md-12 d-flex justify-content-sm-center">
                                    <div class="listphoto col-md-8 d-flex flex-nowrap list-img pb-2"></div>
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

                                    <button type="button" id="save"
                                        class="btn-shadow btn-hover-shine btn btn-primary">
                                        <span class="btn-icon-wrapper pr-2 opacity-8">
                                            <i class="bi bi-download"></i>
                                        </span>
                                        <span>Lưu</span>
                                    </button>
                                    <a href="{{ route('admin.product.index') }}" class="border-0 btn btn-outline-info mr-1">
                                        <span class="btn-icon-wrapper pr-1 opacity-8">
                                            <i class="bi bi-arrow-lg"></i>
                                        </span>
                                        <span>Thoát</span>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">Dung lượng</th>
                                    <th class="text-center">Giá nhập</th>
                                    <th class="text-center">Giá bán</th>
                                    <th class="text-center">Số lượng</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>

                            <tbody id="list">
                                @forelse ($listDetail as $item)
                                    <tr id="item-{{ $item['id'] }}">
                                        <td class="text-center text-muted item-capacity">{{ $item['capacity'] }}
                                        </td>
                                        <td class="text-center item-price_import">{{ $item['price_import'] }}</td>
                                        <td class="text-center item-price_sell">{{ $item['price_sell'] }}</td>
                                        <td class="text-center {{ 'quantity-' . $item['id'] }}">
                                            @if (!empty($item['product_detail_color']))
                                                {{ array_sum(array_column($item['product_detail_color'], 'quantity')) }}
                                            @else
                                                0
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a class="btn btn-hover-shine btn-outline-primary border-0 btn-sm update-detail"
                                                data-toggle="modal" data-target="#modalEditDetailProduct"
                                                data-id="{{ $item['id'] }}">
                                                <span class="btn-icon-wrapper opacity-8">
                                                    <i class="bi bi-tools"></i>
                                                </span>
                                            </a>
                                            <a data-id={{ $item['id'] }} data-toggle="modal"
                                                data-target="#modalEditDetailColor" data-original-title="Sửa"
                                                class="btn btn-outline-warning border-0 btn-sm list-color">
                                                <span class="btn-icon-wrapper opacity-8">
                                                    <i class="bi bi-pencil-square"></i>
                                                </span>
                                            </a>
                                            <button class="btn btn-hover-shine btn-outline-danger border-0 btn-sm remove"
                                                type="button" data-toggle="tooltip" title="Delete"
                                                data-placement="bottom" data-id="{{ $item['id'] }}">
                                                <span class="btn-icon-wrapper opacity-8">
                                                    <i class="bi bi-trash"></i>
                                                </span>
                                            </button>
                                            <a data-id={{ $item['id'] }} data-toggle="modal" data-target="#modalColor"
                                                data-toggle="tooltip" data-original-title="Thêm"
                                                class="btn btn-outline-info border-0 btn-sm add-color">
                                                <span class="btn-icon-wrapper opacity-8">
                                                    <i class="bi bi-plus"></i>
                                                    Thêm màu
                                                </span>
                                            </a>
                                        </td>
                                    </tr>

                                @empty
                                    <tr class="empty-data">
                                        <td colspan="5" class="text-center" id="notdata">hiện không có dữ liệu
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@push('modal')
    {{-- modal thêm màu và số lượng cho chi tiết sản phẩm --}}
    <div class="modal fade" id="modalColor" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Thêm màu</h5>
                    <button type="button" id="closeColor" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="modal-body" id="formcolor" action="{{ route('admin.product.create_product_color') }}"
                    method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name='product_id' id="productid">
                    <div class="container-fluid row mb-3">
                        <div class="col-md-12 form-group row colorupdate">
                            <div class="col-md-12 form-group">
                                <label>Màu sắc</label>
                                <select name="color_id" id="colorUpdate" style="width: 100%" class="form-control color">
                                    <option value="">--chọn màu--</option>
                                    @forelse ($colors as $item)
                                        <option value={{ $item['id'] }}>{{ $item['name'] }}</option>
                                    @empty
                                    @endforelse
                                </select>
                                <div class="error error-color_id"></div>
                            </div>
                        </div>
                        <div class="col-md-12 form-group row colorupdate">
                            <div class="col-md-12 form-group">
                                <label>Số lượng</label>
                                <input name="quantity" type="numbers" id="quantity" style="width: 100%"
                                    class="form-control color input">
                                <div class="error error-quantity"></div>
                            </div>
                        </div>
                        {{-- <div class="col-md-12 form-group row">
                            <div class="col-md-12 form-group imgInput">
                                <label>Ảnh Thêm</label>
                                <input class="form-control shadow-none rounded-0 file-img input" name="photo[]" multiple
                                    id="photo" type="file">
                                <div class="error error-photo"></div>
                            </div>
                            <div class="col-md-12 form-group">
                                <div class="listphoto d-flex flex-nowrap"></div>
                            </div>
                        </div> --}}

                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary closetype" data-dismiss="modal">Đóng</button>
                    <button class="btn btn-primary rounded-0 shadow-none" id="savecolor" type="button">Lưu</button>
                </div>
            </div>
        </div>
    </div>


    {{-- modal chỉnh sửa chi tiết sản phẩm --}}
    <div class="modal fade" id="modalEditDetailColor" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Chi Tiết</h5>
                    <button type="button" id="closeUpdateColor" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="formcolor">
                    <input type="hidden" name='product_id' id="productIdColor">
                    <div class="container-fluid row mb-3">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">Màu</th>
                                    <th class="text-center">Số lượng</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>

                            <tbody id="listColor">
                            </tbody>
                        </table>

                    </div>
                </div>
                {{-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary closetype" data-dismiss="modal">Đóng</button>
                    <button class="btn btn-primary rounded-0 shadow-none" id="listDetail" type="button">Lưu</button>
                </div> --}}
            </div>
        </div>
    </div>


    {{-- sửa chi tiết sản phẩm --}}
    {{-- modal chỉnh sửa chi tiết sản phẩm --}}
    <div class="modal fade" id="modalEditDetailProduct" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Chi Tiết</h5>
                    <button type="button" id="closeDetial" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" class="container-fluid row mb-3" id="formProductDetail"
                        enctype="multipart/form-data" action="{{ route('admin.product.update_product_detail') }}">
                        @csrf
                        <div class="col-md-12 form-update-detail"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endpush
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.28/dist/sweetalert2.all.min.js"></script>
    @include('admin.product.create_detail_script')
@endpush
