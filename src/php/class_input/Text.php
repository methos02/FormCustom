<?php
namespace App\Api\FormCustom\class_input;

class Text extends Input
{
    public function __construct($filename, $options)
    {
        parent::__construct($filename, $options);
        $this->setParam($options);
    }

    public function setParam($options) {
        $this->params = array_merge($this->params, [
            'height' => isset($options['height']) && is_numeric($options['height'])? ' style="height:' . $options['height'] . 'px"': '',
            'compteur' => $options['compteur'] ?? false,
        ]);
    }
}