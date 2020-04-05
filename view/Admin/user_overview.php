<?php

require_once '../view/Static/top.php';

?>
<div class="container">
    <hr>
    <div class="col-lg-8">
        <h3>Valg</h3>


        <table class="table table-responsive">

            <thead>
            <tr>
                <th>Brukernavn</th>
                <th>Status</th>
                <th></th>
            </tr>
            </thead>

            <tbody>
            <?php foreach ($users as $user) {
                /* @var \genfors\User $user */ ?>
                <tr>
                    <td><?php echo $user->getUsername(); ?></td>
                    <td><?php echo $user->isActive() ? 'Aktiv' : 'Inaktiv'; ?></td>
                    <?php if ($user->isActive()) { ?>
                        <td>
                            <button class="btn btn-warning" onclick="deactivate(<?php echo $user->getId(); ?>)">
                                Deaktiver
                            </button>
                        </td>
                    <?php } else { ?>
                        <td>
                            <button class="btn btn-info" onclick="activate(<?php echo $user->getId(); ?>)">Aktiver
                            </button>
                        </td>
                    <?php } ?>
                </tr>

            <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="col-lg-2">
        <hr>
        <button class="btn btn-danger" onclick="deactivate_all()">Deaktiver alle</button>
        <hr>
        <button class="btn btn-warning" onclick="activate_all()">Aktiver alle</button>
    </div>

</div>

<script>
    function activate(id) {
        $.ajax({
            type: 'POST',
            url: '?a=admin/activate_user',
            method: 'POST',
            data: 'id=' + id,
            success: function (data) {
                window.location.reload();
            },
            error: function (req, stat, err) {
                alert(err);
            }
        });
    }

    function deactivate(id) {
        $.ajax({
            type: 'POST',
            url: '?a=admin/deactivate_user',
            method: 'POST',
            data: 'id=' + id,
            success: function (data) {
                window.location.reload();
            },
            error: function (req, stat, err) {
                alert(err);
            }
        });
    }

    function deactivate_all() {
        $.ajax({
            type: 'POST',
            url: '?a=admin/deactivate_all_users',
            method: 'POST',
            success: function (data) {
                window.location.reload();
            },
            error: function (req, stat, err) {
                alert(err);
            }
        });
    }

    function activate_all() {
        $.ajax({
            type: 'POST',
            url: '?a=admin/activate_all_users',
            method: 'POST',
            success: function (data) {
                window.location.reload();
            },
            error: function (req, stat, err) {
                alert(err);
            }
        });
    }


</script>