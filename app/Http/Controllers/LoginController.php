<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;
use App\Models\Login;
use Session;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function user_login(Request $request)
    {
        try {
            // dd($request->all());
            $request->validate([
                'txt_email' => 'required|email',
            ], [
                'txt_email.required' => 'Email is required',
                'txt_email.email' => 'Email field must have a valid email address',
            ]);

            $email = $request->get('txt_email');
            $password = $request->get('txt_password');

            if(!empty($password)){

                $login_data = Login::login_user($email)->toArray();
                // dd($login_data);
                if($login_data){
                    if (Hash::check($password, $login_data[0]->password)) {

                        // dd($login_data[0]->password);

                        //=== Setting up a session ==//
                        Session::put('user_session', $login_data);

                        Alert::toast('Log In Successfully','success');
                        return redirect('profile');
                    }
                    else{
                        Alert::toast('Email or Password Incorrect','warning');
                        return back();
                    }
                }
                else {
                    Alert::toast('Email not found','warning');
                        return back();
                }
            }
            else {
                $set_password_email_details = Login::set_user_password($email)->toArray();

                if ($set_password_email_details){
                    if($set_password_email_details[0]->password == "" || $set_password_email_details[0]->password == NULL){
                    Alert::toast('New user! Set up Password','success');

                    return view('auth.set_password', compact('set_password_email_details'));
                    }
                    else{
                        Alert::toast('Enter Password to Login','warning');
                       return redirect('/');
                    }
                }
                else{
                    Alert::toast('Email not found! Enter Again','warning');
                    return redirect('/');
                }
            }


        } catch (exception $e) {
            echo 'Caught exception';
        }
    }


    public function logout_user(Request $request){
        $request->session()->forget('user_session');

        return redirect('/');
    }

}
