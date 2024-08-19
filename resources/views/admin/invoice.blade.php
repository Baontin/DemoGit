<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style type="text/css">
    * {
        font-family: DejaVu Sans, sans-serif;
    }
    .table_deg {
        text-align: center;

        border: 2px solid #ccc;
        margin-top: 50px;
        border-collapse: collapse;
    }
    th {
      background-color: slateblue;
      /* border: 1px solid black(214, 225, 152); */
      color: white;
      padding: 15px;
      font-size: 20px;
      font-weight: bold;
    }
    td {
      color: black;
      padding: 10px;
      border: 1px solid black;
    }
    
</style>
<body>
    <center><h1>History Of Order</h1></center>
    <div class="container">
        <div>
            Customer: <b>{{$order->name}}</b> <br>
            Phone: <b>{{$order->phone}}</b> <br>
            Address: <b>{{$order->rec_address}}</b> <br>
        </div>
        <p style="font-size: 18px; line-height: 20px;">
            You have ordered our's products at <b>{{$order->created_at}}</b>. <br>
            Your id order is: <b> {{$order->id}}</b>; <br>
            Total order is: <b style="color: crimson;">{{$order->total_order}}</b>; <br>
            We hope in next time. You will come with us again. Thanks!!!
        </p>

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
            @foreach ($data as $data)
            <?php $totalOrder += $data->total_value; ?>
            <tr>
                <td>{{$data->name}}</td>
                <td>{{$data->product_id}}</td>
                <td>{{$data->order_id}}</td>
                <td>{{$data->price}}</td>
                <td>{{$data->quantity}}</td>
                <td>{{$data->total_value}}</td>
                <td>
                    <img width="100" height="100" src="{{asset('/products/'. $data->image)}}">
                    {{-- <img src="/products/{{$data->product->image}}" alt="" height="250" width="250"> --}}

                </td>                                                    
                
            </tr>
            @endforeach
                       
         </table>  
    </div>

</body>
</html>