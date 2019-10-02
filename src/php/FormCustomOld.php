<?php
namespace Utils\FormCustom;
use \Exception;
/**
 * @method static string nom($nom, $label, $option = []) retourne un input de data-type nom
 * @method static string titre($nom, $label, $option = []) retourne un input de data-type titre
 * @method static string license($nom, $label, $option = []) retourne un input de data-type license
 * @method static string password($nom, $label, $option = []) retourne un input de data-type mdp
 * @method static string numb($nom, $label, $option = []) retourne un input de data-type numb
 * @method static string numb_rue($nom, $label, $option = []) retourne un input de data-type numb_rue
 * @method static string rue($nom, $label, $option = []) retourne un input de data-type rue
 * @method static string cp($nom, $label, $option = []) retourne un input de data-type cp
 * @method static string ville($nom, $label, $option = []) retourne un input de data-type ville
 * @method static string tel($nom, $label, $option = []) retourne un input de data-type tel
 * @method static string mail($nom, $label, $option = []) retourne un input de data-type mail
 * @method static string site($nom, $label, $option = []) retourne un input de data-type site
 * @method static string img($nom, $label, $option = []) retourne un input de data-type img
 * @method static string video($nom, $label, $option = []) retourne un input de data-type video
 * @method static string pdf($nom, $label, $option = []) retourne un input de data-type pdf
 * @method static string heure($nom, $label, $option = []) retourne un input de data-type pdf
 * @method static string date($nom, $label, $option = []) retourne un input de data-type pdf
 * @method static string text($nom, $label, $option = []) retourne un input de data-type pdf
 * @method static string select($nom, $label, $option = []) retourne un input de data-type pdf
 * @method static string datalist($nom, $label, $option = []) retourne un input de data-type pdf
 * @method static string checkbox($nom, $label, $option = []) retourne un input de data-type pdf
 */
class FormCustomOld {
    CONST WIDTH = ['demi', 'order', 'tier'];
    CONST DEFAUT_PREVIEW = ['img' => '/images/empty_img.png', 'video' => '/images/empty_video.png', 'img_cropper' => '/images/empty_img.png'];

    static protected $data;
    static protected $error;
    static protected $config;
    static protected $dataSelectList;
    static protected $fileName;
    static protected $params = [];
    static protected $staticArgument = ['nom' => 0, 'label' => 1, 'params' => 2, 'dataSelectList' => 2];

    public function __construct($data = null){
        self::$data = $data;
    }

    public static function factoryForm($data = null){
        $instance = new FormCustomOld($data);

        return $instance;
    }

    /**
     * @param $dataType
     * @param $arguments array
     * @throws Exception
     * @return string
     */
    public static function __callStatic($dataType, $arguments):string {
        self::$config = include('Config/config.php');

        self::setIndexParam($dataType, $arguments);
        self::setFileName($dataType);
        self::setParams($arguments[self::$staticArgument['nom']], $arguments[self::$staticArgument['label']], $dataType, $arguments[self::$staticArgument['params']] ?? []);

        return self::getInputHtml(['params' => self::$params]);
    }

    public static function openUpdate($name, $instance, $options = []) {
        $options['data'] = $instance;

        return self::open($name, $options) . '<input name="_method" type="hidden" value="PUT">';
    }

    public static function open($name, $options = []) {
        if(!empty($options['errors'])) {self::$error = FormatData::formatError($options['errors']);}
        self::$data = FormatData::formatData($options);

        $method = isset($options['method'])? $options['method']: 'post';
        $action = isset($options['action'])? ' action="' . $options['action'] . '"': '';
        $enctype = isset($options['file']) && $options['file'] == true ? ' enctype="multipart/form-data"' : '';

        return '<form name="'.$name.'" method="'.$method.'"' . $action . $enctype . '>';
    }

    public static function btn(string $value,array $options):string {
        $class = $options['class'] ?? '';

        return '<input type="submit" value="' . $value . '" class="btn ' . $class . '">';
    }

    /**
     * @param $dataType
     * @param $arguments
     */
    private static function setIndexParam($dataType, $arguments) {
        if(in_array($dataType, ['select', 'datalist']) == true ) {
            self::$staticArgument['params'] = 3;
            self::$dataSelectList = $arguments[self::$staticArgument['dataSelectList']];
            return;
        }

        self::$staticArgument['params'] = 2;
    }

    /**
     * @param $nomInput
     * @throws Exception
     */
    private static function setFileName($nomInput) {
        if (!isset(self::$config[$nomInput])) { throw new Exception('La fonction ' . $nomInput . ' est inconnue'); }

        self::$fileName = self::$config[$nomInput];
    }

