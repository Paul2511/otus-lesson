<?php


namespace App\Helpers;


class UtilsHelper
{
    /**
     * Метод формирует лейблы для констант в зависимости от lang
     * @param string $class
     * @param string|array $part
     * @return array
     */
    public static function getLangLabels($class, $part, $langDir = null)
    {
        $result = [];
        $class = new \ReflectionClass($class);
        $constants = $class->getConstants();
        $langDir = $langDir ?? strtolower($class->getShortName());
        if ($constants) {
            foreach ($constants as $key=>$constant) {
                $keyParts = explode('_', $key);
                $keyPart = $keyParts[0] ?? '';
                if (is_string($part) && strtoupper($part) === $keyPart) {
                    $keyStr = self::dashesToCamelCase($key);
                    $result[$constant] = trans($langDir.'.'.$keyStr);
                } elseif (is_array($part)) {
                    $part = array_map(function ($item) {
                        return strtoupper($item);
                    }, $part);
                    $inter = array_intersect($part, $keyParts);
                    if ($inter && count($inter) === count($part) ) {
                        $keyStr = self::dashesToCamelCase($key);
                        $result[$constant] = trans($langDir.'.'.$keyStr);
                    }
                }
            }
        }

        return $result;
    }

    /**
     * Превращает camel_case_etc в camelCaseEtc
     * @param $string
     * @param string $dash
     * @param bool $capitalizeFirstCharacter
     * @return mixed|string
     */
    public static function dashesToCamelCase($string, $dash = '_', $capitalizeFirstCharacter = false)
    {
        $str = str_replace($dash, '', ucwords(strtolower($string), $dash));

        if (!$capitalizeFirstCharacter) {
            $str = lcfirst($str);
        }

        return $str;
    }


}