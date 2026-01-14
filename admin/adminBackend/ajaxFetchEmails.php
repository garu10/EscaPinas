<?php
ob_start();
require_once __DIR__ . '/../../frontend/php/connect.php';

header('Content-Type: application/json');

try {
    $filter = $_GET['filter'] ?? 'all';
    $sql = "SELECT * FROM admin_emails ";
    if ($filter === 'unread') {
        $sql .= "WHERE is_unread = 1 ";
    }
    $sql .= "ORDER BY date_received DESC LIMIT 50";

    $result = $conn->query($sql);
    $emails = [];

    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $emails[] = [
                'id'      => $row['mail_id'],
                'from'    => $row['sender_name'],
                'email' => $row['sender_username'],
                'subject' => $row['subject'],
                'date'    => date("M d, H:i", strtotime($row['date_received'])),
                'unread'  => (bool)$row['is_unread'],
                'body'    => $row['body']
            ];
        }
    }

    ob_clean();
    echo json_encode($emails);
} catch (Exception $e) {
    ob_clean();
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}