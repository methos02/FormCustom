<?php if(!isset($params) || !is_array($params)) { exit;} ?>
<label class="border-date" data-nom="<?= $params['nom'] ?>" <?= $params['type'] . $params['obliger'] ?>>
    <span class="label-input"><?= $params['label'] ?></span>
    <input name="jour_<?= $params['nom'] ?>" type="text" maxlength="2" autocomplete="off" data-type="date" class="date-jm date-j" <?= $params['jour'] ?>>
    <span class="date-separateur">/</span>
    <input name="mois_<?= $params['nom'] ?>" type="text" maxlength="2" autocomplete="off" data-type="date" class="date-jm" <?= $params['mois'] ?>>
    <span class="date-separateur">/</span>
    <input name="annee_<?= $params['nom'] ?>" type="text" maxlength="4" autocomplete="off" data-type="date" class="date-a" <?= $params['annee'] ?>>
</label>
