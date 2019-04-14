<?php

namespace KupujemProdajem\Entity;

class Picture
{
    private $photoNum;

    private $photoPath;

    private $fileName;

    /**
     * @return mixed
     */
    public function getPhotoNum()
    {
        return $this->photoNum;
    }

    /**
     * @param mixed $photoNum
     */
    public function setPhotoNum($photoNum)
    {
        $this->photoNum = $photoNum;
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
        $this->photoPath = $photoPath;
    }

    /**
     * @return mixed
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * @param mixed $fileName
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
    }


}