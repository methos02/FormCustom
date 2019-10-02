<?php if(!isset($params) || !is_array($params)) { exit;} ?>
<label class="label-compact<?= $params['width'] ?>">
    <input type="password" name="<?= $params['nom'] ?>" data-type="mdp" class="input-compact<?= $params['class_error_1']?>"<?= $params['obliger'] . $params['message'] . $params['statut_1'] ?> >
    <span class="label-input" <?= $params['error_1'] != "" ? 'style="display:none"' : '' ?> ><?= $params['label'] ?></span>
    <?= $params['error_1'] ?>
</label>
<label class="label-compact<?= $params['width'] ?>">
    <input type="password" name="<?= $params['nom'] ?>_confirmation" data-type="mdp" data-message="confirm" class="input-compact<?= $params['class_error_2']?>" <?= $params['obliger'] . $params['message'] . $params['statut_2'] ?> >
    <span class="label-input" <?= $params['error_2'] != "" ? 'style="display:none"' : '' ?> > Confirmation </span>
    <?= $params['error_2'] ?>
</label>