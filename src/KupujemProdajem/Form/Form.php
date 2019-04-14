<?php

namespace KupujemProdajem\Form;

abstract class Form implements FormInterface
{
    protected $formAction;

    protected $formMethod;

    public function getAction()
    {
       return $this->formAction;
    }

    public function getMethod()
    {
       return $this->formMethod;
    }

    public abstract function getData();


}