
<h3>Who will play?</h3>


<?php echo form_open('tic-tac-toe/begin'); ?>


    <?php echo form_label('Player 1', 'player1') ?>
    <br />
    <?php /*echo form_input('player1', $player1)*/ ?>
    <?php echo form_input(array(
            'name' => 'player1',
            'value' => set_value('player1', ''),
            'id' => 'player1',
    )) ?>

    <br />
    <br />
    <br />

    <?php echo form_label('Player 2', 'player2') ?>
    <br />
    <?php echo form_input(array(
            'name' => 'player2',
            'value' => set_value('player2', ''),
            'id' => 'player2',
    )) ?>

    <br />
    <br />
    <br />

    <?php echo form_submit('submit', 'Play!') ?>

<?php echo form_close() ?>
