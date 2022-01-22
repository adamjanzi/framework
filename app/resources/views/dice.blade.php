<header class="row">
    @include('header')
</header>
<?php

$header = $header ?? null;
$message = $message ?? null;
$action = $action ?? null;
$numberOfFaces = $numberOfFaces ?? null;
$numberOfDice = $numberOfDice ?? null;
$diceHandRoll = $diceHandRoll ?? null;
$diceHandClass = $diceHandClass ?? null;

?><h1><?= $header ?></h1>

<p><?= $message ?></p>

<form method="post" action="<?= $action ?>">
@csrf
    <p>Select the number of faces:</p>    
    <p>
        <input type="radio" name="content" value="4" <?php if ($numberOfFaces == 4) {
            echo 'checked="checked"';
                                                     }
                                                        ?>>4
        <input type="radio" name="content" value="6" <?php if ($numberOfFaces == 6 || $numberOfFaces == null) {
            echo 'checked="checked"';
                                                     }
                                                        ?>>6
    </p>
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
        <input type="submit" value="Press to play">
    </p>

</form>

<p><?= $diceHandRoll ?></p>


<p class="dice-utf8">
    <?= $diceHandClass ?>
</p>