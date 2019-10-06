<?php
namespace FormCustom;

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
        if (empty(self::$config)) { self::$config = include($_SERVER["DOCUMENT_ROOT"] . '/../config/formcustom/php/config.php'); }
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
        return '</form>';
    }

    public static function openUpdate($name, $instance, $options = []) {
        $options['data'] = $instance;

        return self::open($name, $options) . '<input name="_method" type="hidden" value="PUT">';
    }

    public static function btn(string $value, array $options):string {
        $class = $options['class'] ?? '';
        $verif = isset($options['verif'])? 'data-verif="'. $options['verif'] .'"' : "";

        return '<input type="submit" value="' . $value . '" class="btn ' . $class . '" ' . $verif . ' >';
    }

    static function defineOptions($nom, $label, $options) {
        $new_options = [
            'nom' => $nom,
            'label' => $label,
            'values' => self::$values,
            'errors' => self::$errors,
            'config' => self::$config,
            'const' => self::$const
        ];

        return array_merge($options, $new_options);
    }

    static function checkbox($nom, $label, $options = []) {
        $input = new Checkbox(__FUNCTION__, self::defineOptions($nom, $label,$options));
        return $input->generateInput();
    }

    static function cp($nom, $label, $options = []) {
        $input = new Input(__FUNCTION__, self::defineOptions($nom, $label,$options));
        return $input->generateInput();
    }
    static function color_picker($nom, $label, $options = []) {
        $input = new Input(__FUNCTION__, self::defineOptions($nom, $label,$options));
        return $input->generateInput();
    }

    static function datalist($nom, $label, $liste, $options = []) {
        $input = new Datalist(__FUNCTION__, $liste, self::defineOptions($nom, $label, $options));
        return $input->generateInput();
    }

    static function date($nom, $label, $options = []) {
        $input = new Date(__FUNCTION__, self::defineOptions($nom, $label, $options));
        return $input->generateInput();
    }

    static function heure($nom, $label, $options = []) {
        $input = new Heure(__FUNCTION__, self::defineOptions($nom, $label,$options));
        return $input->generateInput();
    }

    static function img($nom, $label, $options = []) {
        $input = new File(__FUNCTION__, self::defineOptions($nom, $label,$options));
        return $input->generateInput();
    }

    static function img_cropper($nom, $label, $options = []) {
        $input = new Img_cropper(__FUNCTION__, self::defineOptions($nom, $label,$options));
        return $input->generateInput();
    }

    static function licence($nom, $label, $options = []) {
        $input = new Input(__FUNCTION__, self::defineOptions($nom, $label,$options));
        return $input->generateInput();
    }

    static function mail($nom, $label, $options = []) {
        $input = new Input(__FUNCTION__, self::defineOptions($nom, $label,$options));
        return $input->generateInput();
    }

    static function mdp($nom, $label, $options = []) {
        $input = new Mdp(__FUNCTION__, self::defineOptions($nom, $label,$options));
        return $input->generateInput();
    }

    static function mdp_2($nom, $label, $options = []) {
        $input = new MdpConfirm(__FUNCTION__, self::defineOptions($nom, $label,$options));
        return $input->generateInput();
    }

    static function multi_select($nom, $label, $liste, $options = []) {
        $input = new MultiSelect(__FUNCTION__, $liste, self::defineOptions($nom, $label, $options));
        return $input->generateInput();
    }

    static function nom($nom, $label, $options = []) {
        $input = new Input(__FUNCTION__, self::defineOptions($nom, $label,$options));
        return $input->generateInput();
    }

    static function numb($nom, $label, $options = []) {
        $input = new Input(__FUNCTION__, self::defineOptions($nom, $label,$options));
        return $input->generateInput();
    }

    static function numb_rue($nom, $label, $options = []) {
        $input = new Input(__FUNCTION__, self::defineOptions($nom, $label,$options));
        return $input->generateInput();
    }

    static function password($nom, $label, $options = []) {
        $input = new Password(__FUNCTION__, self::defineOptions($nom, $label,$options));
        return $input->generateInput();
    }

    static function pdf($nom, $label, $options = []) {
        $input = new File(__FUNCTION__, self::defineOptions($nom, $label,$options));
        return $input->generateInput();
    }

    static function rue($nom, $label, $options = []) {
        $input = new Input(__FUNCTION__, self::defineOptions($nom, $label,$options));
        return $input->generateInput();
    }

    static function select($nom, $label, $liste, $options = []) {
        $input = new Select(__FUNCTION__, $liste, self::defineOptions($nom, $label,$options));
        return $input->generateInput();
    }

    static function site($nom, $label, $options = []) {
        $input = new Input(__FUNCTION__, self::defineOptions($nom, $label,$options));
        return $input->generateInput();
    }

    static function tel($nom, $label, $options = []) {
        $input = new Input(__FUNCTION__, self::defineOptions($nom, $label,$options));
        return $input->generateInput();
    }

    static function text($nom, $label, $options = []) {
        $input = new Text(__FUNCTION__, self::defineOptions($nom, $label,$options));
        return $input->generateInput();
    }

    static function titre($nom, $label, $options = []) {
        $input = new Input(__FUNCTION__, self::defineOptions($nom, $label,$options));
        return $input->generateInput();
    }

    static function video($nom, $label, $options = []) {
        $input = new File(__FUNCTION__, self::defineOptions($nom, $label,$options));
        return $input->generateInput();
    }

    static function ville($nom, $label, $options = []) {
        $input = new Input(__FUNCTION__, self::defineOptions($nom, $label,$options));
        return $input->generateInput();
    }
}