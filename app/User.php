<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function scopeToNotify(){
        return \DB::table('users')->where(['enable_notify' => 1])->get()->toArray();
    }

    public function updateProfile($user_id, $data){
        return \DB::table('users')->where(['id' => $user_id])->update($data);
    }
}
