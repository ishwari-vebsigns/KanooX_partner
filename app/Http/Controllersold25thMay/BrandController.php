<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand;
use Datatables;
use Auth;
class BrandController extends Controller
{
    //All Brand Data============================================
    public function getAllBrand(){
        $user = Auth::user();
        if($user->role_id==1){
           return view('admin/brand/allBrand');
        }else{
            return redirect('/');
        }
    	
    }

    public function getAllBrandDatatable(Request $request){
            $user = Auth::user();
        if($user->role_id==1){
           $brands = Brand::get();
           return Datatables($brands)->make(true);
        }else{
            return redirect('/');
        }
    		
    }

    //Add Brand Data ==========================================

    public function getBrandAdd(){
        $user = Auth::user();
        if($user->role_id==1){
           return view('admin/brand/addBrand'); 
        }else{
            return redirect('/');
        }

    	
    }

    public function postBrandAdd(Request $request){
        	$request->validate([
        							'brand_name'=>'required',
        							'brand_image'=>'required'
        						]);
        	$brand = new Brand;
        	$brand->brand_name = $request->brand_name;
        	if($request->hasfile('brand_image')){
                $brand_image = $request->file('brand_image');
                $brand_image_path = $brand_image->store('brand_image');
                $brand->brand_image=$brand_image_path;
            }else{
                $brand->brand_image="";
            }

        	$brand->save();
    	return redirect('allBrand');
    }

    //Update Brand Data =========================================
    public function getBrandUpdate($id){
        $user = Auth::user();
        if($user->role_id==1){
           $brand = Brand::find($id);
           return view('admin/brand/updateBrand')->with('brand',$brand);
        }else{
            return redirect('/');
        }

    	
    }

    public function postBrandUpdate(Request $request){
    	 $request->validate([
    	 					'brand_name'=>'required',
        					// 'brand_image'=>'required'
    	 					]);
    	$brand = Brand::find($request->id);
    	$brand->brand_name = $request->brand_name;
        	if($request->hasfile('brand_image')){
                $brand_image = $request->file('brand_image');
                $brand_image_path = $brand_image->store('brand_image');
                $brand->brand_image=$brand_image_path;
            }
        $brand->save();
        return redirect('allBrand');
    }


    //Active or Inactive Brand Data================================
    public function getBrandStatus(Request $request){

    	$brand = Brand::find($request->id);
    	// echo $brand;die;

        if($brand!=""){
            if($brand->is_active==1){

                $brand->is_active=0;
            }else{
                $brand->is_active=1;
            }
        }
        $brand->save();
        return redirect('allBrand');
    }
}
