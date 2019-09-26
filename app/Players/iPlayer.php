<?php

declare(strict_types=1);

namespace App\Players;

use App\Core\Actions\iAction;
use App\Core\PlayerManager\iPlayerManager;

/**
 * Interface iPlayer
 *
 * @package App\Players
 */
interface iPlayer
{
    /**
     * @return string name of player
     */
    public function getName(): string;

    /**
     * @return int current health of player
     */
    public function getHealth(): int;

    /**
     * Store health level of player
     *
     * @param int $health
     */
    public function setHealth(int $health): void;

    /**
     * Get iAction interface for attack/health
     * we have PlayerManager so we can choose which one we want attack
     *
     * @param iPlayerManager $playerManager
     *
     * @return iAction
     */
    public function getAction(iPlayerManager $playerManager): iAction;

}