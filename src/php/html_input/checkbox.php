<?php if(!isset($params) || !is_array($params)) { exit;} ?>
<label class="label-compact input-checkbox">
    <input type="checkbox" name="<?= $params['nom'] ?>" data-type="checkbox"<?= $params['error'] != ""? ' class="input_erreur"' : '' ?> <?=  $params['valueFormat'] . $params['disabled'] . $params['checked'] . $params['obliger'] ?>>
    <span class="label-input" <?= $params['error'] != ""? 'style="display:none"' : '' ?>><?= $params['label'] ?></span>
    <?= $params['error'] ?>
</label>