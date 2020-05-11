<?php


namespace App\Traits;


trait Ecommercable
{
    /**
     * @param int|null $quantity
     * @return bool|null
     * @throws \Exception
     */
    public function basketlistAdd(?int $quantity): ?bool
    {
        return \Basketlist::add($this, $quantity);
    }

    /**
     * @return bool|null
     * @throws \Exception
     */
    public function basketlistDelete(): ?bool
    {
        return \Basketlist::remove($this);
    }

    /**
     * @param int|null $quantity
     * @return bool|null
     * @throws \Exception
     */
    public function basketlistRemove(?int $quantity): ?bool
    {
        return \Basketlist::removeQty($this, $quantity);
    }

    /**
     * @return bool|null
     * @throws \Exception
     */
    public function wishlistAdd(): ?bool
    {
        return \Wishlist::add($this);
    }

    /**
     * @return bool|null
     * @throws \Exception
     */
    public function wishlistRemove(): ?bool
    {
        return \Wishlist::remove($this);
    }
}