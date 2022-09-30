<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SetPassword extends Model
{
    protected $table = 'tbl_users';
     public $timestamps = false;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password'
    ];


    public static function set_user_password(String $id, String $password){

        return  DB::table('tbl_users')
            ->where('id', '=', $id)
            ->update(['password'=>$password]);
        }


    public static function keep_user(String $id){
        return DB::table('tbl_users')
            ->select('tbl_users.*')
            ->where('id', '=', $id)
            ->get();
    }
}
