<?php

namespace App\Http\Middleware;

use Bloonde\UsersAndPrivileges\Http\Middleware\CheckPrivilege;

class CustomCheckPrivilege extends CheckPrivilege
{
    function check($user, $privilege, $request){
        $action_to_check = [
            // 
          ];
        if(isset($action_to_check[$privilege])) {
            $method = $action_to_check[$privilege];
            return $this->$method($user);
        } else {
            return true;
        }
    }
}
