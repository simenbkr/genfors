<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>Genfors</title>
    <link rel="icon"
          type="image/png"
          href="https://intern.singsaker.no/dgs_logo.png">
</head>
<body>

<link rel="stylesheet" href="css/bootstrap.min.css"
      integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<script src="js/jquery-3.4.1.min.js"></script>

<script src="js/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>

<?php

if ($show_menu) { ?>
    <?php /*
    <div class="container">
        <div class="navbar navbar-default">
            <nav class="navbar navbar-expand-lg ">
                <a class="navbar-brand" href="#">
                    <img src="https://intern.singsaker.no/dgs_logo.png" width="30" height="30"
                         class="d-inline-block align-top" alt="">
                    DGS
                </a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="?a=vote">Valg</a>
                        </li>
                        <?php if ($is_admin) { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="?a=admin/new_election">Nytt valg</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="?a=admin/manage_elections">Administrer valg</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="?a=admin/add_user">Ny bruker</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="?a=admin/view_users">Administrer brukere</a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </nav>
        </div>
    </div>*/ ?>

    <div class="container">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">
                <img src="https://intern.singsaker.no/dgs_logo.png" width="30" height="30"
                     class="d-inline-block align-top" alt="">
                DGS
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                    aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link" href="?a=vote">Valg</a>
                    <?php if ($is_admin) { ?>
                        <a class="nav-item nav-link" href="?a=admin/new_election">Nytt valg</a>
                        <a class="nav-item nav-link" href="?a=admin/election_overview">Administrer valg</a>
                        <a class="nav-item nav-link" href="?a=admin/add_user">Ny bruker</a>
                        <a class="nav-item nav-link" href="?a=admin/user_overview">Administrer brukere</a>
                        <a class="nav-item nav-link" href="?a=admin/mass_add_users">Legg til mange brukere</a>
                    <?php } ?>
                    <a class="nav-item nav-link" href="?a=login/logout">Logg ut</a>
                </div>
            </div>
        </nav>
    </div>
<?php } ?>
