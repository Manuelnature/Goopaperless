<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Register;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Mail\RegisterMail;
use App\Mail\FeedbackMail;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function index(){
        return view('auth.register');
    }

    // public function user_register(Request $request){
    //     try {
    //         // dd($request->all());
    //         $request->validate([
    //             'txt_firstname' => 'required',
    //             'txt_lastname' => 'required',
    //             'txt_email' => 'required|email|unique:tbl_users,email',
    //             'txt_password' => 'required',
    //             'txt_confirm_password' => 'required'
    //         ], [
    //             'txt_firstname.required' => 'First Name is required',
    //             'txt_lastname.required' => 'Last Name is required',
    //             'txt_email.required' => 'Email is required',
    //             'txt_email.email' => 'Email field must have a valid email address',
    //             'txt_email.unique' => 'Email already exist',
    //             'txt_password.required' => 'Password is required',
    //             'txt_confirm_password.required' => 'Password Confirmation is required'
    //         ]);
    //         // dd($request->all());
    //         $firstname = $request->get('txt_firstname');
    //         $lastname = $request->get('txt_lastname');
    //         $email = $request->get('txt_email');
    //         $password = $request->get('txt_password');
    //         $confirm_password = $request->get('txt_confirm_password');

    //         if($password ==  $confirm_password){
    //             Register::register_user($firstname,  $lastname, $email, $password);
    //             Alert::toast('New user registered','success');
    //             return back();
    //         }
    //         else{
    //             Alert::toast('Passwords do not match! Enter Again','warning');
    //             return back();
    //         }
    //     } catch (exception $e) {
    //         echo 'Caught exception';
    //     }
    // }


    public function register(Request $request){
        try {
            $request->validate([
                'txt_firstname' => 'required|regex:/^[a-zA-Z-\s]+$/',
                'txt_lastname' => 'required|regex:/^[a-zA-Z-\s]+$/',
                'txt_email' => 'required|email|unique:tbl_users,email',
                'txt_city' => 'required',
                'txt_phone_number' => 'required|numeric',
                'txt_profession' => 'required|regex:/^[a-zA-Z-\s]+$/',
                'txt_address' => 'required',
                'txt_password' => 'required',
                'txt_confirm_password' => 'required',
                ], [
                'txt_firstname.required' => 'Firstname is required',
                'txt_lastname.required' => 'Lastname is required',
                'txt_firstname.regex' => 'Firstname is must be in letters only',
                'txt_lastname.regex' => 'Lastname is must be in letters only',
                'txt_email.required' => 'Email is required',
                'txt_email.email' => 'Email field must have a valid email address',
                'txt_email.unique' => 'Email already exist',
                'txt_city.required' => 'City Name is required',
                'txt_phone_number.required' => 'Phone number is required',
                'txt_phone_number.numeric' => 'Phone number must be in numbers only',
                'txt_profession.required' => 'Your profession is required',
                'txt_profession.regex' => 'Your profession must be in letters only',
                'txt_address.required' => 'First Address Line is required',
                'txt_password.required' => 'First Address Line is required',
                'txt_confirm_password.required' => 'First Address Line is required',
            ]);

            $firstname = ucwords($request->get('txt_firstname'));
            $lastname = ucwords($request->get('txt_lastname'));
            $email = $request->get('txt_email');
            $city = ucwords($request->get('txt_city'));
            $phone_number = $request->get('txt_phone_number');
            $profession = ucwords($request->get('txt_profession'));
            $address = ucwords($request->get('txt_address'));
            $password =  Hash::make($request->get('txt_password'));
            $confirm_password = $request->get('txt_confirm_password');
            $file_name = NULL;


            if(Hash::check($confirm_password, $password)){
                $add_user = new User();
                $add_user->firstname = $firstname;
                $add_user->lastname = $lastname;
                $add_user->email = $email;
                $add_user->city = $city;
                $add_user->phone_number = $phone_number;
                $add_user->profession = $profession;
                $add_user->address = $address;
                $add_user->password = $password;
                $add_user->photo = $file_name;
                $add_user->save();

                $details = [
                    'firstname'=> $first_name,
                    'lastname'=> $last_name,
                    'email'=> $email,
                    'body'=>'Your account has been registered successfully. Please wait for approval.'
                ];

                $feedback = [
                    'firstname'=> $first_name,
                    'lastname'=> $last_name,
                    'email'=> $email,
                    'body'=>'New registration from '.$first_name.' '.$last_name.' Please approve by following the link below.'
                ];

                Mail::to($email)->send(new RegisterMail($details));

                Mail::to('info@goopaperless.com')->send(new FeedbackMail($feedback));


                Alert::toast($firstname.' Registered Successfully, wait for Approval','success');
                return redirect('/');
            }
            else{
                Alert::toast('Passwords do not match, Reset!','warning');
                return redirect()->back();
            }
        }
        catch (exception $e) {
                echo 'Caught exception';
            }
    }
}
