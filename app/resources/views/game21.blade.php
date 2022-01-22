<header class="row">
    @include('header')
</header>
<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

use function App\Functions\url;

$header = $header ?? null;
$message = $message ?? null;
$action = $action ?? null;
$numberOfDice = $numberOfDice ?? null;
$totalScore = $totalScore ?? null;
$computerTotalScore = $computerTotalScore ?? null;
$url = url("/game21/destroy");
$diceHandRoll = $diceHandRoll ?? null;
$diceHandClass = $diceHandClass ?? null;
$diceHandRollSum = $diceHandRollSum ?? 0;
$scoreMessage = $scoreMessage ?? null;


?><h1><?= $header ?></h1>

<p><?= $message ?></p>


<form method="post" action="<?= $action ?>">
@csrf
    <p>Select the number of dice:</p>
    <p>
        <input type="radio" name="content1" value="1" <?php if ($numberOfDice == 1 || $numberOfDice == null) {
            echo 'checked="checked"';
                                                      }
                                                        ?>>1
        <input type="radio" name="content1" value="2" <?php if ($numberOfDice == 2) {
            echo 'checked="checked"';
                                                      }
                                                        ?>>2
    </p>

    <p>
        <input type="submit" value="Press to roll">
    </p>

</form>

<a href="game21computer">Hold</a>

<p>You have rolled: <?= $diceHandRoll ?></p>

<p class="dice-utf8">
    <?= $diceHandClass ?>
</p>

<p>Your total score: <?= $totalScore += $diceHandRollSum ?></p>

<p><?= $scoreMessage ?></p>

<hr>

<p>Your won rounds: <?= $_SESSION["roundScore"] ?></p>

<p>Computer won rounds: <?= $_SESSION["computerRoundScore"] ?></p>

<a href="<?= $url ?>">Reset</a>
