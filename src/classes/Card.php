<?php

require_once 'Memory.php';

/**
 * Class Card
 *
 * Hols the characteristics and actions of a card.
 *
 * @author Ivan Ceballos Vega
 */
class Card
{
    private $number;
    private $suit;

    /**
     * Card constructor.
     *
     * @param Memory $memory
     */
    public function __construct(Memory $memory)
    {
        do {
            $this->number = rand(0, 9);
            $this->suit = rand(0, 3);
        } while ($memory->exists($this));
    }

    /**
     * Compares two cards and indicates if both content are equal.
     *
     * @param Card $card caro to compare.
     * @return bool true if equal; false otherwise.
     */
    public function equals(Card $card)
    {
        return $this->number == $card->number && $this->suit == $card->suit;
    }

    /**
     * Get the number of the card.
     *
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Get the suit of the card.
     *
     * @return int
     */
    public function getSuit()
    {
        return $this->suit;
    }

    /**
     * Calculate the points of the card.
     *
     * @return float|int
     */
    public function calculatePoints()
    {
        return ($this->number > 6) ? 0.5 : $this->number + 1;
    }

    /**
     * Gives a string representation of a card.
     *
     * @return string
     */
    public function __toString()
    {
        switch ($this->number) {
            case 0:
                $name = "As";
                break;
            case 7:
                $name = "Sota";
                break;
            case 8:
                $name = "Caballo";
                break;
            case 9:
                $name = "Rey";
                break;
            default:
                $name = strval($this->number + 1);
        }
        $name .= " de ";
        switch ($this->suit) {
            case 0:
                return $name . "Bastos";
                break;
            case 1:
                return $name . "Espadas";
                break;
            case 2:
                return $name . "Copas";
                break;
            default:
                return $name . "Oros";
                break;
        }
    }
}