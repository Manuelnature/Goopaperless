<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Stroage;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\UploadFile;
use App\Models\Folder;
use App\Models\User;
use App\Models\Link;
use Storage;
use Session;
use Carbon\Carbon;
use DB;
use Log;

class UploadFileController extends Controller
{
    public function index(){
        $get_all_folders = Folder::all();
        $get_all_files = UploadFile::all();

        $user_session = Session::get('user_session')[0];
        $active_user = $user_session->firstname." ".$user_session->lastname;

        $all_my_uploaded_files = UploadFile::where('created_by', $active_user)->get();
        $get_all_users = User::all();
        return view('pages.upload_file', compact('get_all_folders', 'get_all_files', 'all_my_uploaded_files'));
    }



    public function upload_file(Request $request){
        try {

            if($request->hasFile('txt_filename')){

                $user_session = Session::get('user_session')[0];
                $active_user = $user_session->firstname." ".$user_session->lastname;

                $file_title = $request->get('txt_file_title');
                // $filename = $file_title.time().'.'.$request->file('txt_filename')->getClientOriginalExtension();
                $file =  $request->file('txt_filename');

                // $file =  file_get_contents($request->file('txt_filename'));
                $filename = $file_title.time().'.'.$file->getClientOriginalExtension();
                // dump($filename);
                // dump($file);
                $local_folder_id = $request->get('txt_folder_id');
                // if ($request->get('txt_folder_id') != "" || $request->get('txt_folder_id') != NULL) {
                //     $folder_id = $request->get('txt_folder_id');
                // }
                // else{
                //     $folder_id = "";
                // }

                // dump('Folder id is: '.$local_folder_id);

                $get_folder_details = Folder::find($local_folder_id);
                // dump($get_folder_details);

                // dump($get_folder_details->name);
                $google_folder_id = $get_folder_details->folder_id;

                // dd('Google Folder id is: '.$google_folder_id);

                // $local_folder_id = $get_folder_details->id;



                if($google_folder_id != NULL || $google_folder_id != "") {
                    Storage::disk("google")->putFileAs($google_folder_id, $file, $filename);
                    $url = Storage::disk('google')->url($google_folder_id, $filename);
                    $details = Storage::disk("google")->getMetadata($google_folder_id, $filename);

                    $path = $details['path'];
                //     // $file->move('assets/files'.$filename);
                //     dd($details);
                }
                else {
                    Storage::disk("google")->putFileAs("",$file, $filename);
                    $url = Storage::disk('google')->url($filename);
                    $details = Storage::disk("google")->getMetadata($filename);
                    $path = $details['path'];
                    // $file->move('assets/files'.$filename);
                }

                // $file->move(public_path().'/assets/files', $filename);
                $file->move('assets/files/'.$filename);

                // $save_file = storage_path('public/assets/files/'.$filename);
                $data = new UploadFile();
                $data->file_name = $filename;
                $data->title = $file_title;
                $data->description = $request->get('txt_description');
                $data->folder_id = $local_folder_id;
                $data->file_url = $url;
                $data->file_id = $path;
                $data->created_by = $active_user;
                $data->save();

                Alert::toast('File Uploaded Successfully','success');
                return redirect()->back();
            }

        } catch (exception $e) {
            echo 'Caught exception';
        }
    }




