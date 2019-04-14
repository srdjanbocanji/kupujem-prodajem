<?php

namespace KupujemProdajem\Form;

use KupujemProdajem\Entity\Ad;
use KupujemProdajem\Entity\AdPersonalInfo;
use KupujemProdajem\Entity\CompanyInfo;
use KupujemProdajem\Entity\Goods;
use KupujemProdajem\Entity\Service;
use KupujemProdajem\Entity\UserInfo;
use KupujemProdajem\Util\FormMethod;
use KupujemProdajem\Util\KPPaths;

class NewAdForm extends Form
{
    protected $formMethod = FormMethod::POST;

    protected $formAction = KPPaths::STORE_PRODUCT;


    private $action = 'ajax_save';

    /**
     * CSRF token.
     *
     * @var string $token
     */
    private $token;

    /**
     * @var boolean
     */
    private $kpizlog;

    /** @var string  */
    private $swear = 'yes';

    /** @var string  */
    private $accept = 'yes';

    /** @var int  */
    private $submit = 1;

    /** @var UserInfo|CompanyInfo */
    private $userInfo;

    /** @var AdPersonalInfo */
    private $adPersonalInfo;

    /** @var Goods|Service */
    private $ad;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function getData()
    {
        $data = $this->collectData();

        if($this->userInfo instanceof CompanyInfo) {
            $data += $this->addAdditionalCompanyInfoData();
        }

        if($this->ad instanceof Service) {
            $data += $this->addAdditionalServiceData();
        }

        if($this->ad instanceof Goods) {
            $data += $this->addAdditionalGoodsData();
        }

        return $data;

    }

    private function collectData()
    {
        $data = [
            'action' => $this->action,
            'form_id' => $this->token,
            //'data[service_top_price_displayed]' => 504,
            'data[ad_kind]' => $this->ad->getKind(),
            'data[category_id]' => $this->ad->getCategory(),
            'data[group_id]' => $this->ad->getGroup(),
            'data[name]' => $this->ad->getTitle(),
            'data[ad_type]' => $this->ad->getType(),
            'data[price]' => $this->ad->getPrice(),
            'data[currency]' => $this->ad->getCurrency(),
            'data[description]' => $this->ad->getDescription(),
            'data[location_id]' => $this->adPersonalInfo->getLocation(),
            'data[owner]' => $this->adPersonalInfo->getName(),
            'data[phone]' => $this->adPersonalInfo->getPhone(),
            'data[kpizlog]' => $this->kpizlog,
            // USER INFO
            'data[declaration_type]' => $this->userInfo->getDeclarationType(),
            'data[d_person_name]' => $this->userInfo->getName(),
            'data[d_person_lastname]' => $this->userInfo->getLastName(),
            'data[d_person_location]' => $this->userInfo->getLocation(),
            'data[d_person_address]' => $this->userInfo->getAddress(),
            'data[d_jmbg]' => $this->userInfo->getJmbg(),
            'data[d_id_card_number]' => $this->userInfo->getCardNumber(),
            'data[d_id_card_location]' => $this->userInfo->getLocation(),
            'data[swear]' => $this->swear,
            'data[accept]' => $this->accept,
            'submit[post]' => $this->submit
        ];

        $i = 1;
        foreach($this->ad->getPictures() as $picture) {
            $data['photo_num'.$i] = $picture->getPhotoNum();
            $data['photo_path'.$i] = $picture->getPhotoPath();
            $data['file_name'.$i] = $picture->getFileName();
        }

        return $data;
    }

    private function addAdditionalCompanyInfoData()
    {
        return [
            'data[d_company_name]' => $this->userInfo->getCompanyName(),
            'data[d_address]' => $this->userInfo->getCompanyAddress(),
            'data[d_registration_number]' => $this->userInfo->getCompanyRegistrationNumber(),
            'data[d_mather_number]' => $this->userInfo->getCompanyMotherNumber(),
        ];

    }

    private function addAdditionalGoodsData()
    {
        return [
            'data[condition]' => $this->ad->getCondition(),
        ];
    }

    private function addAdditionalServiceData()
    {
        return [];
    }

    public function getToken()
    {
        return $this->token;
    }

}