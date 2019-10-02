<?php
namespace App\Api\FormCustom\class_input;

class Img_cropper extends Input
{
    public function __construct($filename, $options)
    {
        parent::__construct($filename, $options);
        $this->setParam($options);
    }

    public function setParam($options) {
        $this->params = array_merge($this->params, [
            'ratio' => isset($options['ratio']) ? ' data-ratio="' . $options['ratio'] . '"' : "",
            'preview' => $options['const']['PATH_IMG'] . $this->definePreview($options),
            'label' => $options['label'] == ''? 'Selectionnez un fichier' : $options['label'],
        ]);
    }

    public function definePreview($options) {
        if(isset($options['preview'])) {
            return $options['preview'];
        }

        if($this->params['value'] != "") {
            return $this->params['value'];
        }

        return $options['const']['COVER'];
    }
}