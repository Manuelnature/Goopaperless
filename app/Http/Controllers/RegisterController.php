<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Register;

class RegisterController extends Controller
{
    public function index(){
        return view('auth.register');
    }

    public function user_register(Request $request){
        try {
            // dd($request->all());
            $request->validate([
                'txt_firstname' => 'required',
                'txt_lastname' => 'required',
                'txt_email' => 'required|email|unique:tbl_users,email',
                'txt_password' => 'required',
                'txt_confirm_password' => 'required'
            ], [
                'txt_firstname.required' => 'First Name is required',
                'txt_lastname.required' => 'Last Name is required',
                'txt_email.required' => 'Email is required',
                'txt_email.email' => 'Email field must have a valid email address',
                'txt_email.unique' => 'Email already exist',
                'txt_password.required' => 'Password is required',
                'txt_confirm_password.required' => 'Password Confirmation is required' 
            ]);
            // dd($request->all());
            $firstname = $request->get('txt_firstname');
            $lastname = $request->get('txt_lastname');
            $email = $request->get('txt_email');
            $password = $request->get('txt_password');
            $confirm_password = $request->get('txt_confirm_password');

            if($password ==  $confirm_password){
                Register::register_user($firstname,  $lastname, $email, $password);
                Alert::toast('New user registered','success');
                return back();
            } 
            else{
                Alert::toast('Passwords do not match! Enter Again','warning');
                return back();
            }
        } catch (exception $e) {
            echo 'Caught exception';
        }
    }
}
