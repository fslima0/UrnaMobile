<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anexos_model extends CI_Model {
   public function inserir($uploads) {
      $this->db->insert('anexos', $uploads);
      $resultado = $this->db->insert_id();

      return $resultado;
   }

   public function pesquisarAnexoPorId($id) {
      $this->db->select('filename');
      $this->db->from('candidatos c');
      $this->db->join('anexos a', 'c.foto_candidato_id = a.id', 'inner');
      $this->db->where('c.id', $id);
      $query = $this->db->get();
      
      return $query->result();
   }
}