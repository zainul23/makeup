<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mailer extends CI_Controller {

    function __construct(){
        parent::__construct();

        $this->load->helper('url');
        $this->load->model('Mmail', 'mmail');
        $this->load->library('email');
    }

    public function run($count = 3) {
        $mailConfig = $this->mmail->getMailConfig();

        $config = array("smpt_host" => $mailConfig['host'],
            "smtp_auth" => true,
            "smtp_user" => $mailConfig['email'],
            "smtp_pass" => base64_decode($mailConfig['password']),
            "smtp_port" => $mailConfig['port']);

        $this->email->initialize($config);

        $emails = $this->mmail->getMails($count);
        if ($emails != NULL) {
            $sent = 0;
            foreach ($emails as $email) {
                // set destination, subject and message of email delivery

                $mail_to = $email['mail_to'];
                $subject = $email['mail_subject'];
                $data['message'] = $email['message'];
                $message = $this->load->view('email/'.$email['template'], $data, TRUE);

                $mail = $this->email
                    ->from($mailConfig['email'])   // Optional, an account where a human being reads.
                    ->to($mail_to)
                    ->subject($subject)
                    ->message($message);

                // send email
                if ($mail->send()) {
                    $sent++;
                    $this->mmail->delete($email['id']);
                }
            }

            echo "- Send Email Complete<br>";
            echo "- " . $sent . " Email sent successfully";
            exit;
        }
        // if count is less than 1
        echo "There is no data to send";
    }

}
