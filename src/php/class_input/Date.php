<?php
namespace FormCustom\class_input;

use FormCustom\DateTools;
class Date extends Input
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
            'annee' => $this->tools->formatDate($date, 'Y'),
            'jour' => $this->tools->formatDate($date, 'd'),
            'mois' => $this->tools->formatDate($date, 'm')
        ]);
    }
}