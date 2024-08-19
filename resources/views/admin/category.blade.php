<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')
  </head>
  <style type="text/css">
    input[type='text'] {
      width: 400px;
      height: 50px;
      border: none;
      border-radius: 5px;
      padding: 0 2%;
    }

    .div_deg {
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 30px;
    }

    .table_deg {
        text-align: center;
        margin: auto;
        border: 2px solid yellowgreen;
        margin-top: 50px;
        width: 60%;
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
            <h2 style="color: white">Add Category</h2>
            <div class="div_deg">
                <form action="{{route('admin.add_category')}}" method="POST">
                @csrf
                    <div>
                        <input type="text" name="category">
                        <input class="btn btn-primary" type="submit" value="Add Category">
                    </div>
                </form>
            </div>

            <div>
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
            </div>

        </div>
      </div>
    </div>
    <!-- JavaScript files-->
    @include('admin.js')
  </body>
</html>