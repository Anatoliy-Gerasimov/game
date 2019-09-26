<?php

declare(strict_types = 1);

namespace App\Loggers;

use App\Core\Actions\iAction;
use App\Players\iPlayer;

/**
 * Class Console
 *
 * @package App\Loggers
 */
class Console implements iLogger
{

    /** @var string help variable for separate info */
    protected $separator = "-------------------------------------\r\n";

    /**
     * Output all players and HP
     * format:
     * [PLAYER_NAME] - [HP_VALUE] HP
     * [SEPARATOR]
     *
     * @param array $players
     * @param int   $turnsCount
     */
    public function outputPlayers(array $players, int $turnsCount): void
    {
        foreach ($players as $player) {
            /** @var iPlayer $player */
            echo "{$player->getName()} - {$player->getHealth()} HP \r\n";
        }

        echo $this->separator;
    }

    /**
     * Output current turn.
     * format:
     * [PLAYER_NAME] => [ACTION_NAME] ([DAMAGE/HEALING_VALUE] HP) => [PLAYER_NAME_TARGET]
     * [SEPARATOR]
     *
     * @param iPlayer $player
     * @param iAction $action
     * @param int     $turnsCount
     */
    public function outputTurn(iPlayer $player, iAction $action, int $turnsCount): void
    {
        $healthPoints = $this->formatHealthPoints($action->getHealthPoins());

        echo "{$player->getName()} => {$action->getActionName()} ({$healthPoints} HP) => {$action->getTarget()->getName()}\r\n";

        echo $this->separator;
    }

    /**
     * Output killed player
     * format:
     * [PLAYER_NAME] was killed
     * [SEPARATOR]
     *
     * @param iPlayer $player
     * @param int     $turnsCount
     */
    public function outputPlayerKilled(iPlayer $player, int $turnsCount): void
    {
        echo "{$player->getName()} was killed\r\n";
        echo $this->separator;
    }

    /**
     * Output winner
     * format:
     * Winner: [PLAYER_NAME] (HP_VALUE HP)
     * Game is Finished.
     *
     * @param iPlayer $player
     * @param int     $turnsCount
     */
    public function outputWinner(iPlayer $player, int $turnsCount): void
    {
        echo "Winner: {$player->getName()} ({$player->getHealth()} HP) \r\n";
        echo "Game is Finished.\r\n";
    }

    /**
     * Add "+" char if this is healing action
     *
     * @param int $points
     *
     * @return string
     */
    protected function formatHealthPoints(int $points): string
    {
        return  $points > 0 ? "+{$points}" : (string)$points;
    }

}