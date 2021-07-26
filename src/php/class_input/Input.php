<?php
namespace FormCustom\class_input;

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
        $value = $this->getValue($options);

        $this->params = [
            'class' => isset($options['class'])? ' ' . $options['class']: '',
            'class_btn' => isset($options['class_btn'])? ' ' . $options['class_btn']: '',
            'class_label' => isset($options['class_label'])? ' ' . $options['class_label']: '',
            'class_after' => isset($options['after'])? ' after': '',
            'id' => isset($options['id'])? ' id="' .$options['id'] . '"': '',
            'dataType' => $this->dataType,
            'error' => $this->getError($options['nom'], $options['errors']),
            'label' => $options['label'],
            'no_label' => $options['label'] == ""? ' no-label' : "",
            'message' => isset($options['message'])? ' data-message="' . $options['message'] . '"': '',
            'nom' => $options['nom'],
            'custom' => isset($options['custom'])? 'data-custom="' . $options['custom'] . '"' : '',
            'obliger' => isset($options['obliger']) && $options['obliger'] == 1? ' data-obliger="1"': '',
            'disabled' => isset($options['disabled']) && $options['disabled'] == true? ' disabled="disabled"': '',
            'option' => isset($options['option'])? 'data-option="' . $options['option'] . '"' : '',
            'type' => 'text',
            'value' => $value,
            'valueFormat' => $this->formatValue($value),
            'view' => isset($options['view']) && $options['view'] == false ? ' style="display:none"' : '',
            'after' => $options['after'] ?? '',
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

        if(is_object($errors) && class_exists('Illuminate\Support\ViewErrorBag') && !empty($errors->get($key))) {
            return $this->formatError($errors->get($key)[0]);
        }

        return "";
    }

    public function formatError($error) {
        return '<span class="input_message" data-message="erreur">' . $error . '</span>';
    }

    public function getValue($options) {
        $value = (is_array($options['values']) && key_exists($options['nom'], $options['values']))? $options['values'][$options['nom']] : "";

        if($value == "" && isset($options['value'])) $value = (string) $options['value'];

        return strval($value);
    }

    public function formatValue($value) {
        return ($value != '' && is_string($value))? 'value="' . $value . '"' : '';
    }

    public function getFileName($options) {
        return $options['config'][$this->dataType];
    }
}
