<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')
  </head>
  <style type="text/css">

    .div_deg {
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 50px;
    }

    label {
        display: inline-block;
        width: 200px;
        font-size: 18px !important;
        color: white !important;
    }

    input {
        border: none;
        border-radius: 4px
    }
    input[type='text'] {
        width: 350px;
        height: 50px;
    }
    textarea {
        width: 450px;
        height: 80px;
    }

    .input_deg {
        padding: 15px;
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
            <h2 class="text-white">Add Product</h2>
            <div class="div_deg ">
                <form action="{{url('upload_product')}}" method="POST" enctype="multipart/form-data">
                @csrf
                
                    <div  class="input_deg">
                        <label for="">Product title</label>
                        <input type="text" name="title" required>
                    </div>
                    <div class="input_deg">
                        <label for="">Description</label>
                        <textarea name="description" ></textarea>
                    </div>
                    <div class="input_deg">
                        <label for="">Price ($)</label>
                        <input type="text" name="price" required>
                    </div>
                    <div class="input_deg">
                        <label for="">Quantity</label>
                        <input type="number" name="qty">
                    </div>


                    <div class="input_deg">
                        <label for="">Product category</label>
                        <select class="btn bg-secondary text-white" name="category" required>
                            <option value="">Select a Option</option>

                            @foreach ($categories as $category)
                                <option value="{{$category->category_name}}">{{$category->category_name}}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="input_deg">
                        <label for="">Product image</label>
                        <input type="file" name="image">
                    </div>

                    <hr class="border border-warning">
                    <div class="input_deg text-center">
                        <input class="btn btn-success" type="submit" value="Add Product">
                    </div>
                    
                </form>
            </div>

            {{-- <div>
              <table class="table_deg">
                <tr>
                  <th>Category Name</th>
                  <th colspan="2">Activity</th>
                </tr>

                @foreach ($data as $data)
                <tr>
                  <td>{{$data->category_name}}</td>
                  <td>
                    <a class="btn btn-success px-3" href="{{url('edit_category', $data->id)}}">
                      <i class="bi bi-pencil"></i>
                    </a>
                  </td>
                  <td>
                    <a class="btn btn-danger px-4" onclick="confirmation(event)"
                     href="{{url('delete_category', $data->id)}}">
                      <i class="bi bi-trash"></i>
                    </a>
                  </td>
                </tr>
                @endforeach
                                
              </table>
            </div> --}}

        </div>
      </div>
    </div>
    <!-- JavaScript files-->
    @include('admin.js')
  </body>
</html>