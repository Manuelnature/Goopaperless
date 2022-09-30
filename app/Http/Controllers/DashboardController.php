<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;
use App\Models\Folder;
use App\Models\Link;
use App\Models\UploadFile;

class DashboardController extends Controller
{
    public function index(){
        $all_folders = FOlder::all();
        $all_files = UploadFile::all();
        $all_links = Link::all();
        $all_users = User::all();
        $dashboard_top = [
            'all_users' => $all_users,
            'all_folders' => $all_folders,
            'all_files' => $all_files,
            'all_links' => $all_links
        ];
        return view('pages.dashboard', compact('dashboard_top'));
    }
}
