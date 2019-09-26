<?php

declare(strict_types = 1);

namespace App\Core;

use App\Core\Actions\iAction;
use App\Core\PlayerManager\iPlayerManager;
use App\Loggers\iLogger;
use App\Players\iPlayer;

/**
 * Class Game
 *
 * @package App\Core
 */
class Game
{

    /** @var null|iLogger class for output information */
    protected $logger = null;

    /** @var iPlayerManager */
    protected $playerManager = null;

    /**
     * Game constructor.
     *
     * @param iPlayerManager $playerManager class(implemented iPlayerManager interface) which store players and mange the turn
     * @param iLogger|null   $logger class(implemented iLogger interface) for output information
     *
     * @throws \Exception
     */
    public function __construct(iPlayerManager $playerManager, ?iLogger $logger)
    {
        $this->logger = $logger;
        $this->playerManager = $playerManager;
    }

    /**
     * Run the game
     */
    public function run(): void
    {
        $turnsCount = 0;

        if ($this->logger) {
            //output stats of player before first turn
            $this->logger->outputPlayers($this->playerManager->getAllPlayers(), $turnsCount);
        }

        do {
            /** @var iPlayer $player */
            $player = $this->playerManager->getNextPlayer();

            /** @var iAction $action */
            $action = $player->getAction($this->playerManager);

            $isLive = $action->applyAction();
            $turnsCount++;

            if ($this->logger) {
                $this->logger->outputTurn($player, $action, $turnsCount);
            }

            if (!$isLive) {
                if ($this->logger) {
                    $this->logger->outputPlayerKilled($action->getTarget(), $turnsCount);
                }
            }

            $playersCount = count($this->playerManager->getAllActivePlayers());

            if ($this->logger && $playersCount > 1) {
                $this->logger->outputPlayers($this->playerManager->getAllActivePlayers(), $turnsCount);
            }

        } while($playersCount > 1);

        if ($this->logger) {
            $winner = $this->playerManager->getNextPlayer();
            $this->logger->outputWinner($winner, $turnsCount);
        }
    }

}
