<?php
namespace FormCustom;

class FormUtils
{
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
}