<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Product;
use App\Brand;
use App\Category;
use App\Department;
use App\ProductCategory;
use App\ProductDepartment;
use Maatwebsite\Excel\Facades\Excel;
use App\imports\CsvImport;
use Auth;
class ProductController extends Controller
{
   public function getAllProduct(){
            $user = Auth::user();
        if($user->role_id==1){
            		$brands = Brand::all();
           return view('admin/product/allProduct')->with('brands',$brands);
        }else{
            return redirect('/');
        }
            
	}

	public function getAllProductDatatable(){
        $user = Auth::user();
        if($user->role_id==1){
           $product = Product::with('brands')->get();
        }else{
            return redirect('/');
        }
		

		return Datatables($product)->make(true);
	}



//==============================Add User=================================
    public function getProductAdd(){
        $user = Auth::user();
        if($user->role_id==1){
            $brands = Brand::where('is_active',1)->get();
            $categories = Category::where('is_active',1)->get();
            $departments = Department::where('is_active',1)->get();
            return view('admin/product/addProduct')->with('brands',$brands)->with('categories',$categories)->with('departments',$departments);
        }else{
            return redirect('/');
        }
        $brands = Brand::where('is_active',1)->get();
        $categories = Category::where('is_active',1)->get();
        $departments = Department::where('is_active',1)->get();
    	return view('admin/product/addProduct')->with('brands',$brands)->with('categories',$categories)->with('departments',$departments);
    
    }

    public function postProductAdd(Request $request){
// dd($request->all());                                                                                                                                                           
        // phpinfo();die;
            $request->validate([
                                "brand_id"=>'required',
                                'product_name'=>'required',
                                'selling_price'=>'required',
                                'market_price'=>'required',
                                'product_short_description'=>'required',
                                'product_long_description'=>'required',
                                'product_image'=>'required',
                                'category_id'=>'required',
                                'department_id'=>'required',
                                'size'=>'required',
                                'pack'=>'required',
                                'weight'=>'required',
                                'volumn'=>'required',
                                'barcode_image'=>'required',
                                'upc_case'=>'required',
                                'upc_item'=>'required',
                                'purchase_code'=>'required',
                                'product_quantity'=>'required'
                                ]);

    	$product = new Product;
    	$product->brand_id = $request->brand_id;
    	$product->product_name = $request->product_name;
    	$product->selling_price = $request->selling_price;
    	$product->market_price = $request->market_price;
    	$product->product_short_description = $request->product_short_description;
        $product->product_long_description = $request->product_long_description;
        if($request->hasfile('product_image')){
                $product_image = $request->file('product_image');
                $product_image_path = $product_image->store('product_image');
                $product->product_image=$product_image_path;
            }else{
                $product->product_image="";
            }
        $product->size = $request->size;
        $product->pack = $request->pack;
        $product->weight = $request->weight;
        $product->volumn = $request->volumn;
        $product->purchase_code=$request->purchase_code;

        if($request->hasfile('barcode_image')){
                $barcode_image = $request->file('barcode_image');
                $barcode_image_path = $barcode_image->store('barcode_image');
                $product->barcode_image=$barcode_image_path;
            }else{
                $product->barcode_image="";
            }
        $product->upc_case = $request->upc_case;
        $product->upc_item = $request->upc_item;
        $product->product_quantity = $request->product_quantity;

    	$product->save();

        $product_id = $product->product_id;

        $product_category = new ProductCategory;
        $product_category->product_id = $product_id;
        $product_category->category_id = $request->category_id;
        $product_category->save();

        $product_department = new ProductDepartment;
        $product_department->department_id = $request->department_id;
        $product_department->product_id = $product_id;
        $product_department->save();
    	return redirect('allProduct');
    }

//============================================= Update User ============================================
	public function getProductUpdate($id){
        // echo $id;die;
        $user = Auth::user();
        if($user->role_id==1){
           $product = Product::find($id);
           // echo $product;die;
            $categories = Category::where('is_active',1)->get();
            $product_category = ProductCategory::where('product_id',$id)->first();
            $product_department = ProductDepartment::where('product_id',$id)->first();
            // echo $product_department;die;
            $departments = Department::where('is_active',1)->get();
            $brands = Brand::where('is_active',1)->get();
            // echo $departments;die;   
                  return view('admin/product/updateProduct')->with('product',$product)->with('brands',$brands)->with('categories',$categories)->with('departments',$departments)->with('product_category',$product_category)->with('product_department',$product_department);
        }else{
            return redirect('/');
        }
			
           
	}

