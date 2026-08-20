<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Auth;
class CategoryController extends Controller
{
   //All Category Data============================================
    public function getAllCategory(){
        $user = Auth::user();
        if($user->role_id==1){
           return view('admin/category/allCategory');
        }else{
            return redirect('/');
        }
    	
    }

    public function getAllCategoryDatatable(Request $request){
            $user = Auth::user();
            if($user->role_id==1){
               $categories = Category::get();
            return Datatables($categories)->make(true);
            }else{
                return redirect('/');
            }
    		
    }

    //Add Category Data ==========================================

    public function getCategoryAdd(){
        $user = Auth::user();
            if($user->role_id==1){
               return view('admin/category/addCategory');
            }else{
                return redirect('/');
            }
    	
    }

    public function postCategoryAdd(Request $request){
    	// dd($request->all());
        	$request->validate([
        							'category_name'=>'required',
        							'category_image'=>'required',
        						]);
        	$category = new Category;
        	$category->category_name = $request->category_name;
        	if($request->hasfile('category_image')){
                $category_image = $request->file('category_image');
                $category_image_path = $category_image->store('category_image');
                $category->category_image=$category_image_path;
            }else{
                $category->category_image="";
            }

        	$category->save();
    	return redirect('allCategory');
    }

    //Update Category Data =========================================
    public function getCategoryUpdate($id){
        $user = Auth::user();
            if($user->role_id==1){
               $category = Category::find($id);
               return view('admin/category/updateCategory')->with('category',$category);
            }else{
                return redirect('/');
            }

    	
    }

    public function postCategoryUpdate(Request $request){
    	 $request->validate([
    	 					'category_name'=>'required',
        					// 'category_image'=>'required',
    	 					]);
    	$category = Category::find($request->id);
    	$category->category_name = $request->category_name;
        	if($request->hasfile('category_image')){
                $category_image = $request->file('category_image');
                $category_image_path = $category_image->store('category_image');
                $category->category_image=$category_image_path;
            }
        $category->save();
        return redirect('allCategory');
    }

    //Active or Inactive Category Data================================

    public function getCategoryStatus(Request $request){

    	$category = Category::find($request->id);
    	// echo $category;die;

        if($category!=""){
            if($category->is_active==1){

                $category->is_active=0;
            }else{
                $category->is_active=1;
            }
        }
        $category->save();
        return redirect('allCategory');
    }
}
