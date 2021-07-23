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
        $this->setParam($options);
    }

    public function setParam($options) {
        $date = ($this->params['value'] != "")? $this->tools->createDate($this->params['value']) : '';

        $this->params = array_merge($this->params, [
            'annee' => $this->tools->formatDate($date, 'Y'),
            'jour' => $this->tools->formatDate($date, 'd'),
            'mois' => $this->tools->formatDate($date, 'm'),
            'date_type' => isset($options['date_type']) ? " data-date_type={$options['date_type']}" : ''
        ]);
    }
}
