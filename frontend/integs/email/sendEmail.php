<?php
// MANUAL LOADING - Dahil nandoon na ang files sa folder
require_once __DIR__ . '/PHPMailer/Exception.php';
require_once __DIR__ . '/PHPMailer/PHPMailer.php';
require_once __DIR__ . '/PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


function sendBookingEmail($conn, $booking_id, $booking_ref)
{
    // 1. Kunin ang data mula sa Database
    $query = "SELECT u.email, u.first_name, tp.tour_name, b.total_amount, ts.start_date 
              FROM bookings b
              JOIN users u ON b.user_id = u.user_id
              JOIN tour_schedules ts ON b.schedule_id = ts.schedule_id
              JOIN tour_packages tp ON ts.tour_id = tp.tour_id
              WHERE b.booking_id = $booking_id";

    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);

    if (!$data) {
        return false;
    }

    $mail = new PHPMailer(true);

    try {
        // --- SMTP SETTINGS ---
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'escapinas26@gmail.com';
        $mail->Password   = 'ksqu urhy ffrp uaic'; // App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        // SSL FIX PARA SA LOCALHOST/XAMPP
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        // --- EMAIL CONTENT ---
        $mail->setFrom('escapinas26@gmail.com', 'EscaPinas Tours');
        $mail->addAddress($data['email'], $data['first_name']);

        $pdfPath = __DIR__ . '/pdf/terms&condition.pdf';
        if (file_exists($pdfPath)) {
            $mail->addAttachment($pdfPath, 'Terms and Conditions.pdf');
        }

        $mail->isHTML(true);
        $mail->Subject = 'Booking Confirmed - Ref: ' . $booking_ref;
        $mail->Body    = "
            <div style='font-family: Arial, sans-serif; padding: 20px; border: 1px solid #eee;'>
                <h2 style='color: #198754;'>Booking Confirmed!</h2>
                <p>Hi " . htmlspecialchars($data['first_name']) . ",</p>
                <p>Your booking for <b>" . htmlspecialchars($data['tour_name']) . "</b> has been confirmed.</p>
                <p><b>Reference No:</b> " . $booking_ref . "</p>
                <hr style='border:none; border-top: 1px solid #eee;'>
                <p style='font-size: 0.9em; color: #555;'>
                    <b>Important:</b> We have attached a copy of our <b>Terms and Conditions</b> to this email. 
                    Please review them carefully before your scheduled tour date.
                </p>
            </div>";

        $mail->send();
        return true;
    } catch (Exception $e) {
        // Ito ay maglalabas ng error sa iyong PHP error log para malaman natin ang exact issue
        error_log("EscaPinas Mailer Error: {$mail->ErrorInfo}");
        ob_end_clean();
        return false;
    }
}
?>