<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Métodos:
 * get_all($order), get_by_id($id), exists($id), save($dados, $id), insert($dados), delete($id)
 * remove($id), desativa($id), ativa($id)
 */

class MY_Model extends CI_Model{
    
    private $tabela;
    
    public function __construct() {
        parent::__construct();
    }
    
    
    
    //define a tabela
    public function set_tabela($tabela){
        $this->tabela = $tabela;
    }
    
    /**
     * Retorna todas as tuplas da tabela 
     * @param string $order = 'campo ASC/DESC'
     * @return array
     */
    
    public function get_all($order = null){
        $this->db->from($this->tabela);
        if($order){
            $this->db->order_by($order);
        }
        $rs = $this->db->get();
        return $rs->result_array();
    }
    
    /**
     * Retorna todas as tuplas num array, com o ID de cada tupla como chave
     * @param type $order
     * @return type
     */
    public function get_all_by_id($order = null){
        $all = $this->get_all($order);
        $ret = [];
        foreach ($all as $k=>$v){
            $ret[$v['id']] = $v;
        }
        return $ret;
    }
    
    /**
     * Retorna a tupla identificada pelo campo ID (identificador)
     * @param int $id
     * @return array
     */
    
    public function get_by_id($id){
        $this->db->from($this->tabela);
        $this->db->where('id', $id);
        $rs = $this->db->get();
        return $rs->row_array();
    }
    
    
    public function exists($id){
        $this->db->from($this->tabela);
        $this->db->where('id', $id);
        $rs = $this->db->get();
        if($rs->num_rows()>0){
            return true;
        }else{
            return false;
        }
    }
    
    /**
     * Insert or Update dependendo do parâmetro $id.
     * @param int $id
     * @param array $dados ['campo1'=>'valor1', 'campo2'=>'valor2', ...]
     * @return boolean verificado por 'transaction'
     */
    
    public function save($dados, $id=null){
        if($id){
           $this->db->trans_begin();
            $this->db->where("id", $id);
            $this->db->update($this->tabela, $dados);

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return false;
            } else {
                $this->db->trans_commit();
                return true;
            }
        }else{
            $this->db->trans_begin();
            $this->db->insert($this->tabela, $dados);

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return false;
            } else {
                $this->db->trans_commit();
                return true;
            }
        }
    }
    
    /**
     * Insert or Update dependendo do parâmetro $dados['id'].
     * @param int $dados['id']
     * @param array $dados ['campo1'=>'valor1', 'campo2'=>'valor2', ...]
     * @return boolean verificado por 'transaction'
     */
    public function insert($dados){
        
        if(isset($dados['id']) && is_numeric($dados['id'])){
           $this->db->trans_begin();
            $this->db->where("id", $dados['id']);
            
            $this->db->update($this->tabela, $dados);

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return false;
            } else {
                $this->db->trans_commit();
                return true;
            }
        }else{
            $this->db->trans_begin();
            $this->db->insert($this->tabela, $dados);

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return false;
            } else {
                $this->db->trans_commit();
                return true;
            }
        }
    }
    
    /**
     * Define 'STATUS=0'. NÃO DELETA A TUPLA.
     * @param int $id
     * @return boolean verificado por 'transaction'
     */
    
    public function delete($id){
        $this->db->trans_begin();
        $dados = ['status'=>0];
        $this->db->where("id", $id);
        $this->db->update($this->tabela, $dados);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }
    
    /**
     * ****ATENÇÃO****
     * REMOVE A TUPLA. Não pode ser desfeito. Prefira 'delete'
     * @param int $id
     * @return boolean verificado por 'transaction'
     */
    public function remove($id){
        $this->db->trans_begin();
        $this->db->where("id", $id);
        $this->db->delete($this->tabela);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
        
    }
    
    /**
     * Define o campo 'status' como 0 (tupla desativada)
     * @param int $id identificador da tupla
     * @return boolean True se a alteração ocorrer sem problemas ou false pelo contrário
     */
    public function desativa($id){
        $this->db->where('id', $id);
        $this->db->set('status', 0);
        $this->db->update($this->tabela);
        if($this->db->affected->rows()>0){
            return true;
        }else{
            return false;
        }
        
    }
    
    /**
     * Define o campo 'status' como 1 (tupla ativa)
     * @param int $id identificador da tupla
     * @return boolean True se a alteração ocorrer sem problemas ou false pelo contrário
     */
    public function ativa($id){
        $this->db->where('id', $id);
        $this->db->set('status', 2);
        $this->db->update($this->tabela);
        if($this->db->affected->rows()>0){
            return true;
        }else{
            return false;
        }
        
    }
    
    /**
     * Pesquisa se o valor informado ($valor) existe na coluna ($campo)
     * @param string $campo nome da coluna
     * @param string $valor valor a ser pesquisado
     * @return boolean Retorna somente true/false para a existência do item;
     */
    public function campo_existe($campo, $valor){
        $this->db->from($this->tabela);
        $this->db->like($campo, $valor);
        $rs = $this->db->get();
        if($rs->num_rows()>0){
            return true;
        }else{
            return false;
        }
    }
    
    /**
     * Retorna a linha onde for encontrada a ocorrência do valor/coluna informados
     * @param string $campo
     * @param string $valor
     * @return array Retorna a 1ª tupla da pesquisa em forma de array
     */
    public function get_by_campo($campo, $valor){
        $this->db->from($this->tabela);
        $this->db->where($campo, $valor);
        $this->db->limit(1);
        $rs = $this->db->get();
        return $rs->row_array();
        
    }
    
    
}
