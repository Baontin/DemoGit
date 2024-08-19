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
  </div>
  <!-- end hero area -->

    <?php //$totalOrder = number_format($totalOrder, 2) ?>

    <div class="row justify-content-center my-5">
        <div class="col-6">
            <h2 class="text-center">Check Infomation</h2>
            <hr>
            <form action="{{url('confirm_order')}}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="">Receiver Name</label>
                    <input type="text" name="name" class="form-control" value="{{Auth::user()->name}}">
                </div>

                <div class="mb-3">
                    <label for="">Receiver Address</label>
                    <input type="text" name="address" class="form-control" value="{{Auth::user()->address}}">
                </div>

                <div class="mb-3">
                    <label for="">Receiver Phone</label>
                    <input type="text" name="phone" class="form-control" value="{{Auth::user()->phone}}">
                </div>

                <div class="mb-5">
                    <label for="">Total Order</label>
                    <input style="font-size: 18px; font-weight: 600;" type="text" name="totalOrder" 
                            class="form-control text-danger" 
                            value="${{number_format($totalOrder, 2)}}" readonly>
                </div>

                <p class="text-center">
                    <button type="submit" class="btn btn-primary mr-5">Cash On Delivery</button>
                    <a class="btn btn-success" href="{{url('stripe', $totalOrder)}}">Visa Payment</a>
                </p>

            </form>
        </div>
    </div>


   

  <!-- info section -->

  @include('home.footer')

</body>

</html>


