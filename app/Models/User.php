<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class User extends Model
{
    protected $table = 'tbl_users';
    public $timestamps = false;

    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password' ,
        'city',
        'role',
        'phone_number',
        'profession',
        'address',
        'address'
    ];

    public static function add_user(String $firstname, String $lastname, String $email, String $password, String $city, String $role, String $phone_number, String $profession, String $address, $photo)
    {

        $data = array('firstname' => $firstname, 'lastname' => $lastname, 'email' => $email, 'password' => $password, 'city' => $city, 'role' => $role, 'phone_number' => $phone_number, 'profession' => $profession, 'address' => $address, 'photo' => $photo);
        return DB::table('tbl_users')->insert($data);
    }

    public static function load_users(){
        return DB::table('tbl_users')
        ->select('tbl_users.*')
        ->get();
    }
}
