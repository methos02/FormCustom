<?php
namespace App\Utils\FormCustom\class_input;

use App\Utils\FormCustom\FormUtils;

class Select extends Input
{
    public $liste;

    public function __construct($filename, $liste, $options)
    {
        parent::__construct($filename, $options);
        $this->liste = $liste;
        $this->setParam($options);
    }

    public function setParam($options) {
        $default = isset($options['default'])? $options['default'] : $this->getValue($options['nom'], $options['values']);
        $null = isset($options['null']) && $options['null'] == 1 ? 1 : null;
        $type_label = isset($options['short_label']) && $options['short_label'] == false ? 'label-out' : '';

        $this->params = array_merge($this->params, [
            'optionSelect' => FormUtils::defineOptions($this->liste, ['default' => $default, 'null' => $null]),
            'verif' => isset($options['verif']) && $options['verif'] == 0 ? '': 'data-type="select" ',
            'type_label' => $type_label,
            'label_out' => $type_label == 'label-out' ? ' select-label-out' : '',
        ]);
    }
}