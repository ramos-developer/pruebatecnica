<?php
use Bloonde\ProjectGenerator\Helpers\CodesHelper;

return [
    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */
    CodesHelper::OK_CODE             => 'Successful operation',
    CodesHelper::FAILED_VALIDATOR_CODE => 'Validation error',
    CodesHelper::SERVER_ERROR_CODE => 'Server error',
    CodesHelper::BLACKLISTED_TOKEN => 'This token is no longer in use',
    CodesHelper::COULD_NOT_CREATE_TOKEN => 'Could not create token',
    CodesHelper::NO_PERMISSIONS => 'You have not permissions for this operation',
    CodesHelper::EXPIRED_TOKEN => 'Este token ha expirado',
    CodesHelper::INVALID_TOKEN => 'Invalid credentials',
    CodesHelper::INVALID_EMAIL => 'Invalid email',
    CodesHelper::NOT_FOUND => 'Resource not found',
    CodesHelper::NO_ACTIVATED_ACCOUNT => 'This account has been suspended',
    'user_does_not_exist' => 'User doesn\'t exists',
    'activate_account' => 'activate_account',
    'disabled_account' => 'disabled_account',
    
];
