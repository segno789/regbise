<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registration extends CI_Controller {
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
        parent::__construct();
        $this->load->helper('url');
        //this condition checks the existence of session if user is not accessing  
        //login method as it can be accessed without user session
        $this->load->library('session');
        if( !$this->session->userdata('logged_in') && $this->router->method != 'login' ) {
            redirect('login');
        }
    }
    public function index()
    {
        //DebugBreak(); 
        $msg = $this->uri->segment(3);
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $userinfo['isselected'] = 2;
         $userinfo['isdashbord'] = 1;
        $Inst_Id = $userinfo['Inst_Id'];
        $isgovt = $userinfo['isgovt'];
        $emis = $userinfo['emis'];
        $email = $userinfo['email'];
        $phone = $userinfo['phone'];
        $cell = $userinfo['cell'];
        $dist = $userinfo['dist'];
        $teh = $userinfo['teh'];
        $zone = $userinfo['zone'];
        $isInserted = $userinfo['isInserted'];
        $field_status = array();
        $field_status['emis'] = 0;
        $field_status['email'] = 0;
        $field_status['phone'] = 0;
        $field_status['cell'] = 0;
        $field_status['dist'] = 0;
        $field_status['teh'] = 0;
        $field_status['zone'] = 0;
        if($Inst_Id == 399903)
        {
            $target_path = IMAGE_PATH.'/';
            //$this->deleteExtarfiles($target_path );
            //return false; 
        }

        if($isgovt == 1)
        {
            if(strlen($emis)> 1)
            {
                $field_status['emis'] = 1;
            }
            if(strlen($email) > 5){
                $field_status['email'] = 1;
            }
            if(strlen($phone) > 3){
                $field_status['phone'] = 1;
            }
            if(strlen(($cell)>5)){
                $field_status['cell'] = 1;
            }
            if(($dist > 0)){
                $field_status['dist'] = 1;
            }
            if(($teh > 0)){
                $field_status['teh'] = 1;
            }
            if(($zone > 0)){
                $field_status['zone'] = 1;
            }
        }
        else
        {
            $field_status['emis'] = 1;
            if(strlen($email) > 5){
                $field_status['email'] = 1;
            }
            if(strlen($phone) > 3){
                $field_status['phone'] = 1;
            }
            if(strlen(($cell)>5)){
                $field_status['cell'] = 1;
            }
            if(($dist > 0)){
                $field_status['dist'] = 1;
            }
            if(($teh > 0)){
                $field_status['teh'] = 1;
            }
            if(($zone > 0)){
                $field_status['zone'] = 1;
            }
        }
        $Inst_name = $userinfo['inst_Name'];
        $this->load->view('common/header.php',$userinfo);
        //DebugBreak();
        if($msg == 7)
        {
            $this->load->view('common/menu.php',$userinfo);
            $this->load->model('Registration_model');
            $count = $this->Registration_model->Dashboard($Inst_Id);
            $info = array('count'=>$count,'Inst_id'=>$Inst_Id,'Inst_name'=>$Inst_name);
            $this->load->view('Registration/Registration.php',$info);
            $this->load->view('common/footer.php');  
        }
        else
        {
            if( ($field_status['emis'] == 0) || ($field_status['email'] == 0) || ($field_status['phone'] == 0) || ($field_status['cell'] == 0) || ($field_status['dist'] == 0) || ($field_status['teh'] == 0)|| ($field_status['zone'] == 0))
            {
                // $this->session->set_userdata("status",$this->session->flashdata('status'));
                if($this->session->flashdata('status'))
                {
                    $this->load->view('common/menu.php',$userinfo);
                    $this->load->model('Registration_model');
                    $count = $this->Registration_model->Dashboard($Inst_Id);
                    $info = array('count'=>$count,'Inst_id'=>$Inst_Id,'Inst_name'=>$Inst_name);
                    $this->load->view('Registration/Registration.php',$info);
                    $this->load->view('common/footer.php');  

                }
                else{
                    if($isInserted < 1)
                    {
                        $this->load->model('Registration_model');
                        $count = $this->Registration_model->Dashboard($Inst_Id);
                        // DebugBreak();
                        if($field_status['zone'] == 0)
                        {
                            $zone = $this->Registration_model->get_zone();
                        }
                        //DebugBreak();
                        if($this->session->flashdata('incomplete'))
                        {
                            $all_PreData = $this->session->flashdata('incomplete'); 
                            $fillvalues['emis'] = $all_PreData['emis'];
                            $fillvalues['email'] = $all_PreData['email'];
                            $fillvalues['phone'] = $all_PreData['phone'];
                            $fillvalues['cell'] = $all_PreData['cell'];
                            $fillvalues['dist'] = $all_PreData['dist'];
                            $fillvalues['teh'] = $all_PreData['teh'];
                            $fillvalues['zone'] = $all_PreData['zone'];
                            $errors = $all_PreData['error'];
                        }
                        else{
                            $errors ="";
                            $fillvalues="";
                        }
                        //$this->session->set_flashdata('incomplete',$allinfo);
                        $info = array('count'=>$count,'Inst_id'=>$Inst_Id,'Inst_name'=>$Inst_name,'field_status'=>$field_status,'zone'=>$zone,'error'=>$errors,'fill_values'=>$fillvalues);
                        //$this->load->view('Registration/Registration.php',$info);
                        $this->load->view('Registration/9th/Incomplete_inst_info.php',$info);
                        $this->load->view('common/footer.php');
                    }
                    else{
                        $this->load->view('common/menu.php',$userinfo);
                        $this->load->model('Registration_model');
                        $count = $this->Registration_model->Dashboard($Inst_Id);
                        $info = array('count'=>$count,'Inst_id'=>$Inst_Id,'Inst_name'=>$Inst_name);
                        $this->load->view('Registration/Registration.php',$info);
                        $this->load->view('common/footer.php');    

                    } 
                }

                //$this->load->view('common/menu.php',$userinfo);

            }
            else
            {
                $this->load->view('common/menu.php',$userinfo);
                $this->load->model('Registration_model');
                $count = $this->Registration_model->Dashboard($Inst_Id);
                $info = array('count'=>$count,'Inst_id'=>$Inst_Id,'Inst_name'=>$Inst_name);
                $this->load->view('Registration/Registration.php',$info);
                $this->load->view('common/footer.php');    
            } 
        }


    }
    public function Profile(){

        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $userinfo['isselected'] = 2;
        $Inst_Id = $userinfo['Inst_Id'];
        $isgovt = $userinfo['isgovt'];
        $emis = $userinfo['emis'];
        $email = $userinfo['email'];
        $phone = $userinfo['phone'];
        $cell = $userinfo['cell'];
        $dist = $userinfo['dist'];
        $teh = $userinfo['teh'];
        $zone = $userinfo['zone'];
        $isInserted = $userinfo['isInserted'];
        $this->load->model('Registration_model');
        if($isInserted == 1)
        {
            $newinfo = $this->Registration_model->Profile_info($Inst_Id);  
            $emis = $newinfo[0]['emis_code']; 
            $email =  $newinfo[0]['email']; 
            $phone = $newinfo[0]['LandLine'];
            $cell =  $newinfo[0]['MobNo']; 
        }
        if($this->session->flashdata('msg'))
        {

            $msg = $this->session->flashdata('msg');    
        }
        else
        {
            $msg = '';
        }

        $info = array('isgovt'=>$isgovt,'emis'=>$emis,'email'=>$email,'phone'=>$phone, 'cell'=>$cell,'isInserted'=>$isInserted,'msg'=>$msg)  ;
        $this->load->view('common/header.php',$userinfo);
        $this->load->view('common/menu.php',$userinfo);

        $this->load->view('Registration/9th/Profile.php',$info);
        $this->load->view('common/footer.php');


    }
    public function Profile_Update(){
        $this->load->model('Registration_model');
        // DebugBreak();
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $userinfo['isselected'] = 2;
        $Inst_Id = $userinfo['Inst_Id'];
        $this->commonheader($userinfo);
        $error = array();

        if (!isset($Inst_Id))
        {
            //$error['excep'][1] = 'Please Login!';
            $this->load->view('login/login.php');
        }
        if(@$_POST['isGovt']== 1){
            $emis = @$_POST['Profile_emis'];
        }
        else{
            $emis = '';
        }
        $allinputdata = array('isGovt'=>@$_POST['isGovt'],'Profile_email'=>@$_POST['Profile_email'],'Profile_password'=>@$_POST['Profile_password'],'Profile_phone'=>@$_POST['Profile_phone'],'Profile_cell'=>@$_POST['Profile_cell'],'isInserted'=>@$_POST['isInserted'],'Inst_Id'=>$Inst_Id,'Inst_Id'=>$Inst_Id,'emis'=>$emis
        );

        $result =  $this->Registration_model->Profile_UPDATE($allinputdata); 
        if($result == true){
            $msg = 'success';
            $this->session->set_flashdata('msg',$msg);
            redirect('Registration/Profile');
            return;
        }   
        else{
            $msg = 'error';
            $this->session->set_flashdata('msg',$msg);
            redirect('Registration/Profile');
            return;

        }


    }
    public function Incomplete_inst_info(){

        //  DebugBreak();
        $this->load->model('Registration_model');
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $this->load->view('common/header.php',$userinfo);
        $data = array(
            'isselected' => '2',
        );
        //   DebugBreak();
        if($this->session->flashdata('NewEnrolment_error')){

            $error['excep'] = $this->session->flashdata('NewEnrolment_error');    
        }
        else{
            $error['excep'] = '';

        }

        $isInserted = $userinfo['isInserted'];
        $isgovt = $userinfo['isgovt'];
        $emis = $userinfo['emis'];
        $email = $userinfo['email'];
        $phone = $userinfo['phone'];
        $cell = $userinfo['cell'];
        $dist = $userinfo['dist'];
        $teh = $userinfo['teh'];
        $zone = $userinfo['zone'];

        //$isInserted = $userinfo['isInserted'];

        $field_status = array();
        $field_status['emis'] = 0;
        $field_status['email'] = 0;
        $field_status['phone'] = 0;
        $field_status['cell'] = 0;
        $field_status['dist'] = 0;
        $field_status['teh'] = 0;
        $field_status['zone'] = 0;

        if($isgovt == 1)
        {
            if(strlen($emis)> 1)
            {
                $field_status['emis'] = 1;
            }
            if(strlen($email) > 5){
                $field_status['email'] = 1;
            }
            if(strlen($phone) > 3){
                $field_status['phone'] = 1;
            }
            if(strlen(($cell)>5)){
                $field_status['cell'] = 1;
            }
            if(($dist > 0)){
                $field_status['dist'] = 1;
            }
            if(($teh > 0)){
                $field_status['teh'] = 1;
            }
            if(($zone > 0)){
                $field_status['zone'] = 1;
            }
        }
        else
        {
            $field_status['emis'] = 1;
            if(strlen($email) > 5){
                $field_status['email'] = 1;
            }
            if(strlen($phone) > 3){
                $field_status['phone'] = 1;
            }
            if(strlen(($cell)>5)){
                $field_status['cell'] = 1;
            }
            if(($dist > 0)){
                $field_status['dist'] = 1;
            }
            if(($teh > 0)){
                $field_status['teh'] = 1;
            }
            if(($zone > 0)){
                $field_status['zone'] = 1;
            }
        }
        $error['gender'] = $userinfo['gender'];
        $error['isrural'] = $userinfo['isrural'];
        $error['grp_cd'] = $userinfo['grp_cd'];
        $info = array('field_status'=>$field_status,'zone'=>$zone);
        $this->commonheader($data);
        $this->load->view('Registration/9th/Incomplete_inst_info.php',$info);
        $this->load->view('common/footer.php');    
    }
    public function Incomplete_inst_info_INSERT(){
        //DebugBreak();
        // $test = $_POST['info_zone'];
        /*@$_POST['Info_email'];
        @$_POST['info_phone'];
        @$_POST['info_cellNo'];
        @$_POST['info_dist'];
        @$_POST['info_teh'];
        @$_POST['info_zone'];*/
        $this->load->model('Registration_model');
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];

        $allinfo['Inst_Id'] =$userinfo['Inst_Id'];

        if (!array_key_exists("Info_emis",$_POST))
        {
            $allinfo['Info_emis'] =$userinfo['emis'];
        }
        else
        {
            $allinfo['Info_emis'] =$_POST['Info_emis'];
        }
        if (!array_key_exists("Info_email",$_POST))
        {
            $allinfo['info_email']= $userinfo['email'];
        }
        else
        {
            $allinfo['info_email'] =$_POST['Info_email'];
        }
        if (!array_key_exists("info_phone",$_POST))
        {
            $allinfo['info_phone']= $userinfo['phone'];
        }
        else
        {
            $allinfo['info_phone'] =$_POST['info_phone'];
        }
        if (!array_key_exists("info_cellNo",$_POST))
        {
            $allinfo['info_cellNo']= $userinfo['cell'];
        }
        else
        {
            $allinfo['info_cellNo'] =$_POST['info_cellNo'];
        }
        if (!array_key_exists("info_dist",$_POST))
        {
            $allinfo['info_dist']= $userinfo['dist'];
        }
        else
        {
            $allinfo['info_dist'] =$_POST['info_dist'];
        }
        if (!array_key_exists("info_teh",$_POST))
        {
            $allinfo['info_teh']= $userinfo['teh'];
        }
        else
        {
            $allinfo['info_teh'] =$_POST['info_teh'];
        }
        if (!array_key_exists("info_zone",$_POST))
        {
            $allinfo['info_zone']= $userinfo['zone'];
        }
        else
        {//info_zone
            $allinfo['info_zone'] =$_POST['info_zone'];
        }
        // DebugBreak();
        $filledinfo = array('emis'=>$_POST['Info_emis'],'email'=>$_POST['Info_email'],'phone'=>$_POST['info_phone'],'cell'=>$_POST['info_cellNo'],'dist'=>$_POST['info_dist'],'teh'=>$_POST['info_teh'],'zone'=>$_POST['info_zone']);
        if( ($allinfo['Info_emis'] == 0 || $allinfo['Info_emis'] == '') && $userinfo['isgovt']==1  ){

            $filledinfo['error'] = "Please Provide EMIS CODE";
            $this->session->set_flashdata('incomplete',$filledinfo);
            //$this->load->view('Registration/9th/Incomplete_inst_info.php',$error);
            redirect('Registration/index/');
            return;

        }
        if(trim(empty($allinfo['info_email'])) )
        {
            $filledinfo['error'] = "Please Provide Institute Email Address";
            $this->session->set_flashdata('incomplete',$filledinfo);
            //$this->load->view('Registration/9th/Incomplete_inst_info.php',$error);
            redirect('Registration/index/');
            return;

        }
        if(trim($allinfo['info_phone']=="0") || trim($allinfo['info_phone']=="") || trim($allinfo['info_phone']=="-"))
        {
            $filledinfo['error'] = "Please Provide Institute Phone Number";
            $this->session->set_flashdata('incomplete',$filledinfo);
            //$this->load->view('Registration/9th/Incomplete_inst_info.php',$error);
            redirect('Registration/index/');
            return;

        }
        if(trim($allinfo['info_cellNo']=="0") || trim($allinfo['info_cellNo']=="") || trim($allinfo['info_cellNo']=="-"))
        {
            $filledinfo['error'] = "Please Provide Institute Mobile Number";
            $this->session->set_flashdata('incomplete',$filledinfo);
            //$this->load->view('Registration/9th/Incomplete_inst_info.php',$error);
            redirect('Registration/index/');
            return;

        }
        if(trim($allinfo['info_dist']=="0") || trim($allinfo['info_dist']=="") )
        {

            $filledinfo['error'] = "Please Provide Institute District";
            $this->session->set_flashdata('incomplete',$filledinfo);
            //$this->load->view('Registration/9th/Incomplete_inst_info.php',$error);
            redirect('Registration/index/');
            return;
        }
        if(trim($allinfo['info_teh']=="0") || trim($allinfo['info_teh']=="") )
        {

            $filledinfo['error'] = "Please Provide Institute Tehsil";
            $this->session->set_flashdata('incomplete',$filledinfo);
            //$this->load->view('Registration/9th/Incomplete_inst_info.php',$error);
            redirect('Registration/index/');
            return;
        }
        if(trim($allinfo['info_zone']=="0") || trim($allinfo['info_zone']==""))
        {

            $filledinfo['error'] = "Please Provide Institute Zone";
            $this->session->set_flashdata('incomplete',$filledinfo);
            //$this->load->view('Registration/9th/Incomplete_inst_info.php',$error);
            redirect('Registration/index/');
            return;
        }
        $status = $this->Registration_model->Incomplete_inst_info_INSERT($allinfo);

        if($status == true)
        {
            $this->session->set_flashdata('status',true);
            redirect('Registration/index/');
            return;

        }



    }
    public function NewEnrolment_insert()
    {



        $this->load->model('Registration_model');
        // DebugBreak();
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $userinfo['isselected'] = 2;
        $Inst_Id = $userinfo['Inst_Id'];
        $this->commonheader($userinfo);
        $error = array();

        if (!isset($Inst_Id))
        {
            //$error['excep'][1] = 'Please Login!';
            $this->load->view('login/login.php');
        }
        // $this->Registration_model->Insert_NewEnorlement($data);    
        $formno = $this->Registration_model->GetFormNo($Inst_Id);//, $fname);//$_POST['username'],$_POST['password']);

        $allinputdata = array('cand_name'=>@$_POST['cand_name'],'father_name'=>@$_POST['father_name'],
            'bay_form'=>@$_POST['bay_form'],'father_cnic'=>@$_POST['father_cnic'],
            'dob'=>@$_POST['dob'],'mob_number'=>@$_POST['mob_number'],
            'medium'=>@$_POST['medium'],'Inst_Rno'=>@$_POST['Inst_Rno'],
            'speciality'=>@$_POST['speciality'],'MarkOfIden'=>@$_POST['MarkOfIden'],
            'medium'=>@$_POST['medium'],'nationality'=>@$_POST['nationality'],
            'gender'=>@$_POST['gender'],'hafiz'=>@$_POST['hafiz'],
            'religion'=>@$_POST['religion'],'std_group'=>@$_POST['std_group'],
            'address'=>@$_POST['address'],
            'UrbanRural'=>@$_POST['UrbanRural'],'sub1'=>@$_POST['sub1'],
            'sub2'=>@$_POST['sub2'],'sub3'=>@$_POST['sub3'],
            'sub4'=>@$_POST['sub4'],'sub5'=>@$_POST['sub5'],
            'sub6'=>@$_POST['sub6'],'sub7'=>@$_POST['sub7'],
            'sub8'=>@$_POST['sub8']
        );

        /* $target_path = './assets/uploads/'.$Inst_Id.'/';
        if (!file_exists($target_path)){
        mkdir($target_path, 0777, true);
        }*/

        $target_path = IMAGE_PATH;
        // $target_path = '../uploads2/'.$Inst_Id.'/';
        if (!file_exists($target_path)){

            mkdir($target_path);
        }
        $target_path = IMAGE_PATH.$Inst_Id.'/';
        if (!file_exists($target_path)){

            mkdir($target_path);
        } 

        $config['upload_path']   = $target_path;
        $config['allowed_types'] = 'jpg';
        $config['max_size']      = '20';
        $config['min_size']      = '4';
      //  $config['max_width']     = '260';
       // $config['max_height']    = '290';
        $config['min_width']     = '110';
        $config['min_height']    = '100';
        $config['overwrite']     = TRUE;
        $config['file_name']     = $formno.'.jpg';

        $filepath = $target_path. $config['file_name']  ;

        //$config['new_image']    = $formno.'.JPEG';

        $this->load->library('upload', $config);

        $check = getimagesize($_FILES["image"]["tmp_name"]);
        $this->upload->initialize($config);

        if($check !== false) {

            $file_size = round($_FILES['image']['size']/1024, 2);
            if($file_size<=20 && $file_size>=4)
            {
                if ( !$this->upload->do_upload('image',true))
                {
                    if($this->upload->error_msg[0] != "")
                    {
                        $error['excep']= $this->upload->error_msg[0];
                        $allinputdata['excep'] = $this->upload->error_msg[0];
                        $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                        //  echo '<pre>'; print_r($allinputdata['excep']);exit();
                        redirect('Registration/NewEnrolment/');
                        return;

                    }


                }
            }
            else
            {
                $allinputdata['excep'] = 'The file you are attempting to upload size is between 4 to 20 Kb.';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                //  echo '<pre>'; print_r($allinputdata['excep']);exit();
                redirect('Registration/NewEnrolment/');

            }
        }
        else
        {
            // $check = getimagesize($filepath);
            if($check === false)
            {
                $allinputdata['excep'] = 'Please Upload Your Picture';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Registration/NewEnrolment/');
                return;
            }
        }

        $this->frmvalidation('NewEnrolment',$allinputdata,0);

        $a = getimagesize($filepath);
        if($a[2]!=2)
        {
            $this->convertImage($filepath,$filepath,100,$a['mime']);
        }
        // $name = 'Waseem Saleem';
        // $fname = 'Muhammad Saleem'; 
        $sub1ap1 = 0;
        $sub2ap1 = 0;
        $sub3ap1 = 0;
        $sub4ap1 = 0;
        $sub5ap1 = 0;
        $sub6ap1 = 0;
        $sub7ap1 = 0;
        $sub8ap1 = 0;
        if(@$_POST['sub1'] != 0)
        {
            $sub1ap1 = 1;    
        }
        if(@$_POST['sub2'] != 0)
        {
            $sub2ap1 = 1;    
        }
        if(@$_POST['sub3'] != 0)
        {
            $sub3ap1 = 1;    
        }
        if(@$_POST['sub4'] != 0)
        {
            $sub4ap1 = 1;    
        }
        if(@$_POST['sub5'] != 0)
        {
            $sub5ap1 = 1;    
        }
        if(@$_POST['sub6'] != 0)
        {
            $sub6ap1 = 1;    
        }
        if(@$_POST['sub7'] != 0)
        {
            $sub7ap1 = 1;    
        }
        if(@$_POST['sub8'] != 0)
        {
            $sub8ap1 = 1;    
        }
        $data = array(
            'name' =>$this->input->post('cand_name'),
            'Fname' =>$this->input->post('father_name'),
            'BForm' =>$this->input->post('bay_form'),
            'FNIC' =>$this->input->post('father_cnic'),
            'Dob' =>$this->input->post('dob'),
            'CellNo' =>$this->input->post('mob_number'),
            'medium' =>$this->input->post('medium'),
            'Inst_Rno' =>$this->input->post('Inst_Rno'),
            'MarkOfIden' =>$this->input->post('MarkOfIden'),
            'Speciality' =>$this->input->post('speciality'),
            'nat' =>$this->input->post('nationality'),
            'sex' =>$this->input->post('gender'),
            'IsHafiz' =>$this->input->post('hafiz'),
            'rel' =>$this->input->post('religion'),
            'addr' =>$this->input->post('address'),
            'grp_cd' =>$this->input->post('std_group'),
            'sub1' =>$this->input->post('sub1'),
            'sub2' =>$this->input->post('sub2'),
            'sub3' =>$this->input->post('sub3'),
            'sub4' =>$this->input->post('sub4'),
            'sub5' =>$this->input->post('sub5'),
            'sub6' =>$this->input->post('sub6'),
            'sub7' =>$this->input->post('sub7'),
            'sub8' =>$this->input->post('sub8'),
            'sub1ap1' => ($sub1ap1),
            'sub2ap1' => ($sub2ap1),
            'sub3ap1' => ($sub3ap1),
            'sub4ap1' => ($sub4ap1),
            'sub5ap1' => ($sub5ap1),
            'sub6ap1' => ($sub6ap1),
            'sub7ap1' => ($sub7ap1),
            'sub8ap1' => ($sub8ap1),
            'UrbanRural' =>$this->input->post('UrbanRural'),
            'Inst_cd' =>($Inst_Id),
            'FormNo' =>($formno)





        );
        $logedIn = $this->Registration_model->Insert_NewEnorlement($data);//, $fname);//$_POST['username'],$_POST['password']);
        //DebugBreak();
         if($logedIn[0]['error'] != 'false')
        {  
            $allinputdata = "";
            $allinputdata['excep'] = 'success';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Registration/NewEnrolment');
            return;


        }
        else
        {     
            $allinputdata['excep'] = 'An error has occoured. Please try again later. ';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Registration/NewEnrolment');
            return;
            echo 'Data NOT Saved Successfully !';

        } 




        $this->load->view('common/footer.php');
    }
    public function NewEnrolment()
    {    
        // DebugBreak();
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $this->load->view('common/header.php',$userinfo);
        $data = array(
            'isselected' => '2',
        );
        //  DebugBreak();
        if($this->session->flashdata('NewEnrolment_error')){

            $error['excep'] = $this->session->flashdata('NewEnrolment_error');    
        }
        else{
            $error['excep'] = '';
        }


        $error['gender'] = $userinfo['gender'];
        $error['isrural'] = $userinfo['isrural'];
        $error['grp_cd'] = $userinfo['grp_cd'];
        $error['isgovt'] = $userinfo['isgovt'];

        $this->commonheader($data);
        $this->load->view('Registration/9th/NewEnrolment.php',$error);
        // $this->load->view('common/footer.php');
        $this->commonfooter(array("files"=>array("jquery.maskedinput.js","validate.NewEnrolment.js")));
        // if(@$_POST['cand_name'] != '' )//&& @$_POST['father_name'] != '' && @$_POST['bay_form'] != '' && @$_POST['father_cnic'] != '' && @$_POST['dob'] != '' && @$_POST['mob_number'] != '') //{   



        //}



    }
    public function NewEnrolment_EditForm($formno)
    {    
        //  DebugBreak();
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $Inst_Id = $userinfo['Inst_Id'];
        $this->load->view('common/header.php',$userinfo);
        $isReAdm = 0;
        $year = 0;
        $data = array(
            'isselected' => '2',
        );
        $this->load->model('Registration_model');
        if($this->session->flashdata('NewEnrolment_error')){
            //DebugBreak();

            $RegStdData['data'][0] = $this->session->flashdata('NewEnrolment_error');   
            $isReAdm = $RegStdData['data'][0]['isreadm'];
            $RegStdData['isReAdm']=$isReAdm;
            $RegStdData['Oldrno']=0;

        }
        else{
            $error['excep'] = '';

            if($this->session->flashdata('IsReAdm')){
                $isReAdm = 1;
                $year = 2015;
            }
            else{
                $isReAdm = 0;
                $year = 2016;    
            }

            $RegStdData = array('data'=>$this->Registration_model->EditEnrolement_data($formno,$year,$Inst_Id),'isReAdm'=>$isReAdm,'Oldrno'=>0);
        }


        $this->load->view('common/menu.php',$data);
        $this->load->view('Registration/9th/Edit_Enrolement_form.php',$RegStdData);   
        $this->commonfooter(array("files"=>array("jquery.maskedinput.js","validate.NewEnrolment.js"))); 

    }
    public function NewEnrolment_update()
    {
         //DebugBreak();

        $this->load->model('Registration_model');

        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $userinfo['isselected'] = 2;
        $Inst_Id = $userinfo['Inst_Id'];
        $this->commonheader($userinfo);
        if (!isset($Inst_Id))
        {
            //$error['excep'][1] = 'Please Login!';
            $this->load->view('login/login.php');
        }
        $error = array();
        // DebugBreak();
        $formno =  $_POST['formNo'];  //$this->Registration_model->GetFormNo($Inst_Id);//, $fname);//$_POST['username'],$_POST['password']);
        $sub1ap1 = 0;
        $sub2ap1 = 0;
        $sub3ap1 = 0;
        $sub4ap1 = 0;
        $sub5ap1 = 0;
        $sub6ap1 = 0;
        $sub7ap1 = 0;
        $sub8ap1 = 0;
        if(@$_POST['sub1'] != 0)
        {
            $sub1ap1 = 1;    
        }
        if(@$_POST['sub2'] != 0)
        {
            $sub2ap1 = 1;    
        }
        if(@$_POST['sub3'] != 0)
        {
            $sub3ap1 = 1;    
        }
        if(@$_POST['sub4'] != 0)
        {
            $sub4ap1 = 1;    
        }
        if(@$_POST['sub5'] != 0)
        {
            $sub5ap1 = 1;    
        }
        if(@$_POST['sub6'] != 0)
        {
            $sub6ap1 = 1;    
        }
        if(@$_POST['sub7'] != 0)
        {
            $sub7ap1 = 1;    
        }
        if(@$_POST['sub8'] != 0)
        {
            $sub8ap1 = 1;    
        }
         $target_path = IMAGE_PATH.$Inst_Id.'/';
        // $target_path = '../uploads2/'.$Inst_Id.'/';
        if (!file_exists($target_path)){

            mkdir($target_path);
        }

        $config['upload_path']   = $target_path;
        $config['allowed_types'] = 'jpg';
        $config['max_size']      = '20';
        // $config['max_width']     = '260';
        // $config['max_height']    = '290';
        $config['min_width']     = '110';
        $config['min_height']    = '100';
        $config['overwrite']     = TRUE;
        $config['file_name']     = $formno.'.jpg';

        $filepath = $target_path. $config['file_name']  ;
        // DebugBreak();
        if(@$_POST['IsReAdm'] == '1')
        {


            $User_info_data = array('Inst_Id'=>$Inst_Id,'RollNo'=>@$_POST['OldRno'],'spl_case'=>17);
            $user_info  =  $this->Registration_model->readmission_check($User_info_data); //$db->first("SELECT * FROM  Admission_online..tblinstitutes_all WHERE Inst_Cd = " .$user->inst_cd);

            if($user_info == false)
            {
                $this->session->set_flashdata('error', 'This Roll No. Result is not cancelled. Please Cancel result from 9th Branch Before proceeding!');
                redirect('Registration/ReAdmission');
                return;
            }
            // DebugBreak();
            $allinputdata = array('CellNo'=>@$_POST['mob_number'],
                'med'=>@$_POST['medium'],'classRno'=>@$_POST['Inst_Rno'],
                'speciality'=>@$_POST['speciality'],'markOfIden'=>@$_POST['MarkOfIden'],
                'med'=>@$_POST['medium'],'nat'=>@$_POST['nationality'],
                'sex'=>@$_POST['gender'],'Ishafiz'=>@$_POST['hafiz'],
                'rel'=>@$_POST['religion'],'RegGrp'=>@$_POST['std_group'],
                'addr'=>@$_POST['address'],
                'RuralORUrban'=>@$_POST['UrbanRural'],'sub1'=>@$_POST['sub1'],
                'sub2'=>@$_POST['sub2'],'sub3'=>@$_POST['sub3'],
                'sub4'=>@$_POST['sub4'],'sub5'=>@$_POST['sub5'],
                'sub6'=>@$_POST['sub6'],'sub7'=>@$_POST['sub7'],
                'sub8'=>@$_POST['sub8'],'PicPath'=>$config['file_name'],'formNo'=>$formno,
                'sub1ap1' => ($sub1ap1),
                'sub2ap1' => ($sub2ap1),
                'sub3ap1' => ($sub3ap1),
                'sub4ap1' => ($sub4ap1),
                'sub5ap1' => ($sub5ap1),
                'sub6ap1' => ($sub6ap1),
                'sub7ap1' => ($sub7ap1),
                'sub8ap1' => ($sub8ap1),

            );
            $allinputdata['name']= $user_info[0]['name'];
            $allinputdata['Fname']= $user_info[0]['Fname'];
            $allinputdata['BForm']= $user_info[0]['BForm'];
            $allinputdata['FNIC']= $user_info[0]['FNIC'];
            $allinputdata['Dob']= $user_info[0]['Dob'];
            $allinputdata['regoldrno']= $user_info[0]['rno'];
            $allinputdata['regoldsess']= $user_info[0]['sess'];
            $allinputdata['regoldclass']= $user_info[0]['class'];
            $allinputdata['regoldyear']= $user_info[0]['Iyear'];
            $allinputdata['isreadm']= 1;
            $formno = $this->Registration_model->GetFormNo($Inst_Id);
            $allinputdata['formNo']= $formno;
            //DebugBreak();

        }
        else{
            $allinputdata = array('name'=>@$_POST['cand_name'],'Fname'=>@$_POST['father_name'],
                'BForm'=>@$_POST['bay_form'],'FNIC'=>@$_POST['father_cnic'],
                'Dob'=>@$_POST['dob'],'CellNo'=>@$_POST['mob_number'],
                'med'=>@$_POST['medium'],'classRno'=>@$_POST['Inst_Rno'],
                'speciality'=>@$_POST['speciality'],'markOfIden'=>@$_POST['MarkOfIden'],
                'med'=>@$_POST['medium'],'nat'=>@$_POST['nationality'],
                'sex'=>@$_POST['gender'],'Ishafiz'=>@$_POST['hafiz'],
                'rel'=>@$_POST['religion'],'RegGrp'=>@$_POST['std_group'],
                'addr'=>@$_POST['address'],
                'RuralORUrban'=>@$_POST['UrbanRural'],'sub1'=>@$_POST['sub1'],
                'sub2'=>@$_POST['sub2'],'sub3'=>@$_POST['sub3'],
                'sub4'=>@$_POST['sub4'],'sub5'=>@$_POST['sub5'],
                'sub6'=>@$_POST['sub6'],'sub7'=>@$_POST['sub7'],
                'sub8'=>@$_POST['sub8'],'PicPath'=>$config['file_name'],'formNo'=>@$_POST['formNo'],
                'sub1ap1' => ($sub1ap1),
                'sub2ap1' => ($sub2ap1),
                'sub3ap1' => ($sub3ap1),
                'sub4ap1' => ($sub4ap1),
                'sub5ap1' => ($sub5ap1),
                'sub6ap1' => ($sub6ap1),
                'sub7ap1' => ($sub7ap1),
                'sub8ap1' => ($sub8ap1),
            );
            $allinputdata['regoldrno']= 0;
            $allinputdata['regoldsess']= 0;
            $allinputdata['regoldclass']=0;
            $allinputdata['regoldyear']= 0;
            $allinputdata['isreadm']= 0;
        }

      

     


        //$config['new_image']    = $formno.'.JPEG';
        $this->load->library('upload', $config);

         $check = getimagesize($_FILES["image"]["tmp_name"]);
         $this->upload->initialize($config);

         if($check !== false) {

             $file_size = round($_FILES['image']['size']/1024, 2);
             if($file_size<=20 && $file_size>=4)
             {

                 if ( !$this->upload->do_upload('image',True))
                 {
                     if($this->upload->error_msg[0] != "")
                     {
                         $error['excep']= $this->upload->error_msg[0];
                         $allinputdata['excep'] = $this->upload->error_msg[0];
                         $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                         redirect('Registration/NewEnrolment_EditForm/'.$formno);
                         return;

                     }

                 }
             }
             else
             {
                 $allinputdata['excep'] = 'The file you are attempting to upload size is between 4 to 20 Kb.';
                 $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                 //  echo '<pre>'; print_r($allinputdata['excep']);exit();
                 redirect('Registration/NewEnrolment_EditForm/'.$formno);

             }


         }
         else
         {
             $check = getimagesize($filepath);
             if($check === false)
             {
                 $allinputdata['excep'] = 'Please Upload Your Picture';
                 $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                 redirect('Registration/NewEnrolment_EditForm/'.$formno);
                 return;
             }
         }


        //DebugBreak();
        $this->frmvalidation('NewEnrolment_EditForm/'.$formno,$allinputdata,1);

        /*  $a = getimagesize($filepath);
        if($a[2]!=2)
        {
        $this->convertImage($filepath,$filepath,100,$a['mime']);
        }*/

        // $name = 'Waseem Saleem'; Edit_Enrolement_form
        // $fname = 'Muhammad Saleem'; 
        $sub1ap1 = 0;
        $sub2ap1 = 0;
        $sub3ap1 = 0;
        $sub4ap1 = 0;
        $sub5ap1 = 0;
        $sub6ap1 = 0;
        $sub7ap1 = 0;
        $sub8ap1 = 0;
        if(@$_POST['sub1'] != 0)
        {
            $sub1ap1 = 1;    
        }
        if(@$_POST['sub2'] != 0)
        {
            $sub2ap1 = 1;    
        }
        if(@$_POST['sub3'] != 0)
        {
            $sub3ap1 = 1;    
        }
        if(@$_POST['sub4'] != 0)
        {
            $sub4ap1 = 1;    
        }
        if(@$_POST['sub5'] != 0)
        {
            $sub5ap1 = 1;    
        }
        if(@$_POST['sub6'] != 0)
        {
            $sub6ap1 = 1;    
        }
        if(@$_POST['sub7'] != 0)
        {
            $sub7ap1 = 1;    
        }
        if(@$_POST['sub8'] != 0)
        {
            $sub8ap1 = 1;    
        }
       // DebugBreak();
        $data = array(
            'name' =>$this->input->post('cand_name'),
            'Fname' =>$this->input->post('father_name'),
            'BForm' =>$this->input->post('bay_form'),
            'FNIC' =>$this->input->post('father_cnic'),
            'Dob' =>$this->input->post('dob'),
            'CellNo' =>$this->input->post('mob_number'),
            'medium' =>$this->input->post('medium'),
            'Inst_Rno' =>$this->input->post('Inst_Rno'),
            'MarkOfIden' =>$this->input->post('MarkOfIden'),
            'Speciality' =>$this->input->post('speciality'),
            'nat' =>$this->input->post('nationality'),
            'sex' =>$this->input->post('gender'),
            'IsHafiz' =>$this->input->post('hafiz'),
            'rel' =>$this->input->post('religion'),
            'addr' =>$this->input->post('address'),
            'grp_cd' =>$this->input->post('std_group'),
            'sub1' =>$this->input->post('sub1'),
            'sub2' =>$this->input->post('sub2'),
            'sub3' =>$this->input->post('sub3'),
            'sub4' =>$this->input->post('sub4'),
            'sub5' =>$this->input->post('sub5'),
            'sub6' =>$this->input->post('sub6'),
            'sub7' =>$this->input->post('sub7'),
            'sub8' =>$this->input->post('sub8'),
            'sub1ap1' => ($sub1ap1),
            'sub2ap1' => ($sub2ap1),
            'sub3ap1' => ($sub3ap1),
            'sub4ap1' => ($sub4ap1),
            'sub5ap1' => ($sub5ap1),
            'sub6ap1' => ($sub6ap1),
            'sub7ap1' => ($sub7ap1),
            'sub8ap1' => ($sub8ap1),
            'UrbanRural' =>$this->input->post('UrbanRural'),
            'Inst_cd' =>($Inst_Id),
            'FormNo' =>($formno),
            'regoldrno' =>($allinputdata['regoldrno']),
            'regoldsess' =>($allinputdata['regoldsess']),
            'regoldclass' =>( $allinputdata['regoldclass']),
            'regoldyear' =>( $allinputdata['regoldyear']),
            'isreadm'=>($allinputdata['isreadm'])
            



        );
        $logedIn = $this->Registration_model->Update_NewEnorlement($data);//, $fname);//$_POST['username'],$_POST['password']);
        if($logedIn[0]['error'] != 'false')
        {  

            $this->session->set_flashdata('error', 'success');
            redirect('Registration/EditForms');
            return;

            echo 'Data Saved Successfully !';

        }
        else
        {     
            $allinputdata['excep'] = 'An error has occoured. Please try again later. ';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Registration/NewEnrolment_EditForm/'.$formno);
            return;
            echo 'Data NOT Saved Successfully !';

        } 



        $this->load->view('common/footer.php');
    }
    public function NewEnrolment_Delete($formno)
    {
        // DebugBreak();
        $this->load->model('Registration_model');
        $RegStdData = array('data'=>$this->Registration_model->Delete_NewEnrolement($formno));
        $this->load->library('session');
        $this->session->set_flashdata('error', '2');
        redirect('Registration/EditForms');
        return;
    }
    public function ReAdmission()
    {
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        // DebugBreak();
        $data = array(
            'isselected' => '2',
        );
        $this->load->view('common/header.php',$userinfo);
        $this->commonheader($data);
        if(!( $this->session->flashdata('error'))){

            $error_msg_readmission = "";    
        }
        else{
            $error_msg_readmission = $this->session->flashdata('error');
        }
        $myinfo = array('error'=>$error_msg_readmission);
        $this->load->view('Registration/9th/ReAdmission.php',$myinfo);
        $this->load->view('common/footer.php');

    }
    public function BatchRelease()
    {
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
         //DebugBreak();
        $data = array(
            'isselected' => '2',
        );
        $Batch_ID = $this->uri->segment(3);
        $this->load->view('common/header.php',$userinfo);
        $this->commonheader($data);
        if(!( $this->session->flashdata('BatchList_error'))){

            $error['batchId']= $Batch_ID;    
        }
        else{
            $error = $this->session->flashdata('BatchList_error');
        }
      // echo $error['batchId'];
       // $myinfo = array('error'=>$error_msg_readmission);
        $this->load->view('Registration/9th/BatchRelease.php',$error);//,$myinfo);
        $this->load->view('common/footer.php');
    }
    public function Batchlist_INSERT()
    {
        $this->load->model('Registration_model');
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $data = array(
            'isselected' => '2',
        );
        $userinfo['isselected'] = 2;
        $Inst_Id = $userinfo['Inst_Id'];
        $this->load->view('common/header.php',$userinfo);
        $batchId = @$_POST['batch_real_Id'];
        $reason = @$_POST['batch_real_reason'];
        $branch = @$_POST['batch_real_bankbranch'];
        $challan = @$_POST['batch_real_challanno'];
        $amount = @$_POST['batch_real_PaidAmount'];
        $date = @$_POST['batch_real_PaidDate'];
        $allinputdata['batchId'] = $batchId;
        $allinputdata['reason'] = $reason;
        $allinputdata['branch'] = $branch;
        $allinputdata['challan'] = $challan;
        $allinputdata['amount'] = $amount;
        $allinputdata['date'] = $date;
       // DebugBreak();
        if($batchId == 0 || $batchId == ''){
            $allinputdata['BatchRelease_excep'] = 'Please Select Batch From Batch List Section';
                            $this->session->set_flashdata('BatchList_error',$allinputdata);
                            redirect('Registration/BatchRelease');
                            return;
        }
        else if($reason == ''){
              $allinputdata['BatchRelease_excep'] = 'Please Give Reason';
                            $this->session->set_flashdata('BatchList_error',$allinputdata);
                            redirect('Registration/BatchRelease');
                            return;
        }
        else if($branch =='' ){
              $allinputdata['BatchRelease_excep'] = 'Please Select Bank Branch';
                            $this->session->set_flashdata('BatchList_error',$allinputdata);
                            redirect('Registration/BatchRelease');
                            return;
        }
        else if ($challan == '' || $challan == 0){
              $allinputdata['BatchRelease_excep'] = 'Please Give Challan No.';
                            $this->session->set_flashdata('BatchList_error',$allinputdata);
                            redirect('Registration/BatchRelease');
                            return;
        }
        else if ($amount == '' || $amount == 0){
              $allinputdata['BatchRelease_excep'] = 'Please Give Amount';
                            $this->session->set_flashdata('BatchList_error',$allinputdata);
                            redirect('Registration/BatchRelease');
                            return;
        }
        else if($date == '' || $date == 0){
              $allinputdata['BatchRelease_excep'] = 'Please Select Paid Date';
                            $this->session->set_flashdata('BatchList_error',$allinputdata);
                            redirect('Registration/BatchRelease');
                            return;
        }
        
        $allinputdata['Inst_Id'] = $Inst_Id;
        $user_info  =  $this->Registration_model->ReleaseBatch_INSERT($allinputdata); //$db->first("SELECT * FROM  Admission_online..tblinstitutes_all WHERE Inst_Cd = " .$user->inst_cd);
        if($user_info == true){
              $allinputdata['BatchRelease_excep'] = 'Applied Successfully.';
                            $this->session->set_flashdata('BatchList_error',$allinputdata);
                            redirect('Registration/BatchList');
                            return;
        }
        else{
              $allinputdata['BatchRelease_excep'] = 'Not Applied Successfully! An Error occoured, Please Try Again Latter.';
                            $this->session->set_flashdata('BatchList_error',$allinputdata);
                            redirect('Registration/BatchRelease');
                            return;
        }
       
    }
    public function ReAdmission_check()
    {
        // DebugBreak();
        $RollNo = $this->uri->segment(3);
        //$Spl_case = $this->uri->segment(4);

        $this->load->model('Registration_model');
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $data = array(
            'isselected' => '2',
        );
        $userinfo['isselected'] = 2;
        $Inst_Id = $userinfo['Inst_Id'];
        $this->load->view('common/header.php',$userinfo);
        $User_info_data = array('Inst_Id'=>$Inst_Id,'RollNo'=>$RollNo,'spl_case'=>17);
        $user_info  =  $this->Registration_model->readmission_check($User_info_data); //$db->first("SELECT * FROM  Admission_online..tblinstitutes_all WHERE Inst_Cd = " .$user->inst_cd);

        if($user_info == false)
        {
            $this->session->set_flashdata('error', 'This Roll No. Result is not cancelled. Please Cancel result from 9th Branch Before proceeding!');
            redirect('Registration/ReAdmission');
            return;
        }
        else
        {
            $formno = $user_info[0]['formNo'];
            $OldRno = $user_info[0]['rno'];
            $year = 2015;
            $RegStdData = array('data'=>$this->Registration_model->EditEnrolement_data($formno,$year,$Inst_Id),'isReAdm'=>'1','Oldrno'=>$OldRno);

            $filledinfo['error'] = "";
            //$this->session->set_flashdata('isReAdm','1');
            $this->load->view('common/menu.php',$data);
            $this->load->view('Registration/9th/Edit_Enrolement_form.php',$RegStdData);   
            $this->commonfooter(array("files"=>array("jquery.maskedinput.js","validate.NewEnrolment.js"))); 
        }
    }
    public function EditForms()
    {
        // DebugBreak();
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $this->load->view('common/header.php',$userinfo);
        $data = array(
            'isselected' => '2',

        );
        $msg = $this->uri->segment(3);



        if($msg == FALSE){

            $error_msg = $this->session->flashdata('error');    
        }
        else{
            $error_msg = $msg;
        }

        $Logged_In_Array = $this->session->all_userdata();
        $user = $Logged_In_Array['logged_in'];
        $this->load->model('Registration_model');
        //  $error['grp_cd'] = $user['grp_cd'];
        $RegStdData = array('data'=>$this->Registration_model->EditEnrolement($user['Inst_Id']),'grp_cd'=>$user['grp_cd']);
        $RegStdData['msg_status'] = $error_msg;
        $userinfo = $Logged_In_Array['logged_in'];
        $this->load->view('common/header.php',$userinfo);
        $this->load->view('common/menu.php',$data);
        $this->load->view('Registration/9th/EditForms.php',$RegStdData);
        $this->load->view('common/footer.php');



    }
    public function BatchList()
    {
        // DebugBreak();
        $data = array(
            'isselected' => '2',

        );
        // $this->commonheader($data);
        $this->load->model('Registration_model');
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $userinfo['isselected'] = 2;
        $Inst_Id = $userinfo['Inst_Id'];
        //$page_name  = "Create Batch";
         if($this->session->flashdata('BatchList_error')){

            $error_msg = $this->session->flashdata('BatchList_error');    

        }
        else{
            $error_msg = '';
        }
        $data1 = array('Inst_Id'=>$Inst_Id);
        $user_info  =  $this->Registration_model->Batch_List($data1);
        $user_info_arr = array('info'=>$user_info,'errors'=>$error_msg);
        $this->load->view('common/header.php',$userinfo);
        $this->load->view('common/menu.php',$data);
        
        $this->load->view('Registration/9th/BatchList.php',$user_info_arr);


        $this->load->view('common/footer.php');
        //$this->commonheader($data);
        //  $this->load->view('Registration/9th/BatchList.php');
        //$this->commonfooter();
    }
    public function ProofReading()
    {
        $data = array(
            'isselected' => '2',

        );
        $this->commonheader($data);
        $this->load->view('Registration/9th/ProofReading.php');
        $this->commonfooter();
    }
    public function CreateBatch()
    {
        //DebugBreak();
        $data = array(
            'isselected' => '2',

        );
        $msg = $this->uri->segment(3);
        $spl_cd = $this->uri->segment(4);
        $grp_selected = $this->uri->segment(5);

        $this->load->library('session');
        if($this->session->flashdata('error')){

            $error_msg = $this->session->flashdata('error');    

        }
        else{
            $error_msg = 0;
        }


        $Logged_In_Array = $this->session->all_userdata();
        $user = $Logged_In_Array['logged_in'];
        $this->load->model('Registration_model');
        $myinfo = array('Inst_cd'=>$user['Inst_Id'],'spl_cd'=>$spl_cd,'grp_cd'=>$user['grp_cd'],'grp_selected'=>$grp_selected);
        $RegStdData = array('data'=>$this->Registration_model->Spl_case_std_list($myinfo),'spl_cd'=>$spl_cd,'grp_selected'=>$grp_selected);
        $RegStdData['msg_status'] = $error_msg;
        $RegStdData['spl_cd'] =  $spl_cd;
        $userinfo = $Logged_In_Array['logged_in'];
        $this->load->view('common/header.php',$userinfo);
        $this->load->view('common/menu.php',$data);

        $this->load->view('Registration/9th/CreateBatch.php',$RegStdData);
        $this->load->view('common/footer.php');



    }
    public function Make_Batch_Group_wise()
    {
        ///DebugBreak();
        $RegGrp = $this->uri->segment(3);
        $Spl_case = $this->uri->segment(4);

        $this->load->model('Registration_model');
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $userinfo['isselected'] = 2;
        $Inst_Id = $userinfo['Inst_Id'];
        $page_name  = "Create Batch";
        $User_info_data = array('Inst_Id'=>$Inst_Id,'RegGrp'=>$RegGrp,'spl_case'=>$Spl_case);
        $user_info  =  $this->Registration_model->user_info($User_info_data); 
        if($user_info == false)
        {
            $this->session->set_flashdata('error', '3');
            redirect('Registration/CreateBatch');
            return;
        }
        $is_gov            =  $user_info['info'][0]['IsGovernment'];  
        /*====================  Counting Fee  ==============================*/
        $processing_fee = 100;
        $reg_fee           = 1000;
        $Lreg_fee          = 0;
        $TotalRegFee = 0;
        $TotalLatefee = 0;
        $Totalprocessing_fee = 0;
        $netTotal = 0;
        /*====================  Counting Fee  ==============================*/    
        if(date('Y-m-d',strtotime(SINGLE_LAST_DATE))>=date('Y-m-d'))
        {
            $rule_fee   =  $this->Registration_model->getreulefee(1); 
            $lastdate  = date('Y-m-d',strtotime($rule_fee[0]['End_Date'] )) ;
        }
        else if($user_info['info'][0]['feedingDate'] != null)
        {
            $lastdate  = date('Y-m-d',strtotime($user_info['info'][0]['feedingDate'])) ;
            if(date('Y-m-d')<=$lastdate)
            {
                $rule_fee  =  $this->Registration_model->getreulefee(1); 
            }
        }
        else if(date('Y-m-d',strtotime(DOUBLE_LAST_DATE))>=date('Y-m-d'))
        {
            $rule_fee   =  $this->Registration_model->getreulefee(2); 
            $lastdate  = date('Y-m-d',strtotime($rule_fee[0]['End_Date'] )) ;
        }
        
        if($is_gov == 1 && $rule_fee[0]['Rule_Fee_ID'] ==1)
        {
            $reg_fee = 0;
            $Lreg_fee = $rule_fee[0]['Fine'];
            $processing_fee = $rule_fee[0]['Reg_Processing_Fee'];
        }
        else
        {
            $reg_fee = $rule_fee[0]['Reg_Fee'];
            $Lreg_fee = $rule_fee[0]['Fine'];
            $processing_fee = $rule_fee[0]['Reg_Processing_Fee'];

        }
        // DebugBreak();
        $q1 = $user_info['fee'];
        $total_std = 0;
        foreach($q1 as $k=>$v) 
        {
            $ids[] = $v["formNo"];
            $total_std++;
            
                
            
            if(date('Y-m-d', strtotime($v["edate"] ))<= $lastdate) 
            {
                
                if($is_gov == 1 && $rule_fee[0]['Rule_Fee_ID'] ==1)
                {
                    $reg_fee = 0;
                    $Lreg_fee = $rule_fee[0]['Fine'];
                    $processing_fee = $rule_fee[0]['Reg_Processing_Fee'];
                }
                else
                {
                    $reg_fee = $rule_fee[0]['Reg_Fee'];
                    $Lreg_fee = $rule_fee[0]['Fine'];
                    $processing_fee = $rule_fee[0]['Reg_Processing_Fee'];

                }
                
                if($v["Spec"] == 1 || $v["Spec"] ==  2)
                {
                    $reg_fee = 0;
                    $TotalLatefee = $TotalLatefee + $Lreg_fee;
                    $Totalprocessing_fee = $Totalprocessing_fee + $processing_fee;
                }
                else 
                {
                    
                    $TotalRegFee = $TotalRegFee + $reg_fee;
                    $TotalLatefee = $TotalLatefee + $Lreg_fee;
                    $Totalprocessing_fee = $Totalprocessing_fee + $processing_fee;
                } 
            } 
            else
            {
                $reg_fee = $rule_fee[0]['Reg_Fee'];
                $TotalRegFee = $TotalRegFee + $reg_fee;
                $TotalLatefee = $TotalLatefee + $Lreg_fee;
                $Totalprocessing_fee = $Totalprocessing_fee + $processing_fee;
            } // end of Else

            $netTotal = (int)$netTotal +$reg_fee + $Lreg_fee+$processing_fee;
        }


        $forms_id   = implode(",",$ids);        
        $tot_fee     = $Totalprocessing_fee+$TotalRegFee+$TotalLatefee;
        // $challan_No = 0;
        $today = date("Y-m-d H:i:s");
        $data = array('inst_cd'=>$Inst_Id,'total_fee'=>$tot_fee,'proces_fee'=>$processing_fee,'reg_fee'=>$reg_fee,'fine'=>$Lreg_fee,'TotalRegFee'=>$TotalRegFee,'TotalLatefee'=>$TotalLatefee,'Totalprocessing_fee'=>$Totalprocessing_fee,'forms_id'=>$forms_id,'todaydate'=>$today,'total_std'=>$total_std);
        $this->Registration_model->Batch_Insertion($data); 
        redirect('Registration/BatchList');
        return;
      
    }
    public function Make_Batch_Formwise()
    {
        //DebugBreak();
        if(!empty($_POST["chk"]))
        {

            $forms_id =   "'".implode("','",$_POST["chk"])."'";    
        }
        else{
            return;
        }

        $RegGrp = $this->uri->segment(3);
        $this->load->model('Registration_model');
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $userinfo['isselected'] = 2;
        $Inst_Id = $userinfo['Inst_Id'];
        $page_name  = "Create Batch";
        $User_info_data = array('Inst_Id'=>$Inst_Id,'forms_id'=>$forms_id);
        $user_info  =  $this->Registration_model->user_info_Formwise($User_info_data); //$db->first("SELECT * FROM  Admission_online..tblinstitutes_all WHERE Inst_Cd = " .$user->inst_cd);
        $is_gov            =  $user_info['info'][0]['IsGovernment'];  //getValue("IsGovernment", " Admission_online..tblinstitutes_all", "Inst_cd =".$user->inst_cd);
        /*====================  Counting Fee  ==============================*/
        $processing_fee = 0;
        $reg_fee           = 1000;
        $Lreg_fee          = 0;
        $TotalRegFee = 0;
        $TotalLatefee = 0;
        $Totalprocessing_fee = 0;
        $netTotal = 0;
        /*====================  Counting Fee  ==============================*/    
         if(date('Y-m-d',strtotime(SINGLE_LAST_DATE))>=date('Y-m-d'))
        {
            $rule_fee   =  $this->Registration_model->getreulefee(1); 
            $lastdate  = date('Y-m-d',strtotime($rule_fee[0]['End_Date'] )) ;
        }
        else if($user_info['info'][0]['feedingDate'] != null)
        {
            $lastdate  = date('Y-m-d',strtotime($user_info['info'][0]['feedingDate'])) ;
            if(date('Y-m-d')<=$lastdate)
            {
                $rule_fee  =  $this->Registration_model->getreulefee(1); 
            }
            else
            {
                $rule_fee  =  $this->Registration_model->getreulefee(2); 
            }
        }
        else if(date('Y-m-d',strtotime(DOUBLE_LAST_DATE))>=date('Y-m-d'))
        {
            $rule_fee   =  $this->Registration_model->getreulefee(2); 
            $lastdate  = date('Y-m-d',strtotime($rule_fee[0]['End_Date'] )) ;
        }
        
        if($is_gov == 1 && $rule_fee[0]['Rule_Fee_ID'] ==1)
        {
            $reg_fee = 0;
            $Lreg_fee = $rule_fee[0]['Fine'];
            $processing_fee = $rule_fee[0]['Reg_Processing_Fee'];
        }
        else
        {
            $reg_fee = $rule_fee[0]['Reg_Fee'];
            $Lreg_fee = $rule_fee[0]['Fine'];
            $processing_fee = $rule_fee[0]['Reg_Processing_Fee'];

        }
        // DebugBreak();
        $q1 = $user_info['fee'];
        $total_std = 0;
        foreach($q1 as $k=>$v) 
        {
            $ids[] = $v["formNo"];
            $total_std++;
            if(date('Y-m-d', strtotime($v["edate"] ))<= $lastdate) 
            {
                  if($is_gov == 1 &&   $rule_fee[0]['Rule_Fee_ID'] ==1)
                {
                    $reg_fee = 0;
                    $Lreg_fee = $rule_fee[0]['Fine'];
                    $processing_fee = $rule_fee[0]['Reg_Processing_Fee'];
                }
                else
                {
                    $reg_fee = $rule_fee[0]['Reg_Fee'];
                    $Lreg_fee = $rule_fee[0]['Fine'];
                    $processing_fee = $rule_fee[0]['Reg_Processing_Fee'];

                }
                if($v["Spec"] == 1 || $v["Spec"] ==  2)
                {
                    $reg_fee = 0;
                    $TotalLatefee = $TotalLatefee + $Lreg_fee;
                    $Totalprocessing_fee = $Totalprocessing_fee + $processing_fee;
                }
                else 
                {
                    $TotalRegFee = $TotalRegFee + $reg_fee;
                    $TotalLatefee = $TotalLatefee + $Lreg_fee;
                    $Totalprocessing_fee = $Totalprocessing_fee + $processing_fee;
                } 
            } 
            else
            {
                $reg_fee = $rule_fee[0]['Reg_Fee'];
                $TotalRegFee = $TotalRegFee + $reg_fee;
                $TotalLatefee = $TotalLatefee + $Lreg_fee;
                $Totalprocessing_fee = $Totalprocessing_fee + $processing_fee;
            } // end of Else

            $netTotal = (int)$netTotal +$reg_fee + $Lreg_fee+$processing_fee;
        }


        $forms_id   = implode(",",$ids);        
        $tot_fee     = $Totalprocessing_fee+$TotalRegFee+$TotalLatefee;
        // $challan_No = 0;
        $today = date("Y-m-d H:i:s");
        $data = array('inst_cd'=>$Inst_Id,'total_fee'=>$tot_fee,'proces_fee'=>$processing_fee,'reg_fee'=>$reg_fee,'fine'=>$Lreg_fee,'TotalRegFee'=>$TotalRegFee,'TotalLatefee'=>$TotalLatefee,'Totalprocessing_fee'=>$Totalprocessing_fee,'forms_id'=>$forms_id,'todaydate'=>$today,'total_std'=>$total_std);
        $this->Registration_model->Batch_Insertion($data); 
        redirect('Registration/BatchList');
        return;
    }
    public function FormPrinting()
    {

        $this->load->library('session');
        //DebugBreak();
        if(!( $this->session->flashdata('error'))){

            $error_msg = "0";    
        }
        else{
            $error_msg = $this->session->flashdata('error');
        }
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $this->load->view('common/header.php',$userinfo);
        $data = array(
            'isselected' => '2',
        );
        //  DebugBreak();
        $error = array();
        $error['excep'] = '';
        $error['gender'] = $userinfo['gender'];
        $error['isrural'] = $userinfo['isrural'];
        $error['error_msg'] = $error_msg;
        $this->commonheader($data);
        $this->load->view('Registration/9th/FormPrinting.php',$error);
        // $this->load->view('common/footer.php');
        $this->commonfooter(array("files"=>array("jquery.maskedinput.js","validate.NewEnrolment.js")));

        //$this->load->model('Registration_model');
    }
    private function set_barcode($code)
    {
        //DebugBreak()  ;
        //load library
        $this->load->library('zend');
        //load in folder Zend
        $this->zend->load('Zend/Barcode');


        $file = Zend_Barcode::draw('code128','image', array('text' => $code,'drawText'=>false), array());
        //$code = $code;
        $store_image = imagepng($file,BARCODE_PATH."{$code}.png");
        return $code.'.png';

    }
    public function return_pdf()
    {


        $Condition = $this->uri->segment(4);
        /*
        $Condition  1 == Batch Id wise printing.
        2 == Final Group wise prining.
        3 == Final Formno wise Printing.
        4 == Proof reading Group wise Printing.
        5 == Proof reading Formno wise Printing.
        */
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $user = $Logged_In_Array['logged_in'];
        $this->load->model('Registration_model');
        if($Condition == "1")
        {
            $Batch_Id = $this->uri->segment(3);
            $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'Batch_Id'=>$Batch_Id);
            $result = array('data'=>$this->Registration_model->return_pdf($fetch_data),'inst_Name'=>$user['inst_Name']);    
        }
        else if($Condition == "2")
        {
            $grp_cd = $this->uri->segment(3);
            $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'grp_cd'=>$grp_cd,'Batch_Id'=>0);
            $result = array('data'=>$this->Registration_model->Print_Form_Groupwise($fetch_data));

        }

        else if($Condition == "3")
        {
            $start_formno = $this->uri->segment(3);
            $end_formno = $this->uri->segment(5);


            $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'start_formno'=>$start_formno,'end_formno'=>$end_formno,'Batch_Id'=>0);
            $result = array('data'=>$this->Registration_model->Print_Form_Formnowise($fetch_data));
        }
        else if($Condition == "4")
        {
            $grp_cd = $this->uri->segment(3);
            $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'grp_cd'=>$grp_cd,'Batch_Id'=>-1);
            $result = array('data'=>$this->Registration_model->Print_Form_Groupwise($fetch_data),'inst_Name'=>$user['inst_Name']);

        }
        else if($Condition == "5")
        {
            $start_formno = $this->uri->segment(3);
            $end_formno = $this->uri->segment(5);
            $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'start_formno'=>$start_formno,'end_formno'=>$end_formno,'Batch_Id'=>-1);
            $result = array('data'=>$this->Registration_model->Print_Form_Formnowise($fetch_data),'inst_Name'=>$user['inst_Name']);

        }

        // DebugBreak();
        if(empty($result['data'])){
            $this->session->set_flashdata('error', $Condition);
            redirect('Registration/FormPrinting');
            return;

        }
        $temp = $user['Inst_Id'].'09-2016-18';
        $image =  $this->set_barcode($temp);
        // $pdf->Image(base_url().'assets/pdfs/'.'/'.$image,6.3,0.5, 1.8, 0.20, "PNG");
        //$studeninfo['data']['info'][0]['barcode'] = $image;
        $this->load->library('PDF_Rotate');


        $pdf = new PDF_Rotate('P','in',"A4");
        $pdf->Rotate(0,-1,-1);
        //   $pdf->SetFont('Arial','B',50);
        //             $pdf->SetTextColor(255,192,203);
        //             $pdf->Rotate(35,190,'W a t e r m a r k   d e m o',45);
        $pdf->AliasNbPages();
         if($Condition==4 or $Condition == 5)
                {
                    $pdf->SetTitle('Proof Print of Return');   
                }
                else
                {
                    $pdf->SetTitle('Final Print of Return');
                }
        
        
        $pdf->SetMargins(0.5,0.5,0.5);
        $lmargin =0.5;
        $rmargin =7.5;
        $topMargin = 0.5;
        $countofrecords=14;
        $title=1.0;
        $cnt=0; $ln[0]=1.5;
        $SR=1;
        while($cnt<15) 
        {
            $cnt++;
            $ln[$cnt]=$ln[$cnt-1]+ 0.6;  //0.5;
        }

        $i = 4;
        $result = $result['data'] ;
        // DebugBreak();
        foreach ($result as $key=>$data) 
        {
            //DebugBreak();
            //DebugBreak();
            $i++;
            $countofrecords=$countofrecords+1;
            if($countofrecords==15) {
                $countofrecords=0;

                $pdf->AddPage();

                //     $pdf->SetFont('Arial','B',50);
                //                 $pdf->SetTextColor(255,192,203);
                //                 $pdf->Rotate(35,190,'W a t e r m a r k   d e m o',45);


                if($Condition==4 or $Condition == 5)
                {
                    $pdf->Image( base_url().'assets/img/PROOF_READ.jpg' ,1,3.5 , 6,4 , "JPG");     
                }

                $pdf->SetFont('Arial','U',14);
                $pdf->SetXY( 0.4,0.2);
                $pdf->Cell(0, 0.2, "BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, GUJRANWALA", 0.25, "C");

                $pdf->SetFont('Arial','',10);
                $pdf->SetXY(1.7,0.4);
                $pdf->Cell(0, 0.25, "MATRIC PART-I ENROLMENT RETURN SESSION (2016-2018)", 0.25, "C");

                $pdf->SetFont('Arial','',10);
                $pdf->SetXY(2.6,0.4);
                $pdf->Image(BARCODE_PATH.$image,6.3,0.43, 1.8, 0.20, "PNG"); 
                $pdf->SetFont('Arial','',9);
                $pdf->SetXY(1.4,0.6);
                $pdf->Cell(0, 0.25,$user['Inst_Id']. "-". $user['inst_Name'], 0.25, "C");

                $pdf->SetFont('Arial','',10);
                $pdf->SetXY(6.9,0.8);
                $pdf->Cell(0, 0.25,  'Gender: '. ($data['sex']==1?"MALE":"FEMALE" ), 0.25, "C");
                $grp_name = $data["RegGrp"];
                switch ($grp_name) {
                    case '1':
                        $grp_name = 'SCIENCE WITH BIOLOGY';
                        break;
                    case '7':
                        $grp_name = 'SCIENCE  WITH COMPUTER SCIENCE';
                        break;
                    case '8':
                        $grp_name = 'SCIENCE  WITH ELECTRICAL WIRING';
                        break;
                    case '2':
                        $grp_name = 'Humanities';
                        break;
                    case '5':
                        $grp_name = 'Deaf and Dumb';
                        break;
                    default:
                        $grp_name = "No Group Selected.";
                }
                $pdf->SetFont('Arial','',10);
                $pdf->SetXY(2.5,0.8);
                $pdf->Cell(0, 0.25,  'Group: '.$grp_name, 0.25, "C");


                $pdf->rect($lmargin,1,$rmargin,10.5);                //the main rectangle box
                $cnt=-1;

                while($cnt<15) 
                { 
                    $cnt++;
                    $pdf->Line($lmargin, $ln[$cnt],$rmargin+.5,$ln[$cnt]);    
                }


                $col1=$lmargin+.3;    
                $col2=$col1+0.9;    
                $col3=$col2+1.8;
                $col4=$col3+1.1;    
                $col5=$col4+1.0;    
                $col6=$col5+1.8;

                $pdf->Line($col1,$title,$col1,$ln[15]);
                $pdf->Line($col2,$title,$col2,$ln[15]);
                $pdf->Line($col3,$title,$col3,$ln[15]);
                $pdf->Line($col4,$title,$col4,$ln[15]);
                $pdf->Line($col5,$title,$col5,$ln[15]);
                $pdf->Line($col6,$title,$col6,$ln[15]);

                $pdf->SetFont('Arial','B',9);
                $pdf->Text($lmargin+.03,$title+.3,"Sr#");    //$pdf->Text(3,3,"TEXT TO DISPLAY");
                $pdf->Text($col1+.2,$title+.3,"FormNo.");

                $pdf->Text($col2+.1,$title+.2,"Name / Father`s Name");
                $pdf->Text($col2+.1,$title+.4,"Mobile No");

                $pdf->Text($col3+.1,$title+.2,"Bay Form No"); 
                $pdf->Text($col3+.1,$title+.4,"Father CNIC");

                $pdf->Text($col4+.1,$title+.2,"Date Of Birth");
                $pdf->Text($col4+.1,$title+.31,"Relegion");
                $pdf->Text($col4+.1,$title+.45,"Old RNo-Year");

                $pdf->Text($col5+.1,$title+.3,"Subjects");

                $pdf->Text($col6+.1,$title+.3,"Picture");
            }
            $dob = date("d-m-Y", strtotime($data["Dob"]));
            $adm = date("d-m-Y", strtotime($data["edate"]));

            //============================ Values ==========================================            
            $pdf->SetFont('Arial','',10);    
            $pdf->Text($lmargin+.03  , $ln[$countofrecords]+0.3 , $SR);                 // Sr No
            $pdf->Text($col1+.05    , $ln[$countofrecords]+0.3,$data["formNo"]);       // Form No

            $pdf->SetFont('Arial','B',8);    
            $pdf->Text($col2+.1,$ln[$countofrecords]+0.2,strtoupper($data["name"]));
            $pdf->SetFont('Arial','',8);                
            $pdf->Text($col2+.1,$ln[$countofrecords]+0.4,strtoupper($data["Fname"]));
            $pdf->SetFont('Arial','',7.5);                
            $pdf->Text($col2+.1,$ln[$countofrecords]+0.55,$data["CellNo"]);
            $pdf->SetFont('Arial','',8);
            $pdf->Text($col3+.1,$ln[$countofrecords]+0.2,$data["BForm"]);
            $pdf->Text($col3+.1,$ln[$countofrecords]+0.4,$data["FNIC"]);

            $pdf->Text($col4+.1,$ln[$countofrecords]+0.2,$dob);
            $pdf->Text($col4+.1,$ln[$countofrecords]+0.4,$data["rel"]==1?"Muslim":"Non-Muslim");
            
            if($data["IsReAdm"] == '1' )
            $pdf->Text($col4+.1,$ln[$countofrecords]+0.55,strtoupper($data["oldRno_reg"]).'-'.$data["oldYear_reg"]);
            //$pdf->Text($col4+.1,$ln[$countofrecords]+0.55,'(Re-Admission)');
            else
            $pdf->Text($col4+.1,$ln[$countofrecords]+0.55,'(NEW)');

            $pdf->SetFont('Arial','B',7);    
            //            $pdf->Text($col5+.05,$ln[$countofrecords]+0.2,GroupName($data["Grp_Cd"]));
            $pdf->Text($col5+.05,$ln[$countofrecords]+0.2,  $data["sub1_abr"].','.$data["sub2_abr"].','.$data["sub3_abr"].','.$data["sub4_abr"]);
            $pdf->SetFont('Arial','',7);    
            $pdf->Text($col5+.05,$ln[$countofrecords]+0.4,$data["sub5_abr"].','.$data["sub6_abr"].','.$data["sub7_abr"].','.$data["sub8_abr"]);

            $pdf->Image(IMAGE_PATH.$data["Sch_cd"].'/'.$data["PicPath"],$col6+0.05,$ln[$countofrecords]+0.05 , 0.50, 0.50, "JPG"); 

            ++$SR;


            //Certified that I have checked all the relevant record of the students and the particulars as mentioned above are correct.
            $pdf->SetFont('Arial','',8);
            $pdf->Text($lmargin+.5,10.8,"Certified that I have checked all the relevant record of the students and the particulars as mentioned above are correct.");
            //$pdf->Text($lmargin+.5,11,"Signature _____________________");
            $pdf->SetFont('Arial','',10);
            $pdf->Text($rmargin-2.5,11.2,"_____________________________________");
            $pdf->Text($rmargin-2.5,11.4,"Signature of Head of Institution with Stamp");
            $pdf->Text($lmargin+0.5,11.4,'Print Date: '. date('d-m-Y H:i:s a'));    

        }
        $pdf->Output($data["Sch_cd"].'.pdf', 'I');
    }
    public function revenue_pdf()
    {
        $Batch_Id = $this->uri->segment(3);
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $user = $Logged_In_Array['logged_in'];
        $this->load->model('Registration_model');
        $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'Batch_Id'=>$Batch_Id);
        $temp = $user['Inst_Id'].'09-2016-18';
        $image =  $this->set_barcode($temp);
        
       //  DebugBreak();    
        $User_info_data = array('Inst_Id'=>$user['Inst_Id'],'RegGrp'=>@$RegGrp,'spl_case'=>@$Spl_case);
        $user_info  =  $this->Registration_model->getuser_info($User_info_data); 
        
        
        
        $isfine = 0;
              
        if(date('Y-m-d',strtotime(SINGLE_LAST_DATE))>=date('Y-m-d'))
        {
            $rule_fee[0]['isfine'] = 0; 
            $rule_fee  =  $this->Registration_model->getreulefee(1);
        }
        else if($user_info['info'][0]['feedingDate'] != null)
        {
            $lastdate  = date('Y-m-d',strtotime($user_info['info'][0]['feedingDate'])) ;
            if(date('Y-m-d')<=$lastdate)
            {
               
                $rule_fee  =  $this->Registration_model->getreulefee(1);
                 $rule_fee[0]['isfine'] = 0; 
            }
            else 
            {
                $rule_fee   =  $this->Registration_model->getreulefee(2);
                $rule_fee[0]['isfine'] = 1;
            }
        }
        else   if(date('Y-m-d',strtotime(DOUBLE_LAST_DATE))>=date('Y-m-d'))
        {
            $isfine = 1;
            $rule_fee   =  $this->Registration_model->getreulefee(2);
            $rule_fee[0]['isfine'] = 1; 
            $lastdate  = date('Y-m-d',strtotime($rule_fee[0]['End_Date'] )) ;
        }
        else
        {
             $isfine = 1;
            $rule_fee   =  $this->Registration_model->getreulefee(2);
            $rule_fee[0]['isfine'] = 1; 
            $lastdate  = date('Y-m-d',strtotime($rule_fee[0]['End_Date'] )) ;
        }
        


        $data = array('data'=>$this->Registration_model->revenue_pdf($fetch_data),'inst_Name'=>$user['inst_Name'],'inst_cd'=>$user['Inst_Id'],'barcode'=>$image,"rulefee"=>$rule_fee);
        $this->load->view('Registration/9th/RevenueForm.php',$data);
    }
    public function commonheader($data)
    {
        $this->load->view('common/header.php',$data);
        $this->load->view('common/menu.php',$data);
    } 
    public function commonfooter($data)
    {
        $this->load->view('common/footer.php',$data);
    }
    public function Print_Registration_Form_Proofreading_Groupwise()
    {

        //  DebugBreak();
        $Condition = $this->uri->segment(4);

        $this->load->library('session');

        $Logged_In_Array = $this->session->all_userdata();
        $user = $Logged_In_Array['logged_in'];
        $this->load->model('Registration_model');

        if($Condition == "1")
        {
            $grp_cd = $this->uri->segment(3);
            $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'grp_cd'=>$grp_cd,'Batch_Id'=>-1);
            $result = array('data'=>$this->Registration_model->Print_Form_Groupwise($fetch_data),'inst_Name'=>$user['inst_Name']);
        }
        else if($Condition == "2")
        {
            $start_formno = $this->uri->segment(3);
            $end_formno = $this->uri->segment(5);
            $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'start_formno'=>$start_formno,'end_formno'=>$end_formno,'Batch_Id'=>-1);
            $result = array('data'=>$this->Registration_model->Print_Form_Formnowise($fetch_data),'inst_Name'=>$user['inst_Name']);
            //Print_Form_Formnowise
        }


        if(empty($result['data'])){
            $this->session->set_flashdata('error', $Condition);
            redirect('Registration/FormPrinting');
            return;

        }


        $this->load->library('PDF_Rotate');


        $pdf = new PDF_Rotate('P','in',"A4");
        //      $this->load->library('PDFF');
        //        $pdf=new PDFF('P','in',"A4");  
         $pdf->AliasNbPages();
        $pdf->SetMargins(0.5,0.5,0.5);
        $grp_cd = $this->uri->segment(3);
       
        $pdf->SetTitle('Proof Print Registration From');

        $fontSize = 10;
        $marge    = .4;   // between barcode and hri in pixel
        $x        = 7.5;  // barcode center
        $y        = 1.2;  // barcode center
        $height   = 0.35;   // barcode height in 1D ; module size in 2D
        $width    = .013;  // barcode height in 1D ; not use in 2D
        $angle    = 0;   // rotation in degrees

        $type     = 'code128';
        $black    = '000000'; // color in hex
        // DebugBreak();
        $result = $result['data'] ;
        //if(!empty($result)):
        foreach ($result as $key=>$data) 
        {

            //First Page ---class instantiation    
            //$pdf = new FPDF_BARCODE("P","in","A4");
            $pdf->AddPage();
            $Y = 0.5;
           

            $pdf->SetFillColor(0,0,0);
            $pdf->SetDrawColor(0,0,0); 
            
            $temp = $data['formNo'].'@09@2016@1';
            $image =  $this->set_barcode($temp);
            $pdf->Image(BARCODE_PATH.$image,6.0, 1.2  ,1.8,0.20,"PNG");
            $pdf->SetFont('Arial','U',16);
            $pdf->SetXY( 1.2,0.2);
            $pdf->Cell(0, 0.2, "Board Of Intermediate and Secondary Education,Gujranwala", 0.25, "C");
            $pdf->Image(base_url()."assets/img/logo.jpg",0.05,0.2, 0.75,0.75, "JPG", "http://www.bisegrw.com");


            $pdf->SetFont('Arial','',10);
            $pdf->SetXY(1.7,0.4);
            $pdf->Cell(0, 0.25, " REGISTRATION FORM FOR SSC/MATRIC SESSION 2016-2018", 0.25, "C");
            $pdf->Image(base_url(). 'assets/img/PROOF_READ.jpg' ,1,3.5 , 6,4 , "JPG");     
            //--------------- Proof Read
            $ProofReed = "(PROOF READ) (Not for Board) ";
            $pdf->SetXY(3,0.8);
            $pdf->SetFont("Arial",'',12);
            $pdf->Cell(0, 0.25, $ProofReed  ,0,'C');

            //--------------------------- Form No & Rno
            $pdf->SetXY(0.2,0.5+$Y);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Form No: _______________",0,'L');

            $pdf->SetXY(0.8,0.5+$Y);
            $pdf->SetFont('Arial','IB',12);
            $pdf->Cell( 0.5,0.5,$data['formNo'],0,'L');

            //--------------------------- Institution Code and Name   $user['Inst_Id']. "-". $user['inst_Name']
            $pdf->SetXY(0.2,0.85+$Y);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Institution Code/Name:",0,'L');
           
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(1.75,0.85+$Y);
           // $pdf->MultiCell(20, .5, $user['Inst_Id']."-".$user['inst_Name'], 0);
            $pdf->Cell(0.5,0.5,  $user['Inst_Id']. "-". $user['inst_Name'],0,'L');    

            //------ Picture Box on Centre      
            $pdf->SetXY(6.8, $Y +1.75);
            $pdf->Cell(1.25,1.4,'',1,0,'C',0);
           
            $pdf->Image(IMAGE_PATH.$data["Sch_cd"].'/'.$data["PicPath"],6.8, 1.75+ $Y, 1.25, 1.4, "JPG"); 
            $pdf->SetFont('Arial','',10);

            //------------- Personal Infor Box
            //====================================================================================================================

            $x = 0.55;
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(0.2,1.28+$Y);
            $pdf->SetFillColor(240,240,240);
            $pdf->Cell(8,0.3,'PERSONAL INFORMATION',1,0,'L',1);
            $Y = 0.3;
            //--------------------------- 1st line 
            $pdf->SetFont('Arial','',10);
            $pdf->SetXY(0.5,1.65+$Y);
            $pdf->Cell( 0.5,0.5,"Name:",0,'L');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(1.5,1.65+$Y);
            $pdf->Cell(0.5,0.5,  strtoupper($data["name"]),0,'L');
            //--------------------------- FATHER NAME 
            $pdf->SetXY(3.5+$x,1.65+$Y);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Father Name:.",0,'L');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(4.5+$x,1.65+$Y);
            $pdf->Cell(0.5,0.5, strtoupper($data["Fname"]),0,'L');


            //--------------------------- 3rd line 
            $pdf->SetXY(0.5,$Y+ 2);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Date Of Birth:",0,'L');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(1.5,2+$Y);

            $pdf->Cell(0.5,0.5,date('d-m-Y', strtotime($data['Dob'])),0,'L');     
            //    $pdf->Cell(0.5,0.5,$data["Rel"]==1?"Muslim":"Non-Muslim",0,'L');

            $pdf->SetXY(3.5+$x,2+$Y);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Gender:",0,'L');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(4.5+$x,2+$Y);
            $pdf->Cell(0.5,0.5,$data["sex"]==1?"MALE":"FEMALE",0,'L');            
            //--------------------------- BAY FORM NO line 
            $pdf->SetXY(0.5,$Y+2.35);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Bay Form No:",0,'L');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(1.5,$Y+2.35);
            $pdf->Cell(0.5,0.5,$data["BForm"],0,'L');


            $pdf->SetXY(3.5+$x,$Y+2.35);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell(0.5,0.5,"Father CNIC:",0,'R');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(4.5+$x,$Y+2.35);
            $pdf->Cell(0.5,0.5,$data["FNIC"],0,'L');
            //---------------------------  
            $spl_casename = 'NONE';
            if($data["Spec"] == 0)
            {
                $spl_casename = 'NONE';
            }
            else  if($data["Spec"] == 1)
            {
                $spl_casename = 'Deaf & Dumb';  
            }
            else  if($data["Spec"] == 2)
            {
                $spl_casename = 'Board Employee';
            }


            $pdf->SetXY(0.5,$Y+2.7);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Speciality:",0,'L');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(1.5,$Y+2.7);
            $pdf->Cell(0.5,0.5, ($spl_casename),0,'L');

            $pdf->SetXY(3.5+$x,$Y+2.7);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell(0.5,0.5,"Locality:",0,'R');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(4.5+$x,$Y+2.7);
            $pdf->Cell(0.5,0.5,$data["RuralORUrban"]==1?"Urban":"Rural",0,'L');

            //--------------------------- Gender Nationality 
            $pdf->SetXY(0.5,$Y+3.05);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Medium:",0,'L');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(1.5,$Y+3.05);
            $pdf->Cell(0.5,0.5,$data["med"]==1?"Urdu":"English",0,'L');            

            $pdf->SetXY(3.5+$x,$Y+3.05);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Nationality:",0,'L');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(4.5+$x,$Y+3.05);
            $pdf->Cell(0.5,0.5,$data["nat"]==1?"PAKISTANI":"NON-PAKISTANI",0,'R');             
            //--------------------------- id mark and Medium 
            $pdf->SetXY(0.5,$Y+3.40);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Ident Mark:",0,'L');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(1.5,$Y+3.40);
            $pdf->Cell(0.5,0.5,$data["markOfIden"],0,'L');

            $pdf->SetXY(3.5+$x,$Y+3.40);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Religion:",0,'L');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(4.5+$x,$Y+3.40);
            $pdf->Cell(0.5,0.5,$data["rel"]==1?"Muslim":"Non-Muslim",0,'L');            
            //             $pdf->Cell(0.5,0.5, $data["MobNo"],0,'L');
            //----- Contact No.    
            $pdf->SetXY(0.5,$Y+3.75);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Mobile No:",0,'L');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(1.5,$Y+3.75);
            $pdf->Cell(0.5,0.5, $data["CellNo"],0,'L');


            $pdf->SetXY(0.5,$Y+4.1);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Address:",0,'L');
            $pdf->SetFont('Arial','b',10);
            $pdf->SetXY(1.5,$Y + 4.1);
            $pdf->Cell(0.5,0.5, strtoupper($data["addr"]),0,'L');
            //========================================  Exam Info ===============================================================================            
            $sY = -1.2;//0.5;
            $pdf->SetXY(0.2,6.1+$sY);
            $pdf->SetFillColor(240,240,240);
            $pdf->Cell(8,0.3,'SUBJECT INFORMATION',1,0,'L',1);

            //--------------------------- Subject Group
            $grp_name = $data["RegGrp"];
            switch ($grp_name) {
                case '1':
                    $grp_name = 'SCIENCE WITH BIOLOGY';
                    break;
                case '7':
                    $grp_name = 'SCIENCE  WITH COMPUTER SCIENCE';
                    break;
                case '8':
                    $grp_name = 'SCIENCE  WITH ELECTRICAL WIRING';
                    break;
                case '2':
                    $grp_name = 'Humanities';
                    break;
                case '5':
                    $grp_name = 'Deaf and Dumb';
                    break;
                default:
                    $grp_name = "No Group Selected.";
            }
            $pdf->SetXY(0.5,6.45+$sY);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Subject Group:",0,'L');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(1.5,6.45+$sY);
            $pdf->Cell(0.5,0.5, ($grp_name),0,'L');

            $y = $sY - 0.3;
            $x = 1;
            //--------------------------- Subjects
            $pdf->SetFont('Arial','',10);
            //DebugBreak();
            //------------- sub 1 & 5
            $pdf->SetXY(0.5,7.05+$y);
            $pdf->Cell(0.5,0.5, '1. '.($data['sub1_NAME']),0,'L');
            $pdf->SetXY(3+$x,7.05+$y);
            $pdf->Cell(0.5,0.5, '5. '.($data['sub5_NAME']),0,'L');
            //------------- sub 2 & 6
            $pdf->SetXY(0.5,7.35+$y);
            $pdf->Cell(0.5,0.5, '2. '.($data['sub2_NAME']),0,'L');
            $pdf->SetXY(3+$x,7.35+$y);
            $pdf->Cell(0.5,0.5, '6. '.($data['sub6_NAME']),0,'R');
            //------------- sub 3 & 7
            $pdf->SetXY(0.5,7.70+$y);
            $pdf->Cell(0.5,0.5,  '3. '.($data['sub3_NAME']),0,'L');
            $pdf->SetXY(3+$x,7.70+$y);
            $pdf->Cell(0.5,0.5, '7. '.($data['sub7_NAME']),0,'R');
            //------------- sub 4 & 8
            $pdf->SetXY(0.5,8.05+$y);
            $pdf->Cell(0.5,0.5, '4. '.($data['sub4_NAME']),0,'L');
            $pdf->SetXY(3+$x,8.05+$y);
            $pdf->Cell(0.5,0.5, '8. '.($data['sub8_NAME']),0,'L');


            $pdf->SetFont('Arial','UI',10);  
            $pdf->SetXY(5.6,  6.9);
            $date = strtotime($data['edate']); 
            $pdf->Cell(8,0.24,'Feeding Date: '. date('d-m-Y h:i:s a', $date) ,0,'L','');

            //date_format($$data['EDate'], 'd/m/Y H:i:s');

            $pdf->SetXY(5.6,  7.2);
            $pdf->Cell(8,0.24,'Print Date: '. date('d-m-Y h:i:s a'),0,'L','');

            //======================================================================================
        }

        $pdf->Output($data["Sch_cd"].'.pdf', 'I');
    }
    function convertImage($originalImage, $outputImage, $quality,$ext)
    {

        if (preg_match('/jpg|jpeg/i',$ext))
            $imageTmp=imagecreatefromjpeg($originalImage);
        else if (preg_match('/png/i',$ext))
            $imageTmp=imagecreatefrompng($originalImage);
            else if (preg_match('/gif/i',$ext))
                $imageTmp=imagecreatefromgif($originalImage);
                else if (preg_match('/bmp/i',$ext))
                    $imageTmp=imagecreatefrombmp($originalImage);
                    else
                        return 0;

        imagejpeg($imageTmp, $outputImage, $quality);
        imagedestroy($imageTmp);

        return 1;
    }
    function frmvalidation($viewName,$allinputdata,$isupdate)
    {
         $_POST['address']  = str_replace("'", "", $_POST['address'] );
          $subjectslang = array('22','23','36','34','35');
          $subjectshis = array('20','21','19');
          
          $cntzero = substr_count(@$_POST['bay_form'],"0");
          $cntone = substr_count(@$_POST['bay_form'],"1");
          $cnttwo = substr_count(@$_POST['bay_form'],"2");
          $cntthr = substr_count(@$_POST['bay_form'],"3");
          $cntfour = substr_count(@$_POST['bay_form'],"4");
          $cntfive = substr_count(@$_POST['bay_form'],"5");
          $cntsix = substr_count(@$_POST['bay_form'],"6");
          $cntseven = substr_count(@$_POST['bay_form'],"7");
          $cnteight = substr_count(@$_POST['bay_form'],"8");
          $cntnine = substr_count(@$_POST['bay_form'],"9");
          
          
        if(@$_POST['dob'] != null || $allinputdata['Dob'] != null)
        {
            $date = new DateTime(@$_POST['dob']);
            $convert_dob = $date->format('Y-m-d');     
        }

        if(@$_POST['cand_name'] == ''  || ($allinputdata['name'] == '' && $isupdate ==1)  )
        {
            $allinputdata['excep'] = 'Please Enter Your Name';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Registration/'.$viewName);
            return;

        }
        //(strpos($a, 'are') !== false)
       /* if ((strpos(@$_POST['cand_name'], 'MOHAMMAD') !== false)|| (strpos(@$_POST['cand_name'], 'MOHAMAD') !== false) || (strpos(@$_POST['cand_name'], 'MOHD') !== false) || (strpos(@$_POST['cand_name'], 'MUHAMAD') !== false) || (strpos(@$_POST['cand_name'], 'MOOHAMMAD') !== false)|| (strpos(@$_POST['cand_name'], 'MOOHAMAD') !== false))
        {
            $allinputdata['excep'] = 'MUHAMMAD Spelling is not Correct in Name';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Registration/'.$viewName);
            return;

        }

        else*/ if (@$_POST['father_name'] == ''  || ($allinputdata['Fname'] == '' && $isupdate ==1) )
        {
            $allinputdata['excep'] = 'Please Enter Your Father Name';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Registration/'.$viewName);
            return;

        }
      /*  if ((strpos(@$_POST['father_name'], 'MOHAMMAD') !== false)|| (strpos(@$_POST['father_name'], 'MOHAMAD') !== false) || (strpos(@$_POST['father_name'], 'MUHAMAD') !== false) || (strpos(@$_POST['father_name'], 'MOOHAMMAD') !== false)|| (strpos(@$_POST['father_name'], 'MOOHAMAD') !== false))
        {
            $allinputdata['excep'] = 'MUHAMMAD Spelling is not Correct in Fathers Name';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Registration/'.$viewName);
            return;

        }*/

        else if(@$_POST['bay_form'] == ''  || ($allinputdata['BForm'] == '' && $isupdate ==1) )
        {
            $allinputdata['excep'] = 'Please Enter Your Bay Form No.';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Registration/'.$viewName);
            return;


        }
        else if( (@$_POST['bay_form'] == '00000-0000000-0') || (@$_POST['bay_form'] == '11111-1111111-1') || (@$_POST['bay_form'] == '22222-2222222-2') || (@$_POST['bay_form'] == '33333-3333333-3') || (@$_POST['bay_form'] == '44444-4444444-4')
            || (@$_POST['bay_form'] == '55555-5555555-5') || (@$_POST['bay_form'] == '66666-6666666-6') || (@$_POST['bay_form'] == '77777-7777777-7') || (@$_POST['bay_form'] == '88888-8888888-8') || (@$_POST['bay_form'] == '99999-9999999-9') ||
            (@$_POST['bay_form'] == '00000-1111111-0') || (@$_POST['bay_form'] == '00000-1111111-1') || (@$_POST['bay_form'] == '00000-0000000-1' || $cntzero >7 || $cntone >7 || $cnttwo >7 || $cntfour >7 || $cntthr >7 || $cntfive >7 || $cntsix >7 || $cntseven >7 || $cnteight >7 || $cntnine >7)
            )
            {
                $allinputdata['excep'] = 'Please Enter Your Correct Bay Form No.';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Registration/'.$viewName);
                return;

            }
           /* else if($this->Registration_model->bay_form_comp(@$_POST['bay_form']) == true && $isupdate ==0 )
            {
                // DebugBreak();
                $allinputdata['excep'] = 'This Bay Form is already Feeded.';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Registration/'.$viewName);
                return;



            }*/
             else if(@$_POST['oldbform'] !=  @$_POST['bay_form'] && $isupdate ==1 )
            {
                // DebugBreak();
                if($this->Registration_model->bay_form_comp(@$_POST['bay_form']) == true )
                {
                    // DebugBreak();
                    $allinputdata['excep'] = 'This Bay Form is already Feeded.';
                    $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                    redirect('Registration/'.$viewName);
                    return;
                }
                else if($this->Registration_model->bay_form_fnic(@$_POST['bay_form'],@$_POST['father_cnic']) == true  )
                {
                    // DebugBreak();
                    $allinputdata['excep'] = 'This Form is already Feeded.';
                    $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                    redirect('Registration/'.$viewName);
                    return;
                }
            }
            else if($this->Registration_model->bay_form_fnic(@$_POST['bay_form'],@$_POST['father_cnic']) == true && $isupdate ==0 )
            {
                // DebugBreak();
                $allinputdata['excep'] = 'This Form is already Feeded.';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Registration/'.$viewName);
                return;



            }
            else if($this->Registration_model->bay_form_fnic_dob_comp(@$_POST['bay_form'],@$_POST['father_cnic'],$convert_dob) == true && $isupdate == 0 )
            {
                // DebugBreak();
                $allinputdata['excep'] = 'This Form is already Feeded.';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Registration/'.$viewName);
                return;



            }

            else if(@$_POST['father_cnic'] == '' || ($allinputdata['FNIC'] == '' && $isupdate ==1)  )
            {
                $allinputdata['excep'] = 'Please Enter Your Father CNIC';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Registration/'.$viewName);
                return;


            }
            else if((@$_POST['bay_form'] == @$_POST['father_cnic']) || (@$_POST['father_cnic'] == @$_POST['bay_form']) )
            {
                $allinputdata['excep'] = 'Your Bay Form and FNIC No. are not same';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Registration/'.$viewName);
                return;


            }
            else if (@$_POST['dob'] == ''  || ($allinputdata['Dob'] == ''   && $isupdate ==1) )
            {
                $allinputdata['excep'] = 'Please Enter Your  Date of Birth';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Registration/'.$viewName);
                return;

            }
            else if(@$_POST['mob_number'] == '')
            {
                $allinputdata['excep'] = 'Please Enter Your Mobile Number';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Registration/'.$viewName);
                return;

            }
            else if(@$_POST['medium'] == 0)
            {
                $allinputdata['excep'] = 'Please Select Your Medium';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Registration/'.$viewName);
                return;

            }
            else if(@$_POST['Inst_Rno']== '')
            { 
                $allinputdata['excep'] = 'Please Enter Your Roll Number';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Registration/'.$viewName);
                return;

            }
            else if(@$_POST['MarkOfIden']== '')
            {
                $allinputdata['excep'] = 'Please Enter Your Mark of Identification';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Registration/'.$viewName);
                return;

            }

            /* else if((@$_POST['speciality'] != '0')or (@$_POST['speciality'] != '1') or (@$_POST['speciality'] != '2'))
            {
            $error['excep'] = 'Please Enter Your Speciality';
            $this->load->view('Registration/9th/NewEnrolment.php',$error);
            }*/
            else if((@$_POST['medium'] != '1') and (@$_POST['medium'] != '2') )
            {
                $allinputdata['excep'] = 'Please Select Your medium';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Registration/'.$viewName);
                return;

            }
            else if((@$_POST['nationality'] != '1') and (@$_POST['nationality'] != '2') )
            {
                $allinputdata['excep'] = 'Please Select Your Nationality';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Registration/'.$viewName);
                return;

            }
            else if((@$_POST['gender'] != '1') and (@$_POST['gender'] != '2'))
            {
                $allinputdata['excep'] = 'Please Select Your Gender';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Registration/'.$viewName);
                return;

            }
            else if((@$_POST['hafiz']!= '1') and (@$_POST['hafiz']!= '2'))
            {
                $allinputdata['excep'] = 'Please Select Your Hafiz-e-Quran option';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Registration/'.$viewName);
                return;

            }
            else if((@$_POST['religion'] != '1') and (@$_POST['religion'] != '2'))
            {
                $allinputdata['excep'] = 'Please Select Your religion';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Registration/'.$viewName);
                return;

            }
            else if((@$_POST['UrbanRural'] != '1') and (@$_POST['UrbanRural'] != '2'))
            {
                $allinputdata['excep'] = 'Please Select Your Residency';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Registration/'.$viewName);
                return;

            }
            else if(@$_POST['address'] =='')
            {
                $allinputdata['excep'] = 'Please Enter Your Address';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Registration/'.$viewName);
                return;

            }
            else if(@$_POST['std_group'] == 0)
            {
                $allinputdata['excep'] = 'Please Select Your Study Group';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Registration/'.$viewName);
                return;

            }
            else if((@$_POST['std_group'] == 1) && ((@$_POST['sub5']!=5) || (@$_POST['sub6']!=6)||(@$_POST['sub7']!=7)|| (@$_POST['sub8']!=8)))
            {

                $allinputdata['excep'] = 'Subjects not according to Group';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Registration/'.$viewName);
                return;

            }
            else if((@$_POST['std_group'] == 7)&& ((@$_POST['sub5']!=5) || (@$_POST['sub6']!=6)||(@$_POST['sub7']!=7)|| (@$_POST['sub8']!=78)))
            {

                $allinputdata['excep'] = 'Subjects not according to Group';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Registration/'.$viewName);
                return;

            }
            else if((@$_POST['std_group'] == 8)&& ((@$_POST['sub5']!=5) || (@$_POST['sub6']!=6)||(@$_POST['sub7']!=7)|| (@$_POST['sub8']!=43)))
            {

                $allinputdata['excep'] = 'Subjects not according to Group';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Registration/'.$viewName);
                return;

            }
            else if((@$_POST['std_group'] == 2) && ((@$_POST['sub5']==5) || (@$_POST['sub6']==6)||(@$_POST['sub7']==7)|| (@$_POST['sub8']==43) || (@$_POST['sub8']==8)))
            {
                $allinputdata['excep'] = 'Subjects not according to Group';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Registration/'.$viewName);
                return;

            }
            
            else if((@$_POST['std_group'] == 5)&& ((@$_POST['sub5']==5) || (@$_POST['sub6']==6)||(@$_POST['sub7']==7)|| (@$_POST['sub8']==43) || (@$_POST['sub8']==8)))
            {
                $allinputdata['excep'] = 'Subjects not according to Group';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Registration/'.$viewName);
                return;

            }

            else if((@$_POST['sub1'] == @$_POST['sub2']) ||(@$_POST['sub1'] == @$_POST['sub3'])||(@$_POST['sub1'] == @$_POST['sub4'])||(@$_POST['sub1'] == @$_POST['sub5'])||(@$_POST['sub1'] == @$_POST['sub6'])||(@$_POST['sub1'] == @$_POST['sub7'])||
                (@$_POST['sub1'] == @$_POST['sub8']))
                {
                    $allinputdata['excep'] = 'Please Select Different Subjects';
                    $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                    redirect('Registration/'.$viewName);
                    return;

                }
                else if((@$_POST['sub2'] == @$_POST['sub1']) ||(@$_POST['sub2'] == @$_POST['sub3'])||(@$_POST['sub2'] == @$_POST['sub4'])||(@$_POST['sub2'] == @$_POST['sub5'])||(@$_POST['sub2'] == @$_POST['sub6'])||(@$_POST['sub2'] == @$_POST['sub7'])                         ||(@$_POST['sub2'] == @$_POST['sub8'])
                    )
                    {
                        $allinputdata['excep'] = 'Please Select Different Subjects';
                        $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                        redirect('Registration/'.$viewName);
                        return;

                    }
                    else if((@$_POST['sub3'] == @$_POST['sub1']) ||(@$_POST['sub3'] == @$_POST['sub2'])||(@$_POST['sub3'] == @$_POST['sub4'])||(@$_POST['sub3'] == @$_POST['sub5'])||(@$_POST['sub3'] == @$_POST['sub6'])||(@$_POST['sub3'] == @$_POST['sub7'])||(@$_POST['sub3'] == @$_POST['sub8'])
                        )
                        {
                            $allinputdata['excep'] = 'Please Select Different Subjects';
                            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                            redirect('Registration/'.$viewName);
                            return;

                        }
                        else if((@$_POST['sub4'] == @$_POST['sub1']) ||(@$_POST['sub4'] == @$_POST['sub3'])||(@$_POST['sub4'] == @$_POST['sub2'])||(@$_POST['sub4'] == @$_POST['sub5'])||(@$_POST['sub4'] == @$_POST['sub6'])||(@$_POST['sub4'] == @$_POST[                                 'sub7'])||(@$_POST['sub4'] == @$_POST['sub8']))
                        {
                            $allinputdata['excep'] = 'Please Select Different Subjects';
                            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                            redirect('Registration/'.$viewName);
                            return;

                        }
                        else if((@$_POST['sub5'] == @$_POST['sub1']) ||(@$_POST['sub5'] == @$_POST['sub3'])||(@$_POST['sub5'] == @$_POST['sub4'])||(@$_POST['sub5'] == @$_POST['sub2'])||(@$_POST['sub5'] == @$_POST['sub6'])||(@$_POST['sub5'] == @$_POST['sub7'])||(@$_POST['sub5'] == @$_POST['sub8']))
                        {
                            $allinputdata['excep'] = 'Please Select Different Subjects';
                            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                            redirect('Registration/'.$viewName);
                            return;

                        }
                        else if((@$_POST['sub6'] == @$_POST['sub1']) ||(@$_POST['sub6'] == @$_POST['sub3'])||(@$_POST['sub6'] == @$_POST['sub4'])||(@$_POST['sub6'] == @$_POST['sub5'])||(@$_POST['sub6'] == @$_POST['sub2'])||(@$_POST['sub6'] ==                                          @$_POST['sub7'])||(@$_POST['sub6'] == @$_POST['sub8']))
                        {
                            $allinputdata['excep'] = 'Please Select Different Subjects';
                            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                            redirect('Registration/'.$viewName);
                            return;

                        }
                        else if((@$_POST['sub7'] == @$_POST['sub1']) ||(@$_POST['sub7'] == @$_POST['sub3'])||(@$_POST['sub7'] == @$_POST['sub4'])||(@$_POST['sub7'] == @$_POST['sub5'])||(@$_POST['sub7'] == @$_POST['sub6'])||(@$_POST['sub7'] == @$_POST['sub2'])||(@$_POST['sub7'] == @$_POST['sub8']))
                        {
                            $allinputdata['excep'] = 'Please Select Different Subjects';
                            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                            redirect('Registration/'.$viewName);
                            return;

                        }
                        else if((@$_POST['sub8'] == @$_POST['sub1']) ||(@$_POST['sub8'] == @$_POST['sub3'])||(@$_POST['sub8'] == @$_POST['sub4'])||(@$_POST['sub8'] == @$_POST['sub5'])||(@$_POST['sub8'] == @$_POST['sub6'])||(@$_POST['                                                   sub8'] == @$_POST['sub7'])||(@$_POST['sub8'] == @$_POST['sub2']))
                        {
                            $allinputdata['excep'] = 'Please Select Different Subjects';
                            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                            redirect('Registration/'.$viewName);
                            return;

                        }
                          else if (in_array($_POST['sub8'], $subjectslang) && in_array($_POST['sub7'], $subjectslang))
                        {
                            $allinputdata['excep'] = 'Double Language is not Allowed Please choose a different Subject';
                            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                            redirect('Registration/'.$viewName);
                            return;
                        }
                         else if (in_array($_POST['sub8'], $subjectshis) && in_array($_POST['sub7'], $subjectshis))
                        {
                             $allinputdata['excep'] = 'Double History is not Allowed Please choose a different Subject';
                            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                            redirect('Registration/'.$viewName);
                            return;
                        }
                        else if(@$_POST['sub6'] == @$_POST['sub8'])
                        {
                            $allinputdata['excep'] = 'Please Select Different Subjects';
                            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                            redirect('Registration/'.$viewName);
                            return;

                        }
                        else if(@$_POST['sub7'] == @$_POST['sub8'])
                        {
                            $allinputdata['excep'] = 'Please Select Different Subjects';
                            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                            redirect('Registration/'.$viewName);
                            return;

                        }

                        else if(@$_POST['sub1'] == 0)
                        {
                            $allinputdata['excep'] = 'Please Select Subject 1';
                            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                            redirect('Registration/'.$viewName);
                            return;

                        }
                        else if(@$_POST['sub2'] == 0)
                        {
                            $allinputdata['excep'] = 'Please Select Subject 2';
                            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                            redirect('Registration/'.$viewName);
                            return;
                        }
                        else if(@$_POST['sub3'] == 0)
                        {
                            $allinputdata['excep'] = 'Please Select Subject 3';
                            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                            redirect('Registration/'.$viewName);
                            return;

                        }
                        else if(@$_POST['sub4'] == 0)
                        {
                            $allinputdata['excep'] = 'Please Select Subject 4';
                            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                            redirect('Registration/'.$viewName);
                            return;

                        }

                        else if(@$_POST['sub5'] == 0)
                        {
                            $allinputdata['excep'] = 'Please Select Subject 5';
                            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                            redirect('Registration/'.$viewName);
                            return;

                        }
                        else if(@$_POST['sub6'] == 0)
                        {
                            $allinputdata['excep'] = 'Please Select Subject 6';
                            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                            redirect('Registration/'.$viewName);
                            return;

                        }
                        else if(@$_POST['sub7'] == 0)
                        {
                            $allinputdata['excep'] = 'Please Select Subject 7';
                            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                            redirect('Registration/'.$viewName);
                            return;

                        }
                        else if(@$_POST['sub8'] == 0)
                        {
                            $allinputdata['excep'] = 'Please Select Subject 8';
                            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                            redirect('Registration/'.$viewName);
                            return;

                        }
    }  
        public function EditPicForms()
    {
        // DebugBreak();
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $this->load->view('common/header.php',$userinfo);
        $data = array(
            'isselected' => '2',

        );
        $msg = $this->uri->segment(3);



        if($msg == FALSE){

            $error_msg = $this->session->flashdata('error');    
        }
        else{
            $error_msg = $msg;
        }

        $Logged_In_Array = $this->session->all_userdata();
        $user = $Logged_In_Array['logged_in'];
        $this->load->model('Registration_model');
        //  $error['grp_cd'] = $user['grp_cd'];
        $RegStdData = array('data'=>$this->Registration_model->EditPicEnrolement($user['Inst_Id']),'grp_cd'=>$user['grp_cd']);
        $RegStdData['msg_status'] = $error_msg;
        $userinfo = $Logged_In_Array['logged_in'];
        $this->load->view('common/header.php',$userinfo);
        $this->load->view('common/menu.php',$data);
        $this->load->view('Registration/9th/EditPicForms.php',$RegStdData);
        $this->load->view('common/footer.php');



    }
    
    public function uplaodpics()
    {
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $formno = $_POST['formno']  ;
        $target_path = IMAGE_PATH;
        
        $Inst_Id = $userinfo['Inst_Id'];
        if (!file_exists($target_path)){

            mkdir($target_path);
        }
        $target_path = IMAGE_PATH.$Inst_Id.'/';
        if (!file_exists($target_path)){

            mkdir($target_path);
        } 

        $config['upload_path']   = $target_path;
        $config['allowed_types'] = 'jpg';
        $config['max_size']      = '20';
        $config['min_size']      = '4';
      //  $config['max_width']     = '260';
       // $config['max_height']    = '290';
        $config['min_width']     = '110';
        $config['min_height']    = '100';
        $config['overwrite']     = TRUE;
        $config['file_name']     = $formno.'.jpg';

        $filepath = $target_path. $config['file_name']  ;

        //$config['new_image']    = $formno.'.JPEG';

        $this->load->library('upload', $config);

        $check = getimagesize($_FILES["image"]["tmp_name"]);
        $this->upload->initialize($config);

        if($check !== false) {

            $file_size = round($_FILES['image']['size']/1024, 2);
            if($file_size<=20 && $file_size>=4)
            {
                if ( !$this->upload->do_upload('image',true))
                {
                    if($this->upload->error_msg[0] != "")
                    {
                        $error['excep']= $this->upload->error_msg[0];
                        $allinputdata['excep'] = $this->upload->error_msg[0];
                        $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                        //  echo '<pre>'; print_r($allinputdata['excep']);exit();
                        redirect('Registration/EditPicForms/');
                        return;

                    }


                }
            }
            else
            {
                $allinputdata['excep'] = 'The file you are attempting to upload size is between 4 to 20 Kb.';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                //  echo '<pre>'; print_r($allinputdata['excep']);exit();
                redirect('Registration/EditPicForms/');

            }
        }
        else
        {
            // $check = getimagesize($filepath);
            if($check === false)
            {
                $allinputdata['excep'] = 'Please Upload Your Picture';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Registration/EditPicForms/');
                return;
            }
        }

       // $this->frmvalidation('NewEnrolment',$allinputdata,0);

        $a = getimagesize($filepath);
        if($a[2]!=2)
        {
            $this->convertImage($filepath,$filepath,100,$a['mime']);
        }
         redirect('Registration/EditPicForms/');
         return;
    }
     public function deleteExtarfiles($dirPath)
    {
        //DebugBreak();
        if (is_dir($dirPath)) {
            $objects = scandir($dirPath);
            foreach ($objects as $object) {
                if ($object != "." && $object !="..") {
                    if (filetype($dirPath . DIRECTORY_SEPARATOR . $object) == "dir") {
                        $this->deleteExtarfiles($dirPath . DIRECTORY_SEPARATOR . $object);
                    } else {
                        $filepath = $dirPath . DIRECTORY_SEPARATOR . $object;
                        $filepath = explode('.',$filepath);
                        if(strtolower(@$filepath[1])!= 'jpg')
                        {
                            unlink($dirPath . DIRECTORY_SEPARATOR . $object); 
                        }

                    }
                }
            }
            reset($objects);
            //rmdir(@$dirPath);
            //rmdir(@$dirPath);
        }
    }
}
