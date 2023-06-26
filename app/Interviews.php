<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Interviews extends Model
{
    use Notifiable;
 
    protected $table='interviews';
 
    protected $guarded='id';




    //
    public function departmentName(){
        return $this->hasOne(Category::class,'id','department_id');

    }

    public function workExperienceInfo(){
    return $this->hasMany(Candidate_Work_Experiences::class,'candidate_id','id');
    }
}
