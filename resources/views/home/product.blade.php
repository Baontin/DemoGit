<section class="shop_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Latest Products
        </h2>
      </div>
      <div class="row border rounded">

        @foreach ($products as $product)     

        <div class="col-sm-6 col-md-4 col-lg-3">         
          <div class="box rounded">
            <a  href="{{url('product_details', $product->id)}}">
              <div style="padding: 0;" class="img-box">
                <img src="products/{{$product->image}}" alt="">
              </div>
              <div class="detail-box pb-1"><h6>{!!Str::limit($product->title, '26')!!}</h6></div>
              <div class="detail-box">
                <h6>
                  Price: $<span>{{$product->price}}</span>
                </h6>
              </div>
              {{-- <div class="new">
                <span>
                  New
                </span>
              </div> --}}
            </a>
              <hr>
              <div class="d-flex justify-content-between">
                @if ($product->quantity > 0)
                  <a href="{{url('buy_now', $product->id)}}" class="btn btn-success text-white">Buy now</a>
                  <a class="btn btn-warning text-white" 
                      href="{{url('add_cart', $product->id)}}">Add To Cart
                  </a>
                @else
                  <span style="cursor: not-allowed;" class="btn btn-secondary">Sold Out</span>
                @endif
              </div>
          </div>
        </div>

        @endforeach
        
      <div style="width:100%; text-align:center; margin: 50px 0;">
        <a class="btn btn-danger" href="{{url('shop')}}">View More</a>
      </div>
      </div>
    </div>
  </section>