<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Votos_model extends CI_Model {
   public function listar($id) {
      $this->db->where('pessoa_id', $id);
      $query = $this->db->get('votos');

      return $query->result_array();
   }

   public function inserir($voto) {
      $resultado = $this->db->insert('votos', $voto);
      
      return $resultado;
   }
}