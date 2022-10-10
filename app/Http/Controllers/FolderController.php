<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Folder;
use Storage;
use Carbon\Carbon;
use Session;
use Log;

class FolderController extends Controller
{
    public function index(){
        $get_all_folders = Folder::all();
        // $get_all_folders = Folder::get_folders();
        // dd($get_all_folders);
        // dd($get_all_folders->name);
        return view('pages.create_folder', compact('get_all_folders'));
    }

    public function create_folder(Request $request){
        try {
            $data = new Folder();

            $folder_name = $request->get('txt_folder_name');
            $folder_description = $request->get('txt_folder_description');

            Storage::disk("google")->makeDirectory($folder_name);
            $url = Storage::disk('google')->url($folder_name);
            $details = Storage::disk("google")->getMetadata($folder_name);
            // dd($url);
            $path = $details['path'];

            $data->name = $folder_name;
            $data->description = $folder_description;
            $data->folder_id = $path;
            $data->url = $url;
            $data->save();

            Alert::toast('Folder Created Successfully','success');
            return redirect()->back();

        } catch (exception $e) {
            echo 'Caught exception';
        }
    }


    // public function edit_folder($id){
    //     try {
    //         $link_to_edit = Folder::find($id);
    //         $get_all_users = User::all();
    //         return view('pages.edit_link', compact('link_to_edit', 'get_all_users'));
    //     } catch (exception $e) {
    //         echo 'Caught exception';
    //     }
    // }

    // public function update_folder(Request $request, $id){
    //     try {

    //         $user_session = Session::get('user_session')[0];
    //         $active_user = $user_session->firstname." ".$user_session->lastname;
    //         $today_date = Carbon::now()->toDateTimeString();

    //         $update_link = Link::find($id);
    //         $update_link->link = $request->get('txt_edit_link');
    //         $update_link->shared_to = $request->get('txt_edit_share_to');
    //         $update_link->description = $request->get('txt_edit_description');
    //         $update_link->updated_at = $today_date;
    //         $update_link->updated_by = $active_user;
    //         $update_link->save();

    //         Alert::toast('Link Records Successfully Updated','success');
    //         return redirect('share_link');
    //     } catch (exception $e) {
    //         echo 'Caught exception';
    //     }
    // }

    public function edit_folder($id){
        try {
            // $file_to_edit = UploadFile::find($id);
            // $get_all_users = User::all();
            $folder_to_edit = Folder::find($id);

            return view('pages.edit_folder', compact('folder_to_edit'));
        } catch (exception $e) {
            echo 'Caught exception';
        }
    }

    public function update_folder(Request $request, $id){
        try {
            $user_session = Session::get('user_session')[0];
            $active_user = $user_session->firstname." ".$user_session->lastname;
            $today_date = Carbon::now()->toDateTimeString();

            $update_folder = Folder::find($id);
            $update_folder->name = $request->get('txt_edit_folder_name');
            $update_folder->description = $request->get('txt_edit_folder_description');
            $update_folder->updated_at = $today_date;
            $update_folder->updated_by = $active_user;
            $update_folder->save();

            return redirect('create_folder');
        } catch (exception $e) {
            echo 'Caught exception';
        }
    }


    public function delete_folder($id){
        try {
            $get_folder = Folder::find($id);
            $folder_google_id = $get_folder['folder_id'];
            // dd($folder_google_id);
            Storage::disk("google")->deleteDirectory($folder_google_id);
            $get_folder->delete();

            Alert::toast('Folder Deleted','warning');
            return redirect('create_folder');
        } catch (exception $e) {
            echo 'Caught exception';
        }
     }

}
