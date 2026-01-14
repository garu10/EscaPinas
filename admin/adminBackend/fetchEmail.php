<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use PhpImap\Mailbox;

$filter = $_GET['filter'] ?? 'all';
$server = '{imap.gmail.com:993/imap/ssl/novalidate-cert}INBOX';
$user = 'escapinas26@gmail.com';
$pass = 'tkwa oeyg csxd dfst';

try {
    $mailbox = new Mailbox($server, $user, $pass);

    // Switch search criteria based on filter
    $criteria = ($filter === 'unread') ? 'UNSEEN' : 'ALL';
    $mailsIds = $mailbox->searchMailbox($criteria);

    if (empty($mailsIds)) {
        return [];
    }

    rsort($mailsIds);
    $mailsIds = array_slice($mailsIds, 0, 15);
    $display_emails = [];

    foreach ($mailsIds as $mailId) {
        $mail = $mailbox->getMail($mailId, false);

        // Capture the full email address (e.g., "user@gmail.com")
        $fullEmail = $mail->fromAddress;

        $display_emails[] = [
            'id'      => $mailId,
            'from'    => htmlspecialchars($mail->fromName ?: $mail->fromAddress),
            'email'   => htmlspecialchars($fullEmail), // This contains the @gmail.com part
            'subject' => htmlspecialchars($mail->subject),
            'date'    => date("M d, H:i", strtotime($mail->date)),
            'unread'  => empty($mail->isSeen),
            'body'    => $mail->textHtml ?: nl2br(htmlspecialchars($mail->textPlain))
        ];
    }
    return $display_emails;
} catch (Exception $e) {
    return [];
}
