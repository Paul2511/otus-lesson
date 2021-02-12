export const PROFILE = '/api/v1/auth/profile';
export const LOGIN = '/api/v1/auth/login';
export const CLIENT_REGISTRATION = '/api/v1/auth/registration';
export const TOKEN_REFRESH = '/api/v1/auth/refresh';


export const GET_USER = (userId) => {
    return '/api/v1/users/'+userId;
};
export const UPDATE_USER = (userId) => {
    return '/api/v1/users/'+userId;
};
export const GET_USER_PETS = (userId) => {
    return '/api/v1/users/'+userId+'/pets';
};

export const GET_PETS = '/api/v1/pets';
export const GET_ALL_PETS = '/api/v1/pets/list';
export const CREATE_PET = '/api/v1/pets';
export const DELETE_PET = (petId) => {
    return '/api/v1/pets/'+petId;
};
export const GET_PET = (petId) => {
    return '/api/v1/pets/'+petId;
};
export const UPDATE_PET = (petId) => {
    return '/api/v1/pets/'+petId;
};

export const GET_PET_TYPES = '/api/v1/pet-types';
export const CREATE_PET_TYPE = '/api/v1/pet-types';
export const UPDATE_PET_TYPE = (id) => {
    return '/api/v1/pet-types/'+id;
};
export const DELETE_PET_TYPE = (id) => {
    return '/api/v1/pet-types/'+id;
};

export const GET_SPECIALIZATIONS = '/api/v1/specializations';
export const CREATE_SPECIALIZATION = '/api/v1/specializations';
export const UPDATE_SPECIALIZATION = (id) => {
    return '/api/v1/specializations/'+id;
};
export const DELETE_SPECIALIZATION = (id) => {
    return '/api/v1/specializations/'+id;
};

export const CREATE_COMMENT = '/api/v1/comments';
export const UPDATE_COMMENT = (id) => {
    return '/api/v1/comments/'+id;
};
export const DELETE_COMMENT = (id) => {
    return '/api/v1/comments/'+id;
};

export const UPLOAD_IMAGE = '/api/v1/files/upload-image';
