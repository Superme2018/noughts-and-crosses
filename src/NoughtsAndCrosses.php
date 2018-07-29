<?php

namespace SuperMe2018\NoughtsAndCrosses;

// Helpers
use SuperMe2018\NoughtsAndCrosses\Helpers\PlayerHelper;

// Framework (not sure if this makes it a Laravel specific package).
use Storage;

class NoughtsAndCrosses
{

    // Thinking these two could be moved to .env
    protected $movesFileName = "playerMoves.txt";
    protected $diskName = "local";

    protected $playerMoves;
    protected $winningCombos;

    protected $playerHelper;

    public function __construct(){

        // Define Helpers
        $this->playerHelper = new PlayerHelper();

        // Set Winning combos
        $this->winningCombos =
		[
			[1,2,3],
			[4,5,6],
			[7,8,9],
			[1,4,7],
			[2,5,8],
			[3,6,9],
			[1,5,9],
			[3,5,7],
		];

    }

    public function makeMove($moveData)
    {
        return $this->setBox($moveData->toArray());
    }

    private function setBox(array $moveData)
    {

        // Create the first move if the file $this->movesFileName does not exist.
        if(!Storage::disk($this->diskName)->exists($this->movesFileName)){
            Storage::disk($this->diskName)->put($this->movesFileName, collect([$moveData]));
            return Storage::disk($this->diskName)->get($this->movesFileName);
        }

        // Get and Set the player moves form storage.
        $this->playerMoves = json_decode(Storage::disk($this->diskName)->get($this->movesFileName));

        // First check if we have a winning player.
        if($winningPlayer = $this->checkForWinner()){
            $this->resetMoves();
            return "We have a winner, player {$winningPlayer} is the winner.";
        }

        // Second check to see if the move has already been made.
        if($this->checkDuplicateMove($moveData))
            return "This move has already been made.";

        // Third check to detect if the last move made, was made by the same player.
        if($this->checkPlayerMove((int)$moveData["playerId"])) //<- Really no need for the collect, it's just to keep things consistent.
            return "Next player please.";

        // Add the new move to the $this->movesFileName.
        $newMoves = json_decode(Storage::disk($this->diskName)->get($this->movesFileName), true);
        $newMoves = collect($newMoves)->push($moveData);

        Storage::disk($this->diskName)->put($this->movesFileName, $newMoves);
        return Storage::disk($this->diskName)->get($this->movesFileName);

    }

    private function checkPlayerMove(int $playerId){

        // Just a check incase we have no data to work with.
        if(!$this->playerMoves)
            return false;

        $lastPlayerMove = collect($this->playerMoves)->last();

        if((int)$lastPlayerMove->playerId === $playerId)
            return true;
        return false;

    }

    private function checkDuplicateMove(array $moveData){

        // Just a check incase we have no data to work with.
        if(!$this->playerMoves)
            return false;

       $playerMoves = collect($this->playerMoves);

       $filtered = $playerMoves->where("moveId", $moveData["moveId"]);
       $filtered->all();

       if(count($filtered))
            return true;
       return false;

    }

    private function checkForWinner(){

        // Just a check incase we have no data to work with.
        if(!$this->playerMoves)
            return false;

        $playerMoves = collect($this->playerMoves);

        $playerOnesMoves = $playerMoves->where("playerId", 1);
        $playerOnesMoves->all();

        $playerTwosMoves = $playerMoves->where("playerId", 2);
        $playerTwosMoves->all();

        // May be worth testing this, seems to work in odd ways sometimes.
        foreach($this->winningCombos as $winingCombo){

            if($winner = $this->playerHelper->winnerCheck(1, $playerOnesMoves->toArray(), $winingCombo))
                return $winner;

            if($winner = $this->playerHelper->winnerCheck(2, $playerTwosMoves->toArray(), $winingCombo))
                return $winner;

            return false;

        }

    }

    private function resetMoves(){
        // Clear out all the player moves.
        Storage::disk($this->diskName)->put($this->movesFileName, "");
    }

}
