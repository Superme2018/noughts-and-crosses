<h3> Noughts and Crosses (A laravel package)</h3>

<p>
  This is a package creation test, it contains some logic that mimics a simple "Noughts and Crosses" game.
</p>

<p>

Use, <strong>composer require superme2018/noughts-and-crosses</strong> to add to your project.

</p>

<p>

// <strong>Namespace to import into controller and or class:</strong> <br>
use SuperMe2018\NoughtsAndCrosses\NoughtsAndCrosses;

// <strong>Player move array format (can take player 1 or player 2)</strong> <br>
$playerMove = ["playerId" => 1, "moveId" => 4];

// <strong>Instance and usage.</strong><br>
$noughtsAndCrosses = new NoughtsAndCrosses();<br>
return $noughtsAndCrosses->makeMove($playerMove);

or  

(new NoughtsAndCrosses)->makeMove(($playerMove);  

</p>

  
