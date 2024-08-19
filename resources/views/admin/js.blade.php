        <!-- Sweet alert CDN link -->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <!-- Customize delete activity -->
        <script>
          function confirmation(ev) {
            // Phương thức này ngăn chặn hành động mặc định của sự kiện. 
            // Trong trường hợp này, nó ngăn chặn việc điều hướng tới liên kết khi người dùng nhấp vào.
            // --> ngăn hàm delete_category($id) xảy ra cho đến khi bạn xác nhận xoá
            ev.preventDefault();

            // show href's link
            var urlToRedirect = ev.currentTarget.getAttribute('href');
            
            console.log(urlToRedirect);

            swal({
              title: "Are you sure?",
              text: "This delete will be parmanent.",
              icon: "warning",
              button: true,
              dangerMode: true,
            })

            .then((willCancel)=>{
              if (willCancel) {
                // Make delete_category($id) at admincontroller file
                window.location.href = urlToRedirect;
              }
            });
          }
        </script>

    <script src="{{asset('admincss/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('admincss/vendor/popper.js/umd/popper.min.js')}}"> </script>
    <script src="{{asset('admincss/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('admincss/vendor/jquery.cookie/jquery.cookie.js')}}"> </script>
    <script src="{{asset('admincss/vendor/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('admincss/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('admincss/js/charts-home.js')}}"></script>
    <script src="{{asset('admincss/js/front.js')}}"></script>