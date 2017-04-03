<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Affiliation_New extends CI_Controller {
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
    function __construct()
    {
        //DebugBreak();
        parent::__construct();
        $this->load->helper('url');
        //this condition checks the existence of session if user is not accessing  
        //login method as it can be accessed without user session
        $this->load->library('session');
        if( !$this->session->userdata('logged_in') && $this->router->method != 'login' ) {
            redirect('login_affiliation');
        }
    }
    public function index()
    {


    }
    public function NewUserReg_Insert()
    {
        $this->load->library('session');
        $this->load->model('Affiliation_model');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $data = array(
            'isselected' => '0',
        );
        $ckpo = $userinfo['Inst_Id'];
        $fetchdata = array('AppNo'=>$BatchId,'ckpo'=>$ckpo);
        DebugBreak(); 
        $fetchdata['ddlAffiliated'] = $_POST['ddlAffiliated'];
        $fetchdata['userName'] = $_POST['userName'];
        $fetchdata['password']= $_POST['password'];
        $fetchdata['inputFirstName'] = $_POST['inputFirstName'];
        $fetchdata['inputEmail'] = $_POST['inputEmail'];
        $fetchdata['txt_pwd'] = $_POST['txt_pwd'];
        $fetchdata['txt_repwd'] = $_POST['txt_repwd'];
        $fetchdata['inputCNIC'] = $_POST['inputCNIC'];
        $fetchdata['btnNewUserReg'] = $_POST['btnNewUserReg'];
        $this->Email_to_Users();
        //$_POST['inputFirstName'] = 'testno2_newreg_testing_php';
        $appdata = $this->Affiliation_model->ch_userName($_POST['inputFirstName']);
        if( $appdata == false)
        {
            $appdata = $this->Affiliation_model->New_reg($fetchdata);
        }
        else
        {
            return;
        }




    }

    public function Email_to_Users()
    {
        $this->load->library('session');
        $this->load->model('Affiliation_model');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $data = array(
            'isselected' => '0',
        );
        $ckpo = $userinfo['Inst_Id'];
        $fetchdata = array('AppNo'=>$BatchId,'ckpo'=>$ckpo);
       // DebugBreak(); 
        $fetchdata['ddlAffiliated'] = $_POST['ddlAffiliated'];
        $fetchdata['userName'] = $_POST['userName'];
        $fetchdata['password']= $_POST['password'];
        $fetchdata['inputFirstName'] = $_POST['inputFirstName'];
        $fetchdata['inputEmail'] = $_POST['inputEmail'];
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'vuhomework22@gmail.com',
            'smtp_pass' => 'bc090402770',
            'mailtype'  => 'html', 
            'charset'   => 'utf-8'
        );
        /*$config = array();
        $config['useragent']           = "CodeIgniter";
        $config['mailpath']            = "/usr/bin/sendmail"; // or "/usr/sbin/sendmail"
        $config['protocol']            = "smtp";
        $config['smtp_host']           = "localhost";
        $config['smtp_port']           = "25";
        $config['mailtype'] = 'html';
        $config['charset']  = 'utf-8';
        $config['newline']  = "\r\n";
        $config['wordwrap'] = TRUE;    */

        $this->load->library('email', $config);
        // $this->email->set_newline("\r\n");
        $this->email->from('vuhomework22@gmail.com', 'BISE Gujranwala');
        $this->email->to('MS150400193@gmail.com'); 

        $this->email->subject('Email Test');
        $this->email->message('Testing the email class.');  
        // Set to, from, message, etc.
        if ($this->email->send()) {
            echo "you are luck!";
        } else {
            echo $this->email->print_debugger();
        }
        return;
        //$result = $this->email->send();

        //$_POST['inputFirstName'] = 'testno2_newreg_testing_php';
        $appdata = $this->Affiliation_model->ch_userName($_POST['inputFirstName']);
        if( $appdata == false)
        {
            $appdata = $this->Affiliation_model->New_reg($fetchdata);
        }
        else
        {
            return;
        }




    }

}