    public function upload_file_with_loop(Request $request){
        try {
            $data=new UploadFile(); //the product here is the model

            $given_file_name = $request->get('txt_file_title');

            // $file=$request->my_file;
            $file =  $request->file('txt_filename');
            $filename = $given_file_name.time().'.'.$file->getClientOriginalExtension();

            Storage::disk("google")->putFileAs("",$file, $filename);
            $url=Storage::disk('google')->url($filename);
            $details=Storage::disk("google")->getMetadata($filename);
            $path=$details['path'];

            dd($url.' '.$path);

            $uploaded_file_name = Storage::disk("google")->putFileAs("",$file, $filename); // this worked in google
            Log::channel('my_log')->info('data saved in Drive');

            $get_uploaded_file_size = $request->file('txt_filename')->getSize();
            dump('Size at upload ===== '.$get_uploaded_file_size); // to get the file size

            $file->move('assets/files',$filename);

            $data->file_name=$filename;
            $data->title = $request->get('txt_file_title');
            $data->description = $request->get('txt_description');
            $data->file_link = $request->get('txt_file_link');
            // $data->id = $request->get('txt_file_link');
            $data->save();




            //====== Get last record inserted=============
            $last_record = DB::table('tbl_my_files')->latest()->first();
            $last_record_timestamp = $last_record->created_at;
            $last_record_id = $last_record->id;

            // dd( $last_record_timestamp);
            dump("Uploaded file name is ==== ".$uploaded_file_name);
            $get_all_ids = Storage::disk("google")->allFiles();
            foreach ($get_all_ids as $get_ids) {
                $get_metadata = Storage::disk("google")->getMetadata($get_ids);
                $get_file_name = $get_metadata['name'];

                if ($get_file_name == $uploaded_file_name) {
                    dump("File name from google drive ==== ".$get_file_name);
                    $get_epoch_time = $get_metadata['timestamp'];
                    $get_main_time = date("Y-m-d H:i:s", substr($get_epoch_time, 0, 10));

                    Log::channel('my_log')->info('get time from drive');
                    // dd('Main_time is == '.$get_main_time);
                    $time_from_google_drive = Carbon::createFromFormat('Y-m-d H:s:i', $get_main_time);
                    $time_from_db = Carbon::createFromFormat('Y-m-d H:s:i', $last_record_timestamp);

                    $difference_in_minutes = $time_from_db->diffInMinutes($time_from_google_drive);
                    dump("Difference in time is  ============= ".$difference_in_minutes);

                    Log::channel('my_log')->info('difference in time');

                    if ($difference_in_minutes < 5) {
                        $get_file_size = $get_metadata['size'];
                        if ($get_file_size == $get_uploaded_file_size){
                            $google_file_id_path = $get_metadata['path'];

                            $this->update_uploaded_file_with_google_id($last_record_id, $google_file_id_path);

                        }
                    }
                }
            }

            Alert::toast('File Uploaded Successfully','success');
            return redirect()->back();

        } catch (exception $e) {
            echo 'Caught exception';
        }
    }

    public function update_uploaded_file_with_google_id($id, $google_path){
            $update_uploaded_file = UploadFile::find($id);
            $update_uploaded_file->file_id = $google_path;
            $update_uploaded_file->save();
    }



    public function show_file(){
        try {
            $get_all_files=UploadFile::all();
            return view('pages.show_file', compact('get_all_files'));
        } catch (exception $e) {
            echo 'Caught exception';
        }
    }


    public function download_file(Request $request, $id){
        try {
            $get_file = UploadFile::find($id);
            $file_name = $get_file['file_name'];
            $file_google_id = $get_file['file_id'];
            $response =  Storage::disk("google")->download($file_google_id, $file_name);
            $response->send();
        } catch (exception $e) {
            echo 'Caught exception';
        }
    }


    public function download_file_old(Request $request, $file){
        try {
            return response()->download(public_path('assets/files/'.$file));
        } catch (exception $e) {
            echo 'Caught exception';
        }
    }


    public function view_file($id){
        try {
            $get_file = UploadFile::find($id);
            $get_file_url = $get_file['file_url'];
            // dd($get_file_url);
            // return response()->file($get_file_url);
            // return redirect($get_file_url);
            return redirect()->to($get_file_url);

            // $details = Storage::disk("google")->getMetadata($file_id);

        } catch (exception $e) {
            echo 'Caught exception';
        }
    }


