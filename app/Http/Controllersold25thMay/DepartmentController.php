<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Datatables;
use App\Department;
use App\Category;
use Auth;
class DepartmentController extends Controller
{
    //All Department Data============================================
    public function getAllDepartment(){
        $user = Auth::user();
        if($user->role_id==1){
           return view('admin/department/allDepartment');
        }else{
            return redirect('/');
        }
    	
    }

    public function getAllDepartmentDatatable(Request $request){
        $user = Auth::user();
        if($user->role_id==1){
           $department = Department::with('categories')->get();
           return Datatables($department)->make(true);
        }else{
            return redirect('/');
        }
    		
    }

    //Add Department Data ==========================================

    public function getDepartmentAdd(){
        $user = Auth::user();
        if($user->role_id==1){
           $categories = Category::where('is_active',1)->get();
           return view('admin/department/addDepartment')->with('categories',$categories);
        }else{
            return redirect('/');
        }


        $categories = Category::where('is_active',1)->get();
    	return view('admin/department/addDepartment')->with('categories',$categories);
    }

    public function postDepartmentAdd(Request $request){
        	$request->validate([
        							'department_name'=>'required',
        							'department_image'=>'required',
                                    'category_id'=>'required'
        						]);
        	$department = new Department;
            $department->department_name = $request->department_name;
        	$department->category_id = $request->category_id;
        	if($request->hasfile('department_image')){
                $department_image = $request->file('department_image');
                $department_image_path = $department_image->store('department_image');
                $department->department_image=$department_image_path;
            }else{
                $department->department_image="";
            }

        	$department->save();
    	return redirect('allDepartment');
    }

    //Update Department Data =========================================
    public function getDepartmentUpdate($id){
        $user = Auth::user();
        if($user->role_id==1){
           $department = Department::find($id);
           $categories = Category::where('is_active',1)->get();
           return view('admin/department/updateDepartment')->with('department',$department)->with('categories',$categories);
        }else{
            return redirect('/');
        }
    }

    public function postDepartmentUpdate(Request $request){
    	 $request->validate([
                            'department_name'=>'required',
    	 					'category_id'=>'required'
        					// 'department_image'=>'required'
    	 					]);
    	$department = Department::find($request->id);
        $department->department_name = $request->department_name;
    	$department->category_id = $request->category_id;
        	if($request->hasfile('department_image')){
                $department_image = $request->file('department_image');
                $department_image_path = $department_image->store('department_image');
                $department->department_image=$department_image_path;
            }
        $department->save();
        return redirect('allDepartment');
    }


    //Active or Inactive Department Data================================
    public function getDepartmentStatus(Request $request){

    	$department = Department::find($request->id);
    	// echo $department;die;

        if($department!=""){
            if($department->is_active==1){

                $department->is_active=0;
            }else{
                $department->is_active=1;
            }
        }
        $department->save();
        return redirect('allDepartment');
    }
}
