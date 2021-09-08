<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Rules\ContactRule;

class Contact extends Model
{
    use HasFactory;

    protected $guarded = array('id');

    protected $fillable = ['fullname','gender','email','postcode','address','building_name','opinion'];

    public static $rules = array(
        'lastname' => 'required',
        'firstname' => 'required',
        'email' => 'required|email',
        'address' => 'required',
        'opinion' =>'required|max:120',
    );
}
