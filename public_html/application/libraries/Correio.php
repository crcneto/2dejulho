<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Correio {

    private $CI;

    public function __construct() {
        $this->CI = & get_instance();
    }

    public function sendMail($to, $title, $message) {

        $config = Array(
            //'useragent'=> 'sendmail',
            'protocol' => 'smtp',
            'smtp_host' => 'p3plcpnl1009.prod.phx3.secureserver.net',
            //'smtp_host' => 'mail.2dejulho.org',
            //'smtp_port' => 25,
            'smtp_port' => 465,
            //'validate'=>'TRUE',
            'smtp_user' => 'associacao@2dejulho.org',
            'smtp_pass' => '@2dejulho',
            'mailtype' => 'html',
            'charset' => 'utf-8',
            //"newline"=>"\r\n",
            'crlf' => "\r\n"
                //'smtp_crypto'=>'tls',
        );


        $this->CI->load->library('email');
        $this->CI->email->initialize($config);
        $this->CI->email->set_newline("\r\n");
        $this->CI->email->from('associacao@2dejulho.org', 'Associação 2 de Julho', 'associacao@2dejulho.org');
        $this->CI->email->to($to);
        $this->CI->email->reply_to('associacao@2dejulho.org', 'Associação 2 de Julho');
        $this->CI->email->subject($title);
        $this->CI->email->message($message);
        return $this->CI->email->send();
    }

    public function enviar_email($to, $title, $msg) {
            $from = "associacao@2dejulho.org";
            $assunto = $title;
            $destino = $to;
            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
            $headers .= "From: $from";
            $arquivo = $msg;
            $enviaremail = mail($destino, $assunto, $arquivo, $headers);
            return $enviaremail;
    }

}
