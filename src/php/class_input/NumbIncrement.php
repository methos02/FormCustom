<?php


namespace FormCustom\class_input;


class NumbIncrement extends Input
{
    function __construct($filename, $options)
    {
        parent::__construct($filename, $options);
        $this->setParam();
    }

    public function setParam() {
        $this->params = array_merge($this->params, [
            'valueFormat' => $this->params['valueFormat'] == '' ? ' value="0"' : $this->params['valueFormat'],
        ]);
    }
}