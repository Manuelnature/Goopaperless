<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Session;
use Carbon\Carbon;
use File;
use Image;

class ProfileController extends Controller
{
    public function index(){
        return view('pages.profile');
    }

    public function update_user_profile(Request $request){

        $user_id = $request->get('txt_user_id');

        if($request->hasFile('txt_update_user_photo')){
            $image = $request->file('txt_update_user_photo');
            $img_ext = $image->getClientOriginalExtension();
            $timestamp = 'ProfilePhoto'.rand(100,999).'-'.str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
            $file_name = $timestamp.'.'.$img_ext;

            $imagePath = $image->move('assets/img/profiles', $file_name);

            // $imagePath = Image::make($image)->resize(128,128)->save('assets/img/profiles/'. $file_name);

            $current_date_and_time = Carbon::now()->toDateTimeString();

            $user_session = Session::get('user_session')[0];
            $active_user = $user_session->firstname." ".$user_session->lastname;

            $update_user = User::find($user_id);
            $update_user->firstname = $request->get('txt_firstname');
            $update_user->lastname = $request->get('txt_lastname');
            $update_user->email = $request->get('txt_email');
            $update_user->profession = $request->get('txt_profession');
            $update_user->city = $request->get('txt_city');
            $update_user->address = $request->get('txt_address');
            $update_user->photo = $file_name;
            $update_user->phone_number = $request->get('txt_phone_number');
            $update_user->updated_by = $active_user;
            $update_user->updated_at = $current_date_and_time;

            $previous_name = 'assets/img/profiles/'.$request->get('txt_previous_photo');
                if (File::exists($imagePath) && File::exists($previous_name)) {
                    File::delete($previous_name);
                }
            $update_user->save();


                // ================ UPDATING USER SESSION ============
            $update_user_session = Session::get('user_session');

            if($update_user_session[0]->id == $user_id){
                $update_user_session[0]->firstname = $request->get('txt_firstname');
                $update_user_session[0]->lastname = $request->get('txt_lastname');
                $update_user_session[0]->email = $request->get('txt_email');
                $update_user_session[0]->profession = $request->get('txt_profession');
                $update_user_session[0]->city = $request->get('txt_city');
                $update_user_session[0]->address = $request->get('txt_address');
                $update_user_session[0]->phone_number = $request->get('txt_phone_number');

                $update_user_session[0]->photo = $file_name;

                // if($file_name == null){
                //     $update_user_session[0]->photo = $update_user_session[0]->photo;
                // }
                // else{
                //     $update_user_session[0]->photo = $file_name;
                // }
            }
            Session::put('user_session', $update_user_session);

            Alert::toast($update_user->firstname.'\'s record updated successfully','success');
            return back();
        }
        else {

            $current_date_and_time = Carbon::now()->toDateTimeString();

            $user_session = Session::get('user_session')[0];
            $active_user = $user_session->firstname." ".$user_session->lastname;

            $update_user = User::find($user_id);
            $update_user->firstname = $request->get('txt_firstname');
            $update_user->lastname = $request->get('txt_lastname');
            $update_user->email = $request->get('txt_email');
            $update_user->profession = $request->get('txt_profession');
            $update_user->city = $request->get('txt_city');
            $update_user->address = $request->get('txt_address');
            $update_user->phone_number = $request->get('txt_phone_number');
            $update_user->updated_by = $active_user;
            $update_user->updated_at = $current_date_and_time;
            $update_user->save();


            // ================ UPDATING USER SESSION ============
            $update_user_session = Session::get('user_session');

            if($update_user_session[0]->id == $user_id){
                $update_user_session[0]->firstname = $request->get('txt_firstname');
                $update_user_session[0]->lastname = $request->get('txt_lastname');
                $update_user_session[0]->email = $request->get('txt_email');
                $update_user_session[0]->profession = $request->get('txt_profession');
                $update_user_session[0]->city = $request->get('txt_city');
                $update_user_session[0]->address = $request->get('txt_address');
                $update_user_session[0]->phone_number = $request->get('txt_phone_number');
            }
            Session::put('user_session', $update_user_session);

            Alert::toast($update_user->firstname.'\'s record updated successfully','success');
            return back();
        }

    }


    public function change_password(Request $request){
            // dd($request->all());
        $user_id = $request->get('txt_user_id');
        $current_password = $request->get('txt_current_password');
        $new_password = Hash::make($request->get('txt_new_password'));
        $confirm_new_password = $request->get('txt_confirm_new_password');

        $get_user_info = User::find($user_id);
        $old_password = $get_user_info->password;

        if (Hash::check($current_password, $old_password)) {

            if(Hash::check($confirm_new_password, $new_password)){
                $set_new_password = User::find($user_id);
                $set_new_password->password = $new_password;
                $set_new_password->save();
                Alert::toast('Password Reset Successful','success');

                $request->session()->forget('user_session');
                return redirect('/');
            }
            else{
                Alert::toast('Confirm Password does not match','warning');
                return back();
            }
        }
        else{
            Alert::toast('Current Password does not match','warning');
            return back();
        }

    }

    public function delete_profile_picture($id){

    }

}



