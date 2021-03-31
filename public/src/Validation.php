<?php

namespace App;

class Validation
{
    public static function validate($post)
    {
        $errorFields = [];

        foreach ($post as $field => $value) {
            if (($field === 'name' || $field === 'surname') && mb_strlen($value) > 30) {
                $errorFields[$field] = "Максимальное число символов в этом поле: 30";
            }
            if (($field === 'name' || $field === 'surname') && !preg_match("/^[a-zа-яё\-\s]+$/ui", $value)) {
                $errorFields[$field] = "Поле содержит недопустимые символы";
            }
            if ($field === 'age' && !preg_match("/^[1-9]\d{0,2}$/", $value)) {
                $errorFields[$field] = "Значение должно быть числом от 1 до 999";
            }
            if ($value === '') {
                $errorFields[$field] = "Поле должно быть заполнено";
            }
        }
        return $errorFields;
    }
}
