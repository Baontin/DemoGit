<!DOCTYPE html>
<html>

<head>
    @include('home.css')
</head>

<style type="text/css">
  .div_deg_1 {
    width: 90%;
    margin: auto;
  }

  /* ========================== */

  .div_deg_2 {
    display: flex;
    justify-content: center;
    align-items: center;
    /* border: 1px solid black; */
    margin: 20px;
  }

  .table_deg {
    border: 1px solid black;
    text-align: center;
    width: 100%;
    font-size: 18px;
    
  }
  th {
    font-weight: 600;
    padding: 5px;
    border: 1px solid white;
    background-color: rgb(30, 29, 29);
    color: white;
  }
  td {
    padding: 5px 8px;
  }
</style>

<body>
  <div class="hero_area">
    <!-- header section strats -->
    @include('home.header')
    <!-- end header section -->

  </div>
  <!-- end hero area -->

  <!-- shop section -->

  <section class="shop_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          My Personal
        </h2>

        <div class="container mt-4 border border-dark rounded">
            <div class="row p-5">
                <!-- Sidebar -->
                <div class="col-md-3 border-right border-dark">
                    <div class="list-group">
                      <a href="#order-history" class="list-group-item list-group-item-action active" data-toggle="list">Order History</a>
                        <a href="#customer-info" class="list-group-item list-group-item-action" data-toggle="list">Customer Information</a>
                        <a href="#account-info" class="list-group-item list-group-item-action" data-toggle="list">Account Information</a>                     
                        @if (Auth::user()->usertype === 'admin')
                            <a href="{{url('admin/dashboard')}}" class="list-group-item list-group-item-action">Dashboard</a>
                        @endif
                    </div>                
                                    
                </div>
                <!-- Main Content -->
                <div class="col-md-9">
                    <div class="tab-content">
                        <!-- Order History -->
                        <div class="tab-pane fade show active" id="order-history">
                          <h3>Order History</h3>
                          <hr>
                          {{-- <p>Đây là lịch sử đơn hàng của bạn.</p> --}}
                          <!-- Thêm lịch sử đơn hàng cụ thể tại đây -->
                          <div class="div_deg_2">
                            <table border="1" class="table_deg">
                              <tr>
                                <th>ID Order</th>
                                <th>Customer Name</th>
                                <th>Address</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Details</th>
                              </tr>

                              @foreach ($orders as $order)
                              <tr>
                                <td>{{$order->id}}</td>
                                <td>{{$order->name}}</td>
                                <td>{{$order->rec_address}}</td>
                                <td>{{$order->total_order}}</td>
                                <td>
                                  @if ($order->status === 'Delivered')
                                    <span class="text-success bold">{{$order->status}}</span>
                                  
                                  @elseif ($order->status === 'On The Way')
                                    <span class="text-warning bold">{{$order->status}}</span>
                                  
                                  @else 
                                    <span class="">{{$order->status}}</span>
                                  @endif
                                </td>
                                <td>
                                  <a class="text-danger" href="{{url('view_order_detail', $order->id)}}">See more..</a>
                                  
                                </td>
                              </tr>
                              @endforeach
                          
                          </table>
                          </div>
                          <div class="div_deg_2">
                            {{$orders->onEachSide(1)->links()}}                            
                          </div>
                        </div>
                        <!-- Customer Info -->
                        <div class="tab-pane fade " id="customer-info">
                          <h3>Customer Infomation</h3>
                          {{-- <p>Đây là thông tin khách hàng của bạn.</p> --}}
                          <!-- Thêm thông tin khách hàng cụ thể tại đây -->
                          <div class="div_deg_1">
                            <form class="text-left" action="{{url('update_customer_info')}}" method="post" onsubmit="return validateForm()">
                              @csrf
                              <div class="form-group">
                                <label for="">Username</label>
                                <input type="text" name="name" class="form-control" value="{{Auth::user()->name}}">
                              </div>
                              <div class="form-group">
                                <label for="">Phone number</label>
                                <input type="text" id="phone" name="phone" class="form-control" value="{{Auth::user()->phone}}">
                              </div>
                              <div class="form-group">
                                <label for="">Address</label>
                                <input type="text" name="address" class="form-control" value="{{Auth::user()->address}}">
                              </div>
                              <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                          </div>
                        </div>
                        <!-- Account Info -->
                        <div class="tab-pane fade" id="account-info">
                            <h3>Account Infomation</h3>
                            {{-- <p>Đây là thông tin tài khoản của bạn.</p> --}}
                            <div class="div_deg_1">
                              <form class="text-left">
                                <div class="form-group">
                                  <label for="exampleInputEmail1">Email address</label>
                                  <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{Auth::user()->email}}" disabled>
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Password</label>
                                  <input type="password" class="form-control" id="exampleInputPassword1" value="{{Auth::user()->password}}" disabled>
                                </div>
                                {{-- <div class="form-group">
                                  <a class="text-danger" href="{{url('forgot-password')}}">Forgot Password</a>
                                </div> --}}
                              </form>
                            </div>
                        </div>
                        

                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end shop section -->




   

  <!-- info section -->
  @include('home.footer')

</body>

</html>