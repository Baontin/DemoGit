<!DOCTYPE html>
<html>

<head>
    @include('home.css')
</head>

<style type="text/css">
  .container {
    font-size: 18px;
  }
  .div_deg {
    height: fit-content;
    
  }

  .column2 > div > * {
    margin-bottom: 20px;
    color: rgb(56, 49, 49);
  }
  .column2 > div > .col2_qty {font-size: 16px; }
  .column2 > div > .col2_qty > i {
    font-size: 25px;
    padding: 0 2px;
  }
  .column2 > div > .col2_qty > span {
    font-size: 20px;
  }
  .column2 > div > .col2_qty > :nth-child(2) {
    font-weight: 600;
  }
  .col2_price > span {
    font-size: 25px;
    font-weight: 600;
  }
</style>

<body>
  <div class="hero_area">
    <!-- header section strats -->
    @include('home.header')
    <!-- end header section -->

  </div>
  <!-- end hero area -->

  <!-- product section -->

  <section class="shop_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Product Detail
        </h2>
      </div>

      <div class="row rounded">
        <div class="col-md-12 rounded">
            
            <div class="div_deg row d-flex justify-content-center rounded border mb-5">
                <div class="col column1 bg-light text-center rounded h-100">
                    <div class="my-4">
                        <img height="400" width="350" src="/products/{{$product->image}}" alt="">
                        {{-- <hr> --}}
                    </div>
                    {{-- <div class="d-flex align-items-end">
                        <img width="70" src="/products/{{$product->image}}" alt="">
                        <img width="70" src="/products/{{$product->image}}" alt="">
                        <img width="70" src="/products/{{$product->image}}" alt="">
                    </div> --}}
                </div>
                <div class="col column2 h-100">
                    <div class="my-4">
                        <h4>{{$product->title}}</h4>

                        <p class="col2_qty">
                            <i class="bi bi-basket"></i> : 
                            @if ($product->quantity > 0)
                              <span class="text-success">{{$product->quantity}}</span>  orders
                              <span class="text-success"> (In stock) </span>
                            @else
                              <span class="text-danger">{{$product->quantity}}</span>  orders
                              <span class="text-danger"> (In stock) </span>
                            @endif
                        </p>

                        <div class="col2_price">
                            <span class="text-danger">${{$product->price}}</span> /per box
                        </div>

                        <p>{!!nl2br($shortDescription)!!}</p>

                        <hr class="bg-warning">

                        <div>
                          @if ($product->quantity > 0)
                          <a href="{{url('buy_now', $product->id)}}" class="btn btn-success px-3 mr-2">Buy now</a>
                          <a href="{{url('add_cart', $product->id)}}" class="btn btn-warning">Add To Cart</a>
                          @else
                          <span style="cursor: not-allowed;" class="btn btn-secondary">Sold Out</span>
                          @endif
                        </div>

                    </div>
                </div>
            </div>
            <div class="row border">
              <div class="p-3 w-100">
                <h2 class="text-center mb-4">Description</h2>
                
                @if (strlen($product->description) > 2000)
                  <!-- Mô tả ngắn gọn -->
                  <div id="short-description">
                    <p>{!! nl2br(Str::words($product->description, 2000)) !!}</p>
                  </div>

                  <!-- Hiện xem thêm -->
                  <div class="text-center">
                    <a class="readmore btn btn-secondary" href="javascript:void(0);" onclick="toggleDescription()">Readmore</a>
                  </div>

                  <!-- Mô tả đầy đủ -->
                  <div style="display: none;" id="full-description">
                      <p>{!! nl2br($product->description) !!}</p>
                  </div>
                 
                @else 
                  <div id="full-description_2">
                    <p>{!! nl2br($product->description) !!}</p>
                  </div>
                @endif

              </div>
            </div>

            
          
        </div>
      </div>

    </div>
  </section>

  <!-- end product section -->







  <!-- contact section -->

@include('home.contact')

  <!-- end contact section -->

   

  <!-- info section -->

  @include('home.footer')

</body>

</html>