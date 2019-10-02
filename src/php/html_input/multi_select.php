<?php if(!isset($params) || !is_array($params)) { exit;} ?>
<div class="label-compact ms-input <?= $params['error'] != ""? ' input_erreur': ""?>" data-input="multi-select" <?= $params['obliger'] ?> data-message="categorie">
    <?= $params['error'] ?>
    <span class="nb-ms" data-nb> <?= $params['nb_checked'] ?> </span>
    <span class="label-ms"> <?= $params['label'] ?></span>
    <span class="s-ms" data-s <?= $params['viewPluriel'] ?>>s</span>
    <span class="arrow-down caret"></span>
    <span class="multi-select-options" data-options style="display: none">
        <?php foreach($params['liste'] as $id => $item): ?>
            <label><input type="checkbox" name="<?= $params['nom'] ?>[]" value="<?= $id ?>" <?= is_array($params['value']) && in_array($id, $params['value'])? 'checked="checked"' : ''?> data-type="multiselect"><?= $item ?></label>
        <?php endforeach ?>
    </span>
</div>
