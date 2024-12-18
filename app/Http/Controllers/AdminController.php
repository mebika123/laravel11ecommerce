<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Transaction;
use App\Models\Product;
use App\Models\Slide;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Intervention\Image\Laravel\Facades\Image;


class AdminController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('Created_at','DESC')->get()->take(10);
        $dashboardDatas = [
            'TotalAmount' => Order::sum('total'),
            'TotalOrderedAmount' => Order::where('status', 'ordered')->sum('total'),
            'TotalDeliveredAmount' => Order::where('status', 'delivered')->sum('total'),
            'TotalCancelledAmount' => Order::where('status', 'canceled')->sum('total'),
            'Total' => Order::count(),
            'TotalOrdered' => Order::where('status', 'ordered')->count(),
            'TotalDelivered' => Order::where('status', 'delivered')->count(),
            'TotalCancelled' => Order::where('status', 'canceled')->count(),
        ];
        return view('admin.index',compact('orders','dashboardDatas'));
    }
    
    public function brands()
    {
        $brands = Brand::orderBy('id','DESC')->paginate(10);
        return view('admin.brands',compact('brands'));
    }

    public function add_brand(){
        return view('admin.brand-add');
    }

    public function brand_store(request $request){
        $request->validate([
            'name'=>'required',
            'slug'=>'required|unique:brands,slug',
            'image'=>'mimes:png,jpg,jpeg|max:2048'
        ]);

        $brand =new Brand();
        $brand->name =$request->name;
        $brand->slug = Str::slug($request->name);
        $image = $request->file('image');
        $file_extention = $request->file('image')->extension();
        $file_name = Carbon::now()->timestamp.'.'.$file_extention;
        $destinationPath = public_path('uploads/brands');
        $this->GeneraterThumbailsImage($image,$file_name,$destinationPath);
    $brand->image = $file_name;
        $brand->save();
        return redirect()->route('admin.brands')->with('status','Brand has been added succefully!');
    }

    public function brand_edit($id){
      $brand = Brand::findOrFail($id);
      return view('admin.brand-edit',compact('brand'));  
    }

    public function brand_update(Request $request){
        $request->validate([
            'name'=>'required',
            'slug'=>'required'.$request->id,
            'image'=>'mimes:png,jpg,jpeg|max:2048'
        ]);

        $brand = Brand::findOrFail($request->id);
        $brand->name =$request->name;
        $brand->slug = Str::slug($request->name);
        if($request->hasFile('image')){
            if(File::exists(public_path('uploads/brands').'/'.$brand->image)){
                File::delete(public_path('uploads/brands').'/'.$brand->image);
            }
            $image = $request->file('image');
            $file_extention = $request->file('image')->extension();
            $file_name = Carbon::now()->timestamp.'.'.$file_extention;
            $destinationPath = public_path('uploads/brands');
            $this->GeneraterThumbailsImage($image,$file_name,$destinationPath);
            $brand->image = $file_name;
        }

        $brand->save();
        return redirect()->route('admin.brands')->with('status','Brand has been updated succefully!');

    }

    public function brand_delete($id){
        $brand = Brand::findOrFail($id);
        if(File::exists(public_path('uploads/brands').'/'.$brand->image)){
            File::delete(public_path('uploads/brands').'/'.$brand->image);
        }
        $brand->delete();
        return redirect()->route('admin.brands')->with('status','Brand has been deleted successfully!');
    }

   public function categories(){
    $categories = Category::orderBy('id','DESC')->paginate(10);
    return view('admin.categories',compact('categories'));
   }
   public function add_category(){
    return view('admin.category-add');
   }
   public function category_store(request $request ){
    $request->validate([
        'name'=>'required',
        'slug'=>'required|unique:categories,slug',
        'image'=>'mimes:png,jpg,jpeg|max:2048'
    ]);

    $category =new Category();
    $category->name =$request->name;
    $category->slug = Str::slug($request->slug);

    $image = $request->file('image');
    $file_extention = $request->file('image')->extension();
    $file_name = Carbon::now()->timestamp.'.'.$file_extention;
    $destinationPath = public_path('uploads/categories');
    $this->GeneraterThumbailsImage($image,$file_name,$destinationPath);
    $category->image = $file_name;
    
    $category->save();
    return redirect()->route('admin.categories')->with('status','Category has been added succefully!');
   }


