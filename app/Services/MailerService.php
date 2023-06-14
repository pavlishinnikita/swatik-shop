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
     * Sends raw message to recipient
     * @param array $emailTo - recipients
     * @param string $emailFrom - from email
     * @param string $emailFromName - from name
     * @param string $subject - mail subject
     * @param string $message - message text
     * @param array $bccRecipients - BCC recipients
     * @return bool - result of execution
     */
    public function sendRaw(array $emailTo, string $emailFrom, string $emailFromName, string $subject, string $message, array $bccRecipients = []) : bool
    {
        try {
            Mail::raw($message, function($message) use ($emailTo, $emailFrom, $emailFromName, $subject, $bccRecipients) {
                $message
                    ->to($emailTo)
                    ->subject($subject);
                $message->from($emailFrom, $emailFromName);
                if (!empty($bccRecipients)) {
                    $message->bcc($bccRecipients);
                }
            });
        } catch (\Exception $e) {
            logger()->error('Error of sending raw message:', [
                'to' => implode(',', $emailTo),
                'subject' => $subject,
                'error' => $e->getMessage(),
            ]);
            return false;
        }
        return true;
    }

    /**
     * Send message to recipient
     * @param array $emailTo - recipient
     * @param string $emailFrom
     * @param string $emailFromName
     * @param string $subject - mail subject
     * @param array $bccRecipients
     * @param string $view - view template
     * @param array $params - params for template
     * @return bool - result of execution
     */
    public function send(array $emailTo, string $emailFrom, string $emailFromName, string $subject, array $bccRecipients = [], string $view = '', array $params = []) : bool
    {
        try {
            Mail::send($view, $params, function($message) use ($emailTo, $emailFrom, $emailFromName, $subject, $bccRecipients) {
                $message
                    ->to($emailTo)
                    ->subject($subject);
                $message->from($emailFrom, $emailFromName);
                if (!empty($bccRecipients)) {
                    $message->bcc($bccRecipients);
                }
            });
        } catch (\Exception $e) {
            logger()->error('Error of sending message:', [
                'to' => $emailTo,
                'subject' => $subject,
                'view' => $view,
                'error' => $e->getMessage(),
            ]);
            return false;
        }
        return true;
    }
}
