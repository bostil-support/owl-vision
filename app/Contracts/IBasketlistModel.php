<?php


namespace App\Contracts;

/**
 * Interface IBasketlistModel
 *
 * @package App\Contracts
 */
interface IBasketlistModel
{

    /**
     * @param  int|null  $quantuty
     *
     * @return int
     */
    public function getQuantityAttribute(?int $quantuty = null): int;
}