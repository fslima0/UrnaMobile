<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


      <form class="form-signin" action="<?= base_url('index.php/votos/index'); ?>" method="POST">
         <?php if (isset($anexo[0]->filename)): ?>
            <img class="avatar" src="<?php echo base_url('assets/uploads/'); echo $anexo[0]->filename; ?>"  height="200" width="200" >
         <?php else:?>
            <img class="avatar" src="<?php echo base_url('assets/img/user-tie-solid.svg') ?>" height="200" width="200" >
         <?php endif;?>
         <h4> <?= $candidato[0]->nome; ?> </h4>
         <?= $candidato[0]->descricao_candidato; ?>
         <input type="hidden" name="candidato_id" value="<?= $candidato[0]->id; ?>">
         <input type="hidden" name="eleicao_id" value="<?= $candidato[0]->eleicao_id; ?>">
         <br /> <br />
         <button type="submit" class="btn btn-lg btn-primary btn-block">Votar!</button>
         <a href="<?= base_url(); ?>" class="btn btn-lg btn-light btn-block" role="button">Retornar</a>
      </form>
     