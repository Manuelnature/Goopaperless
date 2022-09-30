<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Register extends Model
{
    protected $table = 'tbl_users';
    public $timestamps = false;

    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password' 
    ];

    public static function register_user(String $firstname, String $lastname, String $email, String $password)
    {
        $data = array('firstname' => $firstname, 'lastname' => $lastname, 'email' => $email, 'password' => $password);
            
                return DB::table('tbl_users')->insert($data);
    }
}
