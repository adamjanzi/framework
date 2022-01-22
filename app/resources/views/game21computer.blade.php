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
$scoreMessage = $scoreMessage ?? null;
$url = url("/game21/destroy");


?><h1><?= $header ?></h1>


<p><?= $scoreMessage ?></p>

<p>Your score: <?= $_SESSION["totalScore"] ?></p>

<p>Computer score: <?= $_SESSION["computerTotalScore"] ?></p>

<hr>

<p>Your won rounds: <?= $_SESSION["roundScore"] ?></p>

<p>Computer won rounds: <?= $_SESSION["computerRoundScore"] ?></p>

<a href="game21computer/newround">New Round</a>

<a href="<?= $url ?>">Reset</a>
