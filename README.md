### Task:
![task](task.png?raw=true)

### Running script by docker 
```shell script
$ docker-composer up
```

### Running script by php
```shell script
$ composer dump-autoload
$ php run.php
```

### Project terms
```text
Player        - Class which implements iPlayer interface and provide functionality for manage health and choose action for turn
PlayerManager - Class which implements iPlayerManager interface. Store players and choose which player will be next do action
Action        - Class which implements iAction interface and responsible for store and apply action
Logger        - Class which implements iLogger interface and responsible for output information 
```

### Implemented Classes
Players:
```text
* BasePlayer - default player
* AiPlayer - extended player which increase chance of healing when health less than minimal level
```

PlayerManager:
```text
* BasePlayerManager - store players and return random player for next turn
```

Action:
```text
* BaseAction - just store information about player current action and apply for target player 
```

Logger
```text
* Console - logger which output all information to the console
```
