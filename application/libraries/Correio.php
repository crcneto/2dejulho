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
            'smtp_host' => 'smtp.hosang.adv.br',
            'smtp_port' => 587,
            //'validate'=>'TRUE',
            'smtp_user' => 'advocacia@hosang.adv.br',
            'smtp_pass' => 'Hos_Adv056007',
            'mailtype' => 'html',
            'charset' => 'utf-8',
            //"newline"=>"\r\n",
            //'smtp_crypto'=>'tls',
        );
        
        $this->CI->load->library('email');
        $this->CI->email->initialize($config);
        $this->CI->email->set_newline("\r\n");
        $this->CI->email->from('advocacia@hosang.adv.br', 'Hosang Advocacia', 'advocacia@hosang.adv.br');
        $this->CI->email->to($to);
        $this->CI->email->reply_to('advocacia@hosang.adv.br', 'Hosang Advocacia');
        $this->CI->email->subject($title);
        $this->CI->email->message($message);
        return $this->CI->email->send();
        
    }
}