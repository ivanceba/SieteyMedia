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

    public function reset()
    {
        $this->list = array_fill(0, 10, array_fill(0, 4, false));
    }

    public function test()
    {
        for ($i = 0; $i < 10; $i++)
            $this->add(new Card($this));

        $cardsNotDisplayed = $this->getCardsNotDisplayed();
    }

    public function getCardsNotDisplayed()
    {
        $response = [];

        for ($i = 0; $i < count($this->list); $i++)
            $response[] = 4 - array_sum($this->list[$i]);

        return $response;
    }
}