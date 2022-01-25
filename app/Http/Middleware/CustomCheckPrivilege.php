<?php

namespace App\Http\Middleware;

use App\Helpers\ProfileHelper;
use App\Models\Customer;
use Bloonde\UsersAndPrivileges\Http\Middleware\CheckPrivilege;
use Bloonde\UsersAndPrivileges\ProfileUser;

class CustomCheckPrivilege extends CheckPrivilege
{
    function check($user, $privilege, $request){
        $action_to_check = [
            'their_profile' => 'checkTheirProfile'
          ];
        if(isset($action_to_check[$privilege])) {
            $method = $action_to_check[$privilege];
            return $this->$method($user);
        } else {
            return true;
        }
    }

    public function checkTheirProfile($user) {

        $request = request();
        $customerId = $request->route('id');
        $customer = Customer::find($customerId);
        return $user->id == $customer->user_id;
    }
}
