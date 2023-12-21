<?php

namespace App\Controllers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Email extends BaseController
{
    public function __construct()
    {
        helper(['form']);
    }

    public function index()
    {
        return view('tampilan_form_sendmail');
    }

    public function sendmail()
    {
        $to                 = $this->request->getPost('to');
        $subject            = $this->request->getPost('subject');
        $message            = $this->request->getPost('message');

        $mail = new PHPMailer(true);

        try {
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host       = 'smtp.googlemail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'alamatemailanda@gmail.com'; // ubah dengan alamat email Anda
            $mail->Password   = 'passAnda'; // ubah dengan password email Anda
            $mail->SMTPSecure = 'ssl';
            $mail->Port       = 465;

            $mail->setFrom('alamatemailanda@gmail.com', 'Niagahoster Tutorial'); // ubah dengan alamat email Anda
            $mail->addAddress($to);
            $mail->addReplyTo('alamatemailanda@gmail.com', 'Niagahoster Tutorial'); // ubah dengan alamat email Anda

            // Isi Email
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $message;

            $mail->send();

            // Pesan Berhasil Kirim Email/Pesan Error

            session()->setFlashdata('success', 'Selamat, email berhasil terkirim!');
            return redirect('email');
        } catch (Exception $e) {
            session()->setFlashdata('error', "Gagal mengirim email. Error: " . $mail->ErrorInfo);
            return  redirect('email');
        }
    }
}
