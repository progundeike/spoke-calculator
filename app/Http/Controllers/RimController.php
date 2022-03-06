<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Models\Rim;

class RimController extends Controller
{
    public function index()
    {
        $lists = Rim::all()->sortByDesc('created_at');
        return view('rim', ['lists' => $lists]);
    }
}
