<h3> Noughts and Crosses (A laravel package)</h3>

<p>
  This is a package creation test, it contains some logic that mimics a simple "Nought and Crosses" game.
</p>

<p>

Use, composer require superme2018/noughts-and-crosses to add to yur project.

</p>

<p>

// Namescae to import into controller and or class:
use SuperMe2018\NoughtsAndCrosses\NoughtsAndCrosses;

// Player move array format (can take player 1 or player 2)
$playerMove = ["playerId" => 1, "moveId" => 4];

// Instance and usage.
$noughtsAndCrosses = new NoughtsAndCrosses();
return $noughtsAndCrosses->makeMove($playerMove);

</p>

  
