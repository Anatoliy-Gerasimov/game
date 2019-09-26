<?php

declare(strict_types=1);

namespace App\Core\PlayerManager;

use App\Players\iPlayer;

/**
 * Interface iPlayerManager
 *
 * @package App\Core\PlayerManager
 */
interface iPlayerManager
{
    /**
     * Add player to the game with unique name
     *
     * @param iPlayer $player
     *
     * @return $this
     */
    public function addPlayer(iPlayer $player);

    /**
     * Return list of all players
     *
     * @return array
     */
    public function getAllPlayers(): array;

    /**
     * Return list of all players which is live
     *
     * @return array
     */
    public function getAllActivePlayers(): array;

    /**
     * Get player for next turn can depend on previous player
     *
     * @return iPlayer
     */
    public function getNextPlayer(): iPlayer;
}