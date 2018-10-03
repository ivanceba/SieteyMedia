<?php

// Constants
define("PLAYER_WON_POINTS", 7.5);

/**
 * Class Player
 *
 * Holds the player points.
 *
 * @author Ivan Ceballos Vega
 */
class Player
{
    protected $points = 0;
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    public function isOver() {
        return $this->points > PLAYER_WON_POINTS;
    }

    public function getPoints()
    {
        return $this->points;
    }

    public function receiveCard(Card $card)
    {
        $this->points += $card->calculatePoints();

    }

    public function reset()
    {
        $this->points = 0;
    }
}