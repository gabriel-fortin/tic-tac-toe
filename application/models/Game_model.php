<?php

const RECENT_GAMES_LIMIT = 5;

class Game_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    /**
     * Adds a game's result to the selected challenge. The game's result should
     * be a string of 9 characters, each describing one cell of the board
     * (beginning with cells for the first row, then the second, …)
     * @param $challenge_id int id of the challenge the game is part of
     * @param $board_string string a string describing the board
     * @return bool the result of the DB operation
     */
    public function add_game($challenge_id, $board_string)
    {
        $data = array(
            'challenge_id' => $challenge_id,
            'board_state' => $board_string,
            'timestamp' => time(),
        );
        return $this->db->insert('game', $data);
    }

    /**
     * Returns an array of board states for a few recent games.
     * @param $challenge_id int id of the challenge for which to grab data
     * @return array an array of strings representing a board's state
     */
    public function get_recent_games($challenge_id)
    {
        $query = $this->db->query(
            'SELECT board_state
                FROM game
                WHERE challenge_id='.$challenge_id.'
                ORDER BY timestamp DESC
                LIMIT '.RECENT_GAMES_LIMIT);

        // extract strings from query
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
