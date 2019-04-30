<?php

namespace KupujemProdajem\Client;

use KupujemProdajem\Form\DeleteAdForm;
use KupujemProdajem\Form\FormInterface;
use KupujemProdajem\Form\NewAdForm;
use KupujemProdajem\Form\NewLoginForm;
use KupujemProdajem\Form\NewPhotoForm;

/**
 * Interface for Kupujem Prodajem client.
 *
 * Interface KPClientInterface
 * @package KupujemProdajem\Client
 */
interface KPClientInterface
{
    /**
     * Attempts to log user.
     *
     * @param $username
     * @param $password
     */
    public function login($username, $password): void ;

    /**
     * Logs out user.
     */
    public function logout(): void ;

    /**
     * Creates new ad form.
     *
     * @return NewAdForm
     */
    public function createNewAdForm(): NewAdForm;

    /**
     * Creates new login form.
     *
     * @return NewLoginForm
     */
    public function createNewLoginForm(): NewLoginForm;

    /**
     * Creates new photo form.
     *
     * @return NewPhotoForm
     */
    public function createNewPhotoForm(): NewPhotoForm;

    /**
     * Creates new delete ad form.
     *
     * @return DeleteAdForm
     */
    public function createNewDeleteAdForm(): DeleteAdForm;

    /**
     * Submits form.
     *
     * @param FormInterface $form
     */
    public function submitForm(FormInterface $form): void;

    /**
     * Searches KP izlog for given user subdomain.
     *
     * Returns array of ids of ads.
     *
     * @param $id
     * @return array
     */
    public function searchKPIzlog($id): array;

    /**
     * Uploads pictures and returns array of Picture entities.
     *
     * @param array $picturePaths
     * @return array
     */
    public function uploadPictures(array $picturePaths): array;
}