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
                <h2 style="color: white">Order List</h2>
                <table class="table_deg">
                    <tr>
                        <th>id</th>
                        <th>Order Name</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Total Order</th>
                        {{-- <th>Date</th> --}}
                        <th>Status</th>
                        <th>Change Status</th>
                        <th>Print</th>
                        <th>Details</th>
                        
                    </tr>

                    @foreach ($data as $data)
                    <tr>
                      <td>{{$data->id}}</td>
                      <td>{{$data->name}}</td>
                      <td>{{$data->phone}}</td>
                      <td>{{$data->rec_address}}</td>
                      <td>{{$data->total_order}}</td>
                      {{-- <td>{{$data->created_at}}</td> --}}
                      <td>
                        @if ($data->status === 'On The Way')
                            <span>{{$data->status}}</span>                        
                        @elseif ($data->status === 'Delivered')
                            <span>{{$data->status}}</span>
                        @else
                            <span class="text-warning">{{$data->status}}</span>
                        @endif
                      </td>
                      <td>
                        <a class="btn btn-warning mb-2" href="{{url('on_the_way', $data->id)}}">On The Way</a>
                        <a class="btn btn-success" href="{{url('delivered', $data->id)}}">Delivered</a>
                      </td>
                      <td>
                        <a class="btn btn-danger" href="{{url('print_pdf', $data->id)}}">
                          <i class="bi bi-filetype-pdf"></i>
                        </a>
                      </td>
                      <td>
                        <a class="btn text-warning" href="{{url('view_ad_order_detail', $data->id)}}">See More..</a>
                      </td>
        
                  </tr>
                    @endforeach
                                
                 </table>    
            </div>

        </div>
    </div>
    </div>
    <!-- JavaScript files-->
    @include('admin.js')
  </body>
</html>