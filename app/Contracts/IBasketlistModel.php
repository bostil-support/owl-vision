<?php


namespace App\Contracts;

/**
 * Interface IBasketlistModel
 * @package App\Contracts
 * @property int $quantity
 */
interface IBasketlistModel
{
    public function getQuantityAttribute(?int $quantuty = null): int;
}