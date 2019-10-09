<?php if(!isset($params) || !is_array($params)) { exit;} ?>
<label class="label-compact numb_increment <?= $params['width'] ?>" <?= $params['view'] ?> data-input="numb_increment">
    <button class="btn-before" data-action="decrease"> - </button>
    <input type="<?= $params['type'] ?>" name="<?= $params['nom'] ?>" class="input-compact<?= $params['error'] != ""? ' input_erreur' : '' . $params['no_label'] ?>" data-type="numb_increment" <?= $params['valueFormat'] . $params['obliger'] . $params['message'] . $params['disabled'] ?> >
    <span class="label-input" <?= $params['error'] != ""? 'style="display:none"' : '' ?> ><?= $params['label'] ?></span>
    <?= $params['error'] ?>
    <button class="btn-after" data-action="increase"> + </button>
</label>