<?php

class Challenge_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function create_challenge($player1, $player2)
    {
        $data = array(
            'player1' => $player1,
            'player2' => $player2,
        );

        $this->db->trans_start();

        // values are escaped automatically
        $this->db->insert('challenge', $data);
        $query = $this->db->query(
            'SELECT id
                FROM challenge
                ORDER BY id DESC
                LIMIT 1');
        $challenge_id = $query->row()->id;

        $this->db->trans_complete();

        return $challenge_id;
    }

}

/*

CREATE TABLE challenge (
    id int NOT NULL AUTO_INCREMENT,
    player1 varchar(128) NOT NULL,
    player2 varchar(128) NOT NULL,
    PRIMARY KEY(id)
);

 */