    private static function setParams($nom, $label, $dataType, $params) {
        $default = isset($params['default'])? $params['default'] : self::getValue($nom);
        $null = isset($params['null']) && $params['null'] == 1 ? 1 : null;

        self::$params = [
            //params communs
            'attrValue' => self::getAttrValue($nom),
            'dataType' => $dataType,
            'type' => ($dataType != 'mdp')? self::$fileName : 'password',
            'error' => self::getError($nom),
            'label' => $label,
            'message' => isset($params['message'])? ' data-message="' . $params['message'] . '"': '',
            'nom' => $nom,
            'obliger' => isset($params['obliger']) && $params['obliger'] == 1? ' data-obliger="1"': '',
            'option' => isset($params['option'])? 'data-option="' . $params['option'] . '"' : '',
            'width' => isset($params['width']) && in_array($params['width'], self::WIDTH)? ' ' . $params['width']: '',
            'value' => self::getValue($nom),
            'class_label' => isset($params['class_label'])? ' ' . $params['class_label']: '',
            'class_btn' => isset($params['class_btn'])? ' ' . $params['class_btn']: '',

            //checkBox
            'checked' => isset($params['checked']) && $params['checked'] == true? ' checked="checked"': '',
            'disabled' => isset($params['disabled']) && $params['disabled'] == true? ' disabled="disabled"': '',

            //text
            'height' => isset($params['height']) && is_numeric($params['height'])? ' style="height:' . $params['height'] . 'px"': '',

            //date
            'annee' => $dataType == 'date' ? self::valueDate('date_' . $nom, 'Y'): '',
            'jour' => $dataType == 'date' ? self::valueDate('date_' . $nom, 'd'): '',
            'mois' => $dataType == 'date' ? self::valueDate('date_' . $nom, 'm'): '',

            //heure
            'heure' => $dataType == 'heure' ?  self::valueDate('heure_' . $nom, 'H'): '',
            'minute' => $dataType == 'heure' ?  self::valueDate('heure_' . $nom, 'i'): '',

            //file
            'source' => in_array($dataType, ['img', 'video', 'img_cropper'])? self::definePreview($params, $dataType) : '' ,
            'accept' => $params['accept'] ?? $dataType ,

            //img cropper
            'ratio' => isset($params['ratio']) ? ' data-ratio="' . $params['ratio'] . '"' : "",

            //select
            'optionSelect' => $dataType == 'select'? self::defineOptions(self::$dataSelectList, ['default' => $default, 'null' => $null]): '',
            'verif' => isset($params['verif']) && $params['verif'] == 0 ? '': 'data-type="select" ',

            //datalist
            'reset' => isset($params['reset']) && $params['reset'] == true ?'datalist-reset': '',
            'liste' => $dataType == 'datalist' ? self::$dataSelectList : '',
        ];
    }

    public function getParams () {
        return self::$params;
    }

    public static function definePreview($params, $dataType) {
        return isset($params['preview']) && $params['preview'] != "" ? $params['preview'] : self::DEFAUT_PREVIEW[$dataType];
    }

    public static function arrayOptions(array $arrays, string $key, string $value):array {
        $arrayOption = [];

        foreach ($arrays as $array) {
            $keyOption = '';
            $valueOption = '';

            foreach ($array as $keyItem => $item) {
                if($keyItem == $key) {
                    $keyOption = $item;
                }

                if($keyItem == $value) {
                    $valueOption = $item;
                }
            }

            $arrayOption[$keyOption] = $valueOption;
        }

        return $arrayOption;
    }

    public static function defineOptions($data, array $params = null) {
        if(!is_array($data)) {return $data; }

        $default = isset($params['default']) ? $params['default'] : null;

        $options = isset($params['null']) && $params['null'] == 1 ? '<option value="-1">------</option>' : '';

        foreach ($data as $key => $value){
            $options .= '<option value="'.$key.'" '.($key == $default ?'selected="selected"':'').'>' . $value . '</option>';

        }

        return $options;
    }

    public static function defineOptionDatalist(array $array, string $name):string {
        $options = '';

        foreach ($array as $id => $value) {
            $options .= '<option data-id_' . $name . '="'.$id.'">' . $value . '</option>';
        }

        return $options;
    }

    public static function getValue($key) {
        if(is_array(self::$data) && key_exists($key, self::$data)) {
            return self::$data[$key];
        }

        return "";
    }

    public static function getAttrValue($key){
        if(is_array(self::$data) && key_exists($key, self::$data)) {
            return 'value="'.self::$data[$key].'"';
        }

        return "";
    }

    public static function getError($key){

        if(self::$fileName == 'mdp_confirm') {
            return self::getErrorMdpConfirm($key);
        }

        if(is_array(self::$error) && key_exists($key, self::$error)) {
            return self::formatError(self::$error[$key]);
        }

        return "";
    }

    public static function getErrorMdpConfirm($key) {
        $errors = [$key.'_1' => '', $key.'_2' => ''];

        if(is_array(self::$error) && key_exists($key.'_1', self::$error)) {
            $errors[$key.'_1'] = self::formatError(self::$error[$key.'_1']);
        }

        if(is_array(self::$error) && key_exists($key.'_2', self::$error)) {
            $errors[$key.'_2'] = self::formatError(self::$error[$key.'_2']);
        }

        return $errors;
    }

    public static function formatError($error) {
        return '<span class="input_message" data-message="erreur">' . $error . '</span>';
    }

    public static function valueDate($name, $key) {
        if(is_array(self::$data) && key_exists($name, self::$data) && !empty(self::$data[$name])) {
            $date = new \DateTime(self::$data[$name]);
            return 'value="' . $date->format($key) .'"';
        }

        return "";
    }

    /**
     * @param $params
     * @return mixed
     * @throws Exception
     */
    public static function getInputHtml($params) {
        $url = __DIR__ . '/html_input/' . self::$fileName . '.php';

        if (!file_exists($url)) { throw new Exception("Le fichier " . self::$fileName . "n'exciste pas."); }

        ob_start();
        extract($params);
        require ($url);
        return ob_get_clean();
    }
}