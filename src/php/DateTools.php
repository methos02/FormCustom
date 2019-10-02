<?php
namespace App\Utils\FormCustom;

use DateTime;
class DateTools
{
    public function createDate($value) {
        try {
            return new \DateTime($value);
        } catch (\Exception $e) {
            return 'Exception reçue : '.  $e->getMessage() . "\n";
        }
    }

    public function formatDate($date, $key) {
        return ($date instanceof DateTime)? 'value="' . $date->format($key) .'"' : "";
    }
}