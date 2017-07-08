

<div class="container" >

    <div class="row">
        <!-- Play board -->
        <div class="play-section
                    col-xs-12
                    col-sm-offset-0 col-sm-8">
            <h2>Play</h2>

            <div id="ai_info" class="text-center <?php echo ($ai===TRUE ? '' : 'invisible') ?>">
                playing versus AI
            </div>

            <div id="board_info">
                <span id="next_player_label">Next player:</span>
                <span id="winner_label">Winner:</span>
                <span class="next_player_symbol_and_name">
                    <img id="next_player_symbol" name="next_player_symbol" src="/assets/img/empty.svg" />
                    <span id="player_name_x" class="invisible"><?php echo $player1 ?></span>
                    <span id="player_name_o" class="invisible"><?php echo $player2 ?></span>
                </span>
            </div>

            <?php
                $this->load->view('ttt/board', ['clickable' => TRUE]);
            ?>

            <?php
                echo form_open('tic-tac-toe/submit',
                    ['class' => 'invisible'],
                    ['challenge_string' => $challenge_string]);
                echo form_input('board_state', '', ['id' => 'board_transcription']);
                echo form_submit('board_send', 'Board Submission');
                echo form_close();
            ?>

            <div class="text-center">
                Want to start a <?php echo anchor('tic-tac-toe/begin', 'new session') ?>?
            </div>

        </div>

        <!-- Recent boards -->
        <div class="recent-section
                    col-xs-offset-3 col-xs-6
                    col-sm-offset-1 col-sm-3">
            <h3>Recent games</h3>
            <?php
                foreach ($recent_games as $game)
                {
                    $this->load->view('ttt/board', ['board_state' => $game, 'clickable' => FALSE]);
                }
            ?>
            <div class="text-center">
                <?php
                    if (empty($recent_games))
                    {
                        echo 'no recent games';
                    }
                    else
                    {
                        echo anchor('tic-tac-toe/results/' . $challenge_string,
                            '&nbsp;&nbsp;&nbsp;see all games →');
                    }
                ?>
            </div>
        </div>

    </div>

</div>
