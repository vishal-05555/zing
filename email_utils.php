<?php
// filepath: c:\x2\htdocs\zing\email_utils.php

// Include PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Include Composer's autoloader
require 'vendor/autoload.php';

/**
 * Send an email using PHPMailer
 * 
 * @param string $to Recipient email address
 * @param string $subject Email subject
 * @param string $body Email body (HTML)
 * @param string $from Sender email address (optional)
 * @param string $fromName Sender name (optional)
 * @return bool True if email was sent successfully, false otherwise
 */
function sendEmail($to, $subject, $body, $from = 'noreply@vehicleassistance.com', $fromName = 'Vehicle Assistance') {
    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);
    
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Replace with your SMTP host
        $mail->SMTPAuth = true;
        $mail->Username = 'your-email@gmail.com'; // Replace with your email
        $mail->Password = 'your-app-password'; // Replace with your app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        
        // Recipients
        $mail->setFrom($from, $fromName);
        $mail->addAddress($to);
        
        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;
        
        // Send the email
        $mail->send();
        return true;
    } catch (Exception $e) {
        // Log the error (you can implement your own logging mechanism)
        error_log("Email sending failed: {$mail->ErrorInfo}");
        return false;
    }
}

/**
 * Send a service request acceptance email
 * 
 * @param string $customerEmail Customer's email address
 * @param string $customerName Customer's name
 * @param string $serviceType Type of service requested
 * @param string $providerName Name of the service provider
 * @param string $providerPhone Phone number of the service provider
 * @return bool True if email was sent successfully, false otherwise
 */
function sendServiceAcceptanceEmail($customerEmail, $customerName, $serviceType, $providerName, $providerPhone) {
    $subject = "Your {$serviceType} Request Has Been Accepted";
    
    $body = "
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
            .container { max-width: 600px; margin: 0 auto; padding: 20px; }
            .header { background-color: #3498db; color: white; padding: 20px; text-align: center; }
            .content { padding: 20px; }
            .footer { text-align: center; padding: 20px; font-size: 12px; color: #777; }
            .button { display: inline-block; background-color: #3498db; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <h1>Service Request Accepted</h1>
            </div>
            <div class='content'>
                <p>Dear {$customerName},</p>
                <p>Good news! Your {$serviceType} request has been accepted by {$providerName}.</p>
                <p>The service provider will contact you shortly at your registered phone number.</p>
                <p><strong>Provider Details:</strong></p>
                <ul>
                    <li>Name: {$providerName}</li>
                    <li>Phone: {$providerPhone}</li>
                </ul>
                <p>If you have any questions, please don't hesitate to contact our support team.</p>
                <p>Thank you for choosing Vehicle Assistance!</p>
            </div>
            <div class='footer'>
                <p>This is an automated message, please do not reply to this email.</p>
                <p>&copy; " . date('Y') . " Vehicle Assistance. All rights reserved.</p>
            </div>
        </div>
    </body>
    </html>
    ";
    
    return sendEmail($customerEmail, $subject, $body);
}

/**
 * Send a service request rejection email
 * 
 * @param string $customerEmail Customer's email address
 * @param string $customerName Customer's name
 * @param string $serviceType Type of service requested
 * @return bool True if email was sent successfully, false otherwise
 */
function sendServiceRejectionEmail($customerEmail, $customerName, $serviceType) {
    $subject = "Your {$serviceType} Request Has Been Rejected";
    
    $body = "
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
            .container { max-width: 600px; margin: 0 auto; padding: 20px; }
            .header { background-color: #e74c3c; color: white; padding: 20px; text-align: center; }
            .content { padding: 20px; }
            .footer { text-align: center; padding: 20px; font-size: 12px; color: #777; }
            .button { display: inline-block; background-color: #3498db; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <h1>Service Request Rejected</h1>
            </div>
            <div class='content'>
                <p>Dear {$customerName},</p>
                <p>We regret to inform you that your {$serviceType} request has been rejected by the service provider.</p>
                <p>You can try requesting the service again or contact our support team for assistance.</p>
                <p>We apologize for any inconvenience this may have caused.</p>
                <p>Thank you for your understanding.</p>
            </div>
            <div class='footer'>
                <p>This is an automated message, please do not reply to this email.</p>
                <p>&copy; " . date('Y') . " Vehicle Assistance. All rights reserved.</p>
            </div>
        </div>
    </body>
    </html>
    ";
    
    return sendEmail($customerEmail, $subject, $body);
}