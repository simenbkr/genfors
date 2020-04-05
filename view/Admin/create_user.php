<?php

require_once '../view/Static/top.php';

?>

<div class="container">
    <div class="col-lg-12">

        <hr>

        <h1>Opprett bruker</h1>

        <hr>

        <?php require_once '../view/Static/feedback.php'; ?>

        <form action="?a=admin/add_user" method="post">

            <table class="table table-responsive">

                <div class="form-group">
                    <label for="username" class="text-info">Brukernavn:</label><br>
                    <input type="text" name="username" id="username" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password" class="text-info">Passord:</label><br>
                    <input type="password" name="password" id="password" class="form-control">
                </div>

                <div class="form-group">
                    <label for="password2" class="text-info">Passord:</label><br>
                    <input type="password" name="password2" id="password2" class="form-control">
                </div>

                <div class="form-group">
                    <input type="submit" name="submit" class="btn btn-info btn-md" value="Opprett bruker">
                </div>


            </table>


        </form>

    </div>


</div>
