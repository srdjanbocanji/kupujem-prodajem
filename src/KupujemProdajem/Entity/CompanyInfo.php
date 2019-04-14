<?php

namespace KupujemProdajem\Entity;

class CompanyInfo extends UserInfo
{
    protected $declarationType = 'company';

    /**
     * @var string
     */
    private $companyName;

    /**
     * @var string
     */
    private $companyAddress;

    /**
     * @var string
     */
    private $companyRegistrationNumber;

    /**
     * @var string
     */
    private $companyMotherNumber;

    /**
     * @return string
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * @param string $companyName
     */
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;
    }

    /**
     * @return string
     */
    public function getCompanyAddress()
    {
        return $this->companyAddress;
    }

    /**
     * @param string $companyAddress
     */
    public function setCompanyAddress($companyAddress)
    {
        $this->companyAddress = $companyAddress;
    }

    /**
     * @return string
     */
    public function getCompanyRegistrationNumber()
    {
        return $this->companyRegistrationNumber;
    }

    /**
     * @param string $companyRegistrationNumber
     */
    public function setCompanyRegistrationNumber($companyRegistrationNumber)
    {
        $this->companyRegistrationNumber = $companyRegistrationNumber;
    }

    /**
     * @return string
     */
    public function getCompanyMotherNumber()
    {
        return $this->companyMotherNumber;
    }

    /**
     * @param string $companyMotherNumber
     */
    public function setCompanyMotherNumber($companyMotherNumber)
    {
        $this->companyMotherNumber = $companyMotherNumber;
    }


}