<?php

include_once "Card.php";

/**
 * Class Memory
 *
 * Holds the cards already displayed.
 *
 * @author Ivan Ceballos Vega.
 */
class Memory
{
    // List that holds all the cards displayed.
    private $list = null;

    /**
     * Memory constructor.
     */
    public function __construct()
    {
        $this->list = array_fill(0, 10, array_fill(0, 4, false));
    }

    /**
     * Check if a given card exists in memory.
     *
     * @param Card $card
     * @return bool true if exists; false otherwise.
     */
    public function exists(Card $card)
    {
        return $this->list[$card->getNumber()][$card->getSuit()];
    }

    /**
     * Inserts a card into memory. If the card already exist in memory, it will be ignored.
     *
     * @param Card $card
     */
    public function add(Card $card)
    {
        if (!$this->exists($card))
            $this->list[$card->getNumber()][$card->getSuit()] = true;
    }

    /**
     * Resets the memory.
     */
    public function reset()
    {
        $this->list = array_fill(0, 10, array_fill(0, 4, false));
    }

    /**
     * Get the cards that has not been displayed.
     * The format is an array of numbers with the sum of cards not displayed.
     *
     * @return array
     */
    public function getCardsNotDisplayed()
    {
        $response = [];
        $numElements = count($this->list);
        for ($i = 0; $i < $numElements; $i++)
            $response[] = 4 - array_sum($this->list[$i]);

        return $response;
    }
}