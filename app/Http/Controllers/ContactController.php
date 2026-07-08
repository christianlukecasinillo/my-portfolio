<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Twilio\Rest\Client as TwilioClient;

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
            'phone'   => ['nullable', 'regex:/^[0-9]+$/', 'max:15'],
            'reason'  => ['required', 'string', 'max:2000'],
        ]);

        $message = ContactMessage::create($validated);

        // Notify yourself by SMS via Twilio. If Twilio isn't configured yet,
        // this quietly logs instead of throwing an error to the visitor.
        try {
            $sid    = config('services.twilio.sid');
            $token  = config('services.twilio.auth_token');
            $from   = config('services.twilio.from_number');
            $to     = config('services.twilio.to_number');

            if ($sid && $token && $from && $to) {
                $body = sprintf(
                    "New portfolio inquiry from %s (%s)\nCompany: %s\nPhone: %s\nReason: %s",
                    $message->name,
                    $message->email,
                    $message->company ?: '-',
                    $message->phone ?: '-',
                    \Illuminate\Support\Str::limit($message->reason, 200)
                );

                (new TwilioClient($sid, $token))->messages->create($to, [
                    'from' => $from,
                    'body' => $body,
                ]);
            } else {
                Log::info('Twilio not configured - skipping SMS notification.');
            }
        } catch (\Throwable $e) {
            Log::warning('Could not send SMS notification: '.$e->getMessage());
        }

        // Also notify yourself by email. If mail isn't configured yet,
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

        $successMessage = 'Thanks! Your message has been sent — I\'ll get back to you soon.';

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => $successMessage,
                'data'    => $message,
            ], 200);
        }

        return back()->with('status', $successMessage);
    }
}
