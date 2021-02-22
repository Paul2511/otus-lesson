<?php


namespace App\Http;


class RouteNames
{

    const V1_LOGIN = 'login';
    const V1_LOGIN_AS = 'loginAs';
    const V1_PROFILE = 'profile';
    const V1_TOKEN_REFRESH = 'tokenRefresh';
    const V1_CLIENT_REGISTRATION = 'clientRegistration';
    const V1_SPEC_REGISTRATION = 'specRegistration';
    const V1_CHANGE_PASSWORD = 'changePassword';
    const V1_FORGOT_PASSWORD = 'forgotPassword';
    const V1_RESET_PASSWORD = 'resetPassword';

    const PASSWORD_RESET = 'password.reset';

    const V1_GET_USER = 'getUser';
    const V1_CREATE_USER = 'createUser';
    const V1_UPDATE_USER = 'updateUser';
    const V1_GET_ALL_USERS = 'getAllUser';

    const V1_GET_PETS = 'getPets';
    const V1_GET_ALL_PETS = 'getAllPets';
    const V1_GET_USER_PETS = 'getUserPets';
    const V1_GET_USER_COMMENTS = 'getUserComments';
    const V1_GET_PET = 'getPet';
    const V1_UPDATE_PET = 'updatePet';
    const V1_DELETE_PET = 'deletePet';
    const V1_CREATE_PET = 'createPet';

    const V1_GET_PET_TYPES = 'getPetTypes';
    const V1_GET_PET_TYPE = 'getPetType';
    const V1_CREATE_PET_TYPE = 'createPetType';
    const V1_UPDATE_PET_TYPE = 'updatePetType';
    const V1_DELETE_PET_TYPE = 'deletePetType';

    const V1_GET_SPECIALIZATIONS = 'getSpecializations';
    const V1_GET_SPECIALIZATION = 'getSpecialization';
    const V1_CREATE_SPECIALIZATION = 'createSpecialization';
    const V1_UPDATE_SPECIALIZATION = 'updateSpecialization';
    const V1_DELETE_SPECIALIZATION = 'deleteSpecialization';

    const V1_CREATE_COMMENT = 'createComment';
    const V1_UPDATE_COMMENT = 'updateComment';
    const V1_DELETE_COMMENT = 'deleteComment';

    const V1_UPLOAD_IMAGE = 'uploadImage';

    public static $notFound = [
        self::V1_GET_USER => 'user',
        self::V1_UPDATE_USER => 'user',
        self::V1_GET_USER_PETS => 'user',
        self::V1_GET_USER_COMMENTS => 'user',
        self::V1_LOGIN_AS => 'user',
        self::V1_CHANGE_PASSWORD => 'user',
        self::V1_FORGOT_PASSWORD => 'user',
        self::V1_GET_PET => 'pet',
        self::V1_UPDATE_PET => 'pet',
        self::V1_DELETE_PET => 'pet',
        self::V1_GET_PET_TYPE => 'petType',
        self::V1_UPDATE_PET_TYPE => 'petType',
        self::V1_DELETE_PET_TYPE => 'petType',
        self::V1_GET_SPECIALIZATION => 'specialization',
        self::V1_UPDATE_SPECIALIZATION => 'specialization',
        self::V1_DELETE_SPECIALIZATION => 'specialization',
        self::V1_UPDATE_COMMENT => 'comment',
        self::V1_DELETE_COMMENT => 'comment',
    ];

}