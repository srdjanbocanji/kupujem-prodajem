<?php

namespace KupujemProdajem\Factory;

use KupujemProdajem\Form\DeleteAdForm;
use KupujemProdajem\Form\NewAdForm;
use KupujemProdajem\Form\NewLoginForm;
use KupujemProdajem\Form\NewPhotoForm;

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

    public function createNewPhotoForm($photoPath)
    {
        return new NewPhotoForm($photoPath);
    }

    public function createNewDeleteAdForm()
    {
        return new DeleteAdForm();
    }


}