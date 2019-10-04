<?php
namespace FormCustom;

class FormatData
{
    public static function formatError($errors) {
        return $errors;
    }

    public static function formatData($datas, $old) {
        if(!empty($old))  return $old;

        if(empty($datas)) return [];

        if(is_array($datas) && is_object($datas[0]))  return self::getArrayLaravelData($datas);

        if(method_exists($datas, 'getAttributes')) return $datas -> getAttributes();

        if(is_array($datas)) return $datas;

        return [];
    }

    private static function getArrayLaravelData($objects) {
        $datas = [];

        foreach ($objects as $object) {
            if(method_exists($object, 'getAttributes')) {
                $datas = array_merge($datas, $object -> getAttributes());
            }
        }

        return $datas;
    }
}

