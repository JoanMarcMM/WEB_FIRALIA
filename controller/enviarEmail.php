<?php
session_start();

$name = $_POST["name"];
$email = $_POST["email"];
$subject = $_POST["subject"];
$message = $_POST["message"];

require "vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

$mail = new PHPMailer(true);

$mail->isSMTP();
$mail->SMTPAuth = true;

$mail->Host = "smtp.gmail.com";
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;

$mail->Username = "firalia.correo@gmail.com";
$mail->Password = "vtbq kvwp ptkh tooj";

$mail->setFrom('firalia.correo@gmail.com', 'Formulario Firalia');
$mail->addReplyTo($email, $name);
$mail->addAddress("firalia.correo@gmail.com", "Firalia");

$mail->Subject = $subject;
$mail->Body = $message;

$mail->send();
$_SESSION["enviado"] = "enviado";
header("Location: ../view/support.php?error=1");