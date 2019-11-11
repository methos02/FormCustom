<?php if(!isset($params) || !is_array($params)) { exit;} ?>
<div class="file-compact<?= $params['width'] . $params['class_label']?>"<?= $params['view']?>>
    <label class="label-compact label-file">
        <?php if (in_array($params['dataType'], ['img'])): ?>
            <img src="<?= $params['source'] ?>" alt="Apperçu de l'image" class="appercu-file" data-preview>
            <img src="" class="appercu-file" alt="Apperçu de la video postée" style="display: none" data-input>
        <?php endif; ?>
        <?php if (in_array($params['dataType'], ['video'])): ?>
            <?php if(strpos($params['source'], '/videos/') !== false ) : ?>
                <video class="appercu-file" controls data-preview>
                    <source src="<?= $params['source'] ?>" type="video/mp4">
                </video>
            <?php endif; ?>
            <?php if(is_numeric($params['source']) ) : ?>
                <iframe <?= $params['id'] ?> src="https://player.vimeo.com/video/<?= $params['source'] ?>" width="auto" height="auto" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
            <?php endif; ?>
            <?php if($params['preview'] == '') : ?>
                <img src="<?= $params['source'] ?>" alt="Apperçu de l'image" class="appercu-file" data-preview>
            <?php endif; ?>
            <video class="appercu-file" controls data-input style="display: none">
                <source src="" type="video/mp4">
            </video>
        <?php endif; ?>
        <span class="label-input text-center" data-fileName <?= $params['error'] != ""? 'style="display:none"' : '' ?> > Aucun Fichier </span>
        <input type="file" name="<?= $params['nom'] ?>" data-type="file" data-accept="<?= $params['accept'] ?>" <?= $params['option'] . $params['obliger'] ?> style="display: none;">
        <?= $params['error'] ?>
    </label>
    <button class="btn btn-default btn-file" data-file="<?= $params['nom'] ?>"> <?= $params['label'] ?> </button>
</div>
