<?php
namespace App\Utils\FormCustom\class_input;

class Datalist extends Input
{
    public $liste;

    public function __construct($filename, $liste, $options)
    {
        parent::__construct($filename, $options);
        $this->liste = $liste;
        $this->setParam($options);
    }

    public function setParam($options) {
        $this->params = array_merge($this->params, [
            'reset' => isset($options['reset']) && $options['reset'] == true ? 'datalist-reset': '',
            'liste' => $this->liste,
        ]);
    }
}