<?php

class Util
{
    protected $CI;

    public function __construct($rules = array())
    {
        $this->CI =& get_instance();
    }

    /**
     * @param $challenge_string string as got from GET
     * @param $error_msg string used if challenge string cannot be returned
     * @return string challenge string; on failure performs a redirect
     */
    function challenge_string_or_redirect($challenge_string, $error_msg)
    {
        $this->CI->load->library('session');
        $this->CI->load->model('challenge_model');

        $session_challenge_string = $this->CI->session->userdata('challenge_string');

        // first, verify that string is valid
        $verified_string = $this->CI->challenge_model->confirm_challenge_string($challenge_string, $session_challenge_string);

        if ($verified_string === NULL)
        {
            $this->CI->load->helper('url');

            $this->CI->session->set_flashdata('last_error', $error_msg);
            redirect('tic-tac-toe/begin');
        }

        // can be useful later
        $this->CI->session->set_userdata('challenge_string', $verified_string);

        return $verified_string;
    }
}