<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function index() {
        $this->load->view('inc/header_view');
        $this->load->view('home/home_view');
        $this->load->view('inc/footer_view');
    }
    
    public function erro() {
        $this->load->view('inc/header_view');
        $this->load->view('erro/e404_view');
        $this->load->view('inc/footer_view');
    }
    public function quem_somos() {
        $this->load->view('inc/header_view');
        $this->load->view('home/quem_somos_view');
        $this->load->view('inc/footer_view');
    }
    public function localizacao() {
        $this->load->view('inc/header_view');
        $this->load->view('home/localizacao_view');
        $this->load->view('inc/footer_view');
    }

    public function contato() {
        $toView = [];
        if($this->session->flashdata("req")){
            $toView['req'] = $this->session->flashdata("req");
        }
        $this->load->view('inc/header_view');
        $this->load->view('home/contato_view', $toView);
        $this->load->view('inc/footer_view');
    }
    
    public function send(){
        $toView = [];
        
        try{
            $nome = $this->input->post('nome');
            $email = $this->input->post('email');
            $telefone = $this->input->post('telefone');
            $titulo = $this->input->post('titulo');
            $mensagem = $this->input->post('mensagem');
            
            if(!$nome || $nome==''){
                throw new Exception("É necessário o preenchimento do nome");
            }
            if(!$email || $email=='' || !valid_email($email)){
                throw new Exception("É necessário o preenchimento de um e-mail válido");
            }
            if(!$mensagem || $mensagem==''){
                throw new Exception("Mensagem inválida");
            }
            
            $msg = "Contato via site:<br><br>";
            $msg.= "Nome: ".$nome."<br><br>";
            $msg.= "E-mail: ".$email."<br><br>";
            $msg.= "Telefone: ".$telefone."<br><br>";
            $msg.= "T&iacute;tulo: ".$titulo."<br><br><br>";
            $msg.= "Mensagem: ".$mensagem."<br><br>";
            $msg.= "---------------------------<br>Fim da Mensagem";
            
            $this->load->library('correio');
            if(!$this->correio->enviar_email("secretaria@2dejulho.org", "Contato através do site - $email", $msg)){
                throw new Exception("Erro ao enviar a mensagem");
            }
            $this->msg->sucesso("Mensagem enviada. Aguarde nosso contato.");
            
            
        } catch (Exception $ex) {
            $req = $this->input->post();
            $this->session->set_flashdata("req", $req);
            $this->msg->erro($ex->getMessage());
        } finally{
            redirect(site_url('home/contato'));
        }
    }

}
