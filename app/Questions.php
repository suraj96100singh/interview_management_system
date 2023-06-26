<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Questions extends Model
{
    protected $table='questions';
    protected $guarded='id';

    // public function questions(){
    //     return $this->hasMany(Questions::class);
    // }
    public function options(){
        return $this->hasMany(Options::class,'question_id','id');
    }


    // public function rightOption(){
    //     // return $this->hasOne(Options::class,'question_id','id')->where("is_right");
    // }
}
