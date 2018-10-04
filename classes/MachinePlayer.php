<?php


class MachinePlayer extends Player
{
    const MACHINE_STATISTICS_TOLERANCE = 0.6;
    private $rival;

    public function __construct($name, Player $rival)
    {
        parent::__construct($name);
        $this->rival = $rival;
    }

    public function willContinue(Memory $memory)
    {
         return $this->points != PLAYER_WON_POINTS && ($this->rival->points == PLAYER_WON_POINTS ||
                ($this->points <= $this->rival->points && $this->getStatistics($memory) >= self::MACHINE_STATISTICS_TOLERANCE));
    }

    public function getStatistics(Memory $memory)
    {
        $notDisplayed = $memory->getCardsNotDisplayed();
        $pointsToWin = PLAYER_WON_POINTS - $this->points;
        $validCards = array_sum(array_slice($notDisplayed, 0, floor($pointsToWin))) + array_sum(array_slice($notDisplayed, 7));
        return floatval($validCards) / array_sum($notDisplayed);
    }
}