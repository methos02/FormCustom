<?php if(!isset($params) || !is_array($params)) { exit;} ?>
<label class="label-compact">
    <input type="hidden" name="<?= $params['nom'] ?>" data-type="<?= $params['dataType'] ?>" <?= $params['valueFormat'] . $params['obliger'] . $params['message'] ?> >
    <?= $params['error'] ?>
</label>
