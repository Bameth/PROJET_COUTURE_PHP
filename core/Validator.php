<?php
class Validator {
    public static array $errors = [];

    public static function isValid(): bool {
        return count(self::$errors) == 0;
    }
    public static function add(string $key,mixed $data){
        self::$errors[$key]=$data;
    }
    public static function isEmpty(string $valueField, string $nameField, string $message = "Champ obligatoire"): bool {
        if (empty($valueField)) {
            self::$errors[$nameField] = $message;
            return true;
        }
        return false;
    }    
    public static function isEmail(string $valueField, string $nameField, string $message = "Champ doit contenir un email valide") {
        if (!filter_var($valueField, FILTER_VALIDATE_EMAIL)) {
            self::$errors[$nameField] = $message;
        }
    }
    public static function isNumeric(string $valueField, string $nameField, string $message = "Champ doit contenir un numeric") {
        if (!filter_var($valueField, FILTER_VALIDATE_INT)) {
            self::$errors[$nameField] = $message;
        }
    }
    

}
