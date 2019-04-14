<?php

namespace KupujemProdajem\Form;

use KupujemProdajem\Util\FormMethod;
use KupujemProdajem\Util\KPPaths;

class NewLoginForm extends Form
{
    protected $formMethod = FormMethod::POST;

    protected $formAction = KPPaths::LOGIN;

    private $action = 'login';

    private $submit = 1;

    private $username;

    private $password;

    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    public function getData()
    {
       return [
           'action' => $this->action,
           'submit[login]' => $this->submit,
           'data[email]' => $this->username,
           'data[password]' => $this->password
       ];
    }


}