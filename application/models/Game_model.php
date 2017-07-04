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
     * @param $challenge_string string public id of the challenge the game is part of
     * @param $board_string string a string describing the board
     * @return bool the result of the DB operation
     */
    public function add_game($challenge_string, $board_string)
    {
        $data = array(
            'challenge_id' => $this->_challenge_id_for($challenge_string),
            'board_state' => $board_string,
        );
        return $this->db->insert('game', $data);
    }

    private function _challenge_id_for($challenge_string)
    {
        $sql = sprintf(
            "SELECT id
                FROM challenge
                WHERE string_id='%s'",
            $challenge_string);
        $query = $this->db->query($sql);
        return $query->row()->id;
    }

    /**
     * Returns an array of board states for a few recent games.
     * @param $challenge_string string public id of the challenge for which to grab data
     * @return array an array of strings representing a board's state
     */
    public function get_recent_games($challenge_string)
    {
        $sql = sprintf(
        "SELECT board_state
                FROM game
                WHERE challenge_id IN (
                      SELECT id
                      FROM challenge
                      WHERE string_id = '%s'
                )
                ORDER BY `timestamp` DESC
                LIMIT %d",
                $challenge_string,
                RECENT_GAMES_LIMIT);
        $query = $this->db->query($sql);

        // extract strings from query
        $board_strings = array();
        foreach ($query->result() as $row)
        {
            $board_strings[] = $row->board_state;
        }

        return $board_strings;
    }

    // I'm not taking care of removing unused 'game' entries because
    // it's irrelevant from a UX point of view.

}

/*

CREATE TABLE game (
    challenge_id int,
    board_state varchar(9) NOT NULL,
    timestamp timestamp NOT NULL,
    FOREIGN KEY(challenge_id)
        REFERENCES challenge(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

-- Assuming that MANY people will play FEW games
-- using only the index on the primary key seems the most appropriate.
--CREATE INDEX game_time ON game(timestamp);

 */
