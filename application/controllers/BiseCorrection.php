<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class BiseCorrection extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');

        $this->load->library('session');
        if( !$this->session->userdata('logged_in') && $this->router->method != 'login' ) {
            // redirect('login/biselogin');
        }
    }
    public function slips9thcorrections()
    {
        $this->load->helper('url');
        $data = array(
            'isselected' => '0',
        );
        $this->load->library('session');
        $this->load->model('BiseCorrections_model');
        $NinthStdData = array('data'=>$this->BiseCorrections_model->get9thObjectionStdData());
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $this->load->view('common/header.php',$userinfo);
        $this->load->view('common/menu.php',$data);
        $this->load->view('BiseCorrection/slips9thcorrections.php',$NinthStdData);
        $this->load->view('common/footer.php');
    }
    public function reg9thbatch()
    {
        $this->load->helper('url');
        $data = array(
            'isselected' => '0',
        );
        $this->load->library('session');
        $this->load->model('BiseCorrections_model');
        // $NinthStdData = array('data'=>$this->BiseCorrections_model->get9thObjectionStdData());
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $this->load->view('common/header.php',$userinfo);
        $this->load->view('common/menu.php',$data);
        $this->load->view('BiseCorrection/9thCorrection/reg9thbatch.php');
        $this->load->view('common/footer.php');
    }
    public function SpecPermison_9th()
    {
       //DebugBreak();
        $this->load->helper('url');
        $data = array(
            'isselected' => '11',
        );
        
        $spec_case_msg="";
        $this->load->library('session');
      //  DebugBreak();
         if(( $this->session->flashdata('msg'))){

             $msg = $this->session->flashdata('msg');
            $spec_case_msg =array('msg'=>$msg);  
        }
        else{
            $msg = '';
            $spec_case_msg =array('msg'=>$msg);  
        }
        $this->load->model('BiseCorrections_model');
        $NinthStdData = array('Inst_data'=>$this->BiseCorrections_model->GetAllInstList());
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $this->load->view('common/header.php',$userinfo);
        $this->load->view('common/menu.php',$data);
        $this->load->view('BiseCorrection/SpecPermission.php',$NinthStdData);
        $this->load->view('common/footer.php',$spec_case_msg); 
    }
    public function SpecPermison_9th_INSERT()
    {
         $this->load->model('BiseCorrections_model');
       
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $userinfo['isselected'] = 11;
        $kpo = $userinfo['Inst_Id'];
        $this->commonheader($userinfo);
        $error = array();

     //   DebugBreak();
        if (!isset($kpo))
        {
            //$error['excep'][1] = 'Please Login!';
            $this->load->view('login/login.php');
        }
        $lastdate  = date('Y-m-d',strtotime(@$_POST['txt_FeedingDate'])) ;
        $data = array(
        
        'Inst_cd'=>@$_POST['inst_cd'],
        'FeedingDate'=>$lastdate,
        'RegFee'=>@$_POST['Reg_fee'],
        'ProcessingFee'=>@$_POST['Proc_Fee'],
        'SpecialFee'=>@$_POST['Spec_Fee'],
        'Isactive'=>@$_POST['IsActivated'],
        'Kpo'=>$kpo
        
        );
        $IsInserted = $this->BiseCorrections_model->Insert_SpecPermison($data);
        if($IsInserted == true)
        {
            $this->session->set_flashdata('msg','Saved');
            redirect('BiseCorrection/SpecPermison_9th');
        }
        else
        {
            $this->session->set_flashdata('msg','Not Saved');
            redirect('BiseCorrection/SpecPermison_9th');
        }
    }


    public function reg9thcorrections()
    {
        $this->load->helper('url');
        $data = array(
            'isselected' => '8',
        );
        $this->load->library('session');
        $this->load->model('BiseCorrections_model');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $this->load->view('common/header.php',$userinfo);
        $this->load->view('common/menu.php',$data);
        $this->load->view('BiseCorrection/9thCorrection/reg9thcorrections.php');
        $this->load->view('common/footer.php');
    }

    public function reg9thcorrectionapp()
    {
        $this->load->helper('url');
        $data = array(
            'isselected' => '8',
        );
        $this->load->library('session');
        $this->load->model('BiseCorrections_model');
        $NinthStdData = array('info'=>$this->BiseCorrections_model->get9thCorrectionData());
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];

        //  $data1 = array('Inst_Id'=>$Inst_Id);
        if(!( $this->session->flashdata('BatchList_update'))){

            $user_info['errors_RB_update'] = '';  
        }
        else{
            $user_info['errors_RB_update'] = $this->session->flashdata('BatchList_update');
        }
        $this->load->view('common/header.php',$userinfo);
        $this->load->view('common/menu.php',$data);
        $this->load->view('BiseCorrection/9thCorrection/reg9thcorrapp.php',$NinthStdData);
        $this->load->view('common/footer.php');
    }
    public function reg9thcorrectionapp_verified()
    {
        $this->load->helper('url');
        $data = array(
            'isselected' => '8',
        );
        $this->load->library('session');
        $this->load->model('BiseCorrections_model');
        $NinthStdData = array('info'=>$this->BiseCorrections_model->get9thCorrectionData_verified());
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];

        //  $data1 = array('Inst_Id'=>$Inst_Id);
        if(!( $this->session->flashdata('BatchList_update'))){

            $user_info['errors_RB_update'] = '';  
        }
        else{
            $user_info['errors_RB_update'] = $this->session->flashdata('BatchList_update');
        }
        $this->load->view('common/header.php',$userinfo);
        $this->load->view('common/menu.php',$data);
        $this->load->view('BiseCorrection/9thCorrection/reg9thcorrapp_verified.php',$NinthStdData);
        $this->load->view('common/footer.php');
    }

    public function BatchRelease()
    {
        $this->load->helper('url');
        $data = array(
            'isselected' => '0',
        );
        $this->load->library('session');
        $this->load->model('BiseCorrections_model');
        //  $data1 = array('Inst_Id'=>$Inst_Id);
        if(!( $this->session->flashdata('BatchList_update'))){

            $error_msg = '';  
        }
        else{
            $error_msg = $this->session->flashdata('BatchList_update');
        }

        $user_info  =  $this->BiseCorrections_model->Batch_List();
        $user_info_arr = array('info'=>$user_info,'errors_RB_update'=>$error_msg);
        $NinthStdData = array('data'=>$this->BiseCorrections_model->get9thObjectionStdData());
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $this->load->view('common/header.php',$userinfo);
        $this->load->view('common/menu.php',$data);
        $this->load->view('BiseCorrection/9thCorrection/BatchRelease.php',$user_info_arr);
        $this->load->view('common/footer.php');
    }
    //BatchRestore.php
    public function BatchRestore()
    {
        $this->load->helper('url');
        $data = array(
            'isselected' => '0',
        );
        $this->load->library('session');
        $this->load->model('BiseCorrections_model');
        //  $data1 = array('Inst_Id'=>$Inst_Id);
        if(!( $this->session->flashdata('BatchList_update'))){

            $error_msg = '';  
        }
        else{
            $error_msg = $this->session->flashdata('BatchList_update');
        }

        $user_info  =  $this->BiseCorrections_model->Batch_List_Deleted();
        $user_info_arr = array('info'=>$user_info,'errors_RB_restore'=>$error_msg);
        // $NinthStdData = array('data'=>$this->BiseCorrections_model->get9thObjectionStdData());
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $this->load->view('common/header.php',$userinfo);
        $this->load->view('common/menu.php',$data);
        $this->load->view('BiseCorrection/9thCorrection/BatchRestore.php',$user_info_arr);
        $this->load->view('common/footer.php');
    }
    public function BatchRestoreManual()
    {
        $this->load->helper('url');
        $data = array(
            'isselected' => '0',
        );
        $this->load->library('session');
        $this->load->model('BiseCorrections_model');
        //  $data1 = array('Inst_Id'=>$Inst_Id);
        if(!( $this->session->flashdata('BatchList_update'))){

            $error_msg = '';  
        }
        else{
            $error_msg = $this->session->flashdata('BatchList_update');
        }

        $user_info  =  $this->BiseCorrections_model->Batch_List_all();
        $user_info_arr = array('info'=>$user_info,'errors_RB_update'=>$error_msg);
        // $NinthStdData = array('data'=>$this->BiseCorrections_model->get9thObjectionStdData());
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $this->load->view('common/header.php',$userinfo);
        $this->load->view('common/menu.php',$data);
        $this->load->view('BiseCorrection/9thCorrection/BatchReleaseManual.php',$user_info_arr);
        $this->load->view('common/footer.php');
    }
    public function NewEnrolment_insert()
    {



        $this->load->model('Registration_model');
        // DebugBreak();
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $userinfo['isselected'] = 0;
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
        $config['min_width']     = '120';
        $config['min_height']    = '128';
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
                        redirect('BiseCorrection/NewEnrolment/');
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
                redirect('BiseCorrection/NewEnrolment/');
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
            redirect('BiseCorrection/NewEnrolment');
            return;


        }
        else
        {     
            $allinputdata['excep'] = 'An error has occoured. Please try again later. ';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('BiseCorrection/NewEnrolment');
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
            'isselected' => '0',
        );
        //  DebugBreak();
        if($this->session->flashdata('NewEnrolment_error')){

            $error['excep'] = $this->session->flashdata('NewEnrolment_error');    
        }
        else{
            $error['excep'] = '';
        }


        $error['gender'] = '';//$userinfo['gender'];
        $error['isrural'] = '';//$userinfo['isrural'];
        $error['grp_cd'] = $userinfo['grp_cd'];
        $error['isgovt'] = '';//$userinfo['isgovt'];

        $this->commonheader($data);
        $this->load->view('BiseCorrection/9thCorrection/NewEnrolment.php',$error);
        // $this->load->view('common/footer.php');
        $this->commonfooter(array("files"=>array("jquery.maskedinput.js","validate.NewEnrolment.js")));
        // if(@$_POST['cand_name'] != '' )//&& @$_POST['father_name'] != '' && @$_POST['bay_form'] != '' && @$_POST['father_cnic'] != '' && @$_POST['dob'] != '' && @$_POST['mob_number'] != '') //{   



        //}



    }
    public function slip9thactive()
    {
        $rno = $this->uri->segment(3);
        $this->load->model('BiseCorrections_model');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $NinthStdData = array('data'=>$this->BiseCorrections_model->updateslipData($rno,$userinfo['Inst_Id']));
        redirect('index.php/BiseCorrection/slips9thcorrections');
    }

    public function correction_update($BatchId)
    {

        $this->load->library('session');
        $this->load->model('BiseCorrections_model');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $data = array(
            'isselected' => '0',
        );
        $ckpo = $userinfo['Inst_Id'];
        $fetchdata = array('AppNo'=>$BatchId,'ckpo'=>$ckpo);
        
        $appdata = $this->BiseCorrections_model->get9thCorrectionDataById($BatchId);
        
        
        if($appdata[0]['PicFee']>0)
        {
            $picPath =  $appdata[0]['PicPath'] ;
            $formNo =  $appdata[0]['formNo'] ;
            $copy_path = CORR_IMAGE_PATH.$appdata[0]['Sch_cd'].'/';
            $target_path = IMAGE_PATH.$appdata[0]['Sch_cd'].'/';
            
            $oldPath = $target_path.$picPath;
            $newPath = $target_path.$formNo.'_'.date('d-m-Y').'.jpg';
            
            rename($oldPath, $newPath)  ;
            
            copy($copy_path.$picPath, $target_path.$picPath);
            
            $appdata = $this->BiseCorrections_model->updateCorrectionStatus($BatchId,$ckpo);
            
        }
        
        $status = array('data'=>$this->BiseCorrections_model->reg9thCorrection_UPDATE($fetchdata));


        if($status == true){

            $error_msg= "success";
            $this->session->set_flashdata('BatchList_update',$error_msg);
            redirect('BiseCorrection/reg9thcorrectionapp_verified');
            return;
        }
        else{
            $error_msg = "Fail";
            $this->session->set_flashdata('BatchList_update',$error_msg);
            redirect('BiseCorrection/reg9thcorrectionapp');
            return;
        }



    }

    public function BatchRelease_update($BatchId, $Inst_Cd)
    {

        $this->load->library('session');
        $this->load->model('BiseCorrections_model');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        //  DebugBreak();
        $data = array(
            'isselected' => '0',
        );
        $ckpo = $userinfo['Inst_Id'];
        $fetchdata = array('BatchId'=>$BatchId,'Inst_Cd'=>$Inst_Cd,'ckpo'=>$ckpo);
        $status = array('data'=>$this->BiseCorrections_model->Batch_List_UPDATE($fetchdata));

        // $Batch_ID = $this->uri->segment(3);
        //$this->load->view('common/header.php',$userinfo);
        //$this->commonheader($data);
        if($status == true){

            $error_msg= "success";
        }
        else{
            $error_msg = "Fail";
        }
        $this->session->set_flashdata('BatchList_update',$error_msg);
        redirect('BiseCorrection/BatchRelease');
        return;


    }

    public function BatchRestore_update($BatchId, $Inst_Cd)
    {

        $this->load->library('session');
        $this->load->model('BiseCorrections_model');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        //  DebugBreak();
        $data = array(
            'isselected' => '0',
        );
        $ckpo = $userinfo['Inst_Id'];
        $fetchdata = array('BatchId'=>$BatchId,'Inst_Cd'=>$Inst_Cd,'ckpo'=>$ckpo);
        $status = array('data'=>$this->BiseCorrections_model->Batch_List_RESTORE($fetchdata));

        // $Batch_ID = $this->uri->segment(3);
        //$this->load->view('common/header.php',$userinfo);
        //$this->commonheader($data);
        if($status == true){

            $error_msg= "success";
        }
        else{
            $error_msg = "Fail";
        }
        $this->session->set_flashdata('BatchList_update',$error_msg);
        redirect('BiseCorrection/BatchRestore');
        return;


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
            (@$_POST['bay_form'] == '00000-1111111-0') || (@$_POST['bay_form'] == '00000-1111111-1') 
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
    public function commonheader($data)
    {
        $this->load->view('common/header.php',$data);
        $this->load->view('common/menu.php',$data);
    } 
    public function commonfooter($data)
    {
        $this->load->view('common/footer.php',$data);
    }

}

/* End of file example.php */
/* Location: ./application/controllers/example.php */