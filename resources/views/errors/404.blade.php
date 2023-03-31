@extends('user.layout.main')

@section('content')
<section class="error-section text-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-12">
                <div class="error-box">
                    <h1 class="error-code">404</h1>
                    <p class="error-description">Xin lỗi, trang bạn đang tìm không tồn tại.</p>
                    <a href="{{ route('user.product.index') }}" class="btn btn-primary">Về trang chủ</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection