<?php

class Tic_tac_toe extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('challenge_model');
        $this->load->model('game_model');
    }

    public function begin()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $validation_result = $this->_perform_validation();

        // if form is filled correctly then go to PLAY
        // this is the most common scenario
        if ($validation_result === TRUE)
        {
            $this->_go_to_play();
            return;
        }

        // if form was sent but doesn't validate
        // then make sure an error message will be shown
        $should_show_error = $this->_form_was_sent() AND $validation_result === FALSE;


        // prepare all sections of page
        $data['title'] = 'Players\' selection';
        $this->load->view('templates/header', $data);

        if ($should_show_error)
        {
            $this->_show_error();
        }

        $this->load->view('ttt/begin', $data);
        $this->load->view('templates/footer', $data);
    }

    private function _perform_validation()
    {
        $this->form_validation->set_rules('player1', 'Player 1', 'required');
        $this->form_validation->set_rules('player2', 'Player 2', 'required');
        return $this->form_validation->run();
    }

    private function _form_was_sent()
    {
        return $this->input->post('submit') !== NULL;
    }

    private function _show_error()
    {
        $msg = 'Both players must have names!';
        $data['error_message'] = $msg;
        $this->load->view('templates/error', $data);
    }

    private function _go_to_play()
    {
        $player1 = $this->input->post('player1');
        $player2 = $this->input->post('player2');

        $challenge_id = $this->challenge_model->create_challenge($player1, $player2);
        $this->session->set_userdata('ch_id', $challenge_id);

        $this->load->helper('url');
        redirect('tic-tac-toe/play');
    }

    public function play()
    {
        // TODO: import helpers/libraries

        $data['title'] = "Play";
        $this->load->view('templates/header', $data);

        $challenge_id = $this->session->userdata('ch_id');
        $board_state = $this->input->post('board_state');
        // if just finished a game then save the result
        if ($board_state !== NULL)
        {
            $this->game_model->add_game($challenge_id, $board_state);
        }

        $recent_games = $this->game_model->get_recent_games($challenge_id);
        $data['recent_games'] = $recent_games;
        $this->load->view('ttt/play', $data);

        $this->load->view('templates/footer', $data);
    }
}