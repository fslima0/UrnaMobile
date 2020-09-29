<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

      <form class="form-signin" action="<?= base_url('index.php/eleicoes/inserir'); ?>" method="POST">
         <h4><span class="badge badge-warning"><?= $this->session->flashdata('mensagem'); ?></span></h4>
         <img src="<?= base_url('assets/img/vote-yea-solid.svg'); ?>" height="150" width="100" />
         <h1 class="h3 mb-3 font-weight-normal">Cadastrar Nova Eleição</h1>
         <input type="text" class="form-control" name="titulo" placeholder="Titulo" required>
         <textarea type="text" class="form-control" name="edital" rows="3" required>Edital
         </textarea>
         <label class="float-left"> Data início de inscrição </label>
         <input type="datetime-local" class="form-control" name="data_inicio_inscricao" required>
         <label class="float-left"> Data final de inscrição </label>
         <input type="datetime-local" class="form-control" name="data_final_inscricao" required>
         <label class="float-left"> Data início de votação </label>
         <input type="datetime-local" class="form-control" name="data_inicio_votacao" required>
         <label class="float-left"> Data final de votação </label>
         <input type="datetime-local" class="form-control" name="data_final_votacao" required>
         <br />
         <button type="submit" class="btn btn-lg btn-primary btn-block">Adicionar</button>
         <a href="<?= base_url(); ?>" class="btn btn-lg btn-light btn-block" role="button">Voltar</a>
      </form>