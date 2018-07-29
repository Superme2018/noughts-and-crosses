<h3> Noughts and Crosses (A laravel package)</h3>

<p>
  This is a package creation test, it contains some logic that mimics a simple "Nought and Crosses" game.
</p>

<p>

Use, composer require superme2018/noughts-and-crosses to add to yur project.

</p>

<p>

use SuperMe2018\NoughtsAndCrosses\NoughtsAndCrosses;

$playerMove = ["playerId" => 1, "moveId" => 4];

$noughtsAndCrosses = new NoughtsAndCrosses();
return $noughtsAndCrosses->makeMove($playerMove);

</p>

  
