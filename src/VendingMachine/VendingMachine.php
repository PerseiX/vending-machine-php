<?php


namespace VendingMachine;


class VendingMachine
{
    /**
     * @var Wallet
     */
    private $internalWallet;

    /**
     * @var Wallet
     */
    private $userWallet;

    /**
     * @var array
     */
    private $items;

    public function setInternalWallet(Wallet $wallet)
    {
        $this->internalWallet = $wallet;
        return $this;
    }

    /**
     * @param Wallet $userWallet
     * @return $this
     */
    public function setUserWallet(Wallet $userWallet)
    {
        $this->userWallet = $userWallet;
        return $this;
    }

    /**
     * @param array $items
     * @return $this
     */
    public function setItems(array $items)
    {
        $this->items = $items;

        return $this;
    }

    /**
     * @return Wallet
     */
    public function getInternalWallet()
    {
        return $this->internalWallet;
    }

    /**
     * @return Wallet
     */
    public function getUserWallet()
    {
        return $this->userWallet;
    }

    /**
     * @return array
     */
    public function getItems()
    {
        return $this->items;
    }

    public function giveProduct(Item $requiredItem)
    {
        foreach ($this->items as $item) {
            if ($item->getKey() === $requiredItem->getKey()) {
                if ($this->userWallet->getSum() === $requiredItem->getValue()) {
                    return $requiredItem->getKey();
                }
                if ($this->userWallet->getSum() > $requiredItem->getValue()) {

                    return $this->userWallet->getSum() - $requiredItem->getValue() . ' ' . $requiredItem->getKey();
                }

                return (string)$this->userWallet->getSum();
            }
        }

        return (string)$this->userWallet->getSum();
    }


}
