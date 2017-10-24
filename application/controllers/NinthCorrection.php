<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'controllers/Registration.php');
require_once(APPPATH.'controllers/BiseCorrection.php');
class NinthCorrection extends CI_Controller {
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
          $this->clear_cache();
        $this->load->library('session');
        if( !$this->session->userdata('logged_in') && $this->router->method != 'login' ) {
            redirect('login');
        }
    }
     function clear_cache()
    {
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
    }
    public function index()
    {
        //DebugBreak(); 
        $msg = $this->uri->segment(3);
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $userinfo['isselected'] = 7;
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
    public function EditForms()
    {
        //  DebugBreak();
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $this->load->view('common/header.php',$userinfo);
        $data = array(
            'isselected' => '8',

        );
        $msg = $this->uri->segment(3);



        if($msg == FALSE){

            $error_msg = $this->session->flashdata('error');    
        }
        else if($this->session->flashdata('error') !='')
        {
            $error_msg = $this->session->flashdata('error'); 
        }
        else{
            $error_msg = $msg;
        }

        $Logged_In_Array = $this->session->all_userdata();
        $user = $Logged_In_Array['logged_in'];
        // $this->load->model('Registration_model');
       // $this->load->model('NinthCorrection_model');
        //  $error['grp_cd'] = $user['grp_cd'];
        //$RegStdData = array('data'=>$this->NinthCorrection_model->EditEnrolement($user['Inst_Id']),'grp_cd'=>$user['grp_cd']);
        $RegStdData['msg_status'] = $error_msg;
        
      //  print_r($RegStdData);
      //  exit();
        $userinfo = $Logged_In_Array['logged_in'];
        $this->load->view('common/header.php',$userinfo);
        $this->load->view('common/menu.php',$data);
        $this->load->view('NinthCorrection/ApplyforCorrection.php',$RegStdData);
        $this->load->view('common/common_reg/footer.php');



    } 
    public function Applied()
    {
        //  DebugBreak();
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $this->load->view('common/header.php',$userinfo);
        $data = array(
            'isselected' => '8',

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
        // $this->load->model('Registration_model');
        $this->load->model('NinthCorrection_model');
        //  $error['grp_cd'] = $user['grp_cd'];
        $RegStdData = array('data'=>$this->NinthCorrection_model->EditEnrolement_Applied($user['Inst_Id']),'grp_cd'=>$user['grp_cd']);
        $RegStdData['msg_status'] = $error_msg;
        $userinfo = $Logged_In_Array['logged_in'];
        $this->load->view('common/header.php',$userinfo);
        $this->load->view('common/menu.php',$data);
        $this->load->view('NinthCorrection/Applied.php',$RegStdData);
        $this->load->view('common/common_reg/footer.php');



    }
   
 
    public function Correction_EditForm($formno)
    {    
         
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $Inst_Id = substr($formno,0,6);
        $this->load->view('common/header.php',$userinfo);
        $isReAdm = 0;
        $year = 0;
        $data = array(
            'isselected' => '8',
        );
        $this->load->model('Registration_model');
        $this->load->model('NinthCorrection_model');
        if($this->session->flashdata('NewEnrolment_error')){
            //DebugBreak();
              if($this->session->flashdata('IsReAdm')){
                $isReAdm = 1;
                $year = regyear-1;
            }
            else{
                $isReAdm = 0;
                $year = regyear;  
                
            }
            $excep = $this->session->flashdata('NewEnrolment_error');
             //  DebugBreak();
            $RegStdData = array('data'=>$this->Registration_model->EditEnrolement_data($formno,$year,$Inst_Id),'isReAdm'=>$isReAdm,'Oldrno'=>0,'grp_cd'=>$this->NinthCorrection_model->GetInstGrp($Inst_Id));
             $RegStdData['data'][0]['excep'] = $excep['excep'];
            $isReAdm = 0;//$RegStdData['data'][0]['isreadm'];
            $RegStdData['isReAdm']=$isReAdm;
            $RegStdData['Oldrno']=0;

        }
        else{
            $error['excep'] = '';

            if($this->session->flashdata('IsReAdm')){
                $isReAdm = 1;
                $year = regyear-1;
            }
            else{
                $isReAdm = 0;
                $year = regyear;  
                
            }
              
            $RegStdData = array('data'=>$this->Registration_model->EditEnrolement_data($formno,$year,$Inst_Id),'isReAdm'=>$isReAdm,'Oldrno'=>0,'grp_cd'=>$this->NinthCorrection_model->GetInstGrp($Inst_Id));
        }


       // print_r( $RegStdData['data']);
      //  exit();
        
        if($RegStdData['data'] == -1)
        {
             $this->session->set_flashdata('error','Record not found'); 
             redirect('NinthCorrection/EditForms');
             return;
        }
        
        $this->load->view('common/menu.php',$data);
        $this->load->view('NinthCorrection/Correction_form.php',$RegStdData);   
        $this->commonfooter(array("files"=>array("jquery.maskedinput.js","validate.NewEnrolment.js"))); 

    }
    public function commonheader($data)
    {
        $this->load->view('common/header.php',$data);
        $this->load->view('common/menu.php',$data);
    } 
    public function NewEnrolment_update()
    {

       
         
        $this->load->model('NinthCorrection_model');
        $this->load->model('Registration_model');
       // $this->load->controller('Registration');
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $userinfo['isselected'] = 7;
         $formno =  $_POST['formNo'];
        $Inst_Id  = substr($formno,0,6);
        $this->commonheader($userinfo);
        if (!isset($Inst_Id))
        {
            //$error['excep'][1] = 'Please Login!';
            $this->load->view('login/login.php');
        }
        $error = array();
         
         //$reg = new Registration();
         //$myval =  $reg->isExist();
        // DebugBreak();
         //$this->Registration_model->GetFormNo($Inst_Id);//, $fname);//$_POST['username'],$_POST['password']);


        /*
        'name' =>$this->input->post('cand_name'),
        'Fname' =>$this->input->post('father_name'),
        'BForm' =>$this->input->post('bay_form'),
        'FNIC' =>$this->input->post('father_cnic'),
        'Dob' =>$this->input->post('dob'),
        'grp_cd' =>$this->input->post('std_group'),*/
        if(date('Y-m-d',strtotime(Correction_Last_Date))>=date('Y-m-d'))
        {
            $rule_fee   =  $this->NinthCorrection_model->getreulefee(1); 
            $lastdate  = date('Y-m-d',strtotime($rule_fee[0]['End_Date'] )) ;
        }
        else
        {
            $rule_fee   =  $this->NinthCorrection_model->getreulefee(2); 
            $lastdate  = date('Y-m-d',strtotime($rule_fee[0]['End_Date'] )) ;
        }

    //    echo  '<pre>';print_r($rule_fee);echo  '</pre>';exit();
        
        $corr_name ='';
        $corr_Fname = '';
        $corr_BForm = '';
        $corr_FNIC = '';
        $corr_Dob = '';
        $corr_grp_cd  = 0;
        $corr_pic  = '';
        $corr_sub1 = 0;
        $corr_sub2 = 0;
        $corr_sub3 = 0;
        $corr_sub4 = 0;
        $corr_sub5 = 0;
        $corr_sub6 = 0;
        $corr_sub7 = 0;
        $corr_sub8 = 0;
        $NameFee =0;
        $FnameFee =0;
        $DobFee =0;
        $FNICFee =0;
        $BFormFee =0;
        $grpFee =0;
        $subFee =0;
        $PicFee =0;
        $corr_totalFee = 0;

         $isPic = 0;
         //DebugBreak();
        // ======================= Name checkbox ======================
        if (isset($_POST['c'])){

            foreach($_POST['c'] as $value){

                if ($value == '1') {

                    $corr_name = $_POST['corr_cand_name'];
                    $NameFee = $rule_fee[0]['NameFee'];
                    // Name Checkbox is selected
                } 
                /*else {
                $corr_name = '';
                $NameFee = 0;
                //Name Checkbox Not Selected
                }*/

                // =============== FName Checkbox ==================
                if ($value== '2') {

                    $corr_Fname = $_POST['corr_father_name'];
                    $FnameFee = $rule_fee[0]['FNameFee'];
                    // FName Checkbox is selected
                } 
                /*else {

                $corr_Fname = '';
                $FnameFee = 0;
                //FName Checkbox Not Selected
                }*/

                // =============== DOB Checkbox ==================
                if ($value== '3') {

                    $corr_Dob = $_POST['corr_dob'];
                    $DobFee = $rule_fee[0]['FNameFee'];
                    // FName Checkbox is selected
                } 
                /*else {

                $corr_Dob = '';
                $DobFee =0;
                //FName Checkbox Not Selected
                }*/

                // =============== BForm Checkbox ==================
                if ($value== '4') {

                    $corr_BForm = $_POST['corr_bay_form'];
                    $BFormFee = $rule_fee[0]['BFormFee'];
                    // BForm Checkbox is selected
                }
                /* else {

                $corr_BForm = '';
                $BFormFee = 0;
                //BForm Checkbox Not Selected
                }*/
                // =============== FNIC Checkbox ==================
                if ($value== '5') {

                    $corr_FNIC = $_POST['corr_father_cnic'];
                    $FNICFee = $rule_fee[0]['FNICFee'];
                    // FNIC Checkbox is selected
                } 
                /*else {

                $corr_FNIC = '';
                $FNICFee = 0;
                //FNIC Checkbox Not Selected
                }*/
                // =============== Group and Subject Checkbox ==================
                if ($value== '6') {

                    // DebugBreak();
                    $this->load->model('Registration_model');
                    $year = regyear;
                    $RegStdData = $this->Registration_model->EditEnrolement_data($formno,$year,$Inst_Id);
                    $corr_grp_cd = $_POST['corr_std_group'];
                    $pre_grp_cd = $RegStdData[0]['grp_cd'];
                    $tempgrp = $corr_grp_cd;
                    $tempgrp1 = $pre_grp_cd;
                    if($corr_grp_cd ==7 || $corr_grp_cd == 8)
                    {
                        $tempgrp =  1;
                    }
                    if($pre_grp_cd ==  7 || $pre_grp_cd ==8)
                    {
                        $tempgrp1 = 1;
                    }
                
                    if($tempgrp != $tempgrp1)
                    {
                        $grpFee = $rule_fee[0]['GroupFee']; 
                        $corr_sub1 =  $_POST['corr_sub1'];
                        $corr_sub2 =  $_POST['corr_sub2'];
                        $corr_sub3 =  $_POST['corr_sub3']; 
                        $corr_sub4 =  $_POST['corr_sub4'];
                        $corr_sub5 =  $_POST['corr_sub5'];
                        $corr_sub6 =  $_POST['corr_sub6']; 
                        $corr_sub7 =  $_POST['corr_sub7'];
                        $corr_sub8 =  $_POST['corr_sub8'];

                    }
                    else
                    {
                        //=============== Subject Comparison===================
                        if($RegStdData[0]['sub1'] != $_POST['corr_sub1'])
                        {
                            $subFee = $rule_fee[0]['SubFee'];
                            $corr_sub1 =  $_POST['corr_sub1'];
                        }
                        else
                        {
                            $corr_sub1 =  0;
                        }
                        if($RegStdData[0]['sub2'] != $_POST['corr_sub2'])
                        {
                            $subFee = $subFee + $rule_fee[0]['SubFee']; 
                            $corr_sub2 =  $_POST['corr_sub2'];
                        }
                        else{
                            $corr_sub2 =  0;
                        }
                        if($RegStdData[0]['sub3'] != $_POST['corr_sub3'])
                        {
                            $subFee = $subFee + $rule_fee[0]['SubFee'];
                            $corr_sub3 =  $_POST['corr_sub3']; 
                        }
                        else{
                            $corr_sub3 =  0;
                        }
                        if($RegStdData[0]['sub4'] != $_POST['corr_sub4'])
                        {
                            $subFee = $subFee + $rule_fee[0]['SubFee']; 
                            $corr_sub4 =  $_POST['corr_sub4'];
                        }
                        else{
                            $corr_sub4 =  0;
                        }
                        if($RegStdData[0]['sub5'] != $_POST['corr_sub5'])
                        {
                            $subFee = $subFee + $rule_fee[0]['SubFee']; 
                            $corr_sub5 =  $_POST['corr_sub5'];
                        }
                        else{
                            $corr_sub5 =  0;
                        }
                        if($RegStdData[0]['sub6'] != $_POST['corr_sub6'])
                        {
                            $subFee = $subFee + $rule_fee[0]['SubFee'];
                            $corr_sub6 =  $_POST['corr_sub6']; 
                        }
                        else{
                            $corr_sub6 =  0;
                        }
                        if($RegStdData[0]['sub7'] != $_POST['corr_sub7'])
                        {
                            $subFee = $subFee + $rule_fee[0]['SubFee']; 
                            $corr_sub7 =  $_POST['corr_sub7'];
                        }
                        else{
                            $corr_sub7 =  0;
                        }
                        if($RegStdData[0]['sub8'] != $_POST['corr_sub8'])
                        {
                            $subFee = $subFee + $rule_fee[0]['SubFee']; 
                            $corr_sub8 =  $_POST['corr_sub8'];
                        }
                        else{
                            $corr_sub8 =  0;
                        }
                    }



                    // Group Checkbox is selected
                } /*else {

                $corr_grp_cd = '';
                $grpFee=0;
                //Group Checkbox Not Selected
                }*/
                // =============== Pic Checkbox ==================
               
                if ($value== '7') {

                    $PicFee = $rule_fee[0]['PicFee'];
                    $isPic = 1;
                } 

            }          // =================== loop Ending
        }   //===============Array isset Ending
        $target_path = CORR_IMAGE_PATH.$Inst_Id.'/';
          
        // $target_path = '../uploads2/'.$Inst_Id.'/';
        if($isPic ==1)
        {

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
            $filename =    $config['file_name']  ;    
            $this->load->library('upload', $config);
            $check = getimagesize($_FILES["corr_image"]["tmp_name"]);
            $this->upload->initialize($config);
            //DebugBreak();
            if($check !== false) {
                $file_size = round($_FILES['corr_image']['size']/1024, 2);
                if($file_size<=20 && $file_size>=4)
                {

                    if ( !$this->upload->do_upload('corr_image',True))
                    {
                        if($this->upload->error_msg[0] != "")
                        {
                            $error['excep']= $this->upload->error_msg[0];
                            $allinputdata['excep'] = $this->upload->error_msg[0];
                            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                            redirect('NinthCorrection/Correction_EditForm/'.$formno);
                            return;

                        }

                    }
                }
                else
                {
                    $allinputdata['excep'] = 'The file you are attempting to upload size is between 4 to 20 Kb.';
                    $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                    //  echo '<pre>'; print_r($allinputdata['excep']);exit();
                    redirect('NinthCorrection/Correction_EditForm/'.$formno);

                }
            }
            else{
                //$check = getimagesize($filepath);
                //  if($check === false)
                // {
                $allinputdata['excep'] = 'Please Upload Your Picture';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('NinthCorrection/Correction_EditForm/'.$formno);
                return;
                //}
            }

        }
        /*
        $NameFee ='';
        $FnameFee ='';
        $DobFee ='';
        $FNICFee ='';
        $BFormFee ='';
        $grpFee ='';
        $subFee ='';
        $PicFee ='';*/

        $allinputdata = array('name'=>$corr_name,'Fname'=>$corr_Fname,
            'BForm'=>$corr_BForm,'FNIC'=>$corr_FNIC,
            'Dob'=>$corr_Dob,'RegGrp'=>$corr_grp_cd,
            'NameFee'=>$NameFee,
            'FnameFee'=>$FnameFee,
            'DobFee'=>$DobFee,
            'FNICFee'=>$FNICFee,
            'BFormFee'=>$BFormFee,
            'grpFee'=>$grpFee,
            'subFee'=>$subFee,
            'picFee'=>$PicFee,
            'rel'=>@$_POST['hid_rel'],
            'sex'=>@$_POST['hid_sex'],
            'nat'=>@$_POST['hid_nat'],
            'sub1'=>$corr_sub1,'sub2'=>$corr_sub2,'sub3'=>$corr_sub3,
            'sub4'=>$corr_sub4,'sub5'=>$corr_sub5,
            'sub6'=>$corr_sub6,'sub7'=>$corr_sub7,
            'sub8'=>$corr_sub8,'PicPath'=>$filename ,'formNo'=>@$_POST['formNo'],

        );

        //$config['new_image']    = $formno.'.JPEG';

        /* else
        {
        $check = getimagesize($filepath);
        if($check === false)
        {
        $allinputdata['excep'] = 'Please Upload Your Picture';
        $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
        redirect('Registration/NewEnrolment_EditForm/'.$formno);
        return;
        }
        }*/
        $corr_totalFee = $NameFee+$FnameFee+$DobFee+$FNICFee+$BFormFee+$grpFee+$subFee+$PicFee;
        //DebugBreak();
        $AppNo = $this->NinthCorrection_model->GetAppNo();
        $data = array(
            'name'=>$corr_name,
            'Fname'=>$corr_Fname,
            'BForm'=>$corr_BForm,
            'FNIC'=>$corr_FNIC,
            'Dob'=>$corr_Dob,
            'RegGrp'=>$corr_grp_cd,
            'NameFee'=>$NameFee,
            'FnameFee'=>$FnameFee,
            'DobFee'=>$DobFee,
            'FNICFee'=>$FNICFee,
            'BFormFee'=>$BFormFee,
            'grpFee'=>$grpFee,
            'subFee'=>$subFee,
            'picFee'=>$PicFee,
            'totalFee'=>$corr_totalFee,
            'sub1'=>$corr_sub1,'sub2'=>$corr_sub2,'sub3'=>$corr_sub3,
            'sub4'=>$corr_sub4,'sub5'=>$corr_sub5,
            'sub6'=>$corr_sub6,'sub7'=>$corr_sub7,
            'sub8'=>$corr_sub8,'PicPath'=>$filename,'formNo'=>@$_POST['formNo'],
            'AppNo'=>$AppNo,
            'Pic'=>$isPic,
            'Inst_cd'=>$userinfo['Inst_Id'],
           // 'sch_cd'=>$user['Inst_Id'],
            'FormNo'=>$formno,

        );
        // DebugBreak();
        if($corr_name!='')
        {
        $_POST['cand_name']=$corr_name;
        }
        else
        {
        $_POST['cand_name']=$_POST['cand_name'];
        }
        
        if($corr_Dob!='')
        {
        $_POST['dob']=$corr_Dob;
         $date = new DateTime(@$_POST['dob']);
        $convert_dob = $date->format('Y-m-d'); 
        }
        else
        {
        $_POST['dob']=$_POST['dob'];
         $date = new DateTime(@$_POST['dob']);
        $convert_dob = $date->format('Y-m-d'); 
        }
        
        if($corr_FNIC!='')
        {
        $_POST['father_cnic']=$corr_FNIC;
        }
        else
        {
        $_POST['father_cnic']=$_POST['father_cnic'];
        }
        
        if($corr_BForm!='')
        {
        $_POST['bay_form']=$corr_BForm;
        }
        else
        {
        $_POST['bay_form']=$_POST['bay_form'];
        }
        
        // DebugBreak();
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
         if(@$_POST['bay_form'] == ''   )
        {
            $allinputdata['excep'] = 'Please Enter Your Bay Form No.';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
             redirect('NinthCorrection/Correction_EditForm/'.$formno);
            return;


        }
        else if( (@$_POST['bay_form'] == '00000-0000000-0') || (@$_POST['bay_form'] == '11111-1111111-1') || (@$_POST['bay_form'] == '22222-2222222-2') || (@$_POST['bay_form'] == '33333-3333333-3') || (@$_POST['bay_form'] == '44444-4444444-4')
            || (@$_POST['bay_form'] == '55555-5555555-5') || (@$_POST['bay_form'] == '66666-6666666-6') || (@$_POST['bay_form'] == '77777-7777777-7') || (@$_POST['bay_form'] == '88888-8888888-8') || (@$_POST['bay_form'] == '99999-9999999-9') ||
            (@$_POST['bay_form'] == '00000-1111111-0') || (@$_POST['bay_form'] == '00000-1111111-1') || (@$_POST['bay_form'] == '00000-0000000-1' || $cntzero >7 || $cntone >7 || $cnttwo >7 || $cntfour >7 || $cntthr >8 || $cntfive >7 || $cntsix >7 || $cntseven >7 || $cnteight >7 || $cntnine >7)
            )
            {
                $allinputdata['excep'] = 'Please Enter Your Correct Bay Form No.';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                 redirect('NinthCorrection/Correction_EditForm/'.$formno);
                return;

            }
            else if(@$_POST['father_cnic'] == ''   )
            {
                $allinputdata['excep'] = 'Please Enter Your Father CNIC';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                  redirect('NinthCorrection/Correction_EditForm/'.$formno);
                return;


            }
            else if((@$_POST['bay_form'] == @$_POST['father_cnic']) || (@$_POST['father_cnic'] == @$_POST['bay_form']) )
            {
                $allinputdata['excep'] = 'Your Bay Form and FNIC No. are not same';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                  redirect('NinthCorrection/Correction_EditForm/'.$formno);
                return;

            }
       // $_POST['cand_name']=$corr_name;
       // $_POST['dob']=$corr_Dob;
       // $_POST['father_cnic']=$corr_FNIC;
       // $_POST['bay_form']=$corr_BForm;
        //DebugBreak();
        
        $aObj = new Registration();  //create object 
        $reg = $aObj->isExist(); 

       

        if($reg !="SUCCESS")
        {
            //$reg =array($reg);
            $comma_separated = explode(",", $reg);


            $allinputdata['excep'] = 'This Candidate is already appeared in matric '.$comma_separated[1].' examination '.$comma_separated[2].' against roll no.'.$comma_separated[0];
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            //  echo '<pre>'; print_r($allinputdata['excep']);exit();
            redirect('NinthCorrection/Correction_EditForm/'.$formno);
            return;
        }
        $logedIn = $this->NinthCorrection_model->Update_NewEnorlement($data);//, $fname);//$_POST['username'],$_POST['password']);
        if($logedIn[0]['error'] != 'false')
        {  
         
            $aObj = new BiseCorrection();  //create object 
            $reg = $aObj->correction_update($AppNo); 
            $this->session->set_flashdata('error', 'success');
            redirect('NinthCorrection/Applied');
            return;

            echo 'Data Saved Successfully !';

        }
        else
        {     
            $allinputdata['excep'] = 'An error has occoured. Please try again later. ';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('NinthCorrection/Correction_EditForm/'.$formno);
            return;
            echo 'Data NOT Saved Successfully !';

        } 



        $this->load->view('common/common_reg/footer.php');
    }
    public function commonfooter($data)
    {
        $this->load->view('common/common_reg/footer.php',$data);
    }
    private function set_barcode($code)
    {
        //  DebugBreak()  ;
        //load library
        $this->load->library('zend');
        //load in folder Zend
        $this->zend->load('Zend/Barcode');


        $file = Zend_Barcode::draw('code128','image', array('text' => $code,'drawText'=>false), array());
        //$code = $code;
        $store_image = imagepng($file,BARCODE_PATH."{$code}.png");
        return $code.'.png';

    }
 
    public function Corr_App_Delete($AppNo)
    {
        // DebugBreak();
        $this->load->model('NinthCorrection_model');
        $RegStdData = array('data'=>$this->NinthCorrection_model->Delete_Corr_App($AppNo));
        $this->load->library('session');
        $this->session->set_flashdata('error', '2');
        redirect('NinthCorrection/Applied');
        return;
    }
   
}
?>

