<?php
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 2/12/18
 * Time: 4:40 PM
 */

namespace AppBundle\Service;


class RegisterUserMessageGenerator
{
    public $adminEmail;

    public function __construct($adminEmail)
    {
        $this->adminEmail = $adminEmail;
    }

    public function sendMessage($message)
    {
        fwrite(fopen('/tmp/dump', 'a'), print_r($message . ' => ' . $this->adminEmail, 1) . "\n\r");
    }
}