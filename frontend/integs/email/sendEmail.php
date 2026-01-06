<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// load the PHPMailer autoloader
require_once __DIR__ . '/../../../vendor/autoload.php';

function sendBookingEmail($conn, $booking_id, $booking_ref)
{
    ob_start();

    //  get data from database
    $query = "SELECT u.email, u.first_name, tp.tour_name, b.total_amount, ts.start_date 
              FROM bookings b
              JOIN users u ON b.user_id = u.user_id
              JOIN tour_schedules ts ON b.schedule_id = ts.schedule_id
              JOIN tour_packages tp ON ts.tour_id = tp.tour_id
              WHERE b.booking_id = $booking_id";

    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);

    if (!$data) {
        ob_end_clean();
        return false;
    }

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'escapinas26@gmail.com'; // gmail natin
        $mail->Password   = 'vkaj cytc vhji dnf';   // app password natin
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        // pag sesendan ng email depende sa user na mag book
        $mail->setFrom('no-reply@escapinas.com', 'EscaPinas Tours');
        $mail->addAddress($data['email'], $data['first_name']);

        // contents ng email natin
        $mail->isHTML(true);
        $mail->Subject = 'Booking Confirmed - Ref: ' . $booking_ref;

        $mail->Body = "
            <div style='font-family: Arial, sans-serif; max-width: 600px; border: 1px solid #eee; padding: 20px;'>
                <h2 style='color: #198754;'>Booking Confirmed!</h2>
                <p>Hi " . htmlspecialchars($data['first_name']) . ",</p>
                <p>Thank you for your payment. Your adventure is ready!</p>
                <div style='background: #f8f9fa; padding: 15px; border-radius: 5px;'>
                    <p><strong>Tour:</strong> " . htmlspecialchars($data['tour_name']) . "</p>
                    <p><strong>Travel Date:</strong> " . date('M d, Y', strtotime($data['start_date'])) . "</p>
                    <p><strong>Reference:</strong> " . $booking_ref . "</p>
                    <p><strong>Total Paid:</strong> ₱" . number_format($data['total_amount'], 2) . "</p>
                </div>
                <p style='margin-top:20px;'>Please present this email or your booking reference upon arrival.</p>
            </div>";

        $mail->send();

        //clean yung buffer and return
        ob_end_clean();
        return true;
    } catch (Exception $e) {
        // log the error for debugging
        error_log("EscaPinas Mailer Error: {$mail->ErrorInfo}");
        ob_end_clean();
        return false;
    }
}
