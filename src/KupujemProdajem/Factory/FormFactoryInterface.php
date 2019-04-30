<?php

namespace KupujemProdajem\Factory;

use KupujemProdajem\Form\DeleteAdForm;
use KupujemProdajem\Form\NewAdForm;
use KupujemProdajem\Form\NewLoginForm;
use KupujemProdajem\Form\NewPhotoForm;

/**
 * Form factory interface.
 *
 * Interface FormFactoryInterface
 * @package KupujemProdajem\Factory
 */
interface FormFactoryInterface
{
    /**
     * Creates new ad form.
     *
     * @param $token
     * @return NewAdForm
     */
    public function createNewAdForm($token): NewAdForm;

    /**
     * Creates new login form.
     *
     * @return NewLoginForm
     */
    public function createNewLoginForm(): NewLoginForm;

    /**
     * Creates new photo form.
     *
     * @param null $photoPath
     * @return NewPhotoForm
     */
    public function createNewPhotoForm($photoPath = null): NewPhotoForm;

    /**
     * Creates new delete add form.
     *
     * @return DeleteAdForm
     */
    public function createNewDeleteAdForm(): DeleteAdForm;
}