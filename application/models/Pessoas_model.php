<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pessoas_model extends CI_Model {
   function validar($email, $senha) {
      $this->db->where('email', $email);
      $this->db->where('senha', $senha);
      $resultado = $this->db->get('pessoas', 1);

      return $resultado;
   }

   public function inserir($pessoa) {
      $this->db->insert('pessoas', $pessoa);
      $resultado = $this->db->insert_id();
      
      return $resultado;
   }

   public function pesquisarPorEmail($email) {
      $this->db->where('email', $email);      
      $query = $this->db->get('pessoas', 1);

      return $query->result_array();
   }

   public function atualizar($id, $senha) {
      $this->db->query("UPDATE pessoas set senha='$senha' where id='$id'");
   }
}