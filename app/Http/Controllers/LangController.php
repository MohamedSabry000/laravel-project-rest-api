<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LangController extends Controller
{
    public function index($locale)
    {
        App::setLocale($locale);
        return view("lang");
    }
}
