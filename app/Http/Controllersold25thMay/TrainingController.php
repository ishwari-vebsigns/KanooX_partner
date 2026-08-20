<?php

namespace App\Http\Controllers;
use App\Models\Training;
use Illuminate\Http\Request;
use DataTables;

class TrainingController extends Controller
{
    public function getAddTraining(){
        // dd(Training::all());
        return view('admin.training.add');
    }
    public function postAddTraining(Request $request){
        // dd($request->all());
        $training_name = $request->training_name;
        $training_url = $request->training_url;
        $description = $request->description;

        $training = new Training();
        $training->training_name =$training_name;
        $training->training_url =$training_url;
        $training->description =$description;
        $training->status_id =1;

        $training->save();
        $request->session()->put('success',"Training Added Successfully!!");
        return redirect('admin/training/all');
    }
    public function getEditTraining(Request $request){
        // dd(Training::all());
        $id = $request->id;
        $training = Training::where('training_id',$id)->first();
        return view('admin.training.detail')->with('training', $training);
    }
    public function postEditTraining(Request $request){
        $id = $request->id;
        $training_name = $request->training_name;
        $training_url = $request->training_url;
        $description = $request->description;
        $training = Training::where('training_id',$id)->first();
        // dd($training);

        if(isset($request['save'])){
        $training->training_name =$training_name;
        $training->training_url =$training_url;
        $training->description =$description;
        $training->save();
        }
        if(isset($request['active'])){
            $training->status_id = 1;
            $training->save();
            $request->session()->put('success',"Training Activated Successfully!!");

        }
        if(isset($request['inactive'])){
            $training->status_id = 0;
            $training->save();
            $request->session()->put('success',"Training In-ctivated Successfully!!");
        }
        $request->session()->put('success',"Training Updated Successfully!!");
        return redirect('admin/training/all');
    }
    public function getAllTraining(){
        $trainings = Training::all();
        return view('admin.training.all')->with('trainings', $trainings);
    }
    public function getAllTrainingdata(){
        $trainings = Training::all();
        return DataTables::of($trainings)->make(true);
    }
}
