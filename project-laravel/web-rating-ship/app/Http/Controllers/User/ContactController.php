<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController
{

    public function showContact(){
        return view('user.careabout.contact');
    }

    public function save(Request $request){
        // // dd($request->all());
        // $data = $request->except('_token');
        // Contact::insert($data);
        // $request->session()->flash('success','Gửi thành công');
        // // dd($request->all());
        // return redirect()->back();

        $data = $request->all();
        $contact = new Contact;
        $contact->name = $data['name'];
        $contact->email = $data['email'];
        $contact->phone = $data['phone'];
        $contact->title = $data['title'];
        $contact->message = $data['message'];


        $contact->save();
        $request->session()->flash('success','Gửi thành công');
        return redirect()->back();
    }

}
