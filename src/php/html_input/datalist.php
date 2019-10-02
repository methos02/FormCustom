<?php if(!isset($params) || !is_array($params)) { exit;} ?>
<label class="label-compact<?= $params['width'] . $params['reset'] ?>">
    <input type="text" name="<?= $params['nom'] ?>" class="input-compact" title="liste-<?= $params['nom'] ?>" id="liste-<?= $params['nom'] ?>" list="<?= $params['nom'] ?>" data-page="<?= $params['nom'] ?>" data-type="datalist" autocomplete="off" <?= $params['valueFormat'] . $params['message'] . $params['obliger']?>>
    <?php if ($params['reset'] != '' ): ?>
        <button data-action="datalist_reset"><span class="glyphicon glyphicon-trash" style="color: red"></span></button>
    <?php endif; ?>
    <datalist id="<?= $params['nom'] ?>" data-type="datalist"><?= $params['liste'] ?></datalist>
    <input type="hidden" name="id_<?= $params['nom'] ?>" <?= $params['valueFormat'] ?>>
    <span class="label-input"><?= $params['label'] ?></span>
    <?= $params['error'] ?>
</label>
