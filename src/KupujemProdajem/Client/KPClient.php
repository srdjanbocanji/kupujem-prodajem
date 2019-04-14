<?php

namespace KupujemProdajem\Client;

use Curl\Curl;
use KupujemProdajem\Entity\Picture;
use KupujemProdajem\Factory\FormFactory;
use KupujemProdajem\Factory\FormFactoryInterface;
use KupujemProdajem\Form\FormInterface;
use KupujemProdajem\Form\NewAdForm;
use KupujemProdajem\Form\NewLoginForm;
use KupujemProdajem\Util\AuthorizationException;
use KupujemProdajem\Util\FormMethod;
use KupujemProdajem\Util\KPPaths;

class KPClient implements KPClientInterface
{
    /** @var Curl */
    private $curl;

    /** @var string */
    private $baseUrl = 'https://www.kupujemprodajem.com';

    /** @var FormFactoryInterface */
    private $formFactory;

    /** @var bool  */
    private $loggedIn = false;

    /** @var int  */
    private static $pictureUploadIndex = 0;

    public function __construct()
    {
        $this->initializeCurl();
        $this->initializeFormFactory();

    }

    public function login($username, $password)
    {
        $this->submitForm($this->createNewLoginForm($username, $password));

        if($this->curl->getInfo(CURLINFO_EFFECTIVE_URL) == $this->resolveUrl(KPPaths::WELCOME_PAGE)) {
            $this->loggedIn = true;
        }

    }

    public function logout()
    {
        $this->curl->setOpt(CURLOPT_POST, FormMethod::GET);
        $this->curl->setOpt(CURLOPT_URL, $this->resolveUrl(KPPaths::LOGOUT));
        $this->curl->exec();

        $this->loggedIn = false;
    }

    public function createNewAdForm(): NewAdForm
    {

        $this->assertUserIsLoggedIn();

        echo "user is lgd";
        die;

        $token = $this->retrieveCSRFToken();

        static::$pictureUploadIndex = 0;

        return $this->formFactory->createNewAdForm($token);
    }

    private function createNewLoginForm($username, $password): NewLoginForm
    {
        return $this->formFactory->createNewLoginForm($username, $password);
    }

    public function submitForm(FormInterface $form)
    {
        $this->curl->setOpt(CURLOPT_POST, $form->getMethod());
        $this->curl->setOpt(CURLOPT_URL, $this->resolveUrl($form->getAction()));

        if($form->getMethod() == FormMethod::POST) {
            $this->curl->setOpt(CURLOPT_POSTFIELDS, $form->getData());
        }

       return $this->curl->exec();


    }

    private function retrieveCSRFToken()
    {
        $this->curl->setOpt(CURLOPT_POST, 0);
        $this->curl->setOpt(CURLOPT_URL, $this->resolveUrl(KPPaths::CREATE_PRODUCT));

        $response = $this->curl->exec();
        preg_match('/name="form_id" value="(.*)"/', $response, $token, PREG_OFFSET_CAPTURE);
        return count($token) > 1 && count($token[1]) > 0 ? $token[1][0] : null;

    }

    private function resolveUrl($path)
    {
        return $this->baseUrl.$path;
    }

    private function initializeCurl()
    {
        $this->curl = new Curl();
        $this->curl->setOpt(CURLOPT_COOKIESESSION, true);
        $this->curl->setOpt(CURLOPT_COOKIEFILE, 'cookie.txt');
        $this->curl->setOpt(CURLOPT_COOKIEJAR, 'cookie.txt');
        $this->curl->setOpt(CURLOPT_RETURNTRANSFER, true);
        $this->curl->setOpt(CURLOPT_FOLLOWLOCATION, true);
    }

    private function initializeFormFactory()
    {
        $this->formFactory = new FormFactory();
    }

    /**
     * @param array $picturePaths
     * @return Picture[]
     */
    public function uploadPictures(array $picturePaths)
    {

        $pictures = [];

        for($i = static::$pictureUploadIndex;$i<count($picturePaths) + static::$pictureUploadIndex;$i++) {

            $jsonResponse = $this->submitForm($this->formFactory->createNewPhotoForm($picturePaths[$i]));
            $jsonResponse = json_decode($jsonResponse, true);
            var_dump($jsonResponse);
            $picture = new Picture();
            $picture->setFileName($jsonResponse['file_name']);
            $picture->setPhotoNum($i + 1);
            $picture->setPhotoPath($jsonResponse['file_path']);
            $pictures[] = $picture;

        }

        return $pictures;
    }

    private function assertUserIsLoggedIn()
    {
        if(!$this->loggedIn) {
            throw new AuthorizationException("User must be logged in!");
        }
    }


}