<?php if(!isset($params) || !is_array($params)) { exit;} ?>
<span data-div="confirm">
    <input type="submit" data-confirm="true" class="btn" value="<?= $params['label']?>">
    <span data-confirm style="display: none">
        <input type="submit" data-confirm="false" class="btn btn_erreur" value="annuler">
        <input type="submit" class="btn btn_valide" value="confirmer">
    </span>
</span>


