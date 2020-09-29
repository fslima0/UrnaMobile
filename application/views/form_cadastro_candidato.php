<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

      <form class="form-signin" action="<?= base_url('index.php/login/registrar'); ?>" method="POST" enctype="multipart/form-data">
         <img src="<?= base_url('assets/img/user-plus-solid.svg'); ?>" height="150" width="100" />
         <h1 class="h3 mb-3 font-weight-normal">Cadastrar Candidato</h1>
         <input type="text" class="form-control" name="nome" placeholder="Nome Completo" required>
         <input type="text" class="form-control" name="cpf" placeholder="CPF" required>
         <input type="email" class="form-control" name="email" placeholder="Endereço de E-mail" required>
         <textarea class="form-control" name="descricao_candidato" rows="2" placeholder="Descrição do Candidato"></textarea>
         <select class="form-control" name="comarca_id">
            <option disabled selected="true">Município</option>
            <?php foreach($comarcas as $comarca) { ?>
               <option value="<?= $comarca->id; ?>"><?= $comarca->nome; ?></option>';
            <?php } ?>
         </select>
         <select class="form-control" name="eleicao_id">
            <option disabled selected="true">Eleição</option>
            <?php foreach($eleicoes as $eleicao) { ?> <!-- Condição aqui caso status = 1 -->
               <?php if ($eleicao['status'] == '1') { ?>
               <option value="<?= $eleicao['id']; ?>"><?= $eleicao['titulo']; ?></option>';
            <?php } } ?>
         </select>
         <div class="input-group mb-3 text-left">
            <div class="custom-file">
               <input type="file" class="custom-file-input" id="inputGroupFile02" name="foto_candidato_id">
               <label class="custom-file-label" for="inputGroupFile02">Anexar Foto do Candidato</label>
            </div>
         </div>
         <input type="hidden" name="nivel" value="1"> <!-- Nível do Usuário (Candidato) -->
         <button type="submit" class="btn btn-lg btn-primary btn-block">Cadastrar</button>
         <a href="<?= base_url('index.php/ouvidoria'); ?>" class="btn btn-lg btn-light btn-block" role="button">Voltar</a>
      </form>
