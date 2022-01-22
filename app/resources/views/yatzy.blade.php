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
$url = url("/yatzy/destroy");
$lastroll0 = $lastroll0 ?? null;
$lastroll1 = $lastroll1 ?? null;
$lastroll2 = $lastroll2 ?? null;
$lastroll3 = $lastroll3 ?? null;
$lastroll4 = $lastroll4 ?? null;
$yatzyDiceHandRoll = $yatzyDiceHandRoll ?? null;
$diceHandClass = $diceHandClass ?? null;
$diceHandRollSum = $diceHandRollSum ?? null;
$yatzyDiceHandRollGraphic = $yatzyDiceHandRollGraphic ?? null;
$bonus = $bonus ?? null;
$yatzyTotalScore = $yatzyTotalScore ?? null;
$buttonValue = $buttonValue ?? null;
$checkboxStatus = $checkboxStatus ?? null;


?><h1><?= $header ?></h1>

<p>You have rolled <?= $_SESSION["rollQueue"] ?> of 3 rolls for <?= $_SESSION["scoreIndexMessage"] ?></p>
<p><?= $message ?></p>

<form method="post" action="<?= $action ?>">
@csrf
    <p>
        <p class="dice-utf8">
        <input type="checkbox" name="roll1" value="0" <?= $checkboxStatus ?>>
        <?= $yatzyDiceHandRoll[0] ?> <?= $yatzyDiceHandRollGraphic[0] ?></p>

        <p class="dice-utf8">
        <input type="checkbox" name="roll2" value="0" <?= $checkboxStatus ?>>
        <?= $yatzyDiceHandRoll[1] ?> <?= $yatzyDiceHandRollGraphic[1] ?></p>

        <p class="dice-utf8">
        <input type="checkbox" name="roll3" value="0" <?= $checkboxStatus ?>>
        <?= $yatzyDiceHandRoll[2] ?> <?= $yatzyDiceHandRollGraphic[2] ?></p>

        <p class="dice-utf8">
        <input type="checkbox" name="roll4" value="0" <?= $checkboxStatus ?>>
        <?= $yatzyDiceHandRoll[3] ?> <?= $yatzyDiceHandRollGraphic[3] ?></p>

        <p class="dice-utf8">
        <input type="checkbox" name="roll5" value="0" <?= $checkboxStatus ?>>
        <?= $yatzyDiceHandRoll[4] ?> <?= $yatzyDiceHandRollGraphic[4] ?></p>
    </p>

    <p>
        <input type="submit" value="<?= $buttonValue ?>">
        <a href="<?= $url ?>">Reset</a>
    </p>

    <p>_________</p>
    <p>Ones: <?= $_SESSION["yatzyScore"][0] ?></p>
    <p>Twos: <?= $_SESSION["yatzyScore"][1] ?></p>
    <p>Threes: <?= $_SESSION["yatzyScore"][2] ?></p>
    <p>Fours: <?= $_SESSION["yatzyScore"][3] ?></p>
    <p>Fives: <?= $_SESSION["yatzyScore"][4] ?></p>
    <p>Sixes: <?= $_SESSION["yatzyScore"][5] ?></p>
    <p>__________</p>
    <p>Sum: <?= $diceHandRollSum ?></p>
    <p>Bonus: <?= $bonus ?></p>
    <p>TOTAL: <?= $yatzyTotalScore ?></p>

</form>
