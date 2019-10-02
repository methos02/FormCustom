<?php
namespace App\Utils\FormCustom\class_input;

class Checkbox extends Input
{
    function __construct($filename, $options)
    {
        parent::__construct($filename, $options);
        $this->setParam($options);
    }

    public function setParam($options) {
        $this->params = array_merge($this->params, [
            'checked' => $this->isChecked($options)? ' checked="checked"': '',
            'disabled' => isset($options['disabled']) && $options['disabled'] == true? ' disabled="disabled"': ''
        ]);
    }

    public function isChecked($options) {
        if( isset($options['checked']) && $options['checked'] == true)
            return $options['checked'];

        $checked = $this->getValue($options['nom'], $options['values']);

        if($checked == true)
            return $checked;

        return false;
    }
}