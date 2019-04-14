<?php

namespace KupujemProdajem\Client;

interface KPClientInterface
{
    public function login($username, $password);

    public function createNewAdForm();
}