    public function view_file_old($id){
        try {
            $get_file = UploadFile::find($id);
            // $main_file_name = $get_file->file_name;
            $file_id = $get_file->file_id;
            dump($file_id);
            // $files = Storage::disk("google")->allFiles();
            // dd($files);
            // $firstFileName = $files[4];
            // dump("FILE NAME: ". $firstFileName);
            $details = Storage::disk("google")->getMetadata($file_id);
            dd($details);
            // $files = Storage::disk("google")->exists($get_file->file_name);
            // $files = Storage::disk("google")->get($main_file_name);
            dump( $files);

            /*$data = UploadFile::find($id);
            return view ('pages.view_file', compact('data')); */
        } catch (exception $e) {
            echo 'Caught exception';
        }
    }



    public function edit_uploaded_file($id){
        try {
            $file_to_edit = UploadFile::find($id);
            $get_all_users = User::all();
            $get_all_folders = Folder::all();

            return view('pages.edit_file', compact('file_to_edit', 'get_all_users', 'get_all_folders'));
        } catch (exception $e) {
            echo 'Caught exception';
        }
    }

    public function update_file(Request $request, $id){
        try {

            $user_session = Session::get('user_session')[0];
            $active_user = $user_session->firstname." ".$user_session->lastname;
            $today_date = Carbon::now()->toDateTimeString();

            // if ($request->get('txt_give_access_to') != "" || $request->get('txt_give_access_to') != NULL) {
            //     $give_access_to = $request->get('txt_give_access_to');
            // } else {
            //     $give_access_to = "";
            // }

            $user_to_access_id = $request->get('txt_give_access_to');

            $access_response_data = UploadFile::where('id', $id)->get();

            $previous_users_with_access = array();
            $current_user_with_accesss = array();
            $all_users_with_access = array();
            $access_order = 0;

            if (count($access_response_data) > 0) {
                $json_object = json_decode($access_response_data, true);
                $first_user = $json_object[0];
                $previous_users_with_access = $first_user['access_to'];
            } else{
               return response()->json([
               "status"=>"00",
               "message"=>"There is no record for this File ID"
               ]);
            }

            if ($previous_users_with_access == null || empty($previous_users_with_access)) {
                $current_user_with_accesss['order'] = 0;
               $current_user_with_accesss['user_id'] = $user_to_access_id;

               array_push($all_users_with_access, $current_user_with_accesss);
           }
           else{
                $all_users_with_access = json_decode($previous_users_with_access, true);

                foreach ($all_users_with_access as $each_json) {
                    if ($access_order < $each_json['order']) {
                        $access_order = $each_json['order'];
                    }

                }
                $access_order = $access_order + 1;
                $current_user_with_accesss['order'] = $access_order;
                $current_user_with_accesss['user_id'] = $user_to_access_id;
                array_push($all_users_with_access, $current_user_with_accesss);
            }



            $update_file = UploadFile::find($id);
            $update_file->title = $request->get('txt_edit_title');
            $update_file->description = $request->get('txt_edit_description');
            $update_file->access_to = $all_users_with_access;
            $update_file->updated_at = $today_date;
            $update_file->updated_by = $active_user;
            $update_file->save();

            Alert::toast('File Records Successfully Updated','success');
            return redirect('upload_file');
        } catch (exception $e) {
            echo 'Caught exception';
        }
    }


    public function delete_file($id){
        try {
            $get_file = UploadFile::find($id);
            $file_google_id = $get_file['file_id'];
            Storage::disk("google")->delete($file_google_id);

            $get_file->delete();

            Alert::toast('Record Deleted','warning');
            return redirect('upload_file');
        } catch (exception $e) {
            echo 'Caught exception';
        }
     }


    public function delete_file_old(UploadFile $id){
        try {
            // $data=new UploadFile();
            $id->delete();
            Alert::toast('Record Deleted','warning');
            return redirect('pages.show_file');
        } catch (exception $e) {
            echo 'Caught exception';
        }
     }
}
