<?php
namespace FormCustom\class_input;

use App\Utils\FormCustom\DateTools;
class Heure extends Input
{
    public $tools;

    public function __construct($filename, $options)
    {
        parent::__construct($filename, $options);
        $this->tools = new DateTools();
        $this->setParam();
    }

    public function setParam() {
        $date = ($this->params['value'] != "")? $this->tools->createDate($this->params['value']) : '';

        $this->params = array_merge($this->params, [
            'heure' => $this->tools->formatDate($date, 'H'),
            'minute' => $this->tools->formatDate($date, 'i'),
        ]);
    }
}