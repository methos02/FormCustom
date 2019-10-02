<?php if(!isset($params) || !is_array($params)) { exit;} ?>
<div class="file-compact<?= $params['width'] . $params['class_label']?>">
    <div class="label-compact img-cropper">
        <div class="appercu-file" data-preview>
            <img src="<?= $params['preview'] ?>" alt="Apperçu de l'image" id="appercu-<?= $params['nom'] ?>" style="display: block;">
        </div>
        <input type="file" name="<?= $params['nom'] ?>" data-type="file" data-accept="webimg" data-cropper <?= $params['ratio'] . $params['option'] . $params['obliger'] ?> style="display: none;">
        <input type="hidden" name="x">
        <input type="hidden" name="y">
        <input type="hidden" name="height">
        <input type="hidden" name="width">
        <span class="label-input"></span>
    </div>
    <div class="cropper-btn" data-cropper="btn">
        <button class="btn btn-file <?= $params['class_btn'] ?>" data-file="<?= $params['nom'] ?>" <?= $params['disabled'] ?>> <?= $params['label'] ?> </button>
    </div>
    <div class="cropper-btn" data-cropper="btn" style="display: none">
        <button class="btn btn-danger" data-crop="cancel"> Annuler </button>
        <button class="btn btn-info" data-crop="modif"> Modifier </button>
    </div>
</div>