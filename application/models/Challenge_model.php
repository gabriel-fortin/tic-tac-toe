<?php

class Challenge_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    /**
     * Creates a challenge (a sequence of games) and returns its id.
     * @param $player1 string name of player
     * @param $player2 string name of player
     * @return string the externally available id of the created challenge
     */
    public function create_challenge($player1, $player2)
    {
        $challenge_string = random_string('md5');

        $data = array(
            'player1' => $player1,
            'player2' => $player2,
            'string_id' => $challenge_string,
        );

        // values are escaped automatically
        $this->db->insert('challenge', $data);

        return $challenge_string;
    }

    public function get_player_names($challenge_string)
    {
        $sql =
            'SELECT player1, player2
            FROM challenge
            WHERE string_id = ?';

        $query = $this->db->query($sql, [$challenge_string]);

        return $query->row_array();
    }

    /**
     * @param $string1 string one of potential challenge strings
     * @param $string2 string one of potential challenge strings
     * @return string valid challenge string or NULL
     */
    public function confirm_challenge_string($string1, $string2)
    {
        $sql = "SELECT string_id FROM challenge WHERE string_id = ? OR string_id = ?";

        $result = $this->db->query($sql, [$string1, $string2])->result();

        if (empty($result))
        {
            return NULL;
        }

        return $result[0]->string_id;
    }

    // I'm not taking care of removing unused 'challenge' entries because
    // it's irrelevant from a UX point of view.

}

/*

CREATE TABLE challenge (
    id int NOT NULL AUTO_INCREMENT,
    string_id varchar(32) UNIQUE,
    player1 varchar(128) NOT NULL,
    player2 varchar(128) NOT NULL,
    PRIMARY KEY(id)
);

 */