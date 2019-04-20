<?php

namespace KupujemProdajem\Factory;

interface FormFactoryInterface
{
    public function createNewAdForm($token);

    public function createNewLoginForm($username, $password);

    public function createNewPhotoForm($photoPath);

    public function createNewDeleteAdForm();
}