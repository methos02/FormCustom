<?php
namespace App\Api\FormCustom\class_input;


class MultiSelect extends Input
{
    public $liste;

    function __construct($filename, $liste, $options)
    {
        parent::__construct($filename, $options);
        $this->liste = $liste;
        $this->setParam();
    }

    public function setParam() {
        $this->params = array_merge($this->params, [
            'liste' => $this->liste,
            'viewPluriel' => is_array($this->params['value']) && count($this->params['value']) > 1 ? '' : 'style="display: none"',
            'nb_checked' => is_array($this->params['value'])? count($this->params['value']) : 0
        ]);
    }
}
