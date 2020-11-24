<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {



    public function index()
    {
        //data yg diperlukan untuk di unset
        $sess_data = [
            'id','name','email','password','role','is_login'
        ];

        //unset data sesuai $sess_data
        $this->session->unset_userdata($sess_data);
       

        //hancurkan session
        $this->session->sess_destroy();

        //direct ke halama utama
        redirect(base_url());

        
    }

}

/* End of file Logout.php */
