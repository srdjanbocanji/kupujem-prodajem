<?php

namespace KupujemProdajem\Form;

use KupujemProdajem\Util\FormMethod;
use KupujemProdajem\Util\KPPaths;

class NewPhotoForm extends Form
{

    protected $formAction = KPPaths::STORE_PHOTO;

    protected $formMethod = FormMethod::POST;

    private $photoPath;

    public function __construct($photoPath)
    {
        if($photoPath !== null && !file_exists($photoPath)) {
            throw new \InvalidArgumentException("Invalid path: ".$photoPath);
        }

        $this->photoPath = $photoPath;
    }

    public function getData()
    {
        return [
            'file' => curl_file_create($this->photoPath),
            'X-Progress-ID' => 999999,
            'APC_UPLOAD_PROGRESS0' => 999999
        ];
    }

    /**
     * @return mixed
     */
    public function getPhotoPath()
    {
        return $this->photoPath;
    }

    /**
     * @param mixed $photoPath
     */
    public function setPhotoPath($photoPath)
    {
        if(!file_exists($photoPath)) {
            throw new \InvalidArgumentException("Invalid path: ".$photoPath);
        }
        $this->photoPath = $photoPath;
    }



}