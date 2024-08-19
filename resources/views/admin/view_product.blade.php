<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')
  </head>

<style type="text/css">
    .div_deg {
        display: flex;
        justify-content: center;
        align-item: center;
        margin: 30px;
    }

    .table_deg {
        border: 1px solid yellowgreen;
        text-align: center;
        width: 100%;
    }
    th {
        background-color: slateblue;
        border: 1px solid white;
        color: white;
        padding: 15px;
        font-size: 20px;
        font-weight: bold;
    }
    td {
        color: white;
        padding: 15px;
        border: 1px solid rgb(214, 225, 152);
    }

    input[type="text"] {
        width: 500px;
        height: 50px;
        padding-left: 10px;
        border-radius: 4px;
        border: none;
        margin-right: 5px;
    }

   

</style>

  <body>
    {{-- @if (session()->has('success'))
        
        <script>
            alert("{{session('success')}}");
        </script>
        
    @endif --}}
    {{-- header --}}
    @include('admin.header')
    {{-- header end --}}
    @include('admin.sidebar')
    <!-- Sidebar Navigation end-->
    <div class="page-content">
      <div class="page-header">
        <div class="container-fluid">
            <h2 style="color: white">Product List</h2>

            <div class="div_deg">
                <form  action="{{url('product_search')}}" method="get">
                @csrf
                    <input type="text" name="search" placeholder="Search">
                    <input type="submit" class="btn btn-secondary m-0">
                </form>
            </div>

            <div class="div_deg">
                <table class="table_deg">
                    <tr>
                        <th>Product Title</th>
                        <th>Category</th>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Price</th>         
                        <th>Image</th>
                        <th colspan="2">Activity</th>
                    </tr>
                    @foreach ($products as $product)
                    <tr>
                        <td>{{$product->title}}</td>
                        <td>{{$product->category}}</td>
                        <td>{!!Str::limit($product->description, 50)!!}</td>
                        <td>{{$product->quantity}}</td>
                        <td>${{$product->price}}</td>

                        <td>
                            <img width="70" height="70" src="products/{{$product->image}}" alt="">    
                        </td>

                        <td class="bd-none">
                            {{-- EDIT --}}
                            <a class="btn btn-warning px-3 my-2" href="{{url('edit_product', $product->id)}}">
                                <i class="bi bi-pencil"></i>
                            </a>
                            {{-- DELETE --}}
                            <a class="btn btn-danger px-3" onclick="confirmation(event)"
                               href="{{url('delete_product', $product->id)}}">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                        {{-- <td class="bd-none">
                            
                        </td> --}}
                    </tr>
                    @endforeach
                </table>
            </div>

            <div class="div_deg">
                {{-- It can show 100 page, so give it rule -> show a range of number --}}
                {{$products->onEachSide(1)->links()}}
            </div>

        </div>
      </div>
    </div>
    <!-- JavaScript files-->
    @include('admin.js')
  </body>
</html>