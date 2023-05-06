<?php

namespace App;
use App\Category;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles(){
       
        // return $this->hasOne(User::class);
        return $this->hasOne(Roles::class,'id','roles_id');
        // return $this->hasOne(User::class,'id','head_of_department');
    
    }
    public function department(){
       
        // return $this->hasOne(User::class);
        return $this->hasOne(Category::class,'id','department_id');
        // return $this->hasOne(User::class,'id','head_of_department');
    
    }
    
}
