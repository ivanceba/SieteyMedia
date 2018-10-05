<?php

include_once 'Memory.php';

/**
 * Class MachinePlayer
 *
 * Extends the Player class to improve with statistics maths to make
 * machine play more intelligent.
 *
 * @author Ivan Ceballos Vega
 */
class MachinePlayer extends Player
{
    /**
     * Tolerance of machine. The lower, the machine get more risk to get win.
     */
    const MACHINE_STATISTICS_TOLERANCE = 0.6;

    /**
     * Indicates if the machine will continue into game.
     *
     * @param Memory $memory to search into register.
     * @return bool true if continue; false otherwise.
     */
    public function willContinue(Memory $memory, Player $rival)
    {
        return $this->points != PLAYER_WIN_POINTS && ($this->rival->points == PLAYER_WIN_POINTS || ($this->points <= $this->rival->points && $this->getStatistics($memory) >= self::MACHINE_STATISTICS_TOLERANCE));
    }

    /**
     * Get the statistic calculation of probability to get
     * points to win into next card.
     *
     * The function follows the next formula:
     *   P(A) = Probability of an event.
     *   F = Number of favorable outcomes.
     *   T = Number of total outcomes.
     *
     *   P(A) = F / T   where 1 <= P(A) <= 0.
     *
     * @param Memory $memory to search into register.
     * @return float|int percentage to get points to win in next card.
     */
    private function getStatistics(Memory $memory)
    {
        $notDisplayed = $memory->getCardsNotDisplayed();
        $pointsToWin = PLAYER_WIN_POINTS - $this->points;

        // Sum of the cards favorable to win and all the figures (which are always favorable).
        $validCards = array_sum(array_slice($notDisplayed, 0, floor($pointsToWin))) + array_sum(array_slice($notDisplayed, 7));
        return floatval($validCards) / array_sum($notDisplayed);
    }
}