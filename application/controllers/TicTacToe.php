<?php

class TicTacToe extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
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
            goToPlay();
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

    public function play()
    {
        // TODO: import helpers/libraries

        $data['title'] = "Play";
        $this->load->view('templates/header', $data);

        // TODO: logic

        $this->load->view('ttt/play', $data);

        $this->load->view('templates/footer', $data);
    }
}