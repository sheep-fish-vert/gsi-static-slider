<?php
    $subject = 'Заявка с сайта ГСИ';
    $mess = '';
    $mess .= '<hr>';
    if(isset($_POST['info'])) {
        $subject = $_POST['info'];
    }
    if(isset($_POST['contact_name'])) {
        $name = substr(htmlspecialchars(trim($_POST['contact_name'])), 0, 100);
        $mess .= '<b>Имя:</b> ' . $name . '<br>';
    }
    if(isset($_POST['contact_theme'])) {
        $tel = substr(htmlspecialchars(trim($_POST['contact_theme'])), 0, 100);
        $mess .= '<b>Тема:</b> ' . $tel . '<br>';
    }
    if(isset($_POST['contact_mail'])) {
        $mail = substr(htmlspecialchars(trim($_POST['contact_mail'])), 0, 100);
        $mess .= '<b>Почта:</b> ' . $mail . '<br>';
    }
    if(isset($_POST['contact_text'])) {
        $text = substr(htmlspecialchars(trim($_POST['contact_text'])), 0, 100);
        $mess .= '<b>Текст сообщения:</b> ' . $text . '<br>';
    }
    $mess .= '<hr>';
    // подключаем файл класса для отправки почты
    require 'class.phpmailer.php';

    $mail = new PHPMailer();
    $mail->AddAddress('radion91@gmail.com','');   // кому - адрес, Имя
    $mail->IsHTML(true);                        // выставляем формат письма HTML
    $mail->Subject = $subject; // тема письма
    $mail->CharSet = "UTF-8";                   // кодировка
    $mail->Body = $mess;
    if(isset($_FILES['file'])) {
            if($_FILES['file']['error'] == 0){
            $mail->AddAttachment($_FILES['file']['tmp_name'], $_FILES['file']['name']);
        }
    }
    // отправляем наше письмо
    if (!$mail->Send()){
        die ('Mailer Error: ' . $mail->ErrorInfo);
    }else{
        echo 'true';
    }?>