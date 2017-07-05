
<div class="container">
    <span style="margin: 10px;">
        Go back to <?php echo anchor('tic-tac-toe/play/'.$challenge_string, 'playing'); ?>
    </span>

    <?php
        if (empty($all_games))
        {
            echo 'You have no results yet.';
            echo 'Go to ' . anchor('time-tac-toe/play/' . $challenge_string, 'play');
        }
    ?>
    <div class="row">
        <?php foreach ($all_games as $game): ?>
            <div class="board-in-results col-xs-6 col-sm-4 col-md-3">
                <?php $this->load->view('ttt/board', ['board_state' => $game, 'clickable' => FALSE]); ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>
