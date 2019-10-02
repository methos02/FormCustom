<?php if(!isset($params) || !is_array($params)) { exit;} ?>
<label class="label-compact<?= $params['width'] . $params['label_out'] ?>">
    <select name="<?=  $params['nom'] ?>" class="input-compact<?= $params['class_label'] ?><?= $params['error'] != ""? ' input_erreur' : '' ?>" <?= $params['verif'] . $params['obliger'] . $params['message'] ?> >
        <?= $params['optionSelect'] ?>
    </select>
    <span class="label-input <?= $params['type_label']?>" <?= $params['error'] != ""? 'style="display:none"' : '' ?> > <?= $params['label'] ?></span>
    <?= $params['error'] ?>
</label>