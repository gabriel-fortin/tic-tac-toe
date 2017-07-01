

<div class="container-fluid"
>
    container begin

    <div class="row">
        <!-- Play board -->
        <div class="play-section
                    col-xs-12
                    col-sm-offset-0 col-sm-8
                    col-md-offset-1 col-md-7
                    col-lg-offset-1 col-lg-6">
            <h2>Play</h2>
            <?php
                $this->load->view('ttt/board');
            ?>
        </div>

        <!-- Recent boards -->
        <div class="recent-section
                    col-xs-offset-1 col-xs-10
                    col-sm-offset-1 col-sm-3
                    col-md-offset-2 col-md-2
                    col-lg-offset-3 col-lg-2">
            <h3>Recent games</h3>
            <?php
                foreach ($recent_games as $game)
                {
                    $this->load->view('ttt/board', ['board_state' => $game]);
                }
            ?>
            <div>
                see all games →
            </div>
        </div>

    </div>

    container end


</div>
