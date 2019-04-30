<?php

namespace KupujemProdajem\Client;

use Curl\Curl;
use KupujemProdajem\Entity\Picture;
use KupujemProdajem\Factory\FormFactory;
use KupujemProdajem\Factory\FormFactoryInterface;
use KupujemProdajem\Form\DeleteAdForm;
use KupujemProdajem\Form\FormInterface;
use KupujemProdajem\Form\NewAdForm;
use KupujemProdajem\Form\NewLoginForm;
use KupujemProdajem\Form\NewPhotoForm;
use KupujemProdajem\Util\AuthorizationException;
use KupujemProdajem\Util\FormMethod;
use KupujemProdajem\Util\KPPaths;

/**
 * Implementation of KPClientInterface.
 *
 * Class KPClient
 * @package KupujemProdajem\Client
 */
class KPClient implements KPClientInterface
{
    /** @var Curl */
    private $curl;

    /** @var string */
    private $baseUrl = 'https://www.kupujemprodajem.com';

    private $kpIzlogUrl = 'https://{user-id}.kpizlog.rs/index.php?action=search&data%5Bper_page%5D=48&data%5Bpage%5D={page}';

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

    public function login($username, $password): void
    {
        $form = $this->formFactory->createNewLoginForm();
        $form->setUsername($username);
        $form->setPassword($password);
        $this->submitForm($form);

        if($this->curl->getInfo(CURLINFO_EFFECTIVE_URL) == $this->resolveUrl(KPPaths::WELCOME_PAGE)) {
            $this->loggedIn = true;
        }

    }

    public function logout(): void
    {
        $this->curl->setOpt(CURLOPT_POST, FormMethod::GET);
        $this->curl->setOpt(CURLOPT_URL, $this->resolveUrl(KPPaths::LOGOUT));
        $this->curl->exec();

        $this->loggedIn = false;
    }

    public function createNewAdForm(): NewAdForm
    {

        $this->assertUserIsLoggedIn();

        $token = $this->retrieveCSRFToken();

        static::$pictureUploadIndex = 0;

        return $this->formFactory->createNewAdForm($token);
    }

    public function createNewLoginForm(): NewLoginForm
    {
        return $this->formFactory->createNewLoginForm();
    }

    public function submitForm(FormInterface $form): void
    {
        $this->curl->setOpt(CURLOPT_POST, $form->getMethod());
        $this->curl->setOpt(CURLOPT_URL, $this->resolveUrl($form->getAction()));

        if($form->getMethod() == FormMethod::POST) {
            $this->curl->setOpt(CURLOPT_POSTFIELDS, $form->getData());
        }

       return $this->curl->exec();


    }

    private function retrieveCSRFToken(): string
    {
        $this->curl->setOpt(CURLOPT_POST, 0);
        $this->curl->setOpt(CURLOPT_URL, $this->resolveUrl(KPPaths::CREATE_PRODUCT));

        $response = $this->curl->exec();
        preg_match('/name="form_id" value="(.*)"/', $response, $token, PREG_OFFSET_CAPTURE);
        return count($token) > 1 && count($token[1]) > 0 ? $token[1][0] : null;

    }

    private function resolveUrl($path): string
    {
        return $this->baseUrl.$path;
    }

    private function initializeCurl(): void
    {
        $this->curl = new Curl();
        $this->curl->setOpt(CURLOPT_COOKIESESSION, true);
        $this->curl->setOpt(CURLOPT_COOKIEFILE, 'cookie.txt');
        $this->curl->setOpt(CURLOPT_COOKIEJAR, 'cookie.txt');
        $this->curl->setOpt(CURLOPT_RETURNTRANSFER, true);
        $this->curl->setOpt(CURLOPT_FOLLOWLOCATION, true);
    }

    private function initializeFormFactory(): void
    {
        $this->formFactory = new FormFactory();
    }

    /**
     * @param array $picturePaths
     * @return Picture[]
     */
    public function uploadPictures(array $picturePaths): array
    {

        $pictures = [];

        for($i = static::$pictureUploadIndex;$i<count($picturePaths) + static::$pictureUploadIndex;$i++) {

            $this->submitForm($this->formFactory->createNewPhotoForm($picturePaths[$i]));

            $jsonResponse = $this->curl->response;
            $jsonResponse = json_decode($jsonResponse, true);
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

    public function getFormFactory()
    {
        return $this->formFactory;
    }

    public function searchKPIzlog($id): array
    {
        $result = [];
        $page = 1;
        $url = str_replace("{user-id}", $id, $this->kpIzlogUrl);
        $maxPage = 1;
        while(true) {

            $currentUrl = str_replace('{page}', $page, $url);

            if($page > $maxPage) {
                break;
            }

            $response = $this->curl->get($currentUrl);
            if($page == 1) {
                preg_match("/... <a(.*)class=\"page\">(.*)/", $response, $matchMaxPage);
                $maxPage =  count($matchMaxPage) > 0 ? $matchMaxPage[2] : $maxPage;

            }

            unset($matches);
            preg_match_all('/<a href=(.*)-(.*)-oglas.htm/', $response,$matches);

            foreach($matches[2] as $id) {
                $result[] = $id;
            }

            $page++;
        }

        return $result;

    }

    public function createNewDeleteAdForm(): DeleteAdForm
    {
        return $this->formFactory->createNewDeleteAdForm();
    }

    public function createNewPhotoForm(): NewPhotoForm
    {
        return $this->formFactory->createNewPhotoForm();
    }


}