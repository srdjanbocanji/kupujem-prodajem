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

    /** @var string */
    private $username;

    /** @var string */
    private $password;


    public function getData()
    {
       return [
           'action' => $this->action,
           'submit[login]' => $this->submit,
           'data[email]' => $this->username,
           'data[password]' => $this->password
       ];
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }






}