<?php

namespace App\Resto;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class User extends Model
{
    protected $table = 'tbl_user';
    public $timestamps = true;
    protected $fillable = [
        'username', 'level'
    ];
    protected $hidden = [
        'password'
    ];

    public function validateAuth($catch){
        $validator = Validator::make($catch, [
            'username' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return true;
        }
    }

    public function failedAuth($catch){
        $check = self::where('username',$catch['username'])->where('password',$catch['password']);
        if($check->count() == 1){
            $user = $check->first();
            Session::put('username',$user->username);
            Session::put('level',$user->level);
            Session::put('authenticated',TRUE);
        } else {
            return true;
        }
        //dd($check);
    }
}
