<?php if(!isset($params) || !is_array($params)) { exit;} ?>
<label class="label-compact<?= $params['width'] . $params['class_after'] ?>" <?= $params['view'] ?>>
    <input type="<?= $params['type'] ?>" name="<?= $params['nom'] ?>" class="input-compact<?= $params['error'] != ""? ' input_erreur' : '' . $params['no_label'] ?>" data-type="<?= $params['dataType'] ?>" <?= $params['valueFormat'] . $params['obliger'] . $params['message'] . $params['disabled'] ?> >
    <span class="label-input" <?= $params['error'] != ""? 'style="display:none"' : '' ?> > <?= $params['label'] ?></span>
    <?= $params['error'] ?>
    <?php if($params['after'] != ''): ?><span class="input-after"><?= $params['after'] ?></span><?php endif; ?>
</label>
