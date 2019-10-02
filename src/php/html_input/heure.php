<?php if(!isset($params) || !is_array($params)) { exit;} ?>
<label class="border-heure" data-nom="<?= $params['nom'] ?>" <?= $params['obliger'] ?>>
    <span class="label-input"><?= $params['label'] ?></span>
    <input name="heure_<?= $params['nom'] ?>" type="text" maxlength="2" autocomplete="off" data-type="heure" class="input-heure" <?= $params['heure'] ?>>
    <span class="heure-separateur">:</span>
    <input name="minute_<?= $params['nom'] ?>" type="text" maxlength="2" autocomplete="off" data-type="heure" class="input-minute" <?= $params['minute'] ?>>
</label>