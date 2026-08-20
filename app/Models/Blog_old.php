<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
     public $primaryKey='blog_id';

     public static $addRule=[
    'blog_type_id'=>'required',
	'blog_title'=>'required|min:1|max:100',	
	'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',	
	'url'=>'required',
	];

	public static $editRule=[
    'blog_type_id'=>'required',
	'blog_title'=>'required|min:1|max:100',
	'url'=>'required',
	];

    public function blog_type(){
		return $this->belongsTo('App\Models\BlogType','blog_type_id','blog_type_id');
	}
}
