<?php


namespace App\Faker;


use Faker\Provider\ru_RU\PhoneNumber;

class CustomPhoneProvider extends PhoneNumber
{
    protected static $formats = [
        '+7 (922) ###-##-##'
    ];
}