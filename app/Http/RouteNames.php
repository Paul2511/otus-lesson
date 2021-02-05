<?php


namespace App\Http;


class RouteNames
{

    const V1_LOGIN = 'login';
    const V1_PROFILE = 'profile';
    const V1_TOKEN_REFRESH = 'tokenRefresh';
    const V1_CLIENT_REGISTRATION = 'clientRegistration';

    const V1_GET_USER = 'getUser';
    const V1_UPDATE_USER = 'updateUser';

    const V1_GET_PETS = 'getPets';
    const V1_GET_ALL_PETS = 'getAllPets';
    const V1_GET_USER_PETS = 'getUserPets';
    const V1_GET_PET = 'getPet';
    const V1_UPDATE_PET = 'updatePet';
    const V1_DELETE_PET = 'deletePet';
    const V1_CREATE_PET = 'createPet';

    const V1_GET_PET_TYPES = 'getPetTypes';
    const V1_GET_PET_TYPE = 'getPetType';
    const V1_CREATE_PET_TYPE = 'createPetType';
    const V1_UPDATE_PET_TYPE = 'updatePetType';
    const V1_DELETE_PET_TYPE = 'deletePetType';

    const V1_UPLOAD_IMAGE = 'uploadImage';

    public static $notFound = [
        self::V1_GET_USER => 'user',
        self::V1_UPDATE_USER => 'user',
        self::V1_GET_USER_PETS => 'user',
        self::V1_GET_PET => 'pet',
        self::V1_UPDATE_PET => 'pet',
        self::V1_DELETE_PET => 'pet',
        self::V1_GET_PET_TYPE => 'petType',
        self::V1_UPDATE_PET_TYPE => 'petType',
        self::V1_DELETE_PET_TYPE => 'petType',
    ];

}