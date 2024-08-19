<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')
  </head>
  
<style type="text/css">

  .div_deg {
    display: flex;
    justify-content: center;
    align-content: center;
    margin: 50px;
  }

  input[type='text'] {
    width: 400px;
    height: 50px;
    border: none;
    border-radius: 5px;
    padding: 0 2%;
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
            <h2 style="color: white;">Update Category</h2>
            <div class="div_deg">

                <form action="{{url('update_category', $data->id)}}" method="POST">
                @csrf
                    <input type="text" name="category" value="{{$data->category_name}}">
                    <input class="btn btn-primary" type="submit" value="Update">
                </form>

            </div>
            
        </div>
      </div>
    </div>
    <!-- JavaScript files-->
    @include('admin.js')
  </body>
</html>