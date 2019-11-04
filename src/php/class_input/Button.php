<?php


namespace FormCustom\class_input;


class Button extends Input
{
    function __construct($filename, $options)
    {
        parent::__construct($filename, $options);
        $this->setParam($options);
    }

    public function setParam($options) {
        $this->params = array_merge($this->params, [
            'verif' => isset($options['verif'])? 'data-verif="'. $options['verif'] .'"' : "",
            'loader' => isset($options['loader']) && $options['loader'] == true,
        ]);
    }
}