public function category_edit($id){
    $category = Category::findOrFail($id);
    return view('admin.category-edit',compact('category'));  
  }

  public function category_update(request $request){
    $request->validate([
        'name'=>'required',
        'slug'=>'required',
        'image'=>'mimes:png,jpg,jpeg|max:2048'
    ]);
    $category = Category::findOrFail($request->id);
    $category->name =$request->name;
    $category->slug = Str::slug($request->slug);

    if($request->hasFile('image')){
        if(File::exists(public_path('uploads/categories').'/'.$category->image)){
            File::delete(public_path('uploads/categories').'/'.$category->image);
        }
        $image = $request->file('image');
        $file_extention = $request->file('image')->extension();
        $file_name = Carbon::now()->timestamp.'.'.$file_extention;
        $destinationPath = public_path('uploads/categories');
        $this->GeneraterThumbailsImage($image,$file_name,$destinationPath);
            $category->image = $file_name;
    }

    $category->save();
    return redirect()->route('admin.categories')->with('status','Category has been updated succefully!');
}
public function category_delete($id){
    $category = Category::findOrFail($id);
    if(File::exists(public_path('uploads/categories').'/'.$category->image)){
        File::delete(public_path('uploads/categories').'/'.$category->image);
    }
    $category->delete();
    return redirect()->route('admin.categories')->with('status','Category has been deleted succefully!');
  }

  public function products()
  {
    $products = Product::orderBy('created_at','DESC')->paginate(10);
    return view('admin.products',compact('products'));
  }
  public function product_add(){
    $categories = Category::select('id','name')->orderBy('name')->get();
    $brands = Brand::select('id','name')->orderBy('name')->get();
    return view('admin.product-add',compact('categories','brands'));
  }

  public function product_store(Request $request){
    $request->validate([
        'name'=>'required',
        'slug'=>'required|unique:products,slug',
        'short_description'=>'required',
        'description'=>'required',
        'regular_price'=>'required|numeric',
        'sale_price'=>'required||numeric',
        'SKU'=>'required',
        'stock_status'=>'required',
        'featured'=>'required',
        'quantity'=>'required|numeric',
        'image'=>'required|mimes:png,jpg,jpeg|max:2048',
        'category_id'=>'required',
        'brand_id'=>'required',
        ]);
        $product = new Product();
        $product->name = $request->name;
        $product->slug = Str::slug($request->slug);
        $product->short_description = $request->short_description;
        $product->description = $request->description;
        $product->regular_price = $request->regular_price;
        $product->sale_price = $request->sale_price;
        $product->SKU = $request->SKU;
        $product->stock_status = $request->stock_status;
        $product->featured = $request->featured;
        $product->quantity = $request->quantity;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;

        $current_timestamp = Carbon::now()->timestamp;
        $destinationPathThumbnail = public_path('uploads/products/thumbnails');
        $destinationPath = public_path('uploads/products');
    

        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = $current_timestamp.'.'. $image->extension();
            $this->GeneraterThumbailsImage($image,$imageName,$destinationPathThumbnail,104,104);
            $this->GeneraterThumbailsImage($image,$imageName,$destinationPath,540,689);
            $product->image = $imageName;
        }
        $gallery_arr = array();
        $gallery_images ="";
        $counter = 1;
        if($request->hasFile('images')){
          $allowedfileExtion = ['jpg','png','jpeg'];
          $files = $request->file('images');
          foreach($files as $file){
            $gextension = $file->getClientOriginalExtension();
            $gcheck = in_array($gextension,$allowedfileExtion);
            if($gcheck){
                $gfileName = $current_timestamp . "-" . $counter . "." . $gextension;
                $this->GeneraterThumbailsImage($file,$gfileName,$destinationPathThumbnail,104,104);
                $this->GeneraterThumbailsImage($file,$gfileName,$destinationPath,540,689);
    
                array_push($gallery_arr,$gfileName);
                $counter = $counter +1;
            }
          }
          $gallery_images = implode(',',$gallery_arr);
        }
        $product->images = $gallery_images;
        $product->save();
        return redirect()->route('admin.products')->with('status','Product has been added successfully!');

  }

  public function product_edit($id){
    $product = Product::findOrFail($id);
    $categories = Category::select('id','name')->orderBy('name')->get();
    $brands = Brand::select('id','name')->orderBy('name')->get();
    return view('admin.product-edit',compact('product','categories','brands'));
  }

  public function product_update(Request $request){
    $request->validate([
        'name'=>'required',
        'slug'=>'required|unique:products,slug,'.$request->id,
        'short_description'=>'required',
        'description'=>'required',
        'regular_price'=>'required|numeric',
        'sale_price'=>'required|numeric',
        'SKU'=>'required',
        'stock_status'=>'required',
        'featured'=>'required',
        'quantity'=>'required|numeric',
        'image'=>'mimes:png,jpg,jpeg|max:2048',
        'category_id'=>'required',
        'brand_id'=>'required',
        ]);

        $product = Product::findOrFail($request->id);
        $product->name = $request->name;
        $product->slug = Str::slug($request->slug);
        $product->short_description = $request->short_description;
        $product->description = $request->description;
        $product->regular_price = $request->regular_price;
        $product->sale_price = $request->sale_price;
        $product->SKU = $request->SKU;
        $product->stock_status = $request->stock_status;
        $product->featured = $request->featured;
        $product->quantity = $request->quantity;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;

        $current_timestamp = Carbon::now()->timestamp;
        $destinationPathThumbnail = public_path('uploads/products/thumbnails');
        $destinationPath = public_path('uploads/products');
    

        if($request->hasFile('image')){
                if(File::exists(public_path('uploads/products').'/'.$product->image)){
                    File::delete(public_path('uploads/products').'/'.$product->image) ;
                }
                if(File::exists(public_path('uploads/products/thumbnails').'/'.$product->image)){
                    File::delete(public_path('uploads/products/thumbnails').'/'.$product->image) ;
                }

            $image = $request->file('image');
            $imageName = $current_timestamp.'.'. $image->extension();
            $this->GeneraterThumbailsImage($image,$imageName,$destinationPathThumbnail,104,104);
            $product->image = $imageName;
        }
        $gallery_arr = array();
        $gallery_images ="";
        $counter = 1;
        if($request->hasFile('images')){
            foreach(explode(',',$product->image) as $ofile){
                if(File::exists(public_path('uploads/products').'/'.$product->image)){
                    File::delete(public_path('uploads/products').'/'.$product->image) ;
                }
                if(File::exists(public_path('uploads/products/thumbnails').'/'.$product->image)){
                    File::delete(public_path('uploads/products/thumbnails').'/'.$product->image) ;
                }
            }

          $allowedfileExtion = ['jpg','png','jpeg'];
          $files = $request->file('images');
          foreach($files as $file){
            $gextension = $file->getClientOriginalExtension();
            $gcheck = in_array($gextension,$allowedfileExtion);
            if($gcheck){
                $gfileName = $current_timestamp . "-" . $counter . "." . $gextension;
                $this->GeneraterThumbailsImage($file,$gfileName,$destinationPathThumbnail,104,104);
                array_push($gallery_arr,$gfileName);
                $counter = $counter +1;
            }
          }
          $gallery_images = implode(',',$gallery_arr);
        }
        $product->images = $gallery_images;
        $product->save();
        return redirect()->route('admin.products')->with('status','Product has been updates successfully!');
    }
    public function product_delete($id){
        $product = Product::findOrFail($id);
        if(File::exists(public_path('uploads/products').'/'.$product->image)){
            File::delete(public_path('uploads/products').'/'.$product->image) ;
        }
        if(File::exists(public_path('uploads/products/thumbnails').'/'.$product->image)){
            File::delete(public_path('uploads/products/thumbnails').'/'.$product->image) ;
        }
        foreach(explode(',',$product->image) as $ofile){
            if(File::exists(public_path('uploads/products').'/'.$product->image)){
                File::delete(public_path('uploads/products').'/'.$product->image) ;
            }
            if(File::exists(public_path('uploads/products/thumbnails').'/'.$product->image)){
                File::delete(public_path('uploads/products/thumbnails').'/'.$product->image) ;
            }
        }
        $product->delete();
        return redirect()->route('admin.products')->with('status','Product has been deleted successfully!');
  }
  public function GeneraterThumbailsImage($image,$imageName,$path,$height=124,$width=124){
    $img = Image::read($image->path());
    $img->cover($height,$width,"top");
    $img->resize($height,$width,function($constraint){
        $constraint->aspectRatio();
    })->save($path.'/'.$imageName);
}

