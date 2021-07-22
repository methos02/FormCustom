<?php if(!isset($params) || !is_array($params)) { exit;} ?>
<input type="hidden" name="<?= $params['nom'] ?>" data-type="<?= $params['dataType'] ?>" <?= $params['valueFormat'] . $params['obliger'] . $params['message'] ?> >
