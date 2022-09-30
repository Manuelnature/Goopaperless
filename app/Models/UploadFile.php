<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;


class UploadFile extends Model
{
    protected $table = 'tbl_files';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'description',
        'file_name',
        'file_id'
    ];

    public static function upload_file(String $name, String $description, String $file_name, String $file_id)
    {
        $data = array('name' => $name, 'description' => $description, 'file_name' => $file_name, 'file_id' => $file_id);

                return DB::table('tbl_my_files')->insert($data);
    }
}
