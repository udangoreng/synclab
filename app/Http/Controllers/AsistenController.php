<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AsistenController extends Controller
{
    public function masterAsisten()
    {
        return view('laboran/kelolaAsisten_lab');
    }
}
