<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Folder extends Model
{
    protected $table = 'tbl_folders';
    public $timestamps = false;

    public static function get_folders(){
        return DB::table('tbl_folders')
            ->select('tbl_folders.*')
            ->get();
    }
}
