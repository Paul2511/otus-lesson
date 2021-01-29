<?php


namespace App\Http;


class RouteNames
{

    const LOGIN = 'login';
    const PROFILE = 'profile';
    const TOKEN_REFRESH = 'tokenRefresh';
    const CLIENT_REGISTRATION = 'clientRegistration';

    const GET_USER = 'getUser';
    const UPDATE_USER = 'updateUser';

    const GET_PETS = 'getPets';
    const GET_ALL_PETS = 'getAllPets';
    const GET_USER_PETS = 'getUserPets';
    const GET_PET = 'getPet';
    const UPDATE_PET = 'updatePet';
    const DELETE_PET = 'deletePet';
    const CREATE_PET = 'createPet';

    const UPLOAD_IMAGE = 'uploadImage';

    public static $notFound = [
        self::GET_USER => 'user',
        self::UPDATE_USER => 'user',
        self::GET_USER_PETS => 'user',
        self::GET_PET => 'pet',
        self::UPDATE_PET => 'pet',
        self::DELETE_PET => 'pet'
    ];

}