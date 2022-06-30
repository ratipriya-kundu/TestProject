<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dacastro4\LaravelGmail\Services\Message\Mail;

class TestController extends Controller
{
    public function home() {
      return view('home');
    }
}
