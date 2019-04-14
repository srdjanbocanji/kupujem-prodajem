<?php

namespace KupujemProdajem\Factory;

use KupujemProdajem\Form\NewAdForm;
use KupujemProdajem\Form\NewLoginForm;

class FormFactory implements FormFactoryInterface
{
    public function createNewAdForm($token)
    {
        return new NewAdForm($token);
    }

    public function createNewLoginForm($username, $password)
    {
        return new NewLoginForm($username, $password);
    }


}