<?php

class Tic_tac_toe extends CI_Controller
{
    var $errors = array();
    var $validation_passed;

    public function __construct()
    {
        parent::__construct();
        // TODO: load libraries/helpers/models only when they are needed? (performance?)
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper('html');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->model('challenge_model');
        $this->load->model('game_model');
    }

    public function begin()
    {


        // if form is filled correctly then go to PLAY
        // this is the most common scenario
        $this->validation_passed = $this->_perform_validation();
        if ($this->validation_passed)
        {
            $this->_redirect_to_play();
        }

        $this->_check_flash_data();

        $this->_check_session();

        // if form was sent but doesn't validate
        // then make sure an error message will be shown
        $this->_check_form();

        $data['title'] = 'Players\' selection';

        // prepare all sections of page
        $this->load->view('templates/header', $data);
        $this->_show_errors_if_any($data);
        $this->load->view('ttt/begin', $data);
        $this->load->view('templates/footer', $data);
    }

    private function _perform_validation()
    {
        $this->form_validation->set_rules('player1', 'Player 1', 'required');
        $this->form_validation->set_rules('player2', 'Player 2', 'required');
        return $this->form_validation->run();
    }

    private function _check_flash_data()
    {
        $last_error = $this->session->flashdata('last_error');
        if ($last_error !== NULL)
        {
            $this->_add_error($last_error);
        }
    }

    private function _check_session()
    {
        $challenge_id = $this->session->userdata('ch_id');
        if ($challenge_id !== NULL)
        {
            $play_link = anchor('tic-tac-toe/play', 'playing');
            $msg = 'If you continue you will create a new session and current '
                .'results will be lost.<br />'
                .'Go to ' . $play_link . ' instead.';
            $this->_add_error($msg);
        }
    }

    private function _check_form()
    {
        $form_invalid = $this->_form_was_sent() AND $this->validation_passed === FALSE;
        if ($form_invalid)
        {
            $msg = 'Both players must have names!';
            $this->_add_error($msg);
        }
    }

    private function _form_was_sent()
    {
        return $this->input->post('submit') !== NULL;
    }

    private function _add_error($msg)
    {
        $this->errors[] = $msg;
    }

    private function _show_errors_if_any(&$data)
    {
        if ( ! empty($this->errors))
        {
            $data['error_messages'] = $this->errors;
            $this->load->view('templates/error', $data);
        }
    }

    private function _redirect_to_play()
    {
        $player1 = $this->input->post('player1');
        $player2 = $this->input->post('player2');

        $challenge_id = $this->challenge_model->create_challenge($player1, $player2);
        $this->session->set_userdata('ch_id', $challenge_id);

        $this->session->keep_flashdata('last_error');
        redirect('tic-tac-toe/play');
    }

    public function play()
    {

        if ($this->session->userdata('ch_id') === NULL)
        {
            $msg = 'First, name your players!';
            $this->session->set_flashdata('last_error', $msg);
            redirect('tic-tac-toe/begin');
        }


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

        $this->load->view('templates/footer');
    }
}