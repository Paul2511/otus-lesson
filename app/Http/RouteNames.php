<?php


namespace App\Http;


class RouteNames
{

    const GET_USER = 'getUser';
    const UPDATE_USER = 'updateUser';

    const GET_USER_PETS = 'getUserPets';
    const DELETE_PET = 'deletePet';


    public static $notFound = [
        self::GET_USER => 'user',
        self::UPDATE_USER => 'user',
        self::GET_USER_PETS => 'user',
        self::DELETE_PET => 'pet'
    ];

}
