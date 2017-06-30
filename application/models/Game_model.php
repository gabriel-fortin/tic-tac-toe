<?php

const RECENT_GAMES_LIMIT = 5;

class Game_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function add_game($challenge_id, $board_string)
    {
        $data = array(
            'challenge_id' => $challenge_id,
            'board_state' => $board_string,
            'timestamp' => time(),
        );
        return $this->db->insert('game', $data);
    }

    public function get_recent_games($challenge_id)
    {
        $query = $this->db->query(
            'SELECT board_state
                FROM game
                WHERE challenge_id='.$challenge_id.'
                ORDER BY timestamp DESC
                LIMIT '.RECENT_GAMES_LIMIT);

        $board_strings = array();
        foreach ($query->result() as $row)
        {
            $board_strings[] = $row->board_state;
        }

        return $board_strings;
    }

}

/*

CREATE TABLE game (
    challenge_id int,
    board_state varchar(9) NOT NULL,
    timestamp date NOT NULL,
    FOREIGN KEY(challenge_id)
        REFERENCES challenge(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

-- Assuming that MANY people will play FEW games
-- using only the index on the primary key seems the most appropriate.
--CREATE INDEX game_time ON game(timestamp);

 */
