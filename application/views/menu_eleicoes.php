<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
      <form class="form-signin" action="<?= base_url('index.php/ouvidoria/relatorio'); ?>" method="POST">
         <img src="<?= base_url('assets/img/poll-solid.svg'); ?>" height="150" width="100" />
         <h1 class="h3 mb-3 font-weight-normal">Selecione Eleição</h1>
         <select class="form-control" name="eleicao_id" required>
            <option disabled selected="true" value="">Escolha eleição</option>
            <?php foreach($eleicoes as $eleicao) { ?>
               <option value="<?= $eleicao['id']; ?>"><?= $eleicao['titulo']; ?></option>';
            <?php } ?>
         </select>
         <br />
         <button type="submit" class="btn btn-lg btn-primary btn-block">Avançar</button>
         <a href="<?= base_url(); ?>" class="btn btn-lg btn-light btn-block" role="button">Voltar</a>
      </form>