<?php


namespace Support\Phone\Fakers;


use Faker\Provider\ru_RU\PhoneNumber;

class PhoneNumberProvider extends PhoneNumber
{
    protected static $formats = [
        '+7 (922) ###-##-##'
    ];
}