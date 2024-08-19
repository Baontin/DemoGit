<!DOCTYPE html>
<html>

<head>
    @include('home.css')
</head>

<body>
  <div class="hero_area">
    <!-- header section strats -->
    @include('home.header')
    <!-- end header section -->
    <!-- slider section -->

    @include('home.slider')

    <!-- end slider section -->
  </div>
  <!-- end hero area -->

  <!-- shop section -->

<section class="shop_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Shop
        </h2>
      </div>

      <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 mt-4">
            <div class="list-group">
                <a href="{{url('shop')}}" class="list-group-item {{Request::is('shop') ? 'bg-info text-white' : 'text-muted'}} ">All Categories</a>
                @foreach ($categories as $category)
                    <a href="{{url('shop', $category->category_name)}}" 
                        class="list-group-item list-group-item-action {{Request::is('shop/' . $category->category_name) ? 'active' : ''}}">
                        {{$category->category_name}}
                    </a>
                @endforeach
                {{-- <a href="#" class="list-group-item list-group-item-action">Danh mục 2</a>
                <a href="#" class="list-group-item list-group-item-action">Danh mục 3</a>
                <a href="#" class="list-group-item list-group-item-action">Danh mục 4</a> --}}
            </div>
        </div>

        <!-- Products -->
        <div class="col-md-9">
            <div class="row">
                @foreach ($products as $product)
                    <!-- Product  -->
                    <div class="col-md-4">
                        <div class="box rounded">
                            <a  href="{{url('product_details', $product->id)}}">
                              <div style="padding: 0;" class="img-box">
                                <img src="/products/{{$product->image}}" alt="">
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
                                  <a class="btn btn-warning text-white" href="
                                  {{url('add_cart', $product->id)}}">Add To Cart
                                  </a>
                                @else
                                <span style="cursor: not-allowed;" class="btn btn-secondary">Sold Out</span>
                                @endif
                              </div>
                          </div>
                    </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-center mt-5">
              
              {{$products->onEachSide(1)->links()}}
            </div>
        </div>

    </div>
</section>

  <!-- end shop section -->







  <!-- contact section -->

@include('home.contact')

  <!-- end contact section -->

   

  <!-- info section -->

  @include('home.footer')

</body>

</html>