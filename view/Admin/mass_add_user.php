<?php

require_once '../view/Static/top.php';

?>
<div class="container">
    <div class="col-lg-12">

        <hr>
        <h1>Legg til mange brukere</h1>

        <hr>

        <?php require_once '../view/Static/feedback.php'; ?>

        <p>Legg til mange brukere. En e-postadresse per linje.</p>
        <p>Disse vil motta en e-post med (tilfeldig) brukernavn og passord.</p>

        <form method="post" action="?a=admin/mass_add_users">
            <div class="form-group">
                <label for="email-list" class="text-info">Eposter:</label><br>
                <textarea rows="10" class="form-control" name="email-list"></textarea>
            </div>

            <div class="form-group">
                <input type="submit" name="submit" class="btn btn-info btn-md" value="Legg til">
            </div>

        </form>

    </div>


</div>