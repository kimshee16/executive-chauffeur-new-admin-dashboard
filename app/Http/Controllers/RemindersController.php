<?php

namespace App\Http\Controllers;

use App\Models\Reminders;
use Illuminate\Http\Request;

class RemindersController extends Controller
{

    public function index()
    {
        $reminder1Data = Reminders::query()
        ->where('id', '1')
        ->get();

        $reminder2Data = Reminders::query()
        ->where('id', '2')
        ->get();

        return view('reminders.reminders', compact('reminder1Data', 'reminder2Data'));
    }

    public function editremindersfromid1(Request $request)
    {
        $emailaddress1 = $request->input('emailaddress1');
        $emailsubject1 = $request->input('emailsubject1');
        $emailbody1 = $request->input('emailbody1');

        $reminders = Reminders::find(1);

        $reminders->from1 = $emailaddress1;
        $reminders->subj = $emailsubject1;
        $reminders->body = $emailbody1;
        $reminders->save();

        return redirect()->route('reminders', ['success' => '2']);
    }

    public function editremindersfromid2(Request $request)
    {
        $emailaddress2 = $request->input('emailaddress2');
        $emailsubject2 = $request->input('emailsubject2');
        $emailbody2 = $request->input('emailbody2');

        $reminders = Reminders::find(2);

        $reminders->from1 = $emailaddress2;
        $reminders->subj = $emailsubject2;
        $reminders->body = $emailbody2;
        $reminders->save();

        return redirect()->route('reminders', ['success' => '2']);
    }

}
