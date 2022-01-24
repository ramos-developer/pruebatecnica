<?php

namespace App\Helpers;

use Bloonde\UsersAndPrivileges\ProfileUser;

class ProfileHelper
{

    const ADMIN_PROFILE = 1;
    const ADMIN_PROFILE_NAME = 'admin';

    public static function getCurrentProfile(){
        $profile = ProfileUser::where([
            ['id', ProfileHelper::getCurrentProfileUserId()]
        ])->first();
        return $profile;
    }

    /** Funcion que controla que el profile_user proveniente de las cookies es del usuario autenticado
     * @return null
     */
    public static function getCurrentProfileUserId(){
        return null;
    }
}
