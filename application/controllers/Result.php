<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Result extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *         http://example.com/index.php/welcome
     *    - or -
     *         http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
          $this->load->helper('url');
     
        $data = array(
            'isselected' => '4',
          
        );
        
        $this->load->view('common/header.php');
        $this->load->view('common/menu.php',$data);
        $this->load->view('Result/Result.php');
        $this->load->view('common/footer.php');
        
    }
}