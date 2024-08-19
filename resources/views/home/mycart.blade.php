<!DOCTYPE html>
<html>

<head>
    @include('home.css')
</head>

<style>
    .div_deg {
        display: flex;
        justify-content: center;
        align-content: center;
        margin: 60px;
        /* border: 2px solid black; */
    }
    table {
        border: 2px solid black;
        text-align: center;
        width: 90%;
    }
    th {
        border: 2px solid black;
        text-align: center;
        color: white;
        font-size: 20px;
        font-weight: bold;
        background-color: rgb(61, 55, 55);
    }
    td {
        border: 1px solid red;
        padding: 5px;
    }

    .submit_cart {
        width: 50%;
        margin: 5% auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .total_value {
        width: fit-content;
        /* margin: 5% auto; */
        padding: 15px 15px 5px 15px;
        /* background-color: slateblue; */
        border: 2px solid black;
        border-radius: 10px;
        /* color: white; */
    }

    .quantity .quantity_number {width: 50px;}


</style>

<body>
  <div class="hero_area">
    <!-- header section strats -->
    @include('home.header')
    <!-- end header section -->


    <?php $totalValue = 0; ?>


    <div class="div_deg">

        <table>
            <tr>
                <th>Product Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Quantity</th>
                <th>Activity</th>
            </tr>

            @foreach ($cart as $carts)
            <tr>
                <td>{{$carts->product->title}}</td>
                <td>{{$carts->product->price}}</td>
                <td>
                    <img class="border rounded" width="80" src="/products/{{$carts->product->image}}" alt="{{$carts->product->image}}">
                </td>

                <td>
                    <div  class="quantity">
                        <a href="{{url('decrease_quantity', $carts->id)}}" class="btn"><i class="fa fa-minus"></i></a>
                            <input class="quantity_number" type="text" value="{{$carts->quantity}}">
                        <a href="{{url('increase_quantity', $carts->id)}}" class="btn"><i class="fa fa-plus"></i></a>
                    </div>
                </td>

                <td>
                    <a class="btn btn-danger px-4" href="{{url('delete_cart', $carts->id)}}">
                        <i class="bi bi-trash"></i>
                    </a>
                </td>
            </tr>

            <?php 
            // $price = $carts->product->price;
            $price2 = (float)$carts->product->price;
            $quantity = (int)$carts->quantity;
            $totalValue += $price2 * $quantity; 
            // echo "Price: $price, Total Value: $totalValue";
            ?>

            @endforeach
        </table>
    </div>

    <div class="submit_cart">
        <div class="total_value">
            <h3>Total Value: $<b class="text-success">{{number_format($totalValue, 2)}}</b></h3>
        </div>

        <div>
        @if ($count > 0)
                <a style="padding: 5px 15px; font-size: 25px;" class="btn btn-danger" href="{{url('place_order')}}">
                    Place Order
                </a>
        @else 
            <button style="padding: 5px 15px; font-size: 25px;" class="btn btn-secondary" disabled>
            Place Order
            </button>
        @endif
        </div>


    </div>
    



  <!-- info section -->

  @include('home.footer')

</body>

</html>