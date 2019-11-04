<?php if(!isset($params) || !is_array($params)) { exit;} ?>
<button class="btn <?= $params['class'] ?>" <?= $params['verif'] ?>>
    <span data-value><?= $params['label'] ?></span>
    <?php if($params['loader'] == true): ?>
        <img src="../images/loader.gif" alt="loader" style="display: none">
    <?php endif; ?>
</button>
