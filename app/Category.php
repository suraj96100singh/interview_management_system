<?php

namespace App;


use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
    protected $table='department';
    protected $guarded='id';
    // public $dummy;
   
 

    public function user(){
       
        // return $this->hasOne(User::class);
        return $this->hasOne(User::class,'id','head_of_department');
        // return $this->hasOne(User::class,'id','head_of_department');
    
    }
    public function questions(){
        return $this->hasMany(Questions::class,'department_id','id')->with('options');
    }
}