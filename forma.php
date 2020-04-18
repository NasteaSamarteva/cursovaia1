<?php

use PHPMailer\PHPMailer\PHPMailer;

require_once __DIR__ . "/vendor/autoload.php";

if (!empty($_POST['name']) and !empty($_POST['email']) and !empty($_POST['phone'])) {
    $message = new PHPMailer();
    $message->isSMTP();
    $message->CharSet = $message::CHARSET_UTF8;
    $message->setLanguage('ru');
    $message->Host = 'smtp.gmail.com';
    $message->SMTPAuth = true;
    $message->Username = $_POST['email'];
    $message->Password = '***';
    $message->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $message->Port = 587;
    $message->Body = 'мы получили от вас запрос будем рады помочь вам';
    $message->Body .= 'Name: ' . $_POST['name'] . '\r\n';
    $message->setFrom($_POST['email'], $_POST['name']);
    $message->addAddress('samartevan@mail.ru');
    $message->isHTML(true);
    $message->Subject = 'новое сообщение';

    if ($message->send()){
        header('Location:/thank.html');
    } else {
        header('Location:/');
    }
} else {
    header('Location:/');
}