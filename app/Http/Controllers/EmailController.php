<?php
namespace App\Http\Controllers;

use App\Notifications\CustomEmail;
use App\User;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function customEmail(Request $request)
    {
        if ($request->isMethod('get'))
            return view('custom_email');

    }
}
