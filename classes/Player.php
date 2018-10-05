<?php

include_once "Card.php";

// Constants
define("PLAYER_WIN_POINTS", 7.5);

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

    /**
     * Indicates if a player is over.
     *
     * @return bool true if over; false otherwise.
     */
    public function isOver() {
        return $this->points > PLAYER_WIN_POINTS;
    }

    /**
     * Get the points of the player.
     *
     * @return int
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * Get the card and add points.
     *
     * @param Card $card
     */
    public function receiveCard(Card $card)
    {
        $this->points += $card->calculatePoints();

    }

    /**
     * Resets the player data.
     */
    public function reset()
    {
        $this->points = 0;
    }
}