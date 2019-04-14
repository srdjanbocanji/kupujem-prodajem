<?php

namespace KupujemProdajem\Factory;

interface FormFactoryInterface
{
    public function createNewAdForm($token);

    public function createNewLoginForm($username, $password);
}