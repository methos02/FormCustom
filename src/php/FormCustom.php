<?php
namespace FormCustom;

use FormCustom\class_input\Button;
use FormCustom\class_input\Checkbox;
use FormCustom\class_input\Datalist;
use FormCustom\class_input\Date;
use FormCustom\class_input\Heure;
use FormCustom\class_input\File;
use FormCustom\class_input\Img_cropper;
use FormCustom\class_input\Input;
use FormCustom\class_input\Mdp;
use FormCustom\class_input\MdpConfirm;
use FormCustom\class_input\MultiSelect;
use FormCustom\class_input\NumbIncrement;
use FormCustom\class_input\Password;
use FormCustom\class_input\Select;
use FormCustom\class_input\Text;

class FormCustom
{
    static protected $config;
    static protected $const;
    static protected $errors;
    static protected $values;

    public static function open($name, $options = []) {
        if (empty(self::$config)) { self::$config = include('config.php'); }
        if (empty(self::$const)) { self::$const = include($_SERVER["DOCUMENT_ROOT"] . '/../config/formcustom/php/constante.php'); }
        if (!empty($options['errors'])) {self::$errors = FormatData::formatError($options['errors']);}
        self::$values = FormatData::formatData($options['data'] ?? [], $options['old'] ?? []);

        $method = isset($options['method'])? $options['method']: 'post';
        $action = isset($options['action'])? ' action="' . $options['action'] . '"': '';
        $enctype = isset($options['file']) && $options['file'] == true ? ' enctype="multipart/form-data"' : '';
        $class = isset($options['class'])? ' class="' . $options['class'] . '"': '';;

        return '<form name="'.$name.'" method="'.$method.'"' . $action . $enctype . $class . '>';
    }

    public static function close() {
        self::$config = null;
        self::$const = null;
        self::$errors = null;
        self::$values = null;

        return '</form>';
    }

    public static function openUpdate($name, $instance, $options = []) {
        $options['data'] = $instance;

        return self::open($name, $options) . '<input name="_method" type="hidden" value="PUT">';
    }


    static function defineOptions($nom, $first_arg, $second_arg) {
        $new_options = [
            'nom' => $nom,
            'label' => is_string($first_arg)? $first_arg : '',
            'values' => self::$values,
            'errors' => self::$errors,
            'config' => self::$config,
            'const' => self::$const
        ];

        $options = is_array($first_arg)? $first_arg : $second_arg;

        return array_merge($options, $new_options);
    }

    public static function btn($first_arg, $second_arg = []):string {
        return (new Button(__FUNCTION__, self::defineOptions('', $first_arg, $second_arg)))->generateInput();
    }

    static function checkbox($nom, $first_arg, $second_arg = []) {
        return (new Checkbox(__FUNCTION__, self::defineOptions($nom, $first_arg, $second_arg)))->generateInput();
    }

    static function cp($nom, $first_arg, $second_arg = []) {
        return (new Input(__FUNCTION__, self::defineOptions($nom, $first_arg, $second_arg)))->generateInput();
    }

    static function color_picker($nom, $first_arg, $second_arg = []) {
        return (new Input(__FUNCTION__, self::defineOptions($nom, $first_arg, $second_arg)))->generateInput();
    }

    static function datalist($nom, $first_arg, $liste, $second_arg = []) {
        return (new Datalist(__FUNCTION__, $liste, self::defineOptions($nom, $first_arg, $second_arg)))->generateInput();
    }

    static function date($nom, $first_arg, $second_arg = []) {
        return (new Date(__FUNCTION__, self::defineOptions($nom, $first_arg, $second_arg)))->generateInput();
    }

    static function heure($nom, $first_arg, $second_arg = []) {
        return (new Heure(__FUNCTION__, self::defineOptions($nom, $first_arg, $second_arg)))->generateInput();
    }

    static function hidden($nom, $first_arg, $second_arg = []) {
        return (new Input(__FUNCTION__, self::defineOptions($nom, $first_arg, $second_arg)))->generateInput();
    }

    static function img($nom, $first_arg, $second_arg = []) {
        return (new File(__FUNCTION__, self::defineOptions($nom, $first_arg, $second_arg)))->generateInput();
    }

