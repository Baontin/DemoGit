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

  label {
    display: inline-block;
    width: 200px;
    padding: 20px;
  }

  textarea {
    width: 400px;
    height: 80px;
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

            <h2 style="color: white;">Update Product</h2>

            <div class="div_deg">

                <form action="{{url('update_product', $data->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                  <div>
                      <label for="">Title</label>
                      <input type="text" name="title" value="{{$data->title}}">
                  </div>
                  <div>
                    <label for="">Description</label>
                    <textarea name="description">{{$data->description}}</textarea>
                  </div>
                  <div>
                    <label for="">Price ($)</label>
                    <input type="text" name="price" value="{{$data->price}}">
                  </div>
                  <div>
                    <label for="">Quantity</label>
                    <input type="number" name="quantity" value="{{$data->quantity}}">
                  </div>
                  <div>
                    <label for="">Category</label>
                    <select name="category" id="">
                      <option value="{{$data->category}}">{{$data->category}}</option>
                      @foreach ($categories as $category)
                      <option value="{{$category->category_name}}">{{$category->category_name}}</option>
                      @endforeach
                    </select>
                  </div>

                  <div>
                    <label for="">Current Image</label>
                    <img width="70" height="70" src="/products/{{$data->image}}" alt="">
                  </div>

                  <div>
                    <label for="">New Image</label>
                    <input type="file" name="image">
                  </div>

                  <div>
                      <input class="btn btn-primary" type="submit" value="Update">
                  </div>

                </form>

            </div>
            
        </div>
      </div>
    </div>
    <!-- JavaScript files-->
    @include('admin.js')
  </body>
</html>