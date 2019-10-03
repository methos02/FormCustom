<?php
namespace FormCustom\class_input;

class Mdp extends Input
{
    function __construct($filename, $options)
    {
        parent::__construct($filename, $options);
        $this->setParam();
    }

    public function setParam() {
        $this->params = array_merge($this->params, [
            'type' => 'password',
        ]);
    }
}