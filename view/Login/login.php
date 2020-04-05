<?php

$show_menu = false;
require_once '../view/Static/top.php';

?>
    <style>
        #img_logo {
            max-height: 100px;
            max-width: 100px;
        }

        .center-block {
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .vertical-center {
            min-height: 100%;  /* Fallback for browsers do NOT support vh unit */
            min-height: 100vh; /* These two lines are counted as one :-)       */

            display: flex;
            align-items: center;
        }

    </style>

    <div class="jumbotron vertical-center">
        <div class="container-fluid">
            <div id="login">
                <h3 class="text-center">Genfors</h3>
                <div class="container">
                    <div id="login-row" class="row justify-content-center align-items-center">
                        <div id="login-column" class="col-md-6">
                            <div id="login-box" class="col-md-12">
                                <form id="login-form" class="form" action="?a=login" method="post">
                                    <h3 class="text-center text-info">Logg inn</h3>
                                    <div class="form-group">
                                        <label for="username" class="text-info">Brukernavn:</label><br>
                                        <input type="text" name="username" id="username" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="text-info">Passord:</label><br>
                                        <input type="password" name="password" id="password" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" name="submit" class="btn btn-info btn-md" value="Logg inn">
                                    </div>
                                </form>
                                <img class="center-block" id="img_logo" src="https://intern.singsaker.no/dgs_logo.png"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php

require_once '../view/Static/bottom.php';

?>