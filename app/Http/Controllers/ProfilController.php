<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        return view('admin.profil.index');
    }
}
