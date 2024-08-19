<!DOCTYPE html>
<html>

<head>
    @include('home.css')
</head>
<style type="text/css">
    .table_deg {
        /* display: flex;
        justify-content: center;
        margin: 50px; */
        text-align: center;
        width: 80%;
        margin: auto;
        border: 2px solid black;
        margin-top: 50px;
    }
    th {
        border: 1px solid white;
        background-color: #5b4848;
        color: white;
        padding: 15px;
        font-size: 20px;
        font-weight: bold;
    }
    td {
      /* color: white; */
      padding: 10px;
      border: 1px solid rgb(214, 225, 152);
    }
    
    .totalValue {
        font-size: 20px;
        font-weight: 600;
        padding: 1% 2%;
        width: 80%;
        margin: 2% auto;
        border: 1px solid black;
        /* color: white; */
    }
    .totalValue span {
      color: crimson;

    }
</style>
<body>
  <div class="hero_area">
    <!-- header section strats -->
    @include('home.header')
    <!-- end header section -->
  </div>
  <!-- end hero area -->


  <div class="div_deg">
        <h2 style="color: white">Order Detail List</h2>
        <table class="table_deg">
            <tr>
                <th>Name Product</th>
                <th>Product Id</th>
                <th>Order ID</th>
                <th>Price</th>
                <th>QTY</th>
                <th>Total Product</th>
                <th>Image</th>    
            </tr>

            <?php $totalOrder = 0; ?>
            @foreach ($orders as $order)
    
            <tr>
                <td>{{$order->name}}</td>
                <td>{{$order->product_id}}</td>
                <td>{{$order->order_id}}</td>
                <td>{{$order->price}}</td>
                <td>{{$order->quantity}}</td>
                <td>{{number_format($order->total_value, 2);}}</td>
                <td>
                <img width="100" height="100" src="/products/{{$order->image}}" alt="{{$order->image}}">                
                </td>
            </tr>

            <?php
             $totalOrder += $order->total_value; 
             $totalOrder = number_format($totalOrder, 2);
            ?>
            @endforeach
                    
        </table>    
        <div class="totalValue">
            Total Value: <span>${{$totalOrder}}</span>
        </div>
    </div>

   

  <!-- info section -->

  @include('home.footer')

</body>

</html>