<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Classe de persistência de usuários
 */
class Usuario_model extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * Método de persistência do usuário
     * @param array $data Array com os atributos do usuário
     * @return boolean Retorna TRUE se foi inserido o usuário
     */
    public function insert($data) {
        $this->db->insert('usuario', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    public function update($data) {
        $this->db->where(['id' => $data['id']]);
        $this->db->update('usuario', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    public function delete($id) {
        $this->db->delete('usuario', ['id' => $id]);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    public function todos_id(){
        $this->db->order_by('nome ASC');
        $query = $this->db->get('usuario');
        $all = $query->result_array();
        $res = [];
        foreach ($all as $k => $v) {
            $res[$v['id']] = $v;
        }
        return $res;
    }
    
    public function todos_ativos(){
        $this->db->where('status', '2');
        $this->db->order_by('nome', 'ASC');
        $query = $this->db->get('usuario');
        return $query->result_array();
    }
    
}


