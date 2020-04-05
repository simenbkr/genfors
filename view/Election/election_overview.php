<?php

require_once '../view/Static/top.php';

?>

<div class="container">
    <hr>
    <div class="col-lg-12">
    <h3>Valg</h3>

        <?php if(count($elections) == 0) { ?>

            <h3>Det er foreløpig ingen aktive valg.</h3>
            <p>Oppdater siden når det er klart!</p>
        <?php
        } else {
            foreach ($elections as $election) { ?>


            <?php }
        }?>
    </div>
</div>