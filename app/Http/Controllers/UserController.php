<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;
use Image;
use File;
use Carbon\Carbon;
use Session;

class UserController extends Controller
{
    public function index(){
        $all_users = User::all();
        // $all_users = User::load_users();
        // dd($all_users);
        return view('pages.add_user', compact('all_users'));
    }

    public function add_user(Request $request){
        try {
            $request->validate([
                'txt_firstname' => 'required|regex:/^[a-zA-Z-\s]+$/',
                'txt_lastname' => 'required|regex:/^[a-zA-Z-\s]+$/',
                'txt_email' => 'required|email|unique:tbl_users,email',
                'txt_city' => 'required',
                'txt_role' => 'required',
                'txt_phone_number' => 'required|numeric',
                'txt_profession' => 'required|regex:/^[a-zA-Z-\s]+$/',
                'txt_address' => 'required',
                'txt_user_photo' => 'mimes:jpeg,png,jpg',
                ], [
                'txt_firstname.required' => 'Firstname is required',
                'txt_lastname.required' => 'Lastname is required',
                'txt_firstname.regex' => 'Firstname is must be in letters only',
                'txt_lastname.regex' => 'Lastname is must be in letters only',
                'txt_email.required' => 'Email is required',
                'txt_email.email' => 'Email field must have a valid email address',
                'txt_email.unique' => 'Email already exist',
                'txt_city.required' => 'City Name is required',
                'txt_role.required' => 'Assign user a role',
                'txt_phone_number.required' => 'Phone number is required',
                'txt_phone_number.numeric' => 'Phone number must be in numbers only',
                'txt_profession.required' => 'Your profession is required',
                'txt_profession.regex' => 'Your profession must be in letters only',
                'txt_address.required' => 'First Address Line is required',
                'txt_user_photo.mimes' => 'Photo must be a file of type: jpeg,png,jpg',
            ]);

        $firstname = $request->get('txt_firstname');
        $lastname = $request->get('txt_lastname');
        $email = $request->get('txt_email');
        $password = "";
        $city = $request->get('txt_city');
        $role = $request->get('txt_role');
        $phone_number = $request->get('txt_phone_number');
        $profession = $request->get('txt_profession');
        // $address = $request->get('txt_address1')." ".$request->get('txt_address2');
        $address = $request->get('txt_address');

        if($request->hasFile('txt_user_photo')){

            $image = $request->file('txt_user_photo');
            $img_ext = $image->getClientOriginalExtension();
            $timestamp = 'ProfilePhoto'.rand(100,999).'-'.str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
            $file_name = $timestamp.'.'.$img_ext;
            // $imagePath = $image->move('assets/img/profiles', $file_name);

            $imagePath = Image::make($image)->resize(100,100)->save('assets/img/profiles/'. $file_name);

            User::add_user($firstname, $lastname, $email, $password, $city, $role, $phone_number, $profession, $address, $file_name);
            Alert::toast($firstname.' Added Successfully','success');

        }
        else{
            $file_name = NULL;
            User::add_user($firstname, $lastname, $email, $password, $city, $role, $phone_number, $profession, $address, $file_name);
            Alert::toast($firstname.' Added Successfully','success');
        }

        return redirect()->back();

        }
        catch (exception $e) {
                echo 'Caught exception';
            }
    }


    public function edit_user($id){
        try {
            $user_to_edit = User::find($id);
            return view('pages.edit_user', compact('user_to_edit'));
        } catch (exception $e) {
            echo 'Caught exception';
        }
    }

