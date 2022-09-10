<?php

namespace App\Http\Controllers;

use App\Http\Request\ContactRequest;
use App\Mail\MessageMail;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class ContactController extends Controller
{
    public function create ()
    {
        return view ("pages.contact", $this->data);
    }

    public function store (ContactRequest $request)
    {
        try {
            $validated = $request->validated ();
            if ($validated) {
                Message::create ($validated);
                $details = [
                    'title' => 'Message from ' . $validated['email'],
                    'date' => date ('m/d/Y'),
                    'body' => $validated['message'],
                    'name' => $validated['name'],
                ];
                $admins = User::where ('role_id', 2)->get ();
                foreach ($admins as $admin) {
                    Mail::to ($admin->email)->send (new MessageMail($details));
                }
                return redirect ("/contactForm")->with ('status', "You successfully sent message");
            }
        } catch (\Exception $exception) {
            return redirect ("/contactForm")->with ('error', "Your message has not been sent. Try again.");
        }
    }
}

