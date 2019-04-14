<?php

namespace KupujemProdajem\Entity;

class UserInfo
{
    /**
     * @var string
     */
    protected $declarationType = 'person';

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var string
     */
    private $location;

    /**
     * @var string
     */
    private $address;

    /**
     * @var string
     */
    private $jmbg;

    /**
     * @var string
     */
    private $cardNumber;

    /**
     * @var string
     */
    private $cardLocation;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param string $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getJmbg()
    {
        return $this->jmbg;
    }

    /**
     * @param string $jmbg
     */
    public function setJmbg($jmbg)
    {
        $this->jmbg = $jmbg;
    }

    /**
     * @return string
     */
    public function getCardNumber()
    {
        return $this->cardNumber;
    }

    /**
     * @param string $cardNumber
     */
    public function setCardNumber($cardNumber)
    {
        $this->cardNumber = $cardNumber;
    }

    /**
     * @return string
     */
    public function getCardLocation()
    {
        return $this->cardLocation;
    }

    /**
     * @param string $cardLocation
     */
    public function setCardLocation($cardLocation)
    {
        $this->cardLocation = $cardLocation;
    }

    /**
     * @return string
     */
    public function getDeclarationType()
    {
        return $this->declarationType;
    }








}