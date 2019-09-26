<?php

declare(strict_types = 1);

namespace App\Loggers;

use App\Core\Actions\iAction;
use App\Players\iPlayer;

/**
 * Interface iLogger
 *
 * @package App\Loggers
 */
interface iLogger
{
    /**
     * Method for output all players. Fire before first turn and after each turn of the game
     *
     * @param array $players all players pull
     * @param int   $turnsCount count of turns for now
     */
    public function outputPlayers(array $players, int $turnsCount): void;

    /**
     * Method for output info about current turn. Fire for each turn
     *
     * @param iPlayer $player active player
     * @param iAction $action action which player doing
     * @param int     $turnsCount count of turns for now
     */
    public function outputTurn(iPlayer $player, iAction $action, int $turnsCount): void;

    /**
     * Method for output info about player was killed.
     *
     * @param iPlayer $player player which was killed
     * @param int     $turnsCount count of turns for now
     */
    public function outputPlayerKilled(iPlayer $player, int $turnsCount): void;

    /**
     * Method for output winner. Fire at the end of game
     *
     * @param iPlayer $player winner
     * @param int     $turnsCount count of turns
     */
    public function outputWinner(iPlayer $player, int $turnsCount): void;

}