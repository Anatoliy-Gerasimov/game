<?php

declare(strict_types=1);

namespace App\Core\PlayerManager;

use App\Players\iPlayer;
use const null;
use function array_filter;
use function array_rand_value;

/**
 * Class BasePlayerManager
 *
 * @package App\Core\PlayerManager
 */
class BasePlayerManager implements iPlayerManager
{
    /** @var array $players pull of players */
    protected $players = [];

    /** @var iPlayer $previousPlayer player which did last action */
    protected $previousPlayer = null;

    /**
     * Add player to the game with unique name
     *
     * @param iPlayer $player
     *
     * @return $this
     *
     * @throws \Exception
     */
    public function addPlayer(iPlayer $player)
    {
        if (isset($this->players[$player->getName()])) {
            throw new \Exception('Provide unique name of player.');
        }

        $this->players[$player->getName()] = $player;

        return $this;
    }

    /**
     * Return all players
     *
     * @return array
     */
    public function getAllPlayers(): array
    {
        return $this->players;
    }

    /**
     * Return list of all players which is live
     *
     * @return array
     */
    public function getAllActivePlayers(): array
    {
        return array_filter($this->players, function (iPlayer $player) {
            return $player->getHealth() > 0;
        });
    }

    /**
     * Get random player from player pull
     *
     * @return iPlayer
     */
    public function getNextPlayer(): iPlayer
    {
        $this->previousPlayer = array_rand_value($this->getAllActivePlayers());
        return $this->previousPlayer;
    }

}