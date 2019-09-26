<?php

declare(strict_types=1);

namespace App\Players;

use function number_between;

/**
 * Class AiPlayer
 *
 * @package App\Players
 */
class AiPlayer extends BasePlayer
{
    /** @var int $minHPPercentage when health less than this percentage AI increase chance of healing */
    protected $minHPPercentage = 0;

    /** @var array $allActionsWithAdditionalHealing actions if health less than minHPPercentage */
    protected $allActionsWithAdditionalHealing;

    /**
     * AiPlayer constructor.
     *
     * @param string $name unique name of player
     * @param int    $minHPPercentage when health less than this percentage AI increase chance of healing
     * @param int    $health HP points of player
     */
    public function __construct(string $name, int $minHPPercentage, int $health = 100)
    {
        //check and correct percentage should be more or equal 0% and less or equal 100%
        $this->minHPPercentage = number_between($minHPPercentage, 0, 100);

        $this->allActionsWithAdditionalHealing = $this->allActions;
        $this->allActionsWithAdditionalHealing[] = 'healing';
        $this->allActionsWithAdditionalHealing[] = 'healing';

        parent::__construct($name, $health);
    }

    /**
     * Store new amount of health and check if HP less than $minHPPercentage add chance of healing
     *
     * @param int $health
     */
    public function setHealth(int $health): void
    {
        $healthLevel = $this->maxHealth * $this->minHPPercentage / 100;

        if ($health <= $healthLevel) {
            $this->allActions = $this->allActionsWithAdditionalHealing;
        } else {
            //if HP more than $minHPPercentage remove duplicate of 'healing'
            $this->allActions = array_unique($this->allActions);
        }

        parent::setHealth($health);
    }

}