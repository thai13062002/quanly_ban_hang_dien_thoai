  @foreach ($listProduct as $item)
      <div class="col-lg-4 col-sm-6">
          <div class="product-item">
              <div class="pi-pic">
                  <img src="{{ asset('storage/Product' . '/' . $item['img'][0]['path']) }}" alt="">
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
  @endforeach
