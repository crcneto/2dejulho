<?php

class Usuario_model extends MY_Model{
    public function __construct() {
        parent::__construct();
        $this->set_tabela("usuario");
    }
    
    public function login($mail, $senha = null){
        
        if(!$senha){
            return false;
        }else{
            
            if(!$this->existe_email($mail)){
                return false;
            }else{
                $user = $this->carrega_usuario_por_email($mail);
                
                if(md5($senha) != $user['senha']){
                    return false;
                }else{
                    return true;
                }
            }
        }
    }
    
    public function carrega_usuario_por_email($mail){
        if(!$this->existe_email($mail)){
            return false;
        }else{
            $this->db->from("usuario");
            $this->db->where("email", $mail);
            $this->db->limit(1);
            $rs = $this->db->get();
            return $rs->row_array();
        }
    }
    
    
    public function existe_email($mail){
        
        $this->db->from("usuario");
        $this->db->where("email", $mail);
        $rs = $this->db->get();
        if($rs->num_rows()>0){
            return true;
        } else {
            return false;
        }
    }
}