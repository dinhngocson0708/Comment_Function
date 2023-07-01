<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Slide;
use App\Models\Product;
use App\Models\Type_product;
use App\Models\Comment;
use App\Models\BillDetail;
use App\Models\Cart;
use App\Models\Comments;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class PageController extends Controller
{
        public function getIndex(){
            $slide=Slide::all();
            // return view('page.trangchu');
            $new_product = Product::where('new',1)->paginate(8);
            $sanpham_khuyenmai=	Product::where('promotion_price','<>',0)->paginate(4);
            return view('Page.trangchu',compact('slide','new_product','sanpham_khuyenmai'));
        
        }
        public function getDetail(Request $request){
            $sanpham=Product::where('id',$request->id)->first();
            $splienquan=Product::where('id','<>',$sanpham->id,'and','id_type','=',$sanpham->id_type)->paginate(3);
            $comments=Comments::where('id_product',$request->id)->get();
            return view('page.chitiet_sanpham',compact('sanpham','splienquan','comments'));
        }

        public function getLoaiSp($type)
        {
            
            $sp_theoloai=Product::where('id_type',$type)->get();
            $sp_khac=Product::where('id_type','<>',$type)->paginate(3);

            $loai=Type_product::all();
            $loai_sp=Type_product::where('id',$type)->first();

            return view('page.loai_sanpham',compact('sp_theoloai','sp_khac','loai','loai_sp'));
        }
        public function getIndexAdmin()
        {
            $products = Product::all();
            $currentDate = Carbon::now();
            $day = $currentDate->day; // Ngày
            $month = $currentDate->month; // Tháng
            $year = $currentDate->year; // Năm
            $sumSold = count(BillDetail::all());

            return view('pageAdmin.admin', compact('products', 'day', 'month', 'year', 'sumSold'));
        }

     
        public function getAdminAdd()						
        {						
            return view('pageAdmin.formAdd');						
        }						
    
     								
	    public function postAdminAdd(Request $request)							
	     {							
            $product = new Product();							
            if ($request->hasFile('inputImage')) {							
            $file = $request->file('inputImage');							
            $fileName = $file->getClientOriginalName('inputImage');							
            $file->move('source/image/product', $fileName);							
            }							
            $file_name = null;							
            if ($request->file('inputImage') != null) {							
            $file_name = $request->file('inputImage')->getClientOriginalName();							
            }							
                                        
            $product->name = $request->inputName;							
            $product->image = $file_name;							
            $product->description = $request->inputDescription;							
            $product->unit_price = $request->inputPrice;							
            $product->promotion_price = $request->inputPromotionPrice;							
            $product->unit = $request->inputUnit;							
            $product->new = $request->inputNew;							
            $product->id_type = $request->inputType;							
            $product->save();							
            return redirect('/admin')->with('Addsuccess', 'Thêm sản phẩm thành công');							
	    }

        public function getAdminEdit($id)
        {
           
                $product = Product::find($id);
                return view('pageadmin.formEdit')->with('product', $product);
            
        }										
                                

         public function postAdminEdit(Request $request)
         {
             $id = $request->editId;
             $product = Product::find($id);
         
             if (!$product) {
                 // Handle the case where the product is not found
                 return redirect()->back()->with('error', 'Product not found.');
            }
         
             if ($request->hasFile('editImage')) {
                 $file = $request->file('editImage');
                 $fileName = $file->getClientOriginalName('editImage');
                 $file->move('source/image/product', $fileName);
             }
         
             // Assign the properties only if the product exists
             $product->name = $request->editName;
             $product->description = $request->editDescription;
             $product->unit_price = $request->editPrice;
             $product->promotion_price = $request->editPromotionPrice;
             $product->unit = $request->editUnit;
             $product->new = $request->editNew;
             $product->id_type = $request->editType;
         
             $product->save();
    
             
            // Trong phần xử lý của bạn
            return redirect('/admin')->with('Editsuccess', 'Sửa sản phẩm thành công');
            }
         
         

        

      
        public function postAdminDelete($id)
        {
            $product = Product::find($id);
            if ($product) {
                $product->delete();
            }
            return redirect('/admin')->with('Deletesuccess', 'Xóa sản phẩm thành công');
        }
    // Không cần đăng nhập vẫn mua hàng được 
    					
    // public function getAddToCart(Request $req, $id){					
    //     $product = Product::find($id);					
    //     $oldCart = Session('cart')?Session::get('cart'):null;					
    //     $cart = new Cart($oldCart);					
    //     $cart->add($product,$id);					
    //     $req->session()->put('cart', $cart);					
    //     return redirect()->back();					
    // }	
    
    // Bắt buộc đăng nhập mới mua hàng
    public function getAddToCart(Request $req, $id)
    {
        if (Session::has('user')) {
            if (Product::find($id)) {
                $product = Product::find($id);
                $oldCart = Session('cart') ? Session::get('cart') : null;
                $cart = new Cart($oldCart);
                $cart->add($product, $id);
                $req->session()->put('cart', $cart);
                return redirect()->back();
            } else {
                return '<script>alert("Không tìm thấy sản phẩm này.");window.location.assign("/");</script>';
            }
        } else {
            return '<script>alert("Vui lòng đăng nhập để sử dụng chức năng này.");window.location.assign("/login");</script>';
        }
    }
      
    	
	  public function getDelItemCart($id){
        $oldCart = Session::has('cart')?Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        if(count($cart->items)>0){
        Session::put('cart',$cart);
        
        }
        else{
            Session::forget('cart');
        }
        return redirect()->back();
    }


    public function storeComments(Request $request, $id)
    {
        // Lấy thông tin người dùng đăng nhập
        $user = Auth::user();
        // Lưu comment vào database
        $comment = new Comments;
        $comment->username = $user->name; // Lấy tên của người đăng nhập
        $comment->comment = $request->input('comment');
        $comment->id_product =$id;
        $comment->save();

        // Chuyển hướng về trang hiển thị bài viết
        return redirect()->back();
    }


}