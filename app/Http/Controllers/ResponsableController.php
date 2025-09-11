<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResponsableController extends Controller
{
    public function index() {
        $user = Auth::user();
        $service = $user->service ?? null;

        return view('responsable.interface');
    }
}
