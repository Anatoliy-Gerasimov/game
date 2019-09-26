<?php

declare(strict_types = 1);

/**
 * Game Simulation cli app
 * @author Anatoliy Gerasimov <lightduelist@gmail.com>
 */

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Load all project classes by composer autoload
|
*/
require __DIR__.'/vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Create instance of Logger for display data to console
|--------------------------------------------------------------------------
*/
$logger = new \App\Loggers\Console();

/*
|--------------------------------------------------------------------------
| Create instance of PlayerManager
|--------------------------------------------------------------------------
|
|  - PlayerManager - class should implement iPlayerManager interface
|                    and store players and manage turns
|
*/
$playerManager = new App\Core\PlayerManager\BasePlayerManager();

/*
|--------------------------------------------------------------------------
| Create instance of players and add to the PlayerManager
|--------------------------------------------------------------------------
|
|  - Player - class should implement iPlayer interface
|
*/
$playerManager
    ->addPlayer(new \App\Players\BasePlayer('Player'))
    ->addPlayer(new \App\Players\AiPlayer('AI Player', 35));

/*
|--------------------------------------------------------------------------
| Create instance of game
|--------------------------------------------------------------------------
|
|  Parameters:
|  - PlayerManager - class should implement iPlayerManager interface.
|                    Store all players and choose which player should do action next
|  - Logger - class should implement iLogger interface and responsible for output information
|
*/
$game = new \App\Core\Game($playerManager, $logger);

/*
|--------------------------------------------------------------------------
| Let's start the game
|--------------------------------------------------------------------------
*/
$game->run();
