<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slider;
use Auth;
class SliderController extends Controller
{
	//All Slider Data =================
    public function allSlider(){
        $user = Auth::user();
        if($user->role_id==1){
           return view('admin/slider/allSlider');
        }else{
            return redirect('/');
        }
    	
    }
    public function allSliderDatatable(){
        $user = Auth::user();
        if($user->role_id==1){
           $slider = Slider::where('is_active',1)->get();
           return Datatables($slider)->make(true);
        }else{
            return redirect('/');
        }
    	
    }

    //Add Slider Data============

    public function getAddSlider(){
        $user = Auth::user();
        if($user->role_id==1){
           return view('admin/slider/addSlider');
        }else{
            return redirect('/');
        }
    	
    }

    public function postAddSlider(Request $request){
    	// dd($request->all());
    	$slider = new Slider;

    	if($request->hasfile('slider_image')){
                $slider_image = $request->file('slider_image');
                $slider_image_path = $slider_image->store('slider_image');
                $slider->slider_image=$slider_image_path;
            }else{
                $slider->slider_image="";
            }
    	$slider->save();
    	return redirect('allSlider');
    }

    //Update Slider Data============

    public function getUpdateSlider($id){
        $user = Auth::user();
        if($user->role_id==1){
           $slider = Slider::find($id);
        return view('admin/slider/updateSlider')->with('slider',$slider);
        }else{
            return redirect('/');
        }
    	
    }

    public function postUpdateSlider(Request $request){
    	// dd($request->all());
    	$slider = Slider::find($request->id);
    	if($request->hasfile('slider_image')){
                $slider_image = $request->file('slider_image');
                $slider_image_path = $slider_image->store('slider_image');
                $slider->slider_image=$slider_image_path;
            }
    	
    	$slider->save();
    	return redirect('allSlider');
    }


    public function getProductStatus(Request $request){
	   $slider = Slider::find($request->id);
	   if($slider!=""){
	            if($slider->is_active==1){

	                $slider->is_active=0;
	            }else{
	                $slider->is_active=1;
	            }
	        }
	        $slider->save();
	    return redirect('allSlider');
	}  
}
