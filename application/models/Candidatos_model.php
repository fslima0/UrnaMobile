<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Candidatos_model extends CI_Model {
   public function listar($id) {
      $this->db->where('pessoa_id', $id);
      $query = $this->db->get('candidatos');

      return $query->result();
   }

   public function inserir($id) {
      $this->db->insert('candidatos', $id);
      $resultado = $this->db->insert_id();
      
      return $resultado;
   }
   
   public function pesquisarPorComarca($comarca_id) {
      $this->db->select('c.id, p.nome');
      $this->db->from('pessoas p');
      $this->db->join('candidatos c', 'p.id = c.pessoa_id', 'inner');
      $this->db->join('eleicoes e', 'e.id = c.eleicao_id', 'inner');
      $this->db->where('e.status', '1');
      $this->db->where('comarca_id', $comarca_id);
      $query = $this->db->get();

      return $query->result();
   }

   public function pesquisarPorId($id) {      
      $this->db->select('c.eleicao_id, c.id, c.foto_candidato_id, p.nome, c.descricao_candidato');
      $this->db->from('candidatos c');
      $this->db->join('pessoas p', 'p.id = c.pessoa_id', 'inner');
      $this->db->where('c.id', $id);
      $query = $this->db->get();

      return $query->result();
   }
}