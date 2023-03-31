@extends('user.layout.main')
@push('css')
    <style>
        .item-color {
            color: black;
            border: 1px solid #ebebeb;
            padding: 10px 10px 10px 10px;
            font-weight: 700;
        }

        a:hover,
        a:focus {
            text-decoration: none;
            outline: none;
            color: #000000;
        }

        .color-active {
            background-color: #e7ab3c;
        }

        .sc-item label {
            width: auto !important;
            padding-left: 5px;
            padding-right: 5px;
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
                        <a href="index.html"><i class="fa-fa-home"></i>Home</a>
                        <a href="shop.html">Shop</a>
                        <span>Detail</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- End -->
    @php
        // dd($product);
    @endphp
    <section class="product-shop spad page-details">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="product-pic-zoom">
                                <img class="product-big-img"
                                    src="{{ asset('storage/Product/' . '/' . $product['img'][0]['path']) }}" alt="">
                                <a href=""></a>
                            </div>
                            <div class="product-thumbs">
                                <div class="product-thumbs-track ps-slider owl-carousel">
                                    @forelse ($product['product_detail'] as $item)
                                        <div class="pt active" data-imgbigurl="img/product-single/product-1.jpg">
                                            <img src="{{ asset('storage/ProductDetail/' . '/' . $item['img'][0]['path']) }}"
                                                alt="">
                                        </div>
                                    @empty
                                    @endforelse
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="product-details">
                                <div class="pd-title">
                                    <h3>{{ $product['name'] }}</h3>
                                </div>
                                <div class="pd-desc">
                                    {{-- <p>Loren ipsum dolor sit amet, consectetur img elit, sed do ...
                                        sit amet, consectetur adipisicing elit , sed do mod temper</p> --}}
                                    @php
                                        $key = array_search($capcityId, array_column($product['product_detail'], 'id')) ?? 0;
                                    @endphp
                                    <h4>{{ number_format($product['product_detail'][$key]['price_sell'], 0, ',', ',') }} Đ
                                    </h4>
                                </div>
                                <div class="pd-size-choose">
                                    {{-- Dung lượng --}}
                                    @php
                                        $listColor = $product['product_detail'][0];
                                    @endphp
                                    @forelse ($product['product_detail'] as $item)
                                        @if ($capcityId && $capcityId == $item['id'])
                                            @php
                                                $listColor = $item;
                                            @endphp
                                        @endif
                                        <a href="{{ route('user.product.product_detail', ['capcityId' => $item['id'], 'id' => $product['id']]) }}"
                                            class="sc-item">
                                            {{-- <input type="radio"> --}}
                                            <label for="sm-size"
                                                class="{{ $capcityId ? ($capcityId == $item['id'] ? 'active' : '') : ($loop->first ? 'active' : '') }}">
                                                {{ $item['capacity'] }}GB</label>
                                        </a>
                                    @empty
                                    @endforelse

                                </div>
                                <div class="pd-color">
                                    <h6>Color</h6>
                                    @php
                                        $index = 0;
                                    @endphp
                                    <div class="pd-color-choose">
                                        @foreach ($listColor['color_detail'] as $key => $item)
                                            @if ($colorId && intval($colorId) == $item['color_id'])
                                                @php
                                                    $index = $key;
                                                @endphp
                                            @endif
                                            <a class="item-color ml-1 {{ $colorId ? (intval($colorId) == $item['color_id'] ? 'color-active' : '') : ($loop->first ? 'color-active' : '') }}"
                                                href="{{ route('user.product.product_detail', [
                                                    'id' => $product['id'],
                                                    'capcityId' => $listColor['id'],
                                                    'colorId' => $item['color_id'],
                                                ]) }}">
                                                <label for="sm-size">
                                                    {{ $item['color']['name'] }}</label>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                                @php
                                    // dd($listColor);
                                @endphp
                                <div class="pd-qty text-dark">
                                    <p>Số lượng : {{ $listColor['color_detail'][$index]['quantity'] }}</p>
                                </div>
                                <div class="quantity">
                                    <div class="quantity">
                                        <div class="pro-qty">
                                            <input type="text" value="1">
                                        </div>
                                        <a href="#" class="primary-btn">Add To Cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-tab">
                        <div class="tab-item">
                            <ul class="nav" role="tablist">
                                <li><a class="active" href="#tab-1" data-toggle="tab" role="tab">DESCRIPTION</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-item-content">
                            <div class="tab-content">
                                <div class="tab-pane fade-in active" id="tab-1" role="tabpanel">
                                    <div class="product-content">
                                        <div class="row">
                                            <div class="col-lg-7">
                                                <p>{{ $product['description'] }}</p>
                                            </div>
                                            <div class="col-lg-5">
                                                <img src="img/product-single/tab-desc.jpg" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('js')
    <script>
        $('.sc-item').click(function() {
            console.log($(this).attr('href'))
        })
    </script>
@endpush
