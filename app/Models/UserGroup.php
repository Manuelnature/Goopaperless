<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserGroup extends Model
{
    public static function select_users(){
        return DB::table('tbl_users')
            ->select('tbl_users.*')
            ->get();
    }

    public static function update_user_group(String $id, String $new_group){
        return DB::table('tbl_users')
            ->where('id', '=', $id)
            ->update(['role'=> $new_group]);
    }
}
