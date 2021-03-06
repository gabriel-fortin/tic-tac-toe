
<div class="container-fluid" style="max-width: 1000px">
<div class="col-xs-12 col-sm-offset-1 col-sm-10">

<h3>Who will play?</h3>

<?php echo form_open('tic-tac-toe/begin'); ?>

    <div class="form-group <?php if (element('player1', $validation_error_array) !== NULL) {echo 'has-error';} ?>">
        <?php echo form_label('Player 1', 'player1', ['class' => 'control-label']) ?>

        <br />

        <?php echo form_input(array(
                'name' => 'player1',
                'value' => set_value('player1', ''),
                'id' => 'player1',
                'class' => 'form-control',
                'placeholder' => 'enter name',
        )) ?>
    </div>

    <div class="form-group <?php if (element('player2', $validation_error_array) !== NULL) {echo 'has-error';} ?>">
        <?php echo form_label('Player 2', 'player2', ['class' => 'control-label']) ?>
        <br />

        <?php echo form_input(array(
                'name' => 'player2',
                'value' => set_value('player2', ''),
                'id' => 'player2',
                'class' => 'form-control',
                'placeholder' => 'enter name',
        )) ?>
    </div>

    <?php echo form_checkbox('ai', 'yes', FALSE, 'class="ai-checkbox"'); ?>
    <span>play versus AI</span>

    <div class="form-group">
        <?php echo form_submit('submit', 'Play!', ['class' => 'btn btn-primary']) ?>
    </div>

<?php echo form_close() ?>

</div>
</div>
