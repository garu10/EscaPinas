<?php
ob_start();
require_once __DIR__ . '/../../frontend/php/connect.php';
require_once __DIR__ . '/../../vendor/autoload.php';
use PhpImap\Mailbox;

header('Content-Type: application/json');

// Get the raw POST data
$json = file_get_contents('php://input');
$data = json_decode($json, true);
$mailId = $data['id'] ?? null;

if (!$mailId) {
    ob_clean();
    echo json_encode(['success' => false, 'message' => 'No Email ID provided']);
    exit;
}

try {
    // First, update the database to mark as read
    $update = $conn->prepare("UPDATE admin_emails SET is_unread = 0 WHERE mail_id = ?");
    $update->bind_param("i", $mailId);
    if (!$update->execute()) {
        throw new Exception("Database update failed: " . $update->error);
    }
    $update->close();
    
    // Then mark as read on the Gmail server
    $server = '{imap.gmail.com:993/imap/ssl/novalidate-cert}INBOX';
    $user = 'escapinas26@gmail.com';
    $pass = 'tkwa oeyg csxd dfst';
    
    $mailbox = new Mailbox($server, $user, $pass);
    $mailbox->markMailAsRead($mailId);
    
    ob_clean();
    echo json_encode(['success' => true, 'message' => 'Email marked as read']);
} catch (Exception $e) {
    ob_clean();
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
exit;
?>