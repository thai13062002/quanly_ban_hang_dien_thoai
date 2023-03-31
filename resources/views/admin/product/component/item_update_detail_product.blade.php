<input type="hidden" name="id" class="id-product" value="{{ $porductDetail['id'] }}">
<div class="position-relative row form-group">
    <label for="name" class="col-md-3 text-md-right col-form-label">Dung lượng</label>
    <div class="col-md-9 col-xl-8">
        {{-- <input required name="capacity" placeholder="Dung lượng điện thoại" type="number"
            class="form-control capacity-update input" value="{{ $porductDetail['capacity'] }}"> --}}
        <select required name="capacity" placeholder="Dung lượng điện thoại" type="number"
            class="form-control input capacity-update">
            <option value="">--Chọn--</option>
            <option value="32" {{ $porductDetail['capacity'] == 32 ? 'selected' : '' }}>32GB</option>
            <option value="64" {{ $porductDetail['capacity'] == 64 ? 'selected' : '' }}>64GB</option>
            <option value="128" {{ $porductDetail['capacity'] == 128 ? 'selected' : '' }}>128GB</option>
            <option value="256" {{ $porductDetail['capacity'] == 256 ? 'selected' : '' }}>256GB</option>
            <option value="512" {{ $porductDetail['capacity'] == 512 ? 'selected' : '' }}>512GB</option>
        </select>
        <p>
        <div class="error error-capacity"></div>
        </p>
    </div>
</div>
<div class="position-relative row form-group">
    <label for="name" class="col-md-3 text-md-right col-form-label">Giá nhập</label>
    <div class="col-md-9 col-xl-8">
        <input required name="price_import" placeholder="Giá nhập" type="number"
            class="form-control price_import-update input" value={{ $porductDetail['price_import'] }}>
        <p>
        <div class="error error-price_import"></div>
        </p>
    </div>
</div>
<div class="position-relative row form-group">
    <label for="name" class="col-md-3 text-md-right col-form-label">Giá bán</label>
    <div class="col-md-9 col-xl-8">
        <input required name="price_sell" placeholder="Giá bán" type="number"
            class="form-control price_sell-update input" value={{ $porductDetail['price_sell'] }}>
        <p>
        <div class="error error-price_sell"></div>
        </p>
    </div>
</div>
<div class="position-relative row form-group">
    <label for="content" class="col-md-3 text-md-right col-form-label">Ảnh thêm</label>
    <div class="col-md-6">
        <input name="img[]" id="imageUpload" type="file" multiple class="form-control input">
        <p>
        <div class="error error-img"></div>
        </p>
    </div>

</div>
<div class="position-relative row form-group">
    <div class="col-md-12 row">
        @foreach ($porductDetail['img'] as $item)
            <div class="col-md-4 mb-2 d-flex flex-column justify-content-md-center item-img" style="height: 50px">
                <img src="{{ asset('storage/ProductDetail/' . $item['path']) }}" alt=""
                    style="width: 100%;height:100%">
                <button type="button" class="btn btn-hover-shine btn-outline-danger border-0 btn-sm remove-img"
                    data-id="{{ $item['id'] }}"> <i class="bi bi-trash"></i></button>
            </div>
        @endforeach
    </div>
</div>
<div class="position-relative row form-group mb-1 mt-2">
    <div class="col-md-12 text-right col-xl-12">
        <button type="button" id="update" class="btn-shadow btn-hover-shine btn btn-primary">
            <span class="btn-icon-wrapper pr-2 opacity-8">
                <i class="bi bi-download"></i>
            </span>
            <span>Lưu</span>
        </button>
    </div>
</div>
