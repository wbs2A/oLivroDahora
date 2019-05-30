<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Mail\Email;
class EmailController extends Controller
{
    public function sendEmail(){
	    Mail::to(Auth::user()->email)->send(new Email('somthing'));
	}
}
