<?php


namespace App\Services;


use App\Model\UserRegistrationModel;

class RegistrationService
{
    public function saveAction($request)
    {
        $userRegistration = new UserRegistrationModel();

        $userRegistration->login = $request->login;
        $userRegistration->password = $request->password;
        $userRegistration->email = $request->email;

        $userRegistration->save();

        return;
    }
}
