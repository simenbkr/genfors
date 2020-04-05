<?php

require_once '../view/Static/top.php';

?>
<div class="container">

    <hr>
    <div class="col-lg-12">

        <h1>Administrer valg</h1>

        <hr>
        <?php foreach ($elections as $election) {
            /* @var \genfors\Election $election */
            ?>
            <table class="table table-responsive">

                <tr>
                    <th>Tittel</th>
                    <td><a href="?a=admin/manage_election/<?php echo $election->getId(); ?>"><?php echo $election->getTitle(); ?></a></td>
                </tr>
                <tr>
                    <th>Beskrivelse:</th>
                    <td><?php echo $election->getDescription(); ?></td>
                </tr>
                <tr>
                    <th>Status:</th>
                    <td><?php echo $election->isActive() ? 'Aktiv' : 'Inaktiv'; ?></td>
                </tr>

                <tr>
                    <th>Stemmefordeling:</th>
                    <td><?php echo $election->getVoteBreakdownString(); ?></td>
                </tr>

                <?php if($election->isActive()) { ?>
                <tr>
                    <th></th>
                    <th><button class="btn btn-warning" onclick="deactivate(<?php echo $election->getId(); ?>)">Deaktiver</button></th>
                </tr>
                <?php } else { ?>
                    <tr>
                        <th></th>
                        <th><button class="btn btn-success" onclick="activate(<?php echo $election->getId(); ?>)">Aktiver</button></th>
                    </tr>

                <?php } ?>

            </table>
            <hr>
        <?php }
          ?>


    </div>
</div>

<script>
    function activate(id) {
        $.ajax({
            type: 'POST',
            url: '?a=admin/activate_election',
            method: 'POST',
            data: 'election_id=' + id,
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
            url: '?a=admin/end_election',
            method: 'POST',
            data: 'election_id=' + id,
            success: function (data) {
                window.location.reload();
            },
            error: function (req, stat, err) {
                alert(err);
            }
        });
    }


</script>