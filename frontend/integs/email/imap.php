<?php
// need ito gawan ng UI
$config = require __DIR__ . '/../../php/imapConfig.php';
$inbox = imap_open(
    $config['host'],
    $config['user'],
    $config['pass']
);

// Get all emails
$emails = imap_search($inbox, 'ALL');

// Add Bootstrap CSS for styling
echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">';
echo '<div class="container mt-5 mb-5">';
echo '<h2 class="mb-4">Email Inbox</h2>';

if ($emails) {
    rsort($emails); // newest first

    foreach ($emails as $email_number) {
        $overview = imap_fetch_overview($inbox, $email_number, 0)[0];
        $structure = imap_fetchstructure($inbox, $email_number);
        $body = '';

        // --- Existing Body Parsing Logic ---
        if (isset($structure->parts)) {
            foreach ($structure->parts as $part_number => $part) {
                if ($part->type == 0) { // text
                    $body = imap_fetchbody($inbox, $email_number, $part_number + 1);
                    if ($part->encoding == 3) { $body = base64_decode($body); } 
                    elseif ($part->encoding == 4) { $body = quoted_printable_decode($body); }

                    if (strtoupper($part->subtype) === 'HTML') { break; }
                }
            }
        } else {
            $body = imap_body($inbox, $email_number);
            $body = quoted_printable_decode($body);
        }

        // --- New Card UI ---
        ?>
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-light">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-primary">
                        <?php echo htmlspecialchars($overview->subject ?? '(No Subject)'); ?>
                    </h5>
                    <span class="badge bg-secondary">
                        <?php echo date("M d, Y H:i", strtotime($overview->date)); ?>
                    </span>
                </div>
                <div class="mt-1">
                    <small class="text-muted">From: <strong><?php echo htmlspecialchars($overview->from); ?></strong></small>
                </div>
            </div>
            <div class="card-body" style="max-height: 400px; overflow-y: auto;">
                <div class="email-content">
                    <?php echo $body; // The body is usually HTML from the email sender ?>
                </div>
            </div>
        </div>
        <?php
    }
} else {
    echo '<div class="alert alert-info">No emails found.</div>';
}

echo '</div>'; // End container
imap_close($inbox);
?>