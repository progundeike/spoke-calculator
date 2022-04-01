<?php

namespace App\Http\Controllers;

use App\Mail\BareMail;
use App\Mail\InquiryMail;
use App\Notifications\InquiryNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class InquiryController extends Controller
{
    public function index()
    {
        return view('inquiry');
    }

    public function sendInquiry (Request $request)
    {
        $data = $request->validate([
            'inquiryName' => 'required|string|max:50',
            'email' => 'nullable|email|max:255',
            'inquiryContent' => 'required|string|max:500',
        ]);

        Mail::to('system@spokelength.net')
            ->send(new InquiryMail($data));

        return back()
            ->withInput()
            ->with('sentMessage', '送信が完了しました。');
    }
}
