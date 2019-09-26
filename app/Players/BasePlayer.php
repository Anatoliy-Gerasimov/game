<?php

declare(strict_types=1);

namespace App\Players;

use App\Core\Actions\BaseAction;
use App\Core\Actions\iAction;
use App\Core\PlayerManager\iPlayerManager;
use function number_between;
use function mt_rand;
use function array_rand_value;
use function array_pop;

/**
 * Class BasePlayer
 *
 * @package App\Players
 */
class BasePlayer implements iPlayer
{
    /** @var int player health */
    protected $health;

    /** @var int player max health */
    protected $maxHealth;

    /** @var string Unique name of player */
    protected $name;

    /** @var array all available actions for player */
    protected $allActions = ['smallAttack', 'defaultAttack', 'healing'];

    /** @var array [min,max] damages for smallAttach */
    protected $smallAttack = [-25, -18];

    /** @var array [min,max] damages for defaultAttack */
    protected $defaultAttack = [-35, -10];

    /** @var array [min,max] HP points for healing */
    protected $healing = [18, 25];

    /**
     * BasePlayer constructor.
     *
     * @param string $name unique name of player
     * @param int    $health HP points of player
     */
    public function __construct(string $name, int $health = 100)
    {
        $this->name = $name;
        $this->health = $health;
        $this->maxHealth = $health;
    }

    /**
     * Get player name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get current health of player
     *
     * @return int
     */
    public function getHealth(): int
    {
        return $this->health;
    }

    /**
     * Store new amount of health, HP can't be less then 0 and more $maxHealth
     *
     * @param int $health
     */
    public function setHealth(int $health): void
    {
        $this->health = number_between($health, 0, $this->maxHealth);
    }

    /**
     * Get Action for attack/health
     *
     * @param iPlayerManager $playerManager
     *
     * @return iAction
     */
    public function getAction(iPlayerManager $playerManager): iAction
    {
        /**
         * @var string $action name of choose action
         * @var int    $value value of HP for attach or Health
         */
        [$action, $value] = $this->getRandomAction();

        if ($action === 'healing') {
            return new BaseAction($action, $this, $value);
        }

        /** @var array $allActivePlayers all active players show we can choose which one we will attack */
        $allActivePlayers = $playerManager->getAllActivePlayers();

        /** @var iPlayer $target player for attack */
        $target = $this->getAnotherPlayerForTarget($allActivePlayers);
        return new BaseAction($action, $target, $value);
    }

    /**
     * Generate random action name and points of HP by attack/health specification
     *
     * @return array [action name, random point of HP]
     */
    protected function getRandomAction(): array
    {
        $action = array_rand_value($this->allActions);

        //get parameters for randomize attach/health level
        $actionValues = $this->{$action};
        $randValue = mt_rand($actionValues[0], $actionValues[1]);

        return  [$action, $randValue];
    }

    /**
     * Get Target for attack and can't attack himself.
     *
     * @param array $players
     * @return iPlayer
     */
    protected function getAnotherPlayerForTarget(array $players): iPlayer
    {
        unset($players[$this->getName()]);
        return array_pop($players);
    }
}