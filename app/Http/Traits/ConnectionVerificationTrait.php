<?php

namespace App\Http\Traits;

use \App\Models\Connection;
use \App\Http\Controllers\ConnectionController;

trait ConnectionVerificationTrait
{
    public static function verify($type, $request, $that)
    {
        if ($type == 'prospector') {
            $that->validate($request, [
                'fullname' => ['required', 'regex:/^[A-Za-zа-яёА-ЯЁ0-9_.,()\/\\-:;\'"— ]+$/u'],
                'email' => ['email', 'nullable'],
                'phone' => ['nullable', 'regex:/^[A-Za-zа-яёА-ЯЁ0-9_.,()\/\\-:;\'"—+ ]+$/u'],
                'experience' => ['nullable', 'regex:/^[A-Za-zа-яёА-ЯЁ0-9_.,()\/\\-:;\'"— ]+$/u'],
                'age' => ['nullable', 'regex:/^[A-Za-zа-яёА-ЯЁ0-9_.,()\/\\-:;\'"— ]+$/u'],
                'price' => ['nullable', 'regex:/^[A-Za-zа-яёА-ЯЁ0-9_.,()\/\\-:;\'"—+ ]+$/u'],
                'region' => ['nullable', 'regex:/^[A-Za-zа-яёА-ЯЁ0-9_.,()\/\\-:;\'"— ]+$/u'],
                'position' => ['nullable', 'regex:/^[A-Za-zа-яёА-ЯЁ0-9_.,()\/\\-:;\'"— ]+$/u'],
                'description' => ['nullable', 'regex:/^[A-Za-zа-яёА-ЯЁ0-9_.,()\/\\-:;\'"— ]+$/u'],
                'doc' => ['file', 'nullable'],
            ], [
                'fullname.regex' => 'Полное имя содержит запрещённые символы.',
                'fullname.required' => 'Полное имя - необходимое поле',
                'email.email' => 'Указан не действительный Email.',
                'phone.regex' => 'Телефон содержит запрещённые символы.',
                'experience.regex' => 'Стаж содержит запрещённые символы.',
                'age.regex' => 'Возраст содержит запрещённые символы.',
                'price.regex' => 'Поле "Ежемесячный доход" содержит запрещённые символы.',
                'region.regex' => 'Поле "Регион проживания" содержит запрещённые символы.',
                'position.regex' => 'Должность содержит запрещённые символы.',
                'description.regex' => 'Краткое описание содержит запрещённые символы.',
                'doc.file' => 'Поддерживаемые форматы файлов: jpg,jpeg,png,pdf,doc,docx,gif,tif,tiff,bmp.',
            ]);
        } elseif ($type == 'customer') {
            $that->validate($request, [
                'fullname' => ['regex:/^[A-Za-zа-яёА-ЯЁ0-9_.,()\/\\-:;\'"— ]+$/u', 'required'],
                'email' => ['email', 'nullable'],
                'phone' => ['regex:/^[A-Za-zа-яёА-ЯЁ0-9_.,()\/\\-:;\'"—+ ]+$/u', 'nullable'],
                'position' => ['regex:/^[A-Za-zа-яёА-ЯЁ0-9_.,()\/\\-:;\'"— ]+$/u', 'nullable'],
                'age' => ['regex:/^[A-Za-zа-яёА-ЯЁ0-9_.,()\/\\-:;\'"— ]+$/u', 'nullable'],
                'contract_date' => ['regex:/^[A-Za-zа-яёА-ЯЁ0-9_.,()\/\\-:;\'"— ]+$/u', 'nullable'],
                'region' => ['regex:/^[A-Za-zа-яёА-ЯЁ0-9_.,()\/\\-:;\'"— ]+$/u', 'nullable'],
                'address' => ['regex:/^[A-Za-zа-яёА-ЯЁ0-9_.,()\/\\-:;\'"— ]+$/u', 'nullable'],
                'description' => ['regex:/^[A-Za-zа-яёА-ЯЁ0-9_.,()\/\\-:;\'"— ]+$/u', 'nullable'],
                'doc' => ['file', 'nullable'],
            ], [
                'fullname.regex' => 'Полное имя содержит запрещённые символы.',
                'fullname.required' => 'Полное имя - необходимое поле',
                'email.regex' => 'Указан не действительный Email.',
                'phone.regex' => 'Телефон содержит запрещённые символы.',
                'position.regex' => 'Место работы содержит запрещённые символы.',
                'age.regex' => 'Возраст содержит запрещённые символы.',
                'contract_date.regex' => 'Дата договора содержит запрещённые символы.',
                'region.regex' => 'Регион содержит запрещённые символы.',
                'address.regex' => 'Адрес содержит запрещённые символы.',
                'description.regex' => 'Суть дела содержит запрещённые символы.',
                'doc.file' => 'Поддерживаемые форматы файлов: jpg,jpeg,png,pdf,doc,docx,gif,tif,tiff,bmp.',
            ]);
        } else {
            $that->validate($request, [
                'fullname' => ['regex:/^[A-Za-zа-яёА-ЯЁ0-9_.,()\/\\-:;\'"— ]+$/u', 'required'],
                'email' => ['email', 'nullable'],
                'phone' => ['regex:/^[A-Za-zа-яёА-ЯЁ0-9_.,()\/\\-:;\'"—+ ]+$/u', 'nullable'],
                'experience' => ['regex:/^[A-Za-zа-яёА-ЯЁ0-9_.,()\/\\-:;\'"— ]+$/u', 'nullable'],
                'age' => ['regex:/^[A-Za-zа-яёА-ЯЁ0-9_.,()\/\\-:;\'"— ]+$/u', 'nullable'],
                'price' => ['regex:/^[A-Za-zа-яёА-ЯЁ0-9_.,()\/\\-:;\'"—+ ]+$/u', 'nullable'],
                'region' => ['regex:/^[A-Za-zа-яёА-ЯЁ0-9_.,()\/\\-:;\'"— ]+$/u', 'nullable'],
                'position' => ['regex:/^[A-Za-zа-яёА-ЯЁ0-9_.,()\/\\-:;\'"— ]+$/u', 'nullable'],
                'description' => ['regex:/^[A-Za-zа-яёА-ЯЁ0-9_.,()\/\\-:;\'"— ]+$/u', 'nullable'],
                'doc' => ['file', 'nullable'],
            ], [
                'fullname.regex' => 'ФИО содержит запрещённые символы.',
                'fullname.required' => 'Полное имя - необходимое поле',
                'email.regex' => 'Email не соответствует формату.',
                'phone.regex' => 'Телефон содержит запрещённые символы.',
                'experience.regex' => 'Стаж содержит запрещённые символы.',
                'age.regex' => 'Возраст содержит запрещённые символы.',
                'price.regex' => 'Стоимость работы содержит запрещённые символы.',
                'region.regex' => 'Регион содержит запрещённые символы.',
                'position.regex' => 'Основная сфера деятельности содержит запрещённые символы.',
                'description.regex' => 'Краткое описание содержит запрещённые символы.',
                'doc.file' => 'Поддерживаемые форматы файлов: jpg,jpeg,png,pdf,doc,docx,gif,tif,tiff,bmp.',
            ]);
        }
    }
}
