<?php
/**
 * Created by PhpStorm.
 * User: texas
 * Date: 3/1/18
 * Time: 9:02 PM
 */

namespace AppBundle\Service;

class PasswordCompareService
{
    public function isPasswordConfirm($password, $password_confirm)
    {
        if ($password == $password_confirm) {
            return true;
        }

        return false;
    }
}