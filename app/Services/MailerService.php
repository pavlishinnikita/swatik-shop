<?php

namespace App\Services;

use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;

/**
 * @package App\Services
 * @category Services
 *
 * class MailerService - service class for mailing
 */
class MailerService
{
    /**
     * Send message to recipient
     * @param string $emailTo - recipient
     * @param string $nameTo - recipient name
     * @param string $subject - mail subject
     * @param string $view - view template
     * @param array $params - params for template
     * @return bool - result of execution
     */
    public function send(string $emailTo, string $nameTo, string $subject, string $view = '', array $params = []) : bool
    {
        try {
            Mail::send($view, $params, function($message) use ($nameTo, $emailTo, $subject) {
                $message
                    ->to([$emailTo => $nameTo])
                    ->subject($subject);
                $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                $message->bcc([env('MAIL_FROM_BCC_ADDRESS') => env('MAIL_FROM_BCC_NAME')]);
            });
        } catch (\Exception $e) {
            logger()->error('Error of sending message:', [
                'to' => $emailTo,
                'subject' => $subject,
                'view' => $view,
            ]);
            return false;
        }
        return true;
    }
}
