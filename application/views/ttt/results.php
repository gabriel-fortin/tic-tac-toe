
<div class="container">
    <h2 class="text-center">Results</h2>
    <?php
        if (empty($all_games))
        {
            $a = anchor('tic-tac-toe/play/' . $challenge_string, 'playing');
            echo 'You have no results yet. Go to ' . $a;
        }
        else
        {
            $a = anchor('tic-tac-toe/play/'.$challenge_string, 'playing');
            echo '<div> Go back to ' . $a . '</div>';
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
