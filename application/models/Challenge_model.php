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