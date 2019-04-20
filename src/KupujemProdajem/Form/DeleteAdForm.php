<?php

namespace KupujemProdajem\Form;

use KupujemProdajem\Util\FormMethod;
use KupujemProdajem\Util\KPPaths;

class DeleteAdForm extends Form
{
    protected $formMethod = FormMethod::POST;

    protected $formAction = KPPaths::DELETE_PRODUCT;

    private $action = 'delete';

    private $submit = 1;

    private $ad = 1;

    private $adId;

    private $reason;

    public function getData()
    {
        return [
            'action' => $this->action,
            'oglas_id' => $this->adId,
            'ad' => $this->ad,
            'data[reason]' => $this->reason,
            'submit[delete]' => $this->submit

        ];
    }

    /**
     * @return mixed
     */
    public function getAdId()
    {
        return $this->adId;
    }

    /**
     * @param mixed $adId
     */
    public function setAdId($adId)
    {
        $this->adId = $adId;
    }

    /**
     * @return mixed
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * @param mixed $reason
     */
    public function setReason($reason)
    {
        $this->reason = $reason;
    }



}