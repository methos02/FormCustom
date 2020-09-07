<?php
namespace FormCustom\class_input;

class MdpConfirm extends Mdp
{
    function __construct($filename, $options)
    {
        parent::__construct($filename, $options);
        $this->setParamInput($options);
    }

    public function setParamInput($options) {
        $error = $this->getErrorMdpConfirm($this->params['nom'], $options['errors']);

        $this->params = array_merge($this->params, [
            'error_1' => $error['1'],
            'statut_1' => $error['1'] != '' ? ' data-statut="erreur"' : '',
            'class_error_1' => $error['1'] != '' ? ' input_erreur' : '',
            'error_2' => $error['2'] != '',
            'statut_2' => $error['2'] != '' ? ' data-statut="erreur"' : '',
            'class_error_2' => $error['2'] != '' ? ' input_erreur' : '',

        ]);
    }

    public function getErrorMdpConfirm($name, $errors) {
        return [
            '1' => $this->getError($name, $errors),
            '2' => $this->getError($name . '_confirmation', $errors)
        ];
    }
}