	public function postProductUpdate(Request $request){
         $request->validate([
                                "brand_id"=>'required',
                                'product_name'=>'required',
                                'selling_price'=>'required',
                                'market_price'=>'required',
                                'product_short_description'=>'required',
                                'product_long_description'=>'required',
                                'category_id'=>'required',
                                'department_id'=>'required',
                                // 'product_image'=>'required',
                                'size'=>'required',
                                'pack'=>'required',
                                'weight'=>'required',
                                'volumn'=>'required',
                                'purchase_code'=>'required',
                                'upc_case'=>'required',
                                'upc_item'=>'required',
                                'product_quantity'=>'required',

                                
                            ]);

    	$product = Product::find($request->id);
    	$product->brand_id = $request->brand_id;
    	$product->product_name = $request->product_name;
    	$product->selling_price = $request->selling_price;
    	$product->market_price = $request->market_price;
    	$product->product_short_description = $request->product_short_description;
        $product->product_long_description = $request->product_long_description;
        if($request->hasfile('product_image')){
                $product_image = $request->file('product_image');
                $product_image_path = $product_image->store('product_image');
                $product->product_image=$product_image_path;
            }
        $product->size = $request->size;
        $product->pack = $request->pack;
        $product->weight = $request->weight;
        $product->volumn = $request->volumn;
        $product->purchase_code=$request->purchase_code;
        if($request->hasfile('barcode_image')){
                $barcode_image = $request->file('barcode_image');
                $barcode_image_path = $barcode_image->store('barcode_image');
                $product->barcode_image=$barcode_image_path;
            }
        $product->upc_case=$request->upc_case;
        $product->upc_item = $request->upc_item;
        $product->product_quantity = $request->product_quantity;
        $product->save();
        $product_id = $product->product_id;


        $product_category = ProductCategory::where('product_id',$product_id)->delete();
        $product_department = ProductDepartment::where('product_id',$product_id)->delete();

        $product_category = new ProductCategory;
        $product_category->product_id = $product_id;
        $product_category->category_id = $request->category_id;
        $product_category->save();

        $product_department = new ProductDepartment;
        $product_department->department_id = $request->department_id;
        $product_department->product_id = $product_id;
        $product_department->save();

        return redirect('allProduct');
	} 


//========================= Delete User ======================================

public function getProductStatus(Request $request){
   $product = Product::find($request->id);
   if($product!=""){
            if($product->is_active==1){

                $product->is_active=0;
            }else{
                $product->is_active=1;
            }
        }
        $product->save();
    return redirect('allProduct');
}  

public function getAddExcelImport(Request $request){
    return view('admin/product/addExcelImport');
}

// public function postAddExcelImport(Request $request){
//     if($request->hasFile('import_excel')){
//             Excel::load($request->file('import_excel')->getRealPath(), function ($reader) {
//                 foreach ($reader->toArray() as $key => $row) {
//                     $data['title'] = $row['Brand'];

//                     $data['description'] = $row['description'];

//                     if(!empty($data)) {
//                         DB::table('post')->insert($data);
//                     }
//                 }
//             });
//         }

//     return view('admin/product/addExcelImport');
// }

public function postAddProductQuantity(Request $request){
        // echo $request->id;
        // dd($request->all());
        $product_id = $request->id;
        $product = Product::find($product_id);
        $product->product_quantity = $request->product_quantity;
        $product->save();
        $notification = array(
            'message' => 'Product Quantity Added successfully', 
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
}




public function postAddExcelImport(Request $request){
        // $file = Input::file('import_file');
        // dd($request->all());
       
        if($request->hasFile('import_excel')){
            
           $file = $request->file('import_excel');
          
        }

           Excel::load($file, function($reader){

            
            
            $sheets=$reader->all();
            // print_r($sheets);die;
            // dd($sheets);
           
           
            foreach ($sheets as $request) {
                // echo $request->category;
                // dd($request);
                    if($request->brand!=""){
                        $brand = Brand::where('brand_name',$request->brand)->first();
                            if($brand == ""){
                                $brand = new Brand;
                                $brand->brand_name = $request->brand;
                                $brand->save();
                                $brand_id = $brand->brand_id;
                            }else{
                                $brand_id = $brand->brand_id;
                            }
                    }else{
                        $brand_id = "";
                    }


                    if($request->category!=""){
                        $category = Category::where('category_name',$request->category)->first();
                            if($category == ""){
                                $category = new Category;
                                $category->category_name = $request->category;
                                $category->save();
                                $category_id = $category->category_id;
                            }else{
                                $category_id = $category->category_id;
                            }
                    }else{
                        $category_id="";
                    }

                    // echo $category_id;die;
                     $selling_price = str_replace('$','',$request->std_selling_price);
                    $market_price = str_replace('$','',$request->net_cost);
                    
                    $product_exist = Product::where('product_name',$request->description)
                                              ->where('brand_id',$brand_id)
                                              ->where('size',$request->size_item)
                                              ->where('weight',$request->case_weight)->first();
                    
                    if($product_exist!=""){
                        $product_id = $product_exist->product_id;
                        $product = Product::find($product_id);
                        // $product->brand_id = $brand_id;
                        // $product->product_name = $request->description;
                        $product->upc_case = $request->upc_case;
                        $product->upc_item = $request->upc_item;
                        // $product->size = $request->size_item;
                        $product->pack = $request->unitspack;
                        // $product->weight = $request->case_weight;
                        $product->selling_price = $selling_price;
                        $product->market_price = $market_price;
                        $product->product_short_description = $request->description;
                        $product->product_long_description = "";
                        $product->volumn = "";
                        $product->barcode_image="";
                        $product->product_image="";
                        $product->purchase_code="";
                        $product->product_quantity=" ";
                        $product->save();
                        $product_id = $product->product_id;
                        
                    }else{
                    $product = new Product;
                    $product->brand_id = $brand_id;
                    $product->product_name = $request->description;
                    $product->upc_case = $request->upc_case;
                    $product->upc_item = $request->upc_item;
                    $product->size = $request->size_item;
                    $product->pack = $request->unitspack;
                    $product->weight = $request->case_weight;
                    $product->selling_price = $selling_price;
                    $product->market_price = $market_price;
                    $product->product_short_description = $request->description;
                    $product->product_long_description = "";
                    $product->volumn = "";
                    $product->barcode_image="";
                    $product->product_image="";
                    $product->purchase_code="";
                    $product->product_quantity=" ";
                    $product->save();
                    $product_id = $product->product_id;
                    }
                    
                    $product_category = ProductCategory::where('product_id',$product_id)->delete();
                    $product_department = ProductDepartment::where('product_id',$product_id)->delete();
                    
                    if($category_id!=""){
                    // echo $category_id;die;
                        $product_category = new ProductCategory;
                        $product_category->product_id=$product_id;
                        $product_category->category_id=$category_id;

                        $product_category->save();
                    }

                    if($request->department_id!=""){
                    $product_department = new ProductDepartment;
                    $product_department->department_id = $request->department_id;
                    $product_department->product_id = $product_id;
                    $product_department->save();
                    }  
             
            }
        });
        
    
        $notification = array(
            'message' => 'Products Imported successfully', 
            'alert-type' => 'success'
        );
        return redirect('allProduct')->with($notification);
    }


}
