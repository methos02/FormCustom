<?php if(!isset($params) || !is_array($params)) { exit;} ?>
<label class="label-compact input-color">
    <input type="text" name="<?= $params['nom'] ?>" data-type="colorpicker" placeholder="Code Couleur" class="input-compact<?= $params['error'] != ""? ' input_erreur' : '' ?>" data-type="color" <?= $params['valueFormat'] . $params['obliger'] . $params['message'] ?> >
    <span class="label-input" <?= $params['error'] != ""? 'style="display:none"' : '' ?> ><?= $params['label'] ?></span>
    <?= $params['error'] ?>
    <button class="color-picker" data-action="color_picker"><img src="../images/form_custom/click.png" alt="icon-click" class="icone-click"></button>
</label>