Lightweight library for creating, searching and deleting ads on kupujemprodajem.com using cURL.

Creating new ads example:

Login:
        
        $kp = new \KupujemProdajem\Client\KPClient();

        $kp->login("username@example.com", "userpassword");

Setting company info:

        $companyInfo = new \KupujemProdajem\Entity\CompanyInfo();

        $companyInfo->setName("Foo"); <br>
        $companyInfo->setLastName("Bar"); <br>
        $companyInfo->setAddress("Elm street");  <br>
        $companyInfo->setCardLocation("Santa Fe"); <br>
        $companyInfo->setCardNumber("xxxxxxxx"); <br>
        $companyInfo->setJmbg("xxxxxxxxxxxxx"); <br>
        $companyInfo->setLocation("Santa Fe"); <br>
        $companyInfo->setCompanyAddress("Elm street xxx"); <Br>
        $companyInfo->setCompanyMotherNumber("xxxxxxxx"); <br>
        $companyInfo->setCompanyName("Standard Oil"); <br>
        $companyInfo->setCompanyRegistrationNumber("xxxxxxxxx"); <br>

Setting personal info:

        $personalAdInfo = new \KupujemProdajem\Entity\AdPersonalInfo();
        $personalAdInfo->setLocation(43); <br>
        $personalAdInfo->setName("Gulbox d.o.o"); <br>
        $personalAdInfo->setPhone("0631625083");
        
Setting ad info: 

        $ad = new \KupujemProdajem\Entity\Goods();
        $ad->setCategory(\KupujemProdajem\Util\KPCategory::AUTOMOBILI_DELOVI_I_ALATI);
        $ad->setGroup($group);
        $ad->setCondition(\KupujemProdajem\Util\KPCondition::CONDITION_NEW);
        $ad->setCurrency(\KupujemProdajem\Util\KPCurrency::EUR);
        $ad->setDescription($description);
        $ad->setPrice($price);
        $ad->setTitle($title);
        $ad->setType(\KupujemProdajem\Util\KPAdTypes::TYPE_SELL);       
        

Uploading pictures:         
         
         $pictures = $kp->uploadPictures([$picture1, $picture2]);
         $ad->setPictures($pictures);
         
Submitting form:
            
         $form = $kp->createNewAdForm();   
         $form->setUserInfo($companyInfo);
         $form->setAd($ad);
         $form->setAdPersonalInfo($personalAdInfo);

         $kp->submitForm($form);