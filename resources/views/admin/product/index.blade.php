@extends('admin.layout.main')
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

                <div class="page-title-actions">
                    <a href="{{ route('admin.product.create') }}" class="btn-shadow btn-hover-shine mr-3 btn btn-primary">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="bi bi-plus"></i>
                        </span>
                        Thêm mới
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">

                    {{-- <div class="card-header">

                        <form>
                            <div class="input-group">
                                <input type="search" name="search" id="search" placeholder="Search everything"
                                    class="form-control">
                                <span class="input-group-append">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-search"></i>&nbsp;
                                        Search
                                    </button>
                                </span>
                            </div>
                        </form>

                        <div class="btn-actions-pane-right">
                            <div role="group" class="btn-group-sm btn-group">
                                <button class="btn btn-focus">This week</button>
                                <button class="active btn btn-focus">Anytime</button>
                            </div>
                        </div>
                    </div> --}}
                    <div class="card-header">
                        <form action="{{ route('admin.product.index') }}">
                            <div class="input-group">
                                <input type="search" name="search" id="search" placeholder="Tìm sản phẩm"
                                    class="form-control" value="{{ request()->input('q') }}">

                                <span class="input-group-append">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-search"></i>
                                        Tìm kiếm
                                    </button>
                                </span>
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Trạng thái</th>
                                    <th class="text-center">Ảnh</th>
                                    <th>Tên</th>
                                    <th class="text-center">Nhãn hàng</th>
                                    <th class="text-center">Thể loại</th>
                                    <th class="text-center">Số lượng</th>
                                    <th class="text-center">Nổi bật</th>
                                    <th class="text-center">Hành động</th>
                                </tr>
                            </thead>

                            <tbody>
                                @php
                                    $id = 0;
                                @endphp
                                @if ($listProduct->total() > 0)
                                    @forelse ($listProduct as $item)
                                        @php
                                            $id++;
                                        @endphp
                                        <tr>

                                            <td class="text-center text-muted">{{ $id }}</td>
                                            <td class="text-center text-muted">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" value="{{ $item['id'] }}"
                                                        class="custom-control-input status-check"
                                                        id="customSwitches-{{ $item['id'] }}"
                                                        {{ $item['status'] ? 'checked' : '' }}>
                                                    <label class="custom-control-label"
                                                        for="customSwitches-{{ $item['id'] }}"></label>
                                                </div>
                                            </td>
                                            <td class="text-center text-muted"><img
                                                    src="{{ asset('storage/Product' . '/' . $item['img'][0]['path']) }}"
                                                    alt="" style="height: 100px;">
                                            </td>
                                            <td class="text-center">{{ $item['name'] }}</td>
                                            <td class="text-center">{{ $item['brand']['name'] }}</td>
                                            <td class="text-center">
                                                {{ $item['category']['name'] }}
                                            </td>
                                            <td class="text-center">{{ $item['quantity'] }}</td>
                                            <td class="text-center"><input type="checkbox" class="check-outstanding"
                                                    {{ $item['is_outstanding'] ? 'checked' : '' }}
                                                    value="{{ $item['id'] }}"></td>
                                            <td class="text-center">
                                                <a data-id={{ $item['id'] }} data-toggle="modal"
                                                    data-target="#modalDetailProduct" data-toggle="tooltip"
                                                    data-original-title="Chi tiết"
                                                    class="btn btn-hover-shine btn-outline-primary border-0 btn-sm detail-product">
                                                    Chi tiết
                                                </a>
                                                <a href="{{ route('admin.product.edit', ['id' => $item['id']]) }}"
                                                    data-toggle="tooltip" title="Edit" data-placement="bottom"
                                                    class="btn btn-outline-warning border-0 btn-sm">
                                                    <span class="btn-icon-wrapper opacity-8">
                                                        <i class="bi bi-tools"></i>
                                                    </span>
                                                </a>
                                                <form class="d-inline" action="{{ route('admin.product.delete_product') }}"
                                                    method="post">
                                                    @method('DELETE')
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $item['id'] }}">
                                                    <button class="btn btn-hover-shine btn-outline-danger border-0 btn-sm"
                                                        type="submit" data-toggle="tooltip" title="Delete"
                                                        data-placement="bottom"
                                                        onclick="return confirm('Bạn có chắc chắn xoá bản ghi này')">
                                                        <span class="btn-icon-wrapper opacity-8">
                                                            <i class="bi bi-trash"></i>
                                                        </span>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse
                                @else
                                    <tr>
                                        <td colspan="8" class="">Không tìm thấy bản ghi nào</td>
                                    </tr>
                                @endif



                            </tbody>
                        </table>
                    </div>

                    <div class="d-block card-footer">
                        <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between">
                            <div class="flex justify-between flex-1 sm:hidden">
                                <span
                                    class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md">
                                    « Previous
                                </span>

                                <a href="#page=2"
                                    class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                                    Next »
                                </a>
                            </div>

                            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">

                                <div>

                                    {{ $listProduct->links() }}
                                    {{-- <span class="relative z-0 inline-flex shadow-sm rounded-md">
                                        <span aria-disabled="true" aria-label="&amp;laquo; Previous">
                                            <span
                                                class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default rounded-l-md leading-5"
                                                aria-hidden="true">
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                            </span>
                                        </span>
                                        <span aria-current="page">
                                            <span
                                                class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5">1</span>
                                        </span>
                                        <a href="#page=2"
                                            class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:text-gray-500 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150"
                                            aria-label="Go to page 2">
                                            2
                                        </a>

                                        <a href="#page=2" rel="next"
                                            class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-r-md leading-5 hover:text-gray-400 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150"
                                            aria-label="Next &amp;raquo;">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </a>
                                    </span> --}}
                                </div>
                            </div>
                        </nav>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@push('modal')
    <div class="modal fade" id="modalDetailProduct" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Chi Tiết</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="mb-4" id="listDetail">

                </div>
            </div>
        </div>
    </div>
@endpush
@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.detail-product').on('click', function() {
                let id = $(this).attr('data-id')
                var url = '{{ route('admin.product.list_product_detail', ':id') }}';
                url = url.replace(':id', id);
                $.ajax({
                    url: url,
                    success: function(result) {
                        console.log(result)
                        $('#listDetail').empty();
                        $('#listDetail').append(result);
                    },
                    error: function(error) {
                        console.log('www', error);
                    }
                })
            })
            $('.status-check').on('click', function() {
                console.log($(this).val(), $(this).is(":checked"))
                let product_id = $(this).val();
                let status = $(this).is(":checked") ? 1 : 0;
                $.ajax({
                    url: "{{ route('admin.product.change_status') }}",
                    type: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        product_id: product_id,
                        status: status
                    },
                    success: function(result) {
                        console.log(result)
                    },
                    error: function(error) {
                        console.log('www', error);
                    }
                })
            })
            $(document).on('click', '.check-outstanding', function() {
                console.log($(this).is(':checked') ? 'co check' : 'khong check');
                let check = $(this).is(':checked') ? 1 : 0
                let product_id = $(this).val();
                $.ajax({
                    url: "{{ route('admin.product.change_outstanding') }}",
                    type: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        product_id: product_id,
                        is_outstanding: check
                    },
                    success: function(result) {
                        console.log(result)
                    },
                    error: function(error) {
                        console.log('www', error);
                    }
                })
            })
        })
    </script>
@endpush
