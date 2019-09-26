<?php

declare(strict_types=1);

namespace App\Core\Actions;

use App\Players\iPlayer;

/**
 * Class BaseAction
 *
 * @package App\Core\Actions
 */
class BaseAction implements iAction
{
    /** @var iPlayer|null action target player  */
    protected $target = null;

    /** @var int value of damage or healing */
    protected $healthPoint = 0;

    /** @var string|null name of action */
    protected $actionName = null;

    /**
     * BaseAction constructor.
     *
     * @param string  $actionName name of action
     * @param iPlayer $target target player for action
     * @param int     $healthPoint value of damage or healing
     */
    public function __construct(string $actionName, iPlayer $target, int $healthPoint)
    {
        $this->actionName = $actionName;
        $this->target = $target;
        $this->healthPoint = $healthPoint;
    }

    /**
     * Get name of action
     *
     * @return string
     */
    public function getActionName(): string
    {
        return $this->actionName;
    }

    /**
     * Get action target player
     *
     * @return iPlayer
     */
    public function getTarget(): iPlayer
    {
        return $this->target;
    }

    /**
     * Get value of damage or healing
     *
     * @return int
     */
    public function getHealthPoins(): int
    {
        return $this->healthPoint;
    }

    /**
     * Apply action for target player
     *
     * @return bool is target player live
     */
    public function applyAction(): bool
    {
        $totalHealth = $this->target->getHealth();

        $totalHealth += $this->healthPoint;

        $this->target->setHealth($totalHealth);

        return $totalHealth > 0;
    }

}