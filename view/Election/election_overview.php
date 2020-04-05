<?php

require_once '../view/Static/top.php';

?>

<div class="container">
    <hr>
    <div class="col-lg-12">
        <h3>Valg</h3>


        <?php require_once '../view/Static/feedback.php'; ?>

        <?php if (count($elections) == 0) { ?>

            <h3>Det er foreløpig ingen aktive valg.</h3>
            <p>Oppdater siden når det er klart!</p>
            <?php
        } else {
            foreach ($elections as $election) {
                /* @var \genfors\Election $election */
                ?>
                <table class="table table-responsive">

                    <tr>
                        <th>Tittel</th>
                        <td>
                            <a href="?a=vote/election/<?php echo $election->getId(); ?>"><?php echo $election->getTitle(); ?></a>
                        </td>
                    </tr>
                    <tr>
                        <th>Beskrivelse:</th>
                        <td><?php echo $election->getDescription(); ?></td>
                    </tr>

                    <?php if ($election->isActive()) { ?>

                        <?php foreach ($election->getAlternatives() as $alternative) {
                            /* @var \genfors\Alternative $alternative */ ?>

                            <tr>
                                <th><?php echo $alternative->getName(); ?></th>
                                <td>
                                    <?php if (!$election->hasVoted($user)) { ?>

                                        <button class="btn btn-danger"
                                                onclick="vote(<?php echo $election->getId(); ?>,<?php echo $alternative->getId(); ?>)">
                                            Stem
                                        </button>
                                    <?php } else { ?>
                                        <button class="btn btn-danger disabled">Stem</button>
                                        <small>Du har allerede avgitt stemme.</small>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php }
                    } ?>
                </table>
                <hr>
            <?php }
        } ?>
    </div>
</div>


<script>

    function vote(election_id, alternative_id) {
        $.ajax({
            type: 'POST',
            url: '?a=vote/vote',
            method: 'POST',
            data: 'election_id=' + election_id + '&alternative_id=' + alternative_id,
            success: function (data) {
                window.location.reload();
            },
            error: function (req, stat, err) {
                alert(err);
            }
        });
    }

</script>