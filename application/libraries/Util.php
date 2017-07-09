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
     * @return string challenge string, never NULL
     */
    function challenge_string_or_redirect($challenge_string, $error_msg)
    {
        $this->load->library('session');

        if ($challenge_string === NULL)
        {
            // try to get one from session
            $challenge_string = $this->session->userdata('challenge_string');
        }
        if ($challenge_string === NULL)
        {
            $this->load->helper('url');

            $this->session->set_flashdata('last_error', $error_msg);
            redirect('tic-tac-toe/begin');
        }

        // can be helpful later
        $this->session->set_userdata('challenge_string', $challenge_string);

        return $challenge_string;
    }
}