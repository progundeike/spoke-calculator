<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Models\Rim;

class RimController extends Controller
{
    public function index()
    {
        $lists = Rim::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        return view('rim.index', ['lists' => $lists]);
    }

    public function create()
    {
        return view('rim.create');
    }
}
