<?php
ob_start();
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../frontend/php/connect.php'; 
use PhpImap\Mailbox;

header('Content-Type: application/json');

$server = '{imap.gmail.com:993/imap/ssl/novalidate-cert}INBOX';
$user = 'escapinas26@gmail.com';
$pass = 'tkwa oeyg csxd dfst';

try {
    $mailbox = new Mailbox($server, $user, $pass);
    $mailsIds = $mailbox->searchMailbox('ALL');
    
    if (empty($mailsIds)) {
        ob_clean();
        echo json_encode(['success' => true, 'new_emails' => 0]);
        exit;
    }

    rsort($mailsIds);
    $mailsIds = array_slice($mailsIds, 0, 15); // Sync latest 15

    $new_count = 0;
    foreach ($mailsIds as $mailId) {
        $stmt = $conn->prepare("SELECT id FROM admin_emails WHERE mail_id = ?");
        $stmt->bind_param("i", $mailId);
        $stmt->execute();
        
        if ($stmt->get_result()->num_rows == 0) {
            $mail = $mailbox->getMail($mailId, false);
            $from = htmlspecialchars($mail->fromName ?: $mail->fromAddress);
            $body = $mail->textHtml ?: nl2br(htmlspecialchars($mail->textPlain));
            $unread = $mail->isSeen ? 0 : 1;
            $date = date("Y-m-d H:i:s", strtotime($mail->date));

            $ins = $conn->prepare("INSERT INTO admin_emails (mail_id, sender_name, subject, body, date_received, is_unread) VALUES (?, ?, ?, ?, ?, ?)");
            $ins->bind_param("issssi", $mailId, $from, $mail->subject, $body, $date, $unread);
            $ins->execute();
            $new_count++;
        }
    }
    ob_clean();
    echo json_encode(['success' => true, 'new_emails' => $new_count]);
} catch (Exception $e) {
    ob_clean();
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}