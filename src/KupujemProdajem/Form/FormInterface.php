<?php

namespace KupujemProdajem\Form;

interface FormInterface
{

    public function getAction();

    public function getMethod();

    public function getData();
}