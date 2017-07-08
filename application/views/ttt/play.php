

<div class="container" >

    <div class="row">
        <!-- Play board -->
        <div class="play-section
                    col-xs-12
                    col-sm-offset-0 col-sm-8">
            <h2>Play</h2>
            <?php
                $this->load->view('ttt/board', ['clickable' => TRUE]);
            ?>
        </div>

        <!-- Recent boards -->
        <div class="recent-section
                    col-xs-offset-2 col-xs-8
                    col-sm-offset-1 col-sm-3">
            <h3>Recent games</h3>
            <?php
                foreach ($recent_games as $game)
                {
                    $this->load->view('ttt/board', ['board_state' => $game, 'clickable' => FALSE]);
                }
            ?>
            <div>
                see all games →
            </div>
        </div>

    </div>

</div>
