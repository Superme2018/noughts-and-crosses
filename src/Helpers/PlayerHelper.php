<?php

namespace SuperMe2018\NoughtsAndCrosses\Helpers;

class PlayerHelper {

     // Split this from checkForWinner(), to keep things clean.
     public function winnerCheck(int $playerId, array $playerMoves, array $winingCombo){

        $playerMoves = collect($playerMoves); //<- got to be a batter way than converting it. Maybe strongly type as collections somehow.

        $playerMoves->whereIn('moveId', $winingCombo);
        $playerMoves->all();

        if(count($playerMoves) == 3)
            return $playerId;

    }

}