public function coupons(){
    $coupons = Coupon::orderBy('expiry_date','DESC')->paginate(12);
    return view('admin.coupons',compact('coupons'));
}
public function coupon_add(){
 return view('admin.coupon-add');
}
public function coupon_store(Request $request){
    $request->validate([
        'code' => 'required',
        'type' => 'required',
        'value' => 'required|numeric',
        'expiry_date' => 'required|date',
    ]);
    $coupon = new Coupon();
    $coupon->code = $request->code;
    $coupon->type =$request->type;
    $coupon->value = $request->value;
    $coupon->cart_value = $request->cart_value;
    $coupon->expiry_date = $request->expiry_date;
    $coupon->save();
    return redirect()->route('admin.coupons')->with('status','Coupon has been added successfully!');
}
public function coupon_edit($id){
    $coupon = Coupon::findOrFail($id);
    return view('admin.coupon-edit',compact('coupon'));
}
public function coupon_update(Request $request){
    $request->validate([
        'code' => 'required',
        'type' => 'required',
        'value' => 'required|numeric',
        'expiry_date' => 'required|date',
    ]);
    $coupon = Coupon::findOrFail($request->id);
    $coupon->code = $request->code;
    $coupon->type =$request->type;
    $coupon->value = $request->value;
    $coupon->cart_value = $request->cart_value;
    $coupon->expiry_date = $request->expiry_date;
    $coupon->save();
    return redirect()->route('admin.coupons')->with('status','Coupon has been update successfully!');
}
public function coupon_delete($id){
    $coupon = Coupon::findOrFail($id);
    $coupon->delete();
    return redirect()->route('admin.coupons')->with('status','Coupon has been deleted succesfully');
}