    public function update_user(Request $request, $id){
        //Quick Info
       /* 'regex:/^[a-zA-Z0-9\s]+$/' or regex:[a-zA-Z0-9\s]+ --- For alpha numeric with spaces
        regex:/^[a-zA-Z-\s]+$/ --- Fo letters with space and hyphen
        regex:/^[a-zA-Z]+$/u ---- For only letters without space and hypen
        */
        try {
            $request->validate([
                'txt_edit_firstname' => 'required|regex:/^[a-zA-Z-\s]+$/',
                'txt_edit_lastname' => 'required|regex:/^[a-zA-Z-\s]+$/',
                'txt_edit_email' => 'required|email',
                'txt_edit_city' => 'required',
                'txt_edit_role' => 'required',
                'txt_edit_phone_number' => 'required|numeric',
                'txt_edit_profession' => 'required|regex:/^[a-zA-Z-\s]+$/',
                'txt_edit_address' => 'required'
                ], [
                'txt_edit_firstname.required' => 'Firstname is required',
                'txt_edit_lastname.required' => 'Lastname is required',
                'txt_edit_firstname.regex' => 'Firstname is must be in letters only',
                'txt_edit_lastname.regex' => 'Lastname is must be in letters only',
                'txt_edit_email.required' => 'Email is required',
                'txt_edit_email.email' => 'Email field must have a valid email address',
                'txt_edit_email.unique' => 'Email already exist',
                'txt_edit_city.required' => 'City Name is required',
                'txt_edit_role.required' => 'Assign user a role',
                'txt_edit_phone_number.required' => 'Phone number is required',
                'txt_edit_phone_number.numeric' => 'Phone number must be in numbers only',
                'txt_edit_profession.required' => 'Your profession is required',
                'txt_edit_profession.regex' => 'Your profession must be in letters only',
                'txt_edit_address.required' => 'First Address Line is required'
            ]);

            if($request->hasFile('txt_edit_user_photo')){
                $image = $request->file('txt_edit_user_photo');
                $img_ext = $image->getClientOriginalExtension();
                $timestamp = 'ProfilePhoto'.rand(100,999).'-'.str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
                $file_name = $timestamp.'.'.$img_ext;
                $imagePath = $image->move('assets/img/profiles', $file_name);



                $current_date_and_time = Carbon::now()->toDateTimeString();

                $user_session = Session::get('user_session')[0];
                $active_user = $user_session->firstname." ".$user_session->lastname;

                $update_user = User::find($id);
                $update_user->firstname = $request->get('txt_edit_firstname');
                $update_user->lastname = $request->get('txt_edit_lastname');
                $update_user->email = $request->get('txt_edit_email');
                $update_user->city = $request->get('txt_edit_city');
                $update_user->role = $request->get('txt_edit_role');
                $update_user->phone_number = $request->get('txt_edit_phone_number');
                $update_user->profession = $request->get('txt_edit_profession');
                $update_user->address = $request->get('txt_edit_address');
                $update_user->photo = $file_name;
                $update_user->updated_by = $active_user;
                $update_user->updated_at = $current_date_and_time;

                $previous_name = 'assets/img/profiles/'.$request->get('txt_previous_photo');
                if (File::exists($imagePath) && File::exists($previous_name)) {
                    File::delete($previous_name);
                }
                $update_user->save();

                Alert::toast($update_user->firstname.'\'s record updated successfully','success');
                return redirect('users');

            }
            else{
                $current_date_and_time = Carbon::now()->toDateTimeString();

                $user_session = Session::get('user_session')[0];
                $active_user = $user_session->firstname." ".$user_session->lastname;

                $update_user = User::find($id);
                $update_user->firstname = $request->get('txt_edit_firstname');
                $update_user->lastname = $request->get('txt_edit_lastname');
                $update_user->email = $request->get('txt_edit_email');
                $update_user->city = $request->get('txt_edit_city');
                $update_user->role = $request->get('txt_edit_role');
                $update_user->phone_number = $request->get('txt_edit_phone_number');
                $update_user->profession = $request->get('txt_edit_profession');
                $update_user->address = $request->get('txt_edit_address');
                $update_user->updated_by = $active_user;
                $update_user->updated_at = $current_date_and_time;
                $update_user->save();

                 Alert::toast($update_user->firstname.'\'s record updated successfully','success');
                 return redirect('users');
            }

        } catch (exception $e) {
            echo 'Caught exception';
        }
    }




    public function delete_user(User $id){
        try {
            $id->delete();
            Alert::toast('Record Deleted','warning');
            return redirect('users');

        } catch (exception $e) {
            echo 'Caught exception';
        }
    }
}
