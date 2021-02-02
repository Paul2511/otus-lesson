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

export const UPLOAD_IMAGE = '/api/v1/files/upload-image';
