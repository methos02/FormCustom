<?php
namespace App\Utils\FormCustom\class_input;


class Input
{
    CONST WIDTH = ['demi', 'order', 'tier'];
    public $params = [];
    public $const;
    public $dataType;
    public $fileName;

    public function __construct($dataType, $options) {
        $this->dataType = $dataType;
        $this->const = $options['const'];
        $this->fileName = $this->getFileName($options);
        $this->setCommunParam($options);
    }

    public function setCommunParam($options) {
        $value = $this->getValue($options['nom'], $options['values']);

        $this->params = [
            'class_btn' => isset($options['class_btn'])? ' ' . $options['class_btn']: '',
            'class_label' => isset($options['class_label'])? ' ' . $options['class_label']: '',
            'dataType' => $this->dataType,
            'error' => $this->getError($options['nom'], $options['errors']),
            'label' => $options['label'],
            'message' => isset($options['message'])? ' data-message="' . $options['message'] . '"': '',
            'nom' => $options['nom'],
            'obliger' => isset($options['obliger']) && $options['obliger'] == 1? ' data-obliger="1"': '',
            'disabled' => isset($options['disabled']) && $options['disabled'] == true? ' disabled="disabled"': '',
            'option' => isset($options['option'])? 'data-option="' . $options['option'] . '"' : '',
            'type' => 'text',
            'value' => $value,
            'valueFormat' => $this->formatValue($value),
            'width' => isset($options['width']) && in_array($options['width'], self::WIDTH)? ' ' . $options['width']: '',
        ];
    }

    public function generateInput() {
        $url = __DIR__ . '/../html_input/' . $this->fileName . '.php';
        ob_start();
        extract(['params' => $this->params]);
        require ($url);
        return ob_get_clean();
    }

    public function getError($key, $errors){
        if(is_array($errors) && key_exists($key, $errors)) {
            return $this->formatError($errors[$key]);
        }

        return "";
    }

    public function formatError($error) {
        return '<span class="input_message" data-message="erreur">' . $error . '</span>';
    }

    public function getValue($key, $values) {
        return (is_array($values) && key_exists($key, $values))? $values[$key] : "";
    }

    public function formatValue($value) {
        return ($value != '' && is_string($value))? 'value="' . $value . '"' : '';
    }

    public function getFileName($options) {
        return $options['config'][$this->dataType];
    }
}