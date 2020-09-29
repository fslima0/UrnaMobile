<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

      <form class="form-signin" action="<?= base_url('index.php/pessoas/votar'); ?>" method="POST">
         <img src="<?= base_url('assets/img/user-tie-solid.svg'); ?>" height="150" width="100" />
         <h1 class="h3 mb-3 font-weight-normal">Selecione Candidato</h1>
         <select class="form-control" name="candidato" required>
            <option disabled selected="true" value="">Escolha seu candidato(a)</option>
            <?php foreach($candidatos as $candidato) { ?>
               <option value="<?= $candidato->id; ?>"><?= $candidato->nome; ?></option>';
            <?php } ?>
         </select>
         <br />
         <button type="submit" class="btn btn-lg btn-primary btn-block">Avançar</button>
      </form>