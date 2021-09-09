<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Rules\ContactRule;

class ContactController extends Controller
{
    public function index()
    {
        return view('index');
    }


    public function confirm(ContactRequest $request)
    {
        
        $request->validate([
            'postcode' => ['required',new ContactRule()],
        ]);
        $name = $request->lastname.$request->firstname;
        $item = [
            'fullname' => $name,
            'gender' => $request->gender,
            'email' => $request->email,
            'postcode' => $request->postcode,
            'address' => $request->address,
            'building_name' => $request->building_name,
            'opinion' => $request->opinion,
        ];
        $request->session()->put('item',$item);
        return view('confirm',$item);
    }

    public function post(Request $request)
    {
        $item = $request->session()->get('item');
        Contact::create($item);
        $request->session()->forget('item');
        return view('thanks');
    }

    public function get()
    {
        Contact::all();
        $input = [
            '_name' => '',
            '_gender' => '',
            '_email' => '',
            '_start' => '',
            '_end' => '',
        ];
        return view('find',compact('input'));
    }

    public function find(Request $request) 
    {
        Contact::all();
        
        $query = Contact::query();

        $name = $request->name;
        $gender = $request->gender;
        $email = $request->email;
        $start = $request->start;
        $end = $request->end;

        if(!empty($name)){
            $query->where('fullname','LIKE','%'.$name.'%');
        } 

        if(!empty($gender)) {
            $query->where('gender',$gender);
        } 

        if(!empty($email)){
            $query->where('email','LIKE','%'.$email.'%');
        } 

        if(!empty($start) && !empty($end)) {
            $query->whereBetween('created_at',[$start,$end]);
        } 

        $data = $query->paginate(10);
        
        $input = [
            '_name' => $name,
            '_gender' => $gender,
            '_email' => $email,
            '_start' => $start,
            '_end' => $end,
        ];

        return view('/find',compact('data','input'));
    }

    public function delete(Request $request) 
    {
        
        Contact::find($request->id)->delete();
        return back();
    }

}
