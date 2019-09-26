<?php

declare(strict_types=1);

namespace App\Core\Actions;

use App\Players\iPlayer;

/**
 * Interface iAction
 *
 * @package App\Core\Actions
 */
interface iAction
{
    /**
     * iAction constructor.
     *
     * @param string  $actionName name of action
     * @param iPlayer $target target player for action
     * @param int     $healthPoint value of damage or healing
     */
    public function __construct(string $actionName, iPlayer $target, int $healthPoint);

    /**
     * Get name of action
     *
     * @return string
     */
    public function getActionName(): string;

    /**
     * Get action target player
     *
     * @return iPlayer
     */
    public function getTarget(): iPlayer;

    /**
     * Get value of damage or healing
     *
     * @return int
     */
    public function getHealthPoins(): int;

    /**
     * Apply action for target player
     *
     * @return bool is target player live
     */
    public function applyAction(): bool;

}