<?php

namespace KupujemProdajem\Factory;

use KupujemProdajem\Form\DeleteAdForm;
use KupujemProdajem\Form\NewAdForm;
use KupujemProdajem\Form\NewLoginForm;
use KupujemProdajem\Form\NewPhotoForm;

class FormFactory implements FormFactoryInterface
{
    public function createNewAdForm($token): NewAdForm
    {
        return new NewAdForm($token);
    }

    public function createNewLoginForm(): NewLoginForm
    {
        return new NewLoginForm();
    }

    public function createNewPhotoForm($photoPath = null): NewPhotoForm
    {
        return new NewPhotoForm($photoPath);
    }

    public function createNewDeleteAdForm(): DeleteAdForm
    {
        return new DeleteAdForm();
    }


}