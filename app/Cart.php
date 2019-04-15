<?php

namespace App;

/**
 * 
 * Package:
 * 
 * The cart class,
 * stores products, their total qty, total price
 * 
 */
class Cart
{
    /**
     * public attributes
     * set as defaults
     * 
     * 
     * @var Integer $totalQty
     * @var Float $totalPrice
     * @var Array $items
     */
    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;

    /**
     * 
     * @param Cart $oldCart 
     * @return Void
     * class constructor
     * update cart if there's an existing one
     * prevents overwriting data
     * 
     */
    public function __construct($oldCart)
    {
        if ($oldCart) {
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    /**
     * @param Product $item 
     * @param Integer $id 
     * 
     * @return Void
     * 
     * 
     * increment totalQty
     * inrement totalPrice
     * 
     */
    public function add($item, $id)
    {
        $storedItem = ['qty' => 0, 'price' => $item->current_price, 'item' => $item];
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $storedItem = $this->items[$id];
            }
        }
        $storedItem['qty']++;
        $storedItem['price'] = $item->current_price * $storedItem['qty'];
        $this->items[$id] = $storedItem;
        $this->totalQty++;
        $this->totalPrice += $item->current_price;
    }

    /**
     * @param Integer $id 
     * 
     * @return Boolean
     * 
     * decrement totalQty
     * decrement totalPrice
     * 
     */
    public function removeItem($id)
    {
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $storedItem = $this->items[$id];
                $this->totalQty -= $storedItem['qty'];
                $this->totalPrice -= $storedItem['price'];
                unset($this->items[$id]);
                return true;
            }
        }

        return false;
    }

    /**
     * @var Integer $id
     * @var Integer $qty
     * 
     * @return Boolean
     */
    public function updateQty($id, $qty)
    {
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {

                if ($qty <= $this->items[$id]['item']->qty && $qty > 0) {
                    $prevQty = $this->items[$id]['qty'];
                    $prevPrice = $this->items[$id]['price'];
                    $this->items[$id]['qty'] = $qty;
                    $this->items[$id]['price'] = $this->items[$id]['qty'] * $this->items[$id]['item']->current_price;
                    $this->totalQty += $qty - $prevQty;
                    $this->totalPrice += $this->items[$id]['price'] - $prevPrice;
                    return true;
                }
                return false;
            }
        }
        return false;
    }
    /**
     * 
     * @return Boolean
     */
    public function clearCart()
    {
        $this->items = null;
        $this->totalPrice = 0;
        $this->totalQty = 0;
        return true;
    }
}
