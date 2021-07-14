<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Correio {

    private $CI;
    
    public function __construct() {
        $this->CI = & get_instance();
    }
    
    public function sendMail($to, $title, $message){
        
        $config = Array(
            //'useragent'=> 'sendmail',
            'protocol' => 'smtp',
            'smtp_host' => 'mail.2dejulho.org',
            'smtp_port' => 25,
            //'validate'=>'TRUE',
            'smtp_user' => 'associacao',
            'smtp_pass' => '@2dejulho',
            'smtp_auth' => TRUE,
            'mailtype' => 'html',
            //'wordwrap'=> TRUE,
            'charset' => 'utf-8',
            //"newline"=>"\r\n",
            //'crlf'=>"\r\n"
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
}