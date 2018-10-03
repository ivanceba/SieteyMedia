<?php

require_once 'Card.php';
require_once 'Player.php';
require_once 'Memory.php';
require_once 'MachinePlayer.php';


/**
 * Class Controller
 *
 * Hold communication with user and models.
 *
 * @author Ivan Ceballos Vega
 */
class Controller
{
    const PLAYER_NAME = "Humano";
    const MACHINE_NAME = "Máquina";

    private static $instance;
    private $memory;
    private $human;
    private $machine;

    /**
     * @return Controller unique instance.
     */
    public static function getController()
    {
        if (!isset(self::$instance)) {
            $class = __CLASS__;
            self::$instance = new $class;
        }
        return self::$instance;
    }

    /**
     * Clone this object.
     *
     * Note: because this class is singleton, the clone is not allowed.
     */
    public function __clone()
    {
        trigger_error('Clone this object is not allowed.', E_USER_ERROR);
    }

    /**
     * Runs the controller.
     */
    public function run()
    {
        do {
            $this->startNewGame();
            echo $this->decideVictory() . 'Repetir (r) o Abandonar (a).';
            fscanf(STDIN, "%s\n", $response);

            $this->reset();
        } while ($response == 'r');
    }

    /**
     * Controller constructor.
     */
    private function __construct()
    {
        $this->human = new Player(self::PLAYER_NAME);
        $this->machine = new MachinePlayer(self::MACHINE_NAME, $this->human);
        $this->memory = new Memory();
    }

    /**
     * Resets the data of the users and memory.
     */
    private function reset()
    {
        $this->human->reset();
        $this->machine->reset();
        $this->memory->reset();
    }

    /**
     * Start playing.
     */
    private function startNewGame()
    {
        $this->playHuman();
        if (!$this->human->isOver()) {
            $this->playMachine();
        }
    }

    private function playHuman()
    {
        do {
            echo "Jugador Humano pide carta.\n";
            $card = new Card($this->memory);
            $this->human->receiveCard($card);
            $this->memory->add($card);
            echo "\tHas sacado " . $card . ". LLevas " . $this->human->getPoints() . " puntos. ";

            if ($this->human->isOver())
                echo "\n";
            else {
                do {
                    echo 'Plantarse (p) o Continuar (c) ';
                    fscanf(STDIN, "%s\n", $response);

                    if ($response === "p") {
                        echo "Jugador Humano se planta.\n";
                        return;
                    }
                } while ($response != 'p' && $response != 'c');
            }
        } while (!$this->human->isOver());
    }

    private function playMachine()
    {

        do {
            echo "Jugador Maquina pide carta.\n";
            $card = new Card($this->memory);

            $this->machine->receiveCard($card);

            echo "\tHas sacado " . $card . ". LLeva " . $this->machine->getPoints() . " puntos. \n";

        } while ($this->machine->willContinue($this->memory) && !$this->machine->isOver());

        if (!$this->machine->isOver())
            echo "Jugador Máquina se planta.\n";

    }

    private function decideVictory()
    {
        if ($this->human->isOver() || (!$this->machine->isOver() && $this->machine->getPoints() >= $this->human->getPoints()))
            echo 'Jugador Máquina';
        else
            echo 'Jugador Humano';
        echo ' gana la partida. ';
    }
}