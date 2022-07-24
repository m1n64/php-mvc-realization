<?php
namespace App\Core\Validator;


class Validator
{
    private const REQUIRED_RULE = "required";
    private const NOREQUIRED_RULE = "norequired";

    private const STRING_RULE = "string";
    private const NUMERIC_RULE = "numeric";
    private const FILE_RULE = "file";


    /**
     * @param $data
     * @param array $rules
     * @return bool
     */
    public static function validate($data, array $rules) : bool
    {
        $flag = false;
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                if (isset($rules[$key])) {
                    $currentRule = $rules[$key];

                    if (self::validateRequired($currentRule[0], $value)) $flag = true;
                    else {
                        if (empty($value)) continue;
                    }

                    if (self::validateType($currentRule[1], $value)) $flag = true;
                }
            }
        }
        else {
            return self::validateRequired($rules[0], $data) && self::validateType($rules[1], $data);
        }

        return $flag;
    }

    /**
     * @param $rule
     * @param $value
     * @return bool
     */
    private static function validateRequired($rule, $value) : bool
    {
        if ($rule === self::REQUIRED_RULE && empty(($value !== 0 ? $value : "0.0"))) return false;

        return true;
    }

    /**
     * @param $type
     * @param $value
     * @return bool
     */
    private static function validateType($type, $value) : bool
    {
        switch ($type)
        {
            case self::STRING_RULE:
                if (!is_string($value)) return false;
                break;

            case self::NUMERIC_RULE:
                if (!is_numeric($value)) return false;
                break;

            case self::FILE_RULE:
                if (!is_array($value) && !isset($value["type"])) return false;
                break;
        }

        return true;
    }
}