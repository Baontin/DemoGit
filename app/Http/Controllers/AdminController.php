<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Order;
use App\Models\order_detail;
use App\Models\Product;

use Barryvdh\DomPDF\Facade\Pdf;

class AdminController extends Controller
{
    /* ==============================================
                    CATEGORY
    ==================================================== */
    public function view_category() {
        // get all cate data
        $data = Category::all();
        return view("admin.category", compact('data'));
    }
    public function add_category(Request $request) {
        $category = new Category();
        $category->category_name = $request->category;

        $category->save();
        toastr()->success('Category has been added successfully.');
        // return redirect()->back()->with("success","Thêm danh mục thành công");
        return redirect()->back();
    }
    public function delete_category($id) {
        // find id
        $data = Category::find($id);
        $data->delete();

        toastr()->success('Category deleted successfully.');
        return redirect()->back();
        
    }
    public function edit_category($id) {
        //find id
        $data = Category::find($id);
        return view('admin.edit_category', compact('data'));
    }
    public function update_category(Request $request ,$id) {
        //find id
        $data = Category::find($id);

        $oldCategory = $data->category_name;

        $data->category_name = $request->category;

        $data->save();

        // Update new cate name for product
        $products = Product::where('category', $oldCategory)->get();

        foreach ($products as $product) {
            $product->category = $request->category;
            $product->save();
        }

        
        return redirect('/view_category');
        // return redirect(route('admin.category')); 
    }

    /* ==============================================
                    PRODUCT
    ==================================================== */
    public function add_product () {
        $categories = Category::all();
        
        return view('admin.add_product', compact('categories'));
    }

    public function upload_product(Request $request) {
        $product = new Product();

        $product->title =  $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category = $request->category;
        $product->quantity = (int) $request->qty;

        $image = $request->image;
        if ($image) {
            // Tạo tên file độc nhất thông qua time up + đuôi file (nó sẽ được lưu ở tm tạm thời)
            $imagename = time() .'.'. $image->getClientOriginalExtension();

            /* 
            Khi file được upload, PHP lưu nó trong thư mục tạm thời của server 
            (thường là /tmp trên hệ thống Unix/Linux hoặc C:\Windows\Temp trên Windows).
            */
            // Dùng move() chuyển file ảnh từ "tm tạm thời" -> "tm chỉ dỉnh" và thay đổi tên file ảnh
            // param1: thư mục chỉ định (ko có sẵn -> laravel tạo giúp)
            // param2: tên mới thay thế cho tên cũ của file ảnh.
            $request->image->move('products', $imagename);

            toastr()->success('Product added successfully.');
            $product->image = $imagename;
        }


        $product->save();

        return redirect()->back();
    }
    public function view_product() {
        $products = Product::paginate(4);


        return view('admin.view_product', compact('products'));
    }
    public function delete_product($id) {
        $data = Product::find($id);

        // DELETE IMAGE
        $image_path = public_path('products/'.$data->image);
        if (file_exists($image_path)) {
            unlink($image_path);
        }
        $data->delete();

        toastr()->success('Product deleted successfully.');

        return redirect()->back();
    }
    public function edit_product($id) {
        $categories = Category::all();
        $data = Product::find($id);

        return view('admin.edit_product', compact('data', 'categories'));
    }

    public function update_product(Request $request, $id) {
        
        $data = Product::find($id);

        $data->title = $request->title;
        $data->description = $request->description;
        $data->price = $request->price;
        $data->quantity = $request->quantity;
        $data->category = $request->category;

        $image = $request->image;
        if($image) {
            // Xoá ảnh cũ
            $old_img_path = public_path('products/'. $data->image);
            if(file_exists($old_img_path)) {
                unlink($old_img_path);
            }
            // Nạp ảnh mới
            $imagename = time() .'.'. $image->getClientOriginalExtension();

            $request->image->move('products', $imagename);
            $data->image = $imagename;
        }

        $data->save();

        toastr()->success('Product updated successfully.');

        return redirect('/view_product');
    }

    public function product_search(Request $request) {
        $search = $request->search;

        // tìm product qua tên
        // $products = Product::where('title', 'LIKE', '%'.$search.'%')->paginate(4);
        // tìm product qua tên, category
        $products = Product::where('title', 'LIKE', '%'.$search.'%')->
        orWhere('category', 'LIKE', '%' .$search. '%')->paginate(4);

        return view('admin.view_product', compact('products'));
    }

    /* ==============================================
                        Order
    ==================================================== */

    public function view_orders() {
        $data = Order::all();

        return view('admin.view_orders', compact('data'));
    }

    public function print_pdf($id) {
        $order = Order::find($id);
        $data = order_detail::where('order_id', $id)->get();

        $pdf = Pdf::loadView('admin.invoice', compact('order', 'data'));
        return $pdf->download('invoice.pdf');
    }

    public function on_the_way($id) {
        $data = Order::find($id);

        $data->status = 'On The Way';

        $data->save();

        // return redirect('/view_orders');
        return redirect()->back();
    }

    public function delivered($id) {
        $data = Order::find($id);

        $data->status = 'Delivered';

        $data->save();

        return redirect('/view_orders');
    }

    public function view_ad_order_detail($orderId) {
        $orders = order_detail::where('order_id', $orderId)->get();


        return view('admin.view_order_detail', compact('orders'));
    }
}