public function orders(){
    $orders = Order::orderBy('created_at','DESC')->paginate(12);
    return view('admin.orders',compact('orders'));
}
public function order_details($order_id){
    $order = Order::find($order_id);
    $orderItems = OrderItem::where('order_id',$order_id)->orderBy('id')->paginate(12);
    $transaction = Transaction::where('order_id',$order_id)->first();
    return view('admin.order-details',compact('order','orderItems','transaction'));
}

public function update_order_status(Request $request){
    $order = Order::find($request->order_id);
    $order->status = $request->order_status;
    if($request->order_status == 'delivered')
    {
        $order->delivered_date == Carbon::now();
    }
    else if($request->order_status == 'canceled')
    {
        $order->canceled_date == Carbon::now();
    }
    $order->save();
    if($request->order_status == 'delivered'){
        $transaction = Transaction::where('order_id',$request->order_id)->first();
        $transaction->status = 'approved';
        $transaction->save();
    }
    return back()->with('status','Status Changed successfully!');
}

public function slides()
{
    $slides = Slide::orderBy('id','DESC')->paginate(12);
    return view('admin.slides',compact('slides'));
}

public function slide_add(){
    return view('admin.slide-add');
}
public function slide_store(Request $request){
    $request->validate([
        'tagline'=>'required',
        'title'=>'required',
        'subtitle'=>'required',
        'link'=>'required',
        'status'=>'required',
        'image'=>'required|mimes:png,jg,jpeg|max:2048',
    ]);
    $slide = new Slide();
    $slide->tagline = $request->tagline;
    $slide->title = $request->title;
    $slide->subtitle = $request->subtitle;
    $slide->link = $request->link;
    $slide->status = $request->status;
    $image = $request->file('image');
    $file_extention = $request->file('image')->extension();
    $file_name = Carbon::now()->timestamp.'.'.$file_extention;
    $destinationPath = public_path('uploads/slides');
    $this->GeneraterThumbailsImage($image,$file_name,$destinationPath,400,690);
    $slide->image = $file_name;
    $slide->save();
    return redirect()->route('admin.slides')->with('status','Slides has been add successfully!');
}

public function slide_edit($id){
    $slide = Slide::find($id);
    return view('admin.slide-edit',compact('slide'));
}
public function slide_update(Request $request){
    $request->validate([
        'tagline'=>'required',
        'title'=>'required',
        'subtitle'=>'required',
        'link'=>'required',
        'status'=>'required',
        'image'=>'mimes:png,jg,jpeg|max:2048',
    ]);
    $slide = Slide::findOrFail($request->id);
    $slide->tagline = $request->tagline;
    $slide->title = $request->title;
    $slide->subtitle = $request->subtitle;
    $slide->link = $request->link;
    $slide->status = $request->status;

    if($request->hasFile('image')){
        if(File::exists(public_path('uploads/slides').'/'.$slide->image)){
            File::delete(public_path('uploads/slides').'/'.$slide->image);
        }
        $image = $request->file('image');
        $file_extention = $request->file('image')->extension();
        $file_name = Carbon::now()->timestamp.'.'.$file_extention;
        $destinationPath = public_path('uploads/slides');
        $this->GeneraterThumbailsImage($image,$file_name,$destinationPath,400,690);
        $slide->image = $file_name;
    }
    $slide->save();
    return redirect()->route('admin.slides')->with('status','Slides has been updated successfully!'); 
}
public function slide_delete($id){
    $slide = Slide::findOrFail($id);
    if(File::exists(public_path('uploads/slides').'/'.$slide->image)){
        File::delete(public_path('uploads/slides').'/'.$slide->image);
    }
    $slide->delete();
    return redirect()->route('admin.slides')->with('status','slide has been deleted successfully!');
}

public function messages()
{
    $messages = Contact::orderBy('id','DESC')->paginate(12);
    return view('admin.messages',compact('messages'));
}
public function message_delete($id){
    $message = Contact::find($id);
    $message->delete();
    return back()->with('status','Message has been deleted successfully!');
}
}