    static function img_cropper($nom, $first_arg, $second_arg = []) {
        return (new Img_cropper(__FUNCTION__, self::defineOptions($nom, $first_arg, $second_arg)))->generateInput();
    }

    static function input($nom, $first_arg, $second_arg = []) {
        return (new Input(__FUNCTION__, self::defineOptions($nom, $first_arg, $second_arg)))->generateInput();
    }

    static function licence($nom, $first_arg, $second_arg = []) {
        return (new Input(__FUNCTION__, self::defineOptions($nom, $first_arg, $second_arg)))->generateInput();
    }

    static function mail($nom, $first_arg, $second_arg = []) {
        $input = new Input(__FUNCTION__, self::defineOptions($nom, $first_arg, $second_arg));
        return $input->generateInput();
    }

    static function mdp($nom, $first_arg, $second_arg = []) {
        $input = new Mdp(__FUNCTION__, self::defineOptions($nom, $first_arg, $second_arg));
        return $input->generateInput();
    }

    static function mdp_2($nom, $first_arg, $second_arg = []) {
        $input = new MdpConfirm(__FUNCTION__, self::defineOptions($nom, $first_arg, $second_arg));
        return $input->generateInput();
    }

    static function multi_select($nom, $first_arg, $liste, $second_arg = []) {
        $input = new MultiSelect(__FUNCTION__, $liste, self::defineOptions($nom, $first_arg, $second_arg));
        return $input->generateInput();
    }

    static function nom($nom, $first_arg, $second_arg = []) {
        $input = new Input(__FUNCTION__, self::defineOptions($nom, $first_arg, $second_arg));
        return $input->generateInput();
    }

    static function numb($nom, $first_arg, $second_arg = []) {
        $input = new Input(__FUNCTION__, self::defineOptions($nom, $first_arg, $second_arg));
        return $input->generateInput();
    }

    static function numb_increment($nom, $first_arg, $second_arg = []) {
        $input = new NumbIncrement(__FUNCTION__, self::defineOptions($nom, $first_arg, $second_arg));
        return $input->generateInput();
    }

    static function numb_rue($nom, $first_arg, $second_arg = []) {
        $input = new Input(__FUNCTION__, self::defineOptions($nom, $first_arg, $second_arg));
        return $input->generateInput();
    }

    static function password($nom, $first_arg, $second_arg = []) {
        $input = new Password(__FUNCTION__, self::defineOptions($nom, $first_arg, $second_arg));
        return $input->generateInput();
    }

    static function pdf($nom, $first_arg, $second_arg = []) {
        $input = new File(__FUNCTION__, self::defineOptions($nom, $first_arg, $second_arg));
        return $input->generateInput();
    }

    static function rue($nom, $first_arg, $second_arg = []) {
        $input = new Input(__FUNCTION__, self::defineOptions($nom, $first_arg, $second_arg));
        return $input->generateInput();
    }

    static function select($nom, $first_arg, $liste, $second_arg = []) {
        $input = new Select(__FUNCTION__, $liste, self::defineOptions($nom, $first_arg, $second_arg));
        return $input->generateInput();
    }

    static function site($nom, $first_arg, $second_arg = []) {
        $input = new Input(__FUNCTION__, self::defineOptions($nom, $first_arg, $second_arg));
        return $input->generateInput();
    }

    static function tel($nom, $first_arg, $second_arg = []) {
        $input = new Input(__FUNCTION__, self::defineOptions($nom, $first_arg, $second_arg));
        return $input->generateInput();
    }

    static function text($nom, $first_arg, $second_arg = []) {
        $input = new Text(__FUNCTION__, self::defineOptions($nom, $first_arg, $second_arg));
        return $input->generateInput();
    }

    static function titre($nom, $first_arg, $second_arg = []) {
        $input = new Input(__FUNCTION__, self::defineOptions($nom, $first_arg, $second_arg));
        return $input->generateInput();
    }

    static function video($nom, $first_arg, $second_arg = []) {
        $input = new File(__FUNCTION__, self::defineOptions($nom, $first_arg, $second_arg));
        return $input->generateInput();
    }

    static function ville($nom, $first_arg, $second_arg = []) {
        $input = new Input(__FUNCTION__, self::defineOptions($nom, $first_arg, $second_arg));
        return $input->generateInput();
    }
}
