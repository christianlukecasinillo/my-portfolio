<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Show the one-page portfolio.
     */
    public function index()
    {
        return view('welcome', [
            'profile' => config('profile'),
        ]);
    }

    /**
     * Store an inquiry submitted by an employer/recruiter.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'    => ['required', 'string', 'max:255'],
            'email'   => ['required', 'email', 'max:255'],
            'company' => ['nullable', 'string', 'max:255'],
            'phone'   => ['nullable', 'string', 'max:50'],
            'reason'  => ['required', 'string', 'max:2000'],
        ]);

        $message = ContactMessage::create($validated);

        // Optional: email yourself a copy. If mail isn't configured yet,
        // this quietly logs instead of throwing an error to the visitor.
        try {
            $to = config('profile.contact.email');
            if ($to) {
                Mail::raw(
                    "New portfolio inquiry from {$message->name} ({$message->email})\n\n"
                    . "Company: {$message->company}\nPhone: {$message->phone}\n\n"
                    . "Reason:\n{$message->reason}",
                    function ($mail) use ($to, $message) {
                        $mail->to($to)
                            ->subject('New portfolio contact from '.$message->name);
                    }
                );
            }
        } catch (\Throwable $e) {
            Log::warning('Could not send contact notification email: '.$e->getMessage());
        }

        return back()->with('status', 'Thanks! Your message has been sent — I\'ll get back to you soon.');
    }
}
