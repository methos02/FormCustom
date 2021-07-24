<?php if(!isset($params) || !is_array($params)) { exit;} ?>
<?php if($params['compteur'] != false): ?>
    <div class="compteur" id="compteur-<?= $params['nom'] ?>">
        <span data-part="nb"><?= strlen ($params['value']) ?></span>/<span data-part="max"><?= $params['compteur'] ?></span>
    </div>
<?php endif; ?>
<label class="label-compact label-text<?= $params['width'] ?>" <?= $params['height'] ?>>
    <textarea name="<?= $params['nom'] ?>" placeholder="<?= $params['label'] ?>" class="text-compact<?= $params['error'] != ""? ' input_erreur' : '' ?>" data-type="texte" <?= $params['obliger'] . $params['message']. $params['disabled'] . $params['autogrow'] ?> ><?= $params['value'] ?></textarea>
    <span class="label-input"></span>
    <?= $params['error'] ?>
</label>
