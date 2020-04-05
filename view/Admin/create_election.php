<?php

require_once '../view/Static/top.php';

?>

<div class="container">
    <div class="col-lg-12">

        <h1>Nytt valg</h1>

        <hr>

        <?php require_once '../view/Static/feedback.php'; ?>

        <div class="control-group" id="fields">
            <div class="controls">
                <form role="form" autocomplete="off" method="post" action="?a=admin/new_election">

                    <h3 class="text-center">Valg</h3>

                    <div class="form-group">
                        <input type="submit" name="submit" class="btn btn-primary btn-md" value="Opprett">
                    </div>

                    <div class="form-group">
                        <label for="title" class="text">Tittel:</label><br>
                        <input type="text" name="title" id="title" class="form-control" placeholder="*">
                    </div>

                    <div class="form-group">
                        <label for="description" class="text">Beskrivelse:</label><br>
                        <textarea id="description" name="description" class="form-control"></textarea>
                    </div>


                    <div class="form-group">
                        <label for="alternatives[]" class="text">Alternativer:</label>
                        <div class="entry input-group col-xs-3">
                            <input class="form-control" id="alternatives" name="alternatives[]" type="text" placeholder="Forslag"/>
                            <span class="input-group-btn">
                            <button class="btn btn-success btn-add" type="button">
                                <span class="glyphicon glyphicon-plus">+</span>
                            </button>
                        </span>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>


<script>
    $(function () {
        $(document).on('click', '.btn-add', function (e) {
            e.preventDefault();

            var controlForm = $('.controls form:first'),
                currentEntry = $(this).parents('.entry:first'),
                newEntry = $(currentEntry.clone()).appendTo(controlForm);

            newEntry.find('input').val('');
            controlForm.find('.entry:not(:last) .btn-add')
                .removeClass('btn-add').addClass('btn-remove')
                .removeClass('btn-success').addClass('btn-danger')
                .html('<span class="glyphicon glyphicon-minus">-</span>');
        }).on('click', '.btn-remove', function (e) {
            $(this).parents('.entry:first').remove();

            e.preventDefault();
            return false;
        });
    });
</script>