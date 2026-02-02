<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function index()
    {
        return view('emails.index');
    }

    // Send email
    public function send(Request $request)
    {
        $validated = $request->validate([
            'audience'     => ['required', 'in:users_only,all,specific'],
            'emails'       => ['nullable', 'string'],
            'subject'      => ['required', 'string', 'max:255'],
            'message'      => ['required', 'string'],
            'button_text'  => ['nullable', 'string', 'max:100'],
            'button_url'   => ['nullable', 'url'],
        ]);

        // 🔹 Collect recipients
        $recipients = collect();

        if ($validated['audience'] === 'users_only') {
            $recipients = User::where('role', 'user')
                ->whereNotNull('email')
                ->pluck('email');
        } elseif ($validated['audience'] === 'all') {
            $recipients = User::whereNotNull('email')->pluck('email');
        } elseif ($validated['audience'] === 'specific') {
            if (empty($validated['emails'])) {
                return back()->withErrors([
                    'emails' => 'Please provide at least one email address.',
                ]);
            }

            $recipients = collect(
                array_filter(
                    array_map('trim', explode(',', $validated['emails']))
                )
            );
        }

        if ($recipients->isEmpty()) {
            return back()->withErrors([
                'audience' => 'No valid recipients found.',
            ]);
        }

        // 🔹 App settings
        $appName     = config('app.name');
        $replyTo  = $setting->contact_email ?? null;

        // 🔹 Send emails
        foreach ($recipients as $email) {
            Mail::send('emails.broadcast', [
                'content'     => $validated['message'],
                'buttonText'  => $validated['button_text'] ?? null,
                'buttonUrl'   => $validated['button_url'] ?? null,
                'appName'     => $appName,
            ], function ($mail) use ($email, $validated, $appName, $replyTo) {
                $mail->to($email)
                    ->subject($validated['subject'])
                    ->from(config('mail.from.address'), $appName);

                if ($replyTo) {
                    $mail->replyTo($replyTo);
                }
            });
        }

        return back()->with('success', 'Email sent successfully to ' . $recipients->count() . ' recipient(s).');
    }
}
