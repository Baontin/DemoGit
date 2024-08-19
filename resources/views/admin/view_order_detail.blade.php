<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')
  </head>

<style type="text/css">
    .table_deg {
        /* display: flex;
        justify-content: center;
        margin: 50px; */
        text-align: center;
        width: 90%;
        margin: auto;
        border: 2px solid yellowgreen;
        margin-top: 50px;
    }
    th {
      background-color: slateblue;
      border: 1px solid rgb(214, 225, 152);
      color: white;
      padding: 15px;
      font-size: 20px;
      font-weight: bold;
    }
    td {
      color: white;
      padding: 10px;
      border: 1px solid rgb(214, 225, 152);
    }
    
    .totalValue {
        font-size: 20px;
        font-weight: bold;
        padding: 1% 2%;
        width: 90%;
        margin: 2% auto;
        border: 1px solid white;
        color: white;
    }
    .totalValue span {
      color: crimson;

    }
</style>

  <body>
    {{-- header --}}
    @include('admin.header')
    {{-- header end --}}
    @include('admin.sidebar')
    <!-- Sidebar Navigation end-->
    <div class="page-content">
      <div class="page-header">
        <div class="container-fluid">
            
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
                    <?php $totalOrder += $order->total_value; ?>
                    <tr>
                        <td>{{$order->name}}</td>
                        <td>{{$order->product_id}}</td>
                        <td>{{$order->order_id}}</td>
                        <td>{{$order->price}}</td>
                        <td>{{$order->quantity}}</td>
                        <td>{{$order->total_value}}</td>
                        <td>
                          <img width="100" height="100" src="products/{{$order->image}}" alt="{{$order->image}}">
                        </td>
                    </tr>
                    @endforeach
                               
                 </table>    
                 <div class="totalValue">
                    Total Value: <span>${{$totalOrder}}</span>
                 </div>
            </div>

        </div>
    </div>
    </div>
    <!-- JavaScript files-->
    @include('admin.js')
  </body>
</html>