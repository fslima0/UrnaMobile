<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Eleicoes_model extends CI_Model {
   public function listar() {
      $query = $this->db->get('eleicoes');
      
      return $query->result_array();
   }

   public function pesquisarPorId($eleicao_id) {
      $this->db->from('eleicoes e');
      $this->db->join('votos v', 'e.id = v.eleicao_id', 'inner');
      $this->db->where('e.id', $eleicao_id);

      $query = $this->db->get();

      return $query->result_array();
   }

   public function deletar($eleicao_id) {
      $this->db->where('id', $eleicao_id);
      
      return $this->db->delete('eleicoes');
   }

   public function inserir($data) {
      return $this->db->insert('eleicoes', $data);
   }

   public function pesquisarPorDataFinal($eleicao_id) {
      $this->db->select('data_final_votacao');
      $query = $this->db->get('eleicoes');
      $this->db->where('id', $eleicao_id);

      return $query->result();
   }

   public function relatorio($eleicao_id) {
      $this->db->select('m.nome as comarca, COUNT(*) as votos, p.nome');
      $this->db->from('candidatos c');
      $this->db->join('pessoas p', 'c.pessoa_id = p.id', 'inner');
      $this->db->join('votos v', 'v.candidato_id = c.id', 'inner');
      $this->db->join('comarcas m', 'p.comarca_id = m.id', 'inner');
      $this->db->group_by('p.nome , p.comarca_id');
      $this->db->order_by("m.id", "desc");
      $this->db->order_by("votos", "desc");
      $this->db->where('v.eleicao_id', $eleicao_id);
      
      $query = $this->db->get();

      return $query->result();
   }

   public function desabilitar($eleicao_id) {
      $this->db->query("UPDATE eleicoes set status = '0'  WHERE id = '$eleicao_id'");
   }

   public function habilitar($eleicao_id) {
      $this->db->query("UPDATE eleicoes set status = '1' WHERE id = '$eleicao_id'");
   }
}