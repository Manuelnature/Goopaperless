<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

class LinkController extends Controller
{
    public function index(){
        $get_all_links = Link::all();
        $get_all_users = User::all();

        $user_session = Session::get('user_session')[0];
        $active_user = $user_session->firstname." ".$user_session->lastname;

        $all_my_shared_links = Link::where('created_by', $active_user)->get();

        return view('pages.share_link', compact('get_all_users', 'get_all_links', 'all_my_shared_links'));
    }

    public function share_link(Request $request){
        try {
            // dd($request->all());
            $request->validate([
                'txt_link' => 'required',
                'txt_share_to' => 'required',
                ], [
                'txt_link.required' => 'Link field is required',
                'txt_share_to.required' => 'Link user is required',
            ]);

            $link = $request->get('txt_link');
            $shared_to = $request->get('txt_share_to');
            $description = $request->get('txt_description');

            $user_session = Session::get('user_session')[0];
            $active_user = $user_session->firstname." ".$user_session->lastname;

            $load_link = new Link();
            $load_link->link = $link;
            $load_link->shared_to = $shared_to;
            $load_link->description = $description;
            $load_link->created_by = $active_user;
            $load_link->save();

            Alert::toast('Link shared to '.$shared_to.' successfully', 'success');
            return redirect()->back();
        }
        catch (exception $e)
        {
            echo 'Caught exception';
        }
    }

    public function edit_link($id){
        try {
            $link_to_edit = Link::find($id);
            $get_all_users = User::all();
            return view('pages.edit_link', compact('link_to_edit', 'get_all_users'));
        } catch (exception $e) {
            echo 'Caught exception';
        }
    }

    public function update_shared_link(Request $request, $id){
        try {

            $user_session = Session::get('user_session')[0];
            $active_user = $user_session->firstname." ".$user_session->lastname;
            $today_date = Carbon::now()->toDateTimeString();

            $update_link = Link::find($id);
            $update_link->link = $request->get('txt_edit_link');
            $update_link->shared_to = $request->get('txt_edit_share_to');
            $update_link->description = $request->get('txt_edit_description');
            $update_link->updated_at = $today_date;
            $update_link->updated_by = $active_user;
            $update_link->save();

            Alert::toast('Link Records Successfully Updated','success');
            return redirect('share_link');
        } catch (exception $e) {
            echo 'Caught exception';
        }
    }


    public function delete_shared_link($id){
        try {
            $get_link = Link::find($id);

            $get_link->delete();

            Alert::toast('Link Deleted','warning');
            return redirect('share_link');
        } catch (exception $e) {
            echo 'Caught exception';
        }
     }

}
