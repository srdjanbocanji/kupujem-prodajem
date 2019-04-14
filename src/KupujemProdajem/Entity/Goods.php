<?php

namespace KupujemProdajem\Entity;

class Goods extends Ad
{
    protected $kind = 'goods';

    /** @var string */
    private $condition;

    /**
     * @return string
     */
    public function getCondition()
    {
        return $this->condition;
    }

    /**
     * @param string $condition
     */
    public function setCondition($condition)
    {
        $this->condition = $condition;
    }







}