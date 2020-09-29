<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comarcas_model extends CI_Model {
   public function listar() {
      $query = $this->db->get('comarcas');
      
      return $query->result();
   }
}