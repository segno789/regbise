<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration extends CI_Controller {
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
    public function std9thclass()
    {

        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $this->load->view('common/header.php',$userinfo);
        $data = array(
            'isselected' => '10',

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
        $this->load->model('Migration_model');
        //  $error['grp_cd'] = $user['grp_cd'];
        $RegStdData = array('data'=>$this->Migration_model->std9thclass($user['Inst_Id']));
        $RegStdData['msg_status'] = $error_msg;
        $userinfo = $Logged_In_Array['logged_in'];
        $this->load->view('common/header.php',$userinfo);
        $this->load->view('common/menu.php',$data);
        $this->load->view('migration/std9thclass.php',$RegStdData);
        $this->load->view('common/footer.php');



    }
    public function get9threalease()
    {

        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $this->load->view('common/header.php',$userinfo);
        $data = array(
            'isselected' => '10',

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
        $this->load->model('Migration_model');
        //  $error['grp_cd'] = $user['grp_cd'];
        $RegStdData = array('data'=>$this->Migration_model->getrelease9thstd($user['Inst_Id']));
        $RegStdData['msg_status'] = $error_msg;
        $userinfo = $Logged_In_Array['logged_in'];
        $this->load->view('common/header.php',$userinfo);
        $this->load->view('common/menu.php',$data);
        $this->load->view('migration/Releasestd9thclass.php',$RegStdData);
        $this->load->view('common/footer.php');



    }
    public function updatefrom()
    {
       
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $Inst_Id = $userinfo['Inst_Id'];
        $isReAdm = 0;
        $year = 0;
        $data = array(
            'isselected' => '10',
        );
        
        $this->load->model('Migration_model');
        $insertinfo = array(
                    "formno"  =>$_POST['formno'],
                    "name"    =>$_POST['cand_name'],
                    "fname"   =>$_POST['father_name'],
                    "fnic"    =>$_POST['fnic'],
                    "bform"   =>$_POST['bform'],
                    "migto"   =>$_POST['migrateto'],
                    "sex"   =>$_POST['sex'],
                    "migfrom" =>$Inst_Id
        );
        $datainfo = $this->Migration_model->updatemigratefrom($insertinfo);
        if($datainfo == 0)
        {
            $allinputdata['excep'] = 'Your Form is not saved.';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Migration/release_stdForm/');
        }
        else
        {
            redirect('Migration/get9threalease/');
        }
        
    }
    public function release_stdForm($formno)
    {    
                 //DebugBreak();
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $Inst_Id = $userinfo['Inst_Id'];
        $this->load->view('common/header.php',$userinfo);
        $isReAdm = 0;
        $year = 0;
        $data = array(
            'isselected' => '10',
        );
        
        if($this->session->flashdata('NewEnrolment_error')){
            //DebugBreak();

            $RegStdData['data'][0] = $this->session->flashdata('NewEnrolment_error');   
            $RegStdData['isReAdm']=0;
            $RegStdData['Oldrno']=0;
            $RegStdData['install']=$this->tblmainstall();


        }
        else
        {
            $this->load->model('Registration_model');
            $year = 2016;
            $datainfo = $this->Registration_model->EditEnrolement_data($formno,$year,$Inst_Id);
            $RegStdData = array('data'=>$datainfo,'isReAdm'=>0,'Oldrno'=>0,"install" => $this->tblmainstall());  
        }
        


        $this->load->view('common/menu.php',$data);
        $this->load->view('migration/9thmigration_form.php',$RegStdData);   
        $this->commonfooter(array("files"=>array("jquery.maskedinput.js","validate.NewEnrolment.js"))); 

    }
      public function std11thclass()
    {

        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $this->load->view('common/header.php',$userinfo);
        $data = array(
            'isselected' => '10',

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
        $this->load->model('Migration_model');
        //  $error['grp_cd'] = $user['grp_cd'];
        $RegStdData = array('data'=>$this->Migration_model->std11thclass($user['Inst_Id']));
        $RegStdData['msg_status'] = $error_msg;
        $userinfo = $Logged_In_Array['logged_in'];
        $this->load->view('common/header.php',$userinfo);
        $this->load->view('common/menu.php',$data);
        $this->load->view('migration/std9thclass.php',$RegStdData);
        $this->load->view('common/footer.php');



    }
    
    public function Print_migration_Form_Final()
    {

       //   DebugBreak();
        $AppNo = $this->uri->segment(3);

        $this->load->library('session');

        $Logged_In_Array = $this->session->all_userdata();
        $user = $Logged_In_Array['logged_in'];
        $this->load->model('Migration_model');

     
        $result = array('data'=>$this->Migration_model->getinfoAll($AppNo));
        //Print_Form_Formnowise


        if(empty($result['data'])){
            $this->session->get9threalease('error', $Condition);
            redirect('Migration/FormPrinting');
            return;

        }


        $this->load->library('PDF_Rotate');


        $pdf = new PDF_Rotate('P','in',"A4");
        //      $this->load->library('PDFF');
        //        $pdf=new PDFF('P','in',"A4");  
        $pdf->AliasNbPages();
        $pdf->SetMargins(0.5,0.5,0.5);
        //$grp_cd = $this->uri->segment(3);

        $pdf->SetTitle('Print Migration From');

        $fontSize = 10;
        $marge    = .4;   // between barcode and hri in pixel
        $x        = 7.5;  // barcode center
        $y        = 1.2;  // barcode center
        $height   = 0.35;   // barcode height in 1D ; module size in 2D
        $width    = .013;  // barcode height in 1D ; not use in 2D
        $angle    = 0;   // rotation in degrees

        $type     = 'code128';
        $black    = '000000'; // color in hex
        //DebugBreak();
        $result = $result['data'];
        //if(!empty($result)):
        foreach ($result as $key=>$data) 
        {

            //First Page ---class instantiation    
            //$pdf = new FPDF_BARCODE("P","in","A4");
            $pdf->AddPage();
            $Y = 0.5;
            $pdf->SetFillColor(0,0,0);
            $pdf->SetDrawColor(0,0,0); 
            $temp = $data['app_No'].'@09@2016@1';
            $image =  $this->set_barcode($temp);
            $pdf->Image(BARCODE_PATH.$image,6.0, 1.2  ,1.8,0.20,"PNG");
            $pdf->SetFont('Arial','U',16);
            $pdf->SetXY( 1.2,0.2);
            $pdf->Cell(0, 0.2, "Board Of Intermediate and Secondary Education,Gujranwala", 0.25, "C");
            $pdf->Image(base_url()."assets/img/logo.jpg",0.35,0.2, 0.75,0.75, "JPG", "http://www.bisegrw.com");


            $pdf->SetFont('Arial','',10);
            $pdf->SetXY(1.7,0.4);
            $pdf->Cell(0, 0.25, " Migration FORM FOR CLASS ".corr_bank_chall_class." SESSION 2016-2018", 0.25, "C");
            //$pdf->Image(base_url(). 'assets/img/PROOF_READ.jpg' ,1,3.5 , 6,4 , "JPG"); 
            //--------------- Proof Read
            $ProofReed = "Application No. ".$data['app_No'];
            $pdf->SetXY(3,0.8);
            $pdf->SetFont("Arial",'B',12);
            $pdf->Cell(0, 0.25, $ProofReed  ,0,'C');

            //--------------------------- Form No & Rno
            $pdf->SetXY(0.2,0.5+$Y);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Form No: _______________",0,'L');

            $pdf->SetXY(0.8,0.5+$Y);
            $pdf->SetFont('Arial','IB',12);
            $pdf->Cell( 0.5,0.5,$data['Formno'],0,'L');

            //--------------------------- Institution Code and Name   $user['Inst_Id']. "-". $user['inst_Name']
            $pdf->SetXY(0.2,0.75+$Y);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Institution Code/Name:",0,'L');

            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(1.75,0.92+$Y);
            // $pdf->MultiCell(20, .5, $user['Inst_Id']."-".$user['inst_Name'], 0);
            $pdf->MultiCell(6,0.2,  $user['Inst_Id']. "-". $user['inst_Name'],0,'L');    

            //------ Picture Box on Centre      
            $Y = $Y+0.1;
            $x = 1.05;
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(0.2,1.28+$Y);
            $pdf->SetFillColor(240,240,240);
            $pdf->Cell(8,0.3,'Personal Information ',1,0,'L',1);
            //------------- Personal Infor Box
            //====================================================================================================================

           
            //  $Y = $Y+0.1;



            $pdf->SetFont('Arial','',10);
            $pdf->SetXY(0.5,1.65+$Y);
            $pdf->Cell( 0.5,0.5,"Candidate Name:",0,'L');
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(1.7,1.65+$Y);
            $pdf->Cell(0.5,0.5,  strtoupper($data["name"]),0,'L');

             $pdf->SetXY(0.5,$Y+2);
           // $pdf->SetXY(3.5+$x,1.65+$Y);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Father Name:",0,'L');
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(1.7,$Y+2);
            $pdf->Cell(0.5,0.5, strtoupper(@$data["fname"]),0,'L');


            $pdf->SetXY(0.5,$Y+2.4);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Father CNIC:",0,'L');
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(1.7,$Y+2.4);
            $pdf->Cell(0.5,0.5,@$data["fnic"],0,'L');    

            $pdf->Image(base_url().'uploads/download.jpg',4.5,1.79+$Y , 0.95, 1.0, "JPG"); //IMAGE_PATH.$data["Sch_cd"].'/'.$data["PicPath"]
             //$pdf->Image( base_url().'uploads/download.jpg',6.6, 1.55+$Y, 1.0, 1.0, "JPG");  
            //========================================  Exam Info ===============================================================================            
           
            $Y = $Y+2.2;
            $x = 1.05;
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(0.2,1.28+$Y);
            $pdf->SetFillColor(240,240,240);
            $pdf->Cell(8,0.3,'Migration Information ',1,0,'L',1);
           
           $pdf->SetFont('Arial','',10);
            $pdf->SetXY(0.5,1.65+$Y);
            $pdf->Cell( 0.5,0.5,"Migration From:",0,'L');
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(1.7,1.80+$Y);
            $pdf->MultiCell(7,0.2,  $user['Inst_Id']. "-". $user['inst_Name'],0,'L');    
           // $pdf->Cell(0.5,0.5,  '',0,'L');
           
           
           $pdf->SetXY(0.5,$Y+2.2);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Migration To:",0,'L');
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(1.7,$Y+2.35);
           
            $pdf->MultiCell(7,0.2,  $data['Migrated_to']. "-". $data['Migrated_name'],0,'L');    
           
           
            $sY = -0.3;//0.5;
            $pdf->SetXY(0.2,6.1+$sY);
            $pdf->SetFillColor(240,240,240);
            $pdf->Cell(8,0.3,'SUBJECT INFORMATION',1,0,'L',1);
            // DebugBreak();
             $grp_name = $data["grp_cd"];
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
                    $grp_name = 'GENERAL';
                    break;
                case '5':
                    $grp_name = 'DEAF AND DUMB';
                    break;
                default:
                $grp_name = "NO GROUP SELECTED";
            }
            
             $pdf->SetXY(0.2,6.5+$sY);
           // $pdf->SetFillColor(240,240,240);
           $pdf->SetFont('Arial','BU',12);
            $pdf->Cell(8,0.3,'Group:  '.$grp_name,0,'L');
               $y = $y-1.8;
            
             $pdf->SetFont('Arial','B',9);  
                $pdf->SetFont('Arial','',8);
                $pdf->SetXY(0.5,7.05+$y);
                $pdf->Cell(0.5,0.5, '1. '.($data['sub1_NAME']),0,'L');

               /* $pdf->SetXY(3+$x,7.05+$y);
                $pdf->Cell(0.5,0.5, '1. '.(@$data['N_sub1_NAME']),0,'L');
                                                                           */
                /*$pdf->SetXY(3+$x,7.05+$y);
                $pdf->Cell(0.5,0.5, '5. '.($data['sub5_NAME']),0,'L');*/
                //------------- sub 2 & 6
                $pdf->SetXY(0.5,7.35+$y);
                $pdf->Cell(0.5,0.5, '2. '.($data['sub2_NAME']),0,'L');
               /* $pdf->SetXY(3+$x,7.35+$y);
                $pdf->Cell(0.5,0.5, '2. '.(@$data['N_sub2_NAME']),0,'R');    */
                /*$pdf->SetXY(3+$x,7.35+$y);
                $pdf->Cell(0.5,0.5, '6. '.($data['sub6_NAME']),0,'R');*/
                //------------- sub 3 & 7
                $pdf->SetXY(0.5,7.70+$y);
                $pdf->Cell(0.5,0.5,  '3. '.($data['sub3_NAME']),0,'L');
                /*$pdf->SetXY(3+$x,7.70+$y);
                $pdf->Cell(0.5,0.5, '3. '.($data['N_sub3_NAME']),0,'R');   */
                /*$pdf->SetXY(3+$x,7.70+$y);
                $pdf->Cell(0.5,0.5, '7. '.($data['sub7_NAME']),0,'R');*/
                //------------- sub 4 & 8
                $pdf->SetXY(0.5,8.05+$y);
                $pdf->Cell(0.5,0.5, '4. '.($data['sub4_NAME']),0,'L');
               /* $pdf->SetXY(3+$x,8.05+$y);
                $pdf->Cell(0.5,0.5, '3. '.($data['N_sub4_NAME']),0,'L');  */
                //-----------------

                $pdf->SetXY(0.5,8.40+$y);
                $pdf->Cell(0.5,0.5, '5. '.($data['sub5_NAME']),0,'L');

               /* $pdf->SetXY(3+$x,8.40+$y);
                $pdf->Cell(0.5,0.5, '5. '.($data['N_sub5_NAME']),0,'L');     */

                //-------------------------
                $pdf->SetXY(0.5,8.75+$y);
                $pdf->Cell(0.5,0.5, '6. '.($data['sub6_NAME']),0,'R');

               /* $pdf->SetXY(3+$x,8.75+$y);
                $pdf->Cell(0.5,0.5, '6. '.($data['N_sub6_NAME']),0,'R'); */

                //------------------------

                $pdf->SetXY(0.5,9.10+$y);
                $pdf->Cell(0.5,0.5, '7. '.($data['sub7_NAME']),0,'R');

               /* $pdf->SetXY(3+$x,9.10+$y);
                $pdf->Cell(0.5,0.5, '7. '.($data['N_sub7_NAME']),0,'R');   */

                //------------------------------

                $pdf->SetXY(0.5,9.45+$y);
                $pdf->Cell(0.5,0.5, '8. '.($data['sub8_NAME']),0,'L');

              /*  $pdf->SetXY(3+$x,9.45+$y);
                $pdf->Cell(0.5,0.5, '8. '.($data['N_sub8_NAME']),0,'L');   */
            

      

           /*  
            $pdf->SetXY(0.5,  10.2+$y);
            $date = strtotime($data['edate']); 
            $pdf->Cell(8,0.24,'Feeding Date: '. date('d-m-Y h:i:s a', $date) ,0,'L','');*/
            $pdf->SetFont('Arial','UI',10); 
            $pdf->SetXY(4.6,  10.2+$y);
            $pdf->Cell(8,0.24,'Signature & Official stamp of the Head of the Institute: ' ,0,'L','');
            //date_format($$data['EDate'], 'd/m/Y H:i:s');

           $pdf->SetXY(0.5,  10.2+$y);
            $pdf->Cell(8,0.24,'Print Date: '. date('d-m-Y h:i:s a'),0,'L','');

            //======================================================================================
        }

        $pdf->Output($data['app_No'].'.pdf', 'I');
    }
    
    
    
    
    public function Print_challan_Form()
    {


        $formno = $this->uri->segment(3);

        $this->load->library('session');
        $this->load->library('NumbertoWord');
        $Logged_In_Array = $this->session->all_userdata();
        $user = $Logged_In_Array['logged_in'];
        $this->load->model('NinthCorrection_model');
        $this->load->model('Migration_model');
        //$grp_cd = $this->uri->segment(3);
        $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'formno'=>$formno);
         // DebugBreak();
        $result = $this->Migration_model->getappbyid($formno);
       
        //   $result = array('data'=>$this->NinthCorrection_model->Print_challan_Form($fetch_data));




        $this->load->library('PDF_Rotate');



        $ctid=1;  //correction type of id starts from one and multiples by 2 for next type of correction id
    
        $migFee =   1600;
         $feestructure[]=$migFee;    
            $displayfeetitle[] =  'Institute Migration';
        $turn=1;     
        $pdf=new PDF_Rotate("P","in","A4");
        $pdf->AliasNbPages();
        $pdf->SetTitle("Challan Form | Application Correction Form");
        $pdf->SetMargins(0.5,0.5,0.5);
        $pdf->AddPage();
        $generatingpdf=false;
        $challanCopy=array(1=>"Depositor Copy",  2=>"Registration Branch Copy",3=>"Bank Copy", 4=>"Board Copy",);
        $challanMSG=array(1=>"(May be deposited in any HBL Branch)",2=>"(To be sent to the Online Registration Branch Via BISE One Window)", 3=>"(To be retained with HBL)", 4=>"(To be sent to the Board via HBL Branch aloongwith scroll)"  );
       // DebugBreak();
        $challanNo =$result[0]['app_No']; 

       /* if(date('Y-m-d',strtotime(Correction_Last_Date))>=date('Y-m-d'))
        {
            $rule_fee   =  $this->NinthCorrection_model->getreulefee(1); 
            $challanDueDate  = date('d-m-Y',strtotime($rule_fee[0]['End_Date'] )) ;
        }
        else
        {
            $rule_fee   =  $this->NinthCorrection_model->getreulefee(2); 
            $challanDueDate  = date('d-m-Y',strtotime($rule_fee[0]['End_Date'] )) ;
        }    */

        $obj    = new NumbertoWord();
        $obj->toWords($migFee,"Only.","");
        // $pdf->Cell( 0.5,0.5,ucwords($obj->words),0,'L');
        $feeInWords = ucwords($obj->words);//strtoupper(cNum2Words($totalfee)); 

        //-------------------- PRINT BARCODE
        //  $pdf->SetDrawColor(0,0,0);
        $temp = $challanNo.'@'.$result[0]['app_No'].'@09@2016@1';
        //  $image =  $this->set_barcode($temp);
        //DebugBreak();
        $temp =  $this->set_barcode($temp);

        $yy = 0.05;
        $dyy = 0.1;
        $corcnt = 0;
        for ($j=1;$j<=4;$j++) 
        {




            $yy = 0.04;
            if($turn==1){$dyy=0.1;} 
            else {
                if($turn==2){$dyy=2.65;} else  if($turn==3) {$dyy=5.2; } else {$dyy=7.75 ; $turn=0;}
            }
            $corcnt = 0;
            $pdf->SetFont('Arial','BI',11);
            $pdf->SetXY(1.0,$yy+$dyy);
            //   DebugBreak();
            $pdf->Cell(2.45, 0.4, "BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, GUJRANWALA", 0.25, "L");
            $pdf->Image(base_url()."assets/img/logo.jpg",0.30,$yy+$dyy, 0.50,0.50, "JPG", "http://www.bisegrw.com");
            //  $pdf->Image(BARCODE_PATH.$Barcode,3.2, 1.15+$yy ,1.8,0.20,"PNG");
            $pdf->Image(BARCODE_PATH.$temp,5.8, $yy+$dyy+0.30 ,1.8,0.20,"PNG");
            $challanTitle = $challanCopy[$j];
            $generatingpdf=true;


            if($turn==1){$dy=0.4;} else {
                if($turn==2){$dy=2.9;} else  if($turn==3) {$dy=5.5; }else {$dy=8.1 ; $turn=0;}
            }
            $turn++;
            $y = 0.08;

            //$pdf->SetFont('Arial','BI',14);
            //$pdf->SetXY(5.5,$y+$dy);
            //$pdf->Image(BARCODE_PATH.$image,3.2, 0.61  ,1.8,0.20,"PNG");
            //$pdf->Cell(0.5, $y, $challanCopy[$j], 0.25, "L");

            $pdf->SetFont('Arial','BI',9);
            $pdf->SetXY(1.0,$y+$dy);
            $pdf->Cell(0.5, $y, $challanCopy[$j], 0.25, "L");
            $w = $pdf->GetStringWidth($challanCopy[$j]);
            $pdf->SetXY($w+1.2,$y+$dy);
            $pdf->SetFont('Arial','I',7);
            $pdf->Cell(0, $y, $challanMSG[$j], 0.25, "L");

            $pdf->SetXY($w+1.4,$y+$dy+0.15);
            $pdf->SetFont('Arial','I',7);
            $pdf->Cell(0, $y, 'Registration Session '.session_year.' '.corr_bank_chall_class, 0.25, "L");

            $y += 0.25;
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(0.5,$y+$dy-0.01);
            $pdf->SetFillColor(0,0,0);
            $pdf->Cell(1.5,0.2,'',1,0,'C',1);
            $pdf->SetFillColor(255,255,255);
            $pdf->SetTextColor(255,255,255);
            $pdf->SetXY(0.5,$y+$dy-0.01);
            $pdf->Cell(0, 0.25, "Due Date: ".date('d-m-Y', strtotime("+10 days")), 0.25, "C");
            $pdf->SetTextColor(0,0,0);
            $pdf->SetFont('Arial','BI',8);
            $pdf->SetXY(2.0,$y+$dy-0.04);
            $pdf->Cell(0, 0.25, "Printing Date: ".date("d/m/y",time())."  Account Title: BISE, GUJRANWALA   CMD Account No. 00427900072103", 0.25, "C");
            //CMD Account No. 00427900072103
            //--------------------------- Fee Description
            $pdf->SetXY(2.8,$y+$dy);
            $pdf->SetFont('Arial','U',8);
            $pdf->Cell(0.5,0.5,"Fee Description",0,'L');

            //  DebugBreak();
            //--------------------------- Challan Depositor Information
            $pdf->SetXY(4,$y+0.1+$dy);
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell( 0.5,0.3,"Bank Challan No:".$challanNo."           Application No.".$result[0]['app_No'],0,2,'L');
            $pdf->SetFont('Arial','U',9);
            $pdf->Cell(0.5,0.25, "Particulars Of Depositor",0,2,'L');
            $pdf->SetX(4.0);
            $pdf->SetFont('Arial','B',8);

            if(intval($result[0]['sex'])==1){$sodo="S/O ";}else{$sodo="D/O ";}
            $pdf->Cell(0.5,0.25,$result[0]['name'].'    '.$sodo.$result[0]['fname'],0,2,'L');
            // $pdf->Cell(0.5,0.25,,0,2,'L');
            $pdf->SetX(4);
            $pdf->SetFont('Arial','I',6.5);
            // DebugBreak();
            //$pdf->Cell(0.5,0.3,"Institute Code: ".$user['Inst_Id'].'-'.$user['inst_Name'],0,2,'L');
            $pdf->MultiCell(4, .1, "Institute Code: ".$user['Inst_Id'].'-'.$user['inst_Name'],0);
            $pdf->SetXY(4,$y+1.15+$dy);
            $pdf->SetFont('Arial','B',9);
            $pdf->Cell(0.5,0.3,"Amount in Words: ".$feeInWords,0,2,'L');

            $x = 0.55;
            $y += 0.2;

            //------------- Fee Statement
            //  DebugBreak();
            $ctid=1;
            $multiply=1;

            /*    foreach ($feestructure as $value) {
            //  $value = $value * 2;

            $pdf->SetFont('Arial','',9);
            $pdf->SetXY(0.5,$y+$dy);
            $pdf->Cell( 0.5,0.5,$displayfeetitle[$ctid],0,'L');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(3,$y+$dy);
            $pdf->Cell(0.8,0.5,$feestructure[$ctid],0,'C');
            $ctid *= 2;
            $y += 0.18;
            }*/
            // DebugBreak();
            $total =  count($feestructure);
            for ($k = 0; $k<count($feestructure); $k++){


                $pdf->SetFont('Arial','',9);
                $pdf->SetXY(0.5,$y+$dy);

                //$feestructure = array(1=>0, 2=>0, 4=>0, 8=>0, 16=>0, 32=>0, 64=>0, 128=>0);
                $pdf->Cell( 0.5,0.5,$displayfeetitle[$k],0,'L');
                $pdf->SetFont('Arial','B',10);
                $pdf->SetXY(3,$y+$dy);
                $pdf->Cell(0.8,0.5,$feestructure[$k],0,'C');
                $y += 0.18;
                $corcnt = $k;




            }

            //------------- Total Amount


            if($corcnt ==0){
                $y += 1.0;
            }
            else if($corcnt ==1){
                $y += .7;
            }
            else if($corcnt ==2){
                $y += .6;
            }
            else if($corcnt ==3){
                $y += .4;
            }
            else if($corcnt ==4){
                $y += .3;
            }
            else if($corcnt ==5){
                $y += .2;
            }

            else if($corcnt ==6){
                $y += .16;
            }
            $y += -0.2;
            $pdf->SetFont('Arial','B',12);
            $pdf->SetXY(0.5,($y)+$dy);
            $pdf->Cell( 0.5,0.5,"Total Amount: ",0,'L');
            $pdf->SetFont('Arial','B',12);
            $pdf->SetXY(3,$y+$dy);
            $pdf->Cell(0.8,0.5,$migFee,0,'C');

            //------------- Signature
            $y += 0.2;
            $pdf->SetFont('Arial','',10);
            $pdf->SetXY(0.5,$y+$dy);
            $pdf->Cell(0.5,0.5, 'Cashier: ___________________',0,'L');
            $pdf->SetXY(5.6,$y+$dy);
            $pdf->Cell(0.5,0.5, 'Manager: _________________',0,'L');    

            if ($turn>1){
                $y += 0.4;
                $pdf->Image( base_url().'assets/img/cut_line.png' ,0.3,$y+$dy, 7.5,0.15, "PNG");   
                // $pdf->Image("images/cut_line.png",0.3,$y+$dy, 7.5,0.15, "PNG");
            }            
        }  
        if ($generatingpdf==true)
        {
            $pdf->Output('challanform.pdf','I');
        } else {
            $containsError=true;
            $errorMessage = "<br />Your Institute does not have any student registration card in accordance with selected group or form no. range.";
        }  

        //======================================================================================
        //  }

        //  $pdf->Output($data["Sch_cd"].'.pdf', 'I');
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
    public function tblmainstall()
    {
        // select '"'+convert(varchar(20), Inst_cd) +'" =>"' +Name+'",' from matric..tblInstitutes_all where IsActive=1 and edu_lvl in(1,3) order by Inst_cd asc  
        return array(

            "111002" =>"GOVT. HIGH SCHOOL, ALI PUR CHATHA (GUJRANWALA)",
            "111003" =>"GOVT. HIGH SCHOOL, ABDAL (GUJRANWALA)",
            "111004" =>"GOVT. HIGH SCHOOL, AROOP (GUJRANWALA)",
            "111005" =>"GOVT. HIGH SCHOOL, ATTAWA (GUJRANWALA)",
            "111006" =>"GOVT. HIGH SCHOOL, AKBAR GHANOKE (GUJRANWALA)",
            "111007" =>"GOVT. CO-OP HIGH SCHOOL BUDHA GORAYA (GUJRANWALA)",
            "111008" =>"GOVT. HIGH SCHOOL, BALLEYWALA (GUJRANWALA)",
            "111009" =>"GOVT. HIGH SCHOOL BHIRI KHURD (GUJRANWALA)",
            "111010" =>"GOVT. HIGH SCHOOL BHAROKE CHEEMA (GUJRANWALA)",
            "111011" =>"GOVT. HIGH SCHOOL BHATTI BHANGO (GUJRANWALA)",
            "111012" =>"GOVT. HIGH SCHOOL BABBAR (GUJRANWALA)",
            "111013" =>"GOVT. HIGH SCHOOL BOTALA SHARM SINGH (GUJRANWALA)",
            "111014" =>"GOVT. HIGH SCHOOL BUTALA JHANDA SINGH (GUJRANWALA)",
            "111015" =>"GOVT. HIGH SCHOOL CHAHAL KALAN (GUJRANWALA)",
            "111016" =>"GOVT. HIGH SCHOOL CHAK BAIG (GUJRANWALA)",
            "111017" =>"GOVT. HIGH SCHOOL, CHANDALA (GUJRANWALA)",
            "111018" =>"GOVT. HIGH SCHOOL DHAUNKAL (GUJRANWALA)",
            "111019" =>"GOVT. HIGH SCHOOL DHENSAR PAEEN (GUJRANWALA)",
            "111020" =>"GOVT. HIGH SCHOOL DANDIAN (GUJRANWALA)",
            "111021" =>"GOVT. HIGH SCHOOL DOGRANWALA WARAICH (GUJRANWALA)",
            "111022" =>"GOVT. HIGH SCHOOL DHILLANWALI (GUJRANWALA)",
            "111023" =>"GOVT. ISLAMIA HIGH SCHOOL NO.1 EMINABAD (GUJRANWALA)",
            "111024" =>"GOVT. ISLAMIA HIGH SCHOOL NO.2 EMINABAD (GUJRANWALA)",
            "111025" =>"GOVT. J.M. ISLAMIA HIGH SCHOOL FEROZEWALA (GUJRANWALA)",
            "111026" =>"GOVT. HIGH SCHOOL NO.1 GHAKHAR (GUJRANWALA)",
            "111027" =>"GOVT. HIGH SCHOOL NO.2 GHAKHAR (GUJRANWALA)",
            "111028" =>"GOVT. HIGH SCHOOL GUNNA AUR (GUJRANWALA)",
            "111029" =>"GOVT. HIGH SCHOOL GARMULA VIRKAN (GUJRANWALA)",
            "111030" =>"GOVT. HIGH SCHOOL HERDO RATALI (GUJRANWALA)",
            "111031" =>"GOVT. HIGH SCHOOL VERPAL (GUJRANWALA)",
            "111032" =>"GOVT. HIGH SCHOOL HAZRAT KAILIANWALA (GUJRANWALA)",
            "111033" =>"GOVT. HIGH SCHOOL HAMID PUR KALAN (GUJRANWALA)",
            "111034" =>"GOVT. HIGH SCHOOL JAMKE CHATHA (GUJRANWALA)",
            "111035" =>"GOVT. HIGH SCHOOL JALLAN (GUJRANWALA)",
            "111036" =>"GOVT. HIGH SCHOOL JAURA SIAN (GUJRANWALA)",
            "111037" =>"GOVT. F-I HIGH SCHOOL KATHORE KALAN (GUJRANWALA)",
            "111038" =>"GOVT. HIGH SCHOOL KHANKI HEAD (GUJRANWALA)",
            "111039" =>"GOVT. HIGH SCHOOL NO.1 KAMOKE (GUJRANWALA)",
            "111040" =>"GOVT. HIGH SCHOOL NO.2 SHEESH MAHAL ROAD, KAMOKE (GUJRANWALA)",
            "111041" =>"GOVT. HIGH SCHOOL KOT RAFIQUE KAMOKE (GUJRANWALA)",
            "111042" =>"GOVT. HIGH SCHOOL KALI SUBA (GUJRANWALA)",
            "111043" =>"GOVT. HIGH SCHOOL KARYAL KALAN (GUJRANWALA)",
            "111044" =>"GOVT. HIGH SCHOOL KALASKE (GUJRANWALA)",
            "111045" =>"GOVT. HIGH SCHOOL KOTLI NAWAB (GUJRANWALA)",
            "111047" =>"GOVT. HIGH SCHOOL LALA PUR (GUJRANWALA)",
            "111048" =>"GOVT. HIGH SCHOOL LADHEWALA CHEEMA (GUJRANWALA)",
            "111049" =>"GOVT. M.D. ISLAMIA HIGH SCHOOL MUCHHRALA (GUJRANWALA)",
            "111050" =>"GOVT. HIGH SCHOOL MALKE (GUJRANWALA)",
            "111051" =>"GOVT. HIGH SCHOOL MATTA VIRKAN (GUJRANWALA)",
            "111052" =>"GOVT. HIGH SCHOOL MARI BHINDRAN (GUJRANWALA)",
            "111054" =>"GOVT. HIGH SCHOOL MANCHAR CHATHA (GUJRANWALA)",
            "111055" =>"GOVT. HIGH SCHOOL MANZOORABAD (GUJRANWALA)",
            "111056" =>"GOVT. HIGH SCHOOL MARI THAKRAN (GUJRANWALA)",
            "111057" =>"GOVT. HIGH SCHOOL NOWSHERA VIRKAN (GUJRANWALA)",
            "111058" =>"GOVT. HIGH SCHOOL NOKHAR (GUJRANWALA)",
            "111059" =>"GOVT. LIAQAT HIGH SCHOOL PIPNAKHA (GUJRANWALA)",
            "111060" =>"GOVT. HIGH SCHOOL NO. 1 QILA DIDAR SINGH (GUJRANWALA)",
            "111061" =>"GOVT. HIGH SCHOOL NO. 2 QILA DIDAR SINGH (GUJRANWALA)",
            "111062" =>"GOVT. HIGH SCHOOL QILA MIAN SINGH (GUJRANWALA)",
            "111063" =>"GOVT. HIGH SCHOOL RAJA (GUJRANWALA)",
            "111065" =>"GOVT. HIGH SCHOOL RAHWALI GUJRANWALA CANTT",
            "111066" =>"GOVT. HIGH SCHOOL KASHMIR COLONY GUJRANWALA CANTT",
            "111067" =>"GOVT. HIGH SCHOOL RASUL NAGAR (GUJRANWALA)",
            "111068" =>"GOVT. BOYS HIGH SCHOOL SOHDRA (GUJRANWALA)",
            "111069" =>"GOVT. HIGH SCHOOL SAROKE (GUJRANWALA)",
            "111070" =>"GOVT. HIGH SCHOOL SUKHANA BAJWA (GUJRANWALA)",
            "111071" =>"GOVT. HIGH SCHOOL SOHAWA DHILWAN (GUJRANWALA)",
            "111072" =>"GOVT. HIGH SCHOOL SALHOKI CHATHA (GUJRANWALA)",
            "111073" =>"GOVT. HIGH SCHOOL TALWANDI MUSA KHAN (GUJRANWALA)",
            "111074" =>"GOVT. HIGH SCHOOL TATLAY AALI (GUJRANWALA)",
            "111075" =>"GOVT. HIGH SCHOOL TALWANDI KHAJOOR WALI (GUJRANWALA)",
            "111076" =>"GOVT. HIGH SCHOOL UDHOWALI (GUJRANWALA)",
            "111077" =>"GOVT. HIGH SCHOOL AULAKH BHAIKE (GUJRANWALA)",
            "111078" =>"GOVT. HIGH SCHOOL NIZAMABAD (GUJRANWALA)",
            "111079" =>"GOVT. HIGH SCHOOL WAZIRABAD (GUJRANWALA)",
            "111080" =>"GOVT. PUBLIC HIGH SCHOOL WAZIRABAD (GUJRANWALA)",
            "111081" =>"GOVT. CHRISTIAN HIGH SCHOOL WAZIRABAD (GUJRANWALA)",
            "111082" =>"SIR SYED PILOT HIGH SCHOOL MODEL COLONY WAZIRABAD (GUJRANWALA)",
            "111084" =>"GOVT. M.T HIGH SCHOOL PEOPLES COLONY GUJRANWALA",
            "111085" =>"GOVT. A.D MODEL HIGH SCHOOL GUJRANWALA",
            "111086" =>"GOVT. P.B MODEL HIGH SCHOOL GUJRANWALA",
            "111087" =>"GOVT. COMPREHENSIVE SCHOOL GUJRANWALA",
            "111088" =>"GOVT. A.M ISLAMIA HIGH SCHOOL NO.1 GUJRANWALA",
            "111089" =>"GOVT. A.M ISLAMIA HIGH SCHOOL NO.2 GUJRANWALA",
            "111090" =>"GOVT. F.C ISLAMIA HIGH SCHOOL GUJRANWALA",
            "111092" =>"GOVT. HAMID ALI MEMORIAL HIGH SCHOOL GUJRANWALA",
            "111093" =>"GOVT. IQBAL HIGH SCHOOL GUJRANWALA",
            "111094" =>"GOVT. JINNAH MEMORIAL MUSLIM HIGH SCHOOL GUJRANWALA",
            "111095" =>"GOVT. M.A. ISLAMIA HIGH SCHOOL GUJRANWALA",
            "111096" =>"GOVT. MILLAT HIGH SCHOOL GUJRANWALA",
            "111097" =>"GOVT. T.N MUSLIM HIGH SCHOOL GUJRANWALA",
            "111098" =>"GOVT. PUBLIC HIGH SCHOOL GUJRANWALA",
            "111099" =>"GOVT. M.S. ISLAMIA HIGH SCHOOL S/TOWN GUJRANWALA",
            "111100" =>"GOVT. F.D. MODEL HIGH SCHOOL GUJRANWALA",
            "111101" =>"GOVT. HIGH SCHOOL DHULLAY GUJRANWALA",
            "111102" =>"GOVT. HIGH SCHOOL GONDLANWALA (GUJRANWALA)",
            "111103" =>"GOVT. HIGH SCHOOL KHIALI GUJRANWALA",
            "111105" =>"QUAID-I-AZAM DIVISIONAL PUBLIC SCHOOL GUJRANWALA",
            "111106" =>"SCIENCE FOUNDATION HIGH SCHOOL CIVIL LINES GUJRANWALA",
            "111107" =>"AL-BADR HIGH SCHOOL GUJRANWALA",
            "111108" =>"PAKISTAN INTERNATIONAL PUBLIC SCHOOL AND COLLEGE GUJRANWALA",
            "111109" =>"JADEED DASTGIR IDEAL BOYS HIGH SCHOOL GUJRANWALA",
            "111110" =>"BEACON HOUSE SCHOOL SYSTEM GUJRANWALA",
            "111111" =>"AIZAR HIGH SCHOOL SATELLITE TOWN GUJRANWALA",
            "111112" =>"WORKERS WELFARE SCHOOL FOR BOYS GULSHAN COLONY GUJRANWALA",
            "111113" =>"ST. JOSEPH'S HIGH SCHOOL SIALKOT ROAD GUJRANWALA",
            "111114" =>"AL-FAROOQ PUBLIC SCHOOL SHALIMAR TOWN GUJRANWALA",
            "111115" =>"JAMAL MODEL HIGH SCHOOL, NANGRAE BHATTI (GUJRANWALA)",
            "111116" =>"GOVT. HIGH SCHOOL NO.3 KAMOKE (GUJRANWALA)",
            "111118" =>"GOVT. HIGH SCHOOL THATHA MANAK (GUJRANWALA)",
            "111120" =>"SPRING FIELD PUBLIC SCHOOL FOR BOYS, GUJRANWALA",
            "111125" =>"AZAM INTERNATIONAL SCHOOL, ALIPUR CHATTAH (GUJRANWALA)",
            "111126" =>"BIBI AND BABA BOYS HIGH SCHOOL, GIL ROAD, GUJRANWALA",
            "111127" =>"SOUTH EASTERN SCHOOL OF SCIENCE AND  ARTS GUJRANWALA",
            "111128" =>"GRAMMAR PUBLIC SCHOOL GUJRANWALA",
            "111130" =>"THE PAKISTAN SCHOOL (FOR BOYS) GUJRANWALA",
            "111133" =>"PAKISTAN FOUNDATION MODEL SCHOOL, 60-A S/TOWN, GUJRANWALA",
            "111134" =>"AMERICAN INTERNATIONAL SCHOOL 21-A S/T GUJRANWALA",
            "111135" =>"THE EDUCATORS GLOBAL ACADEMIC CAMPUS (BOYS)  PAK TOWN, G.T. ROAD KAMOKE (GUJRANWALA)",
            "111137" =>"DAWN PUBLIC HIGH SCHOOL, 3-MAIN ROAD GARJAKH GUJRANWALA",
            "111138" =>"PUNJAB GRAMMAR HIGH SCHOOL (BOYS) NIZAMPUR GUJRANWALA",
            "111139" =>"ASAAS NATIONAL BOYS HIGH SCHOOL SHAHRAH-E-QUAID-E-AZAM GUJRANWALA CANTT",
            "111140" =>"CITY CARDINAL HIGH SCHOOL D.C. ROAD GUJRANWALA",
            "111142" =>"BEST SCHOOL SYSTEM 39/A. S/TOWN GUJRANWALA",
            "111144" =>"YOUNG SCHOLARS COMPUTER HIGH SCHOOL FOR BOYS RAHWALI GUJRANWALA",
            "111146" =>"EDUCATION VERTEX SCHOOL MOHAFIZ TOWN GUJRANWALA",
            "111147" =>"M.K. SCIENCE HIGH SCHOOL GUJRANWALA",
            "111148" =>"THE UNIQUE ANGEL'S CAMPUS (FOR BOYS) SIALKOT ROAD, GUJRANWALA",
            "111149" =>"HUSSAIN HIGH SCHOOL ALIPUR CHATHA (GUJRANWALA)",
            "111150" =>"SCIENCE LOCUS HIGH SCHOOL (FOR BOYS) 150-D SATELLITE TOWN GUJRANWALA",
            "111151" =>"BLUE BELLS KIDS CAMPUS (FOR BOYS) 74-A SATELLITE TOWN GUJRANWALA",
            "111152" =>"DECENT PUBLIC HIGH SCHOOL, KAMOKE GUJRANWALA",
            "111155" =>"CIVIL POLIT HIGH SCHOOL (FOR BOYS) GUJRANWALA",
            "111156" =>"CITY PUBLIC MODEL SCHOOL (FOR BOYS), NOWSHEHRA ROAD, GUJRANWALA.",
            "111157" =>"THE SCHOOL OF SCHOLARS MODEL TOWN GUJRANWALA",
            "111158" =>"ROYAL GENIUS CAMBRIDGE HIGH SCHOOL KASHMIR ROAD PEOPLES COLONY GUJRANWALA",
            "111159" =>"AL-FARABI MODEL HIGH SCHOOL QUDRATABAD, WAZIRABAD",
            "111160" =>"JADEED MUBBASHAR IDEAL HIGH SCHOOL 8-D, SHAHEENABAD, GUJRANWALA.",
            "111161" =>"CHRISTIAN HIGH SCHOOL PO BOX 113, CIVIL LINES, CHURCH ROAD GUJRANWALA-PAKISTAN",
            "111162" =>"AL-DAWAH MODEL HIGH SCHOOL PEOPLES COLONY KASHMIR, ROAD GUJRANWALA",
            "111163" =>"SCIENCE VERTEX (THE SCHOOL OF SCIENCES) FOR BOYS 10-D SATELLITE TOWN GUJRANWALA",
            "111164" =>"CATHEDRAL SCHOOL, GUJRANWALA",
            "111165" =>"ISLAMABAD EDUCATIONAL CENTER BOYS HIGH SCHOOL PEOPLE'S COLONY GUJRANWALA-PAKISTAN",
            "111166" =>"THE EDUCATORS MODEL TOWN CAMPUS GUJRANWALA",
            "111167" =>"BATALA INTERNATIONAL PUBLIC SCHOOL, GUJRANWALA",
            "111168" =>"CITY STANDARED BOYS HIGH SCHOOL, HAFIZABAD ROAD, GUJRANWALA",
            "111169" =>"AZAM PUBLIC BOYS HIGH SCHOOLGALA CH. IJAZ WALAQILA DIDAR SINGH GUJRANWALA",
            "111170" =>"SCIENCE BASE HIGH SCHOOL FOR BOYS, 141-D, SATELITE TOWN, GUJRANWALA",
            "111171" =>"CITY PUBLIC SCHOOL COLLEGE ROAD,  PEOPLES COLONY GUJRANWALA",
            "111173" =>"PAK GRAMMER PUBLIC HIGH SCHOOL, WAHNDO (GUJRANWALA)",
            "111174" =>"ST. PETER'S ENGLISH HIGH SCHOOL, GUJRANWALA",
            "111175" =>"SUN RISE MODEL HIGH SCHOOL NEAR RAILWAY PHATAK, RAHWALI GUJRANWALA",
            "111176" =>"STUDY HOUSE SCHOOL SYSTEM FOR BOYS, BAKHTAYWALA GUJRANWALA",
            "111177" =>"FM. MEMORIAL HIGH SCHOOL G.T. ROAD RAHWALI GRW",
            "111178" =>"THE EDUCATORS CIVIL LINE CAMPUS FOR BOYS SESSION COURT ROAD GUJRANWALA",
            "111180" =>"MUSLIM IIDEAL BOYS HIGH SCHOOL MANDIALA TEGA (GUJRANWALA)",
            "111181" =>"NEW WAY MODEL BOYS HIGH SCHOOL GALA GHULAM MUHAMMAD THEKEDAR GUJRANWALA",
            "111182" =>"TAMEER-E-MILLAT HIGH SCHOOL KAMOKE GUJRANWALA",
            "111183" =>"SCIENCE WAY SCHOOL SYSTEM RACE COURSE ROAD GUJRANWALA",
            "111189" =>"AL-NOOR HIGH SCHOOL MADNI ROAD, SHAHPUR KHIALI GRW",
            "111190" =>"ZIA-E-ISLAM BOYS HIGH SCHOOL TATLAY AALI (GUJRANWALA)",
            "111191" =>"KEN IDEAL GRAMMER HIGH SCHOOL KAMOKE GUJRANWALA",
            "111194" =>"ST. DENYS ENGLISH HIGH SCHOOL (BOYS) 1-CHURCH ROAD, GUJRANWALA",
            "111195" =>"NEW SCIENCE FOUNDATION HIGH SCHOOL FOR BOYS KAMOKE (GUJRANWALA)",
            "111196" =>"THE OXFORD SCHOOL (BOYS) 1-A SATELLITE TOWN GUJRANWALA",
            "111198" =>"IMPERIAL PUBLIC SCHOOL WAZIRABAD. GUJRANWALA",
            "111200" =>"JINNAH INTERNATIONAL PUBLIC SCHOOL, SIALKOT ROAD,  KHOKHERKI GUJRANWALA",
            "111202" =>"MARYLAND HIGH SCHOOL (FOR BOYS) G.T. ROAD GHAKHAR CITY (GRW)",
            "111203" =>"SUN RISE PUBLIC HIGH SCHOOL FOR BOYS ST. 2 DELTA ROAD, (GRW)",
            "111205" =>"M.S. MEMORIAL HIGH SCHOOL FAISAL COLONY NO.1 SHAH PUR KHIALI GUJRANWALA",
            "111208" =>"NEW JINNAH INTERNATIONAL PUBLIC SCHOOL, KALASKE (GUJRANWALA)",
            "111209" =>"SARDAR GRAMMAR SCHOOL DHULLAY GUJRANWALA",
            "111211" =>"ZIA-E-MADINA SECONDARY  SCHOOL FOR BOYS WAZIRABAD (GUJRANWALA)",
            "111212" =>"THE PAKISTAN ENGLISH SCHOOL FOR BOYS 4-TOWER ROAD KHIALI GUJRANWALA",
            "111213" =>"CANTT VIEW PUBLIC SCHOOL FOR BOYS GUJRANWALA",
            "111214" =>"HIGH AIMS SCHOOL SYSTEM LADHEWALA WARRAICH GUJRANWALA",
            "111215" =>"PRIMA STANDARD HIGH SCHOOL FOR BOYS G.T. ROAD KAMOKE (GRW)",
            "111216" =>"SUFFA-E-ISLAM HIGH SCHOOL CHAURA (GUJRANWALA)",
            "111217" =>"LITTLE SCHOLARS SCHOOL SYSTEM TATLAY AALI GUJRANWALA",
            "111218" =>"CRESCENT PUBLIC HIGH SCHOOL (FOR BOYS) MORE EMINABAD, GUJRANWALA",
            "111219" =>"MUMTAZ GRAMMAR SCHOOL (FOR BOYS) G.T. ROAD WAZIRABAD GUJRANWALA",
            "111220" =>"GLASGOW PUBLIC SCHOOL SYSTEM (FOR BOYS) QILA DIDAR SING (GRW)",
            "111222" =>"THE EDUCATOR'S IQBAL CAMPUS FOR BOYS WAPDA TOWN GUJRANWALA",
            "111225" =>"HAIDER MEMORIAL HIGH SCHOOL SAROKI CHEEMA WAZIRABAD GUJRANWALA",
            "111226" =>"PAKISTAN MODEL HIGH SCHOOL SAROKI CHEEMA WAZIRABAD",
            "111227" =>"SAINT FRANSIS HIGH SCHOOL SHEIKHUPURA ROAD GUJRANWALA",
            "111228" =>"SAINT JOHN'S HIGH SCHOOL DELTE ROAD GUJRANWALA",
            "111229" =>"PAK LAND MODEL HIGH SCHOOL FOR BOYS G.T ROAD RAHWALI GUJRANWALA",
            "111230" =>"NEW HORIZON INSTITUTE OF SCIENCES FOR BOYS 44 Y-BLOCK PEOPLE'S COLONY GUJRANWALA ",
            "111233" =>"BRIGHT FUTURE H.S.S. TATLAY AALI(GRW)",
            "111234" =>"SIRAT-UL-JANNAH DIVISIONAL SCHOOL FOR BOYS HAFIZABAD ROAD GUJRANWALA",
            "111235" =>"TALENT KIDS CAMPUS FOR BOYS KASHMIR ROAD PEOPLES COLONY GUJRANWALA",
            "111236" =>"PUBLIC SCIENCE BOYS HIGH SCHOOL GILL ROAD, GUJRANWALA",
            "111237" =>"HAFIZ MODEL HIGH SCHOOL FOR BOYS FARID TOWN GUJRANWALA",
            "111238" =>"GOVT. HIGH SCHOOL NATHU SIVIA DISTT. GUJRANWALA",
            "111239" =>"ALLAMA IQBAL IDEAL HIGH SCHOOL FOR BOYS SIALKOT ROAD SCHOOL STREET JAGNA GUJRANWALA",
            "111240" =>"GOVT. HIGH SCHOOL MAJJU CHACK GUJRANWALA",
            "111241" =>"IQRA MODEL HIGH SCHOOL  SHAHEENABAD GUJRANWALA",
            "111243" =>"WAZIR HASAN MEMORIAL SCHOOL ALI PUR CHATTAH GUJRANWALA",
            "111245" =>"AL-REHMAN IDEAL SECONDARY SCHOOL (BOYS) 15-FAISALABAD, GUJRANWALA",
            "111246" =>"NEW CRESCENT PUBLIC HIGH SCHOOL (FOR BOYS) MORE EMINABAD, GUJRANWALA",
            "111247" =>"KING EDWARD GRAMMAR HIGH SCHOOL (FOR BOYS) GUJRANWALA.
            ",
            "111248" =>"THE EDUCATORS SCHOOL FOR BOYS EMINABAD, G.T ROAD, GUJRANWALA",
            "111249" =>"OXFORD COMPUTER HIGH SCHOOL FOR BOYS VERPAL CHATTHA WAZIRABAD GUJRANWALA",
            "111250" =>"HIJAB PUBLIC HIGH SCHOOL FOR BOYS, KELASKE, WAZIRABAD, GUJRANWALA",
            "111251" =>"SEERAT HIGH SCHOOL FOR BOYS, FAIZ-E-ALAM TOWN, GUJRANWALA",
            "111252" =>"IQRA HUFFAZ BOYS SECONDARY SCHOOL GUJRANWALA",
            "111253" =>"MUSLIM HANDS SCHOOL OF EXCELLANCE SIALKOT ROAD SOHDRA MOR WAZIRABAD",
            "111254" =>"DAR E ARQAM SECONDARY SCHOOL FOR BOYS, DHOUNKAL ROAD, WAZIRABAD, GUJRANWALA",
            "111255" =>"PAKISTAN FOUNDATION SCHOOL FOR GIRLS, GUJRANWALA CANTT",
            "111256" =>"THE PROFESSORS SCHOOL FOR BOYS, CHADHER TOWN GAKHAR, GUJRANWALA",
            "111258" =>"COMMUNITY MODEL HIGH SCHOOL FOR BOYS AZIZ CHAK WAZIRABAD GUJRANWALA",
            "111259" =>"M. S.  NAZ HIGH SCHOOL FOR BOYS, G T ROAD GAKHAR GUJRANWALA",
            "111260" =>"FAISAL MEMORIAL HIGH SCHOOL FOR BOYS, AROOP, GUJRANWALA",
            "111261" =>"DAR-E-ARQAM SCHOOL FOR BOYS, MAIN ROAD, PEOPLES COLONY, GUJRANWALA",
            "111262" =>"ALI GARH BOARDING SCHOOL, NEAR RAILWAY PHATAK, DASKA ROAD, WAZIRABAD, GURJANWALA",
            "111263" =>"ALLIED SCHOOL (APC) CAMPUS FOR BOYS, RAILWAY ROAD ALI PUR CHATTHA, GUJRANWALA",
            "111264" =>"PAKISTAN FOUNDATION SCHOOL FOR BOYS, GREEN TOWN RAHWALI CANTT, GUJRANWALA",
            "111265" =>"ALLIED SCHOOL WAPDA TOWN CMPUS FOR BOYS, D-BLOCK MUHAFIZ TOWN, GUJRANWALA",
            "111266" =>"PUNJAB LYCEUM SCHOOL FOR BOYS, PROFESSORS COLONY AROOP ROAD, GUJRANWALA.",
            "111267" =>"THE ELITE EDUCATORS HIGH SCHOOL, MANDIALA CHATHA WAZIRABAD, GUJRANWALA",
            "111268" =>"ALLIED SCHOOL WAZIRABAD CAMPUS FOR BOYS, SHADMAN TOWN NEAR UMAR MARRIAGE HALL WAZIR ABAD GUJRANWALA",
            "111269" =>"ALLIED SCHOOL (SATELLITE TOWN COMPUS) FOR BOYS, OLD SESSION COURT ROAD CIVIL LINE, GUJRANWALA",
            "111270" =>"PUNJAB GROUP HIGH SCHOOL FOR BOYS, G.T ROAD BY PASS, WAZIRABAD",
            "111271" =>"F.J SCIENCE HIGH SCHOOL FOR BOYS,NOSHEHRA ROAD,GUJRANWALA",
            "111272" =>"GREEN HOUSE MODEL HIGH SCHOOL FOR BOYS. BHARA GALA PATANKEY ROAD AHMAD NAGAR CHATHA TEHSIL WAZIRABAD",
            "111273" =>"LITTLE SCHOLARS PUBLIC  SECONDARY SCHOOL FOR BOYS,ST.NO.5,HAFIZABAD ROAD,BAGHBAN PURA, GUJRANWALA",
            "111275" =>"GOVT. HIGH SCHOOL, MURALIWALA, GUJRANWALA",
            "111276" =>"GOVT. HIGH SCHOOL, JANDIALA BAGHWALA, GUJRANWALA",
            "111277" =>"GOVT. HIGH SCHOOL, WANIA WALA, GUJRANWALA",
            "111278" =>"GOVT HIGH SCHOOL FOR BOYS, MANGOKE VIRKAN, TEHSIL NOSHERA VIRKAN, GUJRANWALA",
            "111279" =>"GOVT. HIGH SCHOOL, KOT WARIS TEHSIL WAZIRABAD GUJRANWALA",
            "111280" =>"GOVT HIGH SCHOOL, JALAL BALAGAN GUJRANWALA",
            "111281" =>"GOVT. HIGH SCHOOL,DILAWAR CHEEMA TEHSIL WAZIRABAD,GUJRANWALA",
            "111282" =>"GOVT HIGH SCHOOL  BADDOKE GOSAIAN NEAR GHAKHAR MANDI, GUJRANWALA",
            "111283" =>"GOVT. MUHAMMAD MUSHTAQ SHAHEED HIGH SCHOOL, BUCHA CHATHA TEHSIL WAZIRABAD, GUJRANWALA",
            "111284" =>"GOVT HIGH SCHOOL FOR BOYS, CHHAJJOKE TEHSIL KAMONKE GUJRANWALA",
            "111285" =>"GOVT DEAF & DEFECTIVE HEARING HIGH SCHOOL, 4-Z BLOCK PEOPLES COLONY, GUJRANWALA",
            "111286" =>"WAPDA TOWN HIGH SCHOOL FOR BOYS, WAPDA TOWN, GUJRANWALA",
            "111287" =>"MODERN SCIENCE HIGH SCHOOL FOR BOYS, KASHMIR ROAD, FARID TOWN, GUJRANWALA",
            "111288" =>"GUJRANWALA CITY GRAMMAR SCHOOL FOR BOYS, HAFIZABAD ROAD, GUJRANWALA",
            "111289" =>"SCHOLARS HIGH SCHOOL FOR BOYS, G.T ROAD,NIZAMABAD TEHSIL WAZIRABAD GUJRANWALA",
            "111290" =>"EDEN HOME SCHOOL SYSTEM FOR BOYS, 16-D SATELLITE TOWN,GUJRANWALA",
            "111291" =>"GOVT. HIGH SCHOOL FOR BOYS, GHUMMAN WALA, NOWSHEHRA VIRKAN, GUJRANWALA",
            "111292" =>"GOVT. HIGH SCHOOL, KOT INAYAT KHAN, WAZIRABAD, GUJRANWALA",
            "111293" =>"GOVT. HIGH SCHOOL, CHABBA SINDHWAN, TEH. NOWSHEHRA VIRKAN, GUJRANWALA",
            "111294" =>"GOVT. HIGH SCHOOL, ABID ABAD, TEH. NOWSHEHRA VIRKAN, GUJRANWALA",
            "111295" =>"GOVT. HIGH SCHOOL FOR BOYS, TAMBOLI TEH. KAMOKE, GUJRANWALA",
            "111296" =>"AIMS GRAMMER HIGH SCHOOL FOR BOYS, DAROGHA ABADI, JINNAH ROAD, KHIALI, GUJRANWALA",
            "111297" =>"ALLIED SCHOOL (NAJJAF CAMPUS) FOR BOYS, COLLEGE ROAD, GUJRANWALA",
            "111298" =>"MUHAMMAD SHAFI KHALIL MEMORIAL MODEL SCHOOL FOR BOYS WAZIRABAD",
            "111300" =>"AL-HADI TRUST HIGH SCHOOL, CHAK NIZAM, CHOWK DHARM KOT, PASRUR ROAD, GUJRANWALA",
            "111301" =>"UNIQUE GRAMMAR SCHOOL FOR BOYS, CHAN DA QILA, JALIL TOWN, GUJRANWALA",
            "111302" =>"THE SPIRIT SCHOOL FOR BOYS, 128-D SATELLITE TOWN, GUJRANWALA",
            "111303" =>"GOHEER CAMBRIDGE SECONDARY SCHOOL FOR BOYS, NOWSHEHRA VIRKAN, GUJRANWALA",
            "111304" =>"GOVT. HIGH SCHOOL, BADDO RATTA, NOWSHEHRA VIRKAN, GUJRANWALA",
            "111305" =>"THE KNOWLEDGE SCHOOL FOR BOYS MOLANA ZAFAR ALI KHAN CAMPUS, NASEER COLONY, WAZIRABAD, GUJRANWALA",
            "111306" =>"THE EDUCATORS WAZIRABAD CAMPUS FOR BOYS, SIALKOT ROAD, WAZIRABAD, GUJRANWALA",
            "111307" =>"HEAVEN SCHOOL SYSTEM FOR BOYS, OPP. THANA QILA DIDAR SINGH, GUJRANWALA",
            "111308" =>"THE GUJRANWALA PUBLIC SCHOOL FOR BOYS, X-BLOCK, PEOPLES COLONY, GUJRANWALA",
            "111309" =>"THE PUNJAB SCHOOL SYSTEM FOR BOYS, CANTT VIEW TOWN, NEAR D.C COLONY, GUJRANWALA CANTT",
            "111310" =>"ALLIED SCHOOL KHIALI CAMPUS FOR BOYS, OPP. ASAD COLONY, SHEIKHUPURA ROAD, GUJRANWALA",
            "111311" =>"ALLIED SCHOOL PASRUR ROAD CAMPUS FOR BOYS, THATHA AZAM KHAN MORE, GUJRANWALA",
            "111312" =>"ALLIED SCHOOL (FAIZ CAMPUS) FOR BOYS, LODHI TOWN, SIALKOT ROAD, GUJRANWALA",
            "111313" =>"THE NATIONAL SCHOOL AIMED EDUCATION FOR BOYS, BOULEVARD, G.MAGNOLIA PARK, G.T ROAD, GUJRANWALA",
            "111314" =>"RANA SIDDIQUE SCHOOL OF ARTS AND SCIENCES, CAMPING GROUND, KAMOKE, GUJRANWALA",
            "111315" =>"ALLIED SCHOOL FOR BOYS, HAFIZABAD ROAD, QILA DIDAR SINGH, GUJRANWALA",
            "111316" =>"A+ SCHOOL SYSTEM FOR BOYS, SHAHRA-E-QUAID-E-AZAM, ALLAMA IQBAL TOWN, GUJRANWALA CANTT",
            "111317" =>"RILLS (RESOURCES OF INNOVATIVE & LIVELY LEARNING SKILLS) SCHOOL FOR BOYS, KAMOKE, GUJRANWALA",
            "111318" =>"ALLIED SCHOOL KAMOKE CAMPUS FOR BOYS, TAJ TOWN, G.T ROAD, KAMOKE, GUJRANWALA",
            "111319" =>"ALLIED SCHOOL (D.C ROAD CAMPUS) FOR BOYS, COMMISSIONER ROAD, GUJRANWALA",
            "111320" =>"INTERNATIONAL ISLAMIC UNIVERSITY SCHOOL FOR BOYS, 28 D.C ROAD, GUJRANWALA",
            "111321" =>"ALLIED SCHOOL (WAHNDO CAMPUS) FOR BOYS, WALEED TOWN, WAHNDO, KAMOKE, GUJRANWALA",
            "111322" =>"ALLIED SCHOOL (GHAKHAR CAMPUS) FOR BOYS, NOORA KOT ROAD, GHAKHAR, GUJRANWALA",
            "111323" =>"ALLIED SCHOOL FOR BOYS NANDI PUR CAMPUS, NIZAMPUR, SIALKOT ROAD, GUJRANWALA",
            "111324" =>"THE EDUCATORS (AL-KALEEM CAMPUS) FOR BOYS, NOWSHERA VIRKAN, GUJRANWALA",
            "111325" =>"THE ELITE SCHOOL FOR BOYS, 162-D DASTGIR ROAD, SATELLITE TOWN, GUJRANWALA",
            "111326" =>"OASIS INTERNATIONAL HIGH SCHOOL FOR BOYS, SECTOR-3 CANAL VIEW HOUSING SCHEME, GUJRANWALA",
            "111327" =>"ALLIED SCHOOL CANAL CAMPUS FOR BOYS, NEAR UBL BANK, PASRUR ROAD, FARID TOWN, GUJRANWALA",
            "111328" =>"GOVT. HIGH SCHOOL FOR BOYS, CHAK JAGNA, GUJRANWALA",
            "111329" =>"ALLIED SCHOOL MODEL TOWN CAMPUS FOR BOYS, 102/B, MODEL TOWN, GUJRANWALA",
            "111330" =>"AZEEM IDEAL SCHOOL OF SCIENCE & ARTS FOR BOYS, STREET HAJI IBRAHIM, MOHALLAH CHAH CHOHAN, ",
            "111331" =>"MODERN MISALI SECONDARY SCHOOL FOR BOYS, MUTTO BHAIKE ROAD, GHARRI NOWSHERA VIRKAN, GUJRAN",
            "111332" =>"KNOWLEDGE BASE SCHOOL SYSTEM FOR BOYS, KASHMIR ROAD, ZAHID COLONY, GUJRANWALA",
            "111333" =>"AL-FAISAL HIGH SCHOOL FOR BOYS, AHMAD NAGAR TEHSIL WAZIRABAD, GUJRANWALA",
            "111335" =>"FOTAN CENTRAL HIGH SCHOOL FOR BOYS, KELASKE TEHSIL WAZIRABAD, GUJRANWALA",
            "111336" =>"INTERNATIONAL ISLAMIC UNIVERSITY ISLAMABAD SCHOOL SYSTEM FOR BOYS, HAFIZABAD ROAD, ALI PUR",
            "111337" =>"ALLIED SCHOOL (AZAM CAMPUS) FOR BOYS, G.T ROAD, MANDIALA WARRAICH, GUJRANWALA",
            "111338" =>"GHAZALI MODEL HIGH SCHOOL FOR BOYS, KELASKE TEHSIL WZIRABAD, GUJRANWALA",
            "111339" =>"THE SMART SCHOOL (AL-NOOR CAMPUS) FOR BOYS, JALIL TOWN, ST.# 1, CHANDA QILA, GUJRANWALA",
            "111340" =>"FUTURE VISION SCHOOL SYSTEM FOR BOYS, 30-FEET BAZAR, SHAHEENABAD, GUJRANWALA",
            "111341" =>"THE CAMBRIDGE EDUCATION SYSTEM FOR BOYS, SPAL COLONY, G.T ROAD, WAZIRABAD, GUJRANWALA",
            "111342" =>"ARQAM DIVISIONAL PUBLIC HIGH SCHOOL FOR BOYS, MOHALLAH GARHI SHAHU, RAHWALI CANTT, GUJRANW",
            "111343" =>"BRIGHT CAREER SCHOOL SYSTEM FOR BOYS, 198-B, MODEL TOWN, GUJRANWALA",
            "111344" =>"THE SCHOOL FOR BOYS, MODEL TOWN, CITY KAMOKE, GUJRANWALA",
            "111345" =>"THE SMART SCHOOL GHAKHAR CAMPUS FOR BOYS, G.T ROAD, GHAKHAR, GUJRANWALA",
            "111346" =>"ALLIED SCHOOL (HARAM CAMPUS) FOR BOYS, CHANDA QILA, JALIL TOWN, GUJRANWALA",
            "111347" =>"RACHNA GRAMMAR HIGH SCHOOL FOR BOYS, G.T ROAD, RAHWALI, GUJRANWALA",
            "111348" =>"GOVT. HIGH SCHOOL NO.2, NOWSHERA VIRKAN, GUJRANWALA",
            "111349" =>"GOVT. HIGH SCHOOL (BOYS), KOT KHEWAN MALL P/O MANDIALA TEGA TEHSIL KAMOKE, GUJRANWALA",
            "111505" =>"GOVT. COMMUNITY MODEL HIGH SCHOOL G.T. ROAD GHAKHAR (GUJRANWALA)",
            "111508" =>"GOVT. C.M. BOYS HIGH SCHOOL QILA DIDAR SINGH (GUJRANWALA)",
            "111509" =>"GOVT. HIGH SCHOOL, RATTA BAJAWA, GUJRANWALA",
            "111510" =>"AIZAR KINDERGARTEN AND SECONDARY SCHOL FOR BOYS, 22-A/A SATELLITE TOWN, GUJRANWALA",
            "111511" =>"THE ROYAL SCHOOL OF SCIENCE FOR BOYS, MUSLIM BAZAR ST.NO.14 SHAH PUR KHIALI, GUJRANWALA",
            "111512" =>"ALLIED SCHOOL PEOPLES COLONY CAMPUS FOR BOYS, KASHMIR ROAD, PEOPLES COLONY, GURJANWALA",
            "111513" =>"TALENT SCIENCE SCHOOL FOR BOYS, 40-D SATELLITE TOWN, GUJRANWALA",
            "112002" =>"GOVT. GIRLS HIGH SCHOOL, ALI PUR CHATHA (GUJRANWALA)",
            "112003" =>"GOVT. GIRLS HIGH SCHOOL AROOP (GUJRANWALA)",
            "112004" =>"GOVT. GIRLS HIGH SCHOOL ABDAL (GUJRANWALA)",
            "112005" =>"GOVT. GIRLS HIGH SCHOOL BUDHA GORAYA (GUJRANWALA)",
            "112006" =>"GOVT. GIRLS HIGH SCHOOL BHATTI BHANGO (GUJRANWALA)",
            "112007" =>"GOVT. GIRLS HIGH SCHOOL DHAUNKAL (GUJRANWALA)",
            "112008" =>"GOVT. GIRLS HIGH SCHOOL DILAWAR CHEEMA (GUJRANWALA)",
            "112009" =>"GOVT. GIRLS HIGH SCHOOL DHILLANWALI (GUJRANWALA)",
            "112011" =>"GOVT. GIRLS HIGH SCHOOL FEROZEWALA (GUJRANWALA)",
            "112013" =>"GOVT. GIRLS HIGH SCHOOL GHUMMANWALA (GUJRANWALA)",
            "112014" =>"GOVT. GIRLS HIGH SCHOOL JAJOKE (GUJRANWALA)",
            "112015" =>"GOVT. GIRLS HIGH SCHOOL JOURA SIAN (GUJRANWALA)",
            "112016" =>"GOVT. GIRLS HIGH SCHOOL KALASKE (GUJRANWALA)",
            "112017" =>"TAMEER E MILLAT GIRLS HIGH SCHOOL PAK TOWN, KAMOKE (GUJRANWALA)",
            "112018" =>"GOVT. GIRLS HIGH SCHOOL, KAMOKE (GUJRANWALA)",
            "112019" =>"GOVT. GIRLS HIGH SCHOOL NO. 2 DHOOPSARI KAMOKE (GUJRANWALA)",
            "112020" =>"GOVT. GIRLS HIGH SCHOOL CHANDALI (GUJRANWALA)",
            "112021" =>"GOVT. GIRLS HIGH SCHOOL KARYAL KALAN (GUJRANWALA)",
            "112022" =>"GOVT. GIRLS HIGH SCHOOL KALI SUBA (GUJRANWALA)",
            "112023" =>"GOVT. GIRLS HIGH SCHOOL KOHLOWALA (GUJRANWALA)",
            "112024" =>"GOVT. GIRLS HIGH SCHOOL LALUPUR KAMOKE (GUJRANWALA)",
            "112025" =>"GOVT. GIRLS HIGH SCHOOL LADHEYWALA WARAICH (GUJRANWALA)",
            "112026" =>"GOVT. GIRLS HIGH SCHOOL MANSOOR WALI (GUJRANWALA)",
            "112027" =>"GOVT. GIRLS HIGH SCHOOL MANCHAR CHATHA (GUJRANWALA)",
            "112028" =>"GOVT. GIRLS HIGH SCHOOL MANDIALA TEGA (GUJRANWALA)",
            "112029" =>"GOVT. GIRLS HIGH SCHOOL MATTA VIRKAN (GUJRANWALA)",
            "112030" =>"GOVT. GIRLS HIGH SCHOOL MANGOKE-VIRKAN (GUJRANWALA)",
            "112031" =>"GOVT. GIRLS HIGH SCHOOL MADHERIANWALA KALAR (GUJRANWALA)",
            "112032" =>"GOVT. GIRLS HIGH SCHOOL NAT KALAN (GUJRANWALA)",
            "112033" =>"GOVT. GIRLS HIGH SCHOOL NOINKE (GUJRANWALA)",
            "112034" =>"GOVT. GIRLS HIGH SCHOOL NOWSHERA VIRKAN (GUJRANWALA)",
            "112035" =>"GOVT. GIRLS HIGH SCHOOL GAHREE (GUJRANWALA)",
            "112036" =>"GOVT. GIRLS HIGH SCHOOL PUPNAKHA (GUJRANWALA)",
            "112037" =>"GOVT. GIRLS HIGH SCHOOL QILA DIDAR SINGH (GUJRANWALA)",
            "112038" =>"GOVT. M.A ISLAMIA GIRLS HIGH SCHOOL QILA DIDAR SINGH (GUJRANWALA)",
            "112039" =>"GOVT. GIRLS HIGH SCHOOL QILA MIAN SINGH (GUJRANWALA)",
            "112040" =>"GOVT. GIRLS HIGH SCHOOL RAHWALI (GUJRANWALA)",
            "112043" =>"GOVT. GIRLS HIGH SCHOOL SOHDRA (GUJRANWALA)",
            "112044" =>"GOVT. GIRLS HIGH SCHOOL SANSRA GORAYA (GUJRANWALA)",
            "112045" =>"GOVT. GIRLS HIGH SCHOOL TALWANDI MUSA KHAN (GUJRANWALA)",
            "112046" =>"GOVT. GIRLS HIGH SCHOOL TALWANDI KHAJOOR WALI (GUJRANWALA)",
            "112047" =>"GOVT. GIRLS HIGH SCHOOL TATLAY AALI (GUJRANWALA)",
            "112048" =>"GOVT. GIRLS HIGH SCHOOL VERPAL (GUJRANWALA)",
            "112049" =>"GOVT. GIRLS HIGH SCHOOL WAHNDO (GUJRANWALA)",
            "112050" =>"GOVT. (M.C) GIRLS HIGH SCHOOL WAZIRABAD (GUJRANWALA)",
            "112051" =>"GOVT. S.K GIRLS HIGH SCHOOL WAZIRABAD (GUJRANWALA)",
            "112052" =>"GOVT. GIRLS HIGH SCHOOL NIZAMABAD, WAZIRABAD (GUJRANWALA)",
            "112053" =>"GOVT. SYED GIRLS HIGH SCHOOL GUJRANWALA",
            "112054" =>"GOVT. F.D. ISLAMIA GIRLS HIGH SCHOOL GUJRANWALA",
            "112055" =>"GOVT. MADRISA-TUL-BINNAT GIRLS HIGH SCHOOL GUJRANWALA",
            "112056" =>"GOVT. SAQAFAT UL BANAT HIGH SCHOOL GUJRANWALA",
            "112057" =>"GOVT. HAKIM BIBI GIRLS HIGH SCHOOL GUJRANWALA",
            "112058" =>"GOVT. NAJEEB MEMORIAL GIRLS HIGH SCHOOL GUJRANWALA",
            "112059" =>"GOVT. GULZAR-I-ISLAM GIRLS HIGH SCHOOL GUJRANWALA",
            "112061" =>"GOVT. MUSLIM MODEL HIGH SCHOOL FOR GIRLS GUJRANWALA",
            "112062" =>"GOVT. GIRLS HIGH SCHOOL GARJAKH GUJRANWALA",
            "112063" =>"GOVT. GIRLS MODEL HIGH SCHOOL SATELLITE TOWN GUJRANWALA",
            "112064" =>"GOVT. GIRLS HIGH SCHOOL, KHIALI (GUJRANWALA)",
            "112065" =>"GOVT. JAN BIBI GIRLS HIGH SCHOOL GUJRANWALA",
            "112066" =>"GOVT. TEHZIB-UL-BINNAT GIRLS HIGH SCHOOL GUJRANWALA",
            "112067" =>"GOVT. MODERN EDUCATION GIRLS HIGH SCHOOL ST. TOWN, GUJRANWALA",
            "112069" =>"JADEED DASTGIR IDEAL GIRLS HIGH SCHOOL GUJRANWALA",
            "112071" =>"LASANI GIRLS HIGH SCHOOL PEOPLES COLONY, Y-BLOCK,Q-STREET,HOUSE NO-26 ,GUJRANWALA",
            "112072" =>"QUAID-I-AZAM DIVISIONAL PUBLIC SCHOOL GUJRANWALA",
            "112073" =>"ST. PETERS ENGLISH HIGH SCHOOL GUJRANWALA",
            "112074" =>"PAKISTAN INTERNATIONAL PUBLIC SCHOOL AND COLLEGE GUJRANWALA",
            "112075" =>"GOVT. MISSION GIRLS HIGH SCHOOL GUJRANWALA",
            "112076" =>"GOVT. GIRLS HIGH SCHOOL SARFRAZ COLONY GUJRANWALA",
            "112077" =>"BEACONHOUSE SCHOOL SYSTEM GUJRANWALA",
            "112079" =>"TAMIR-E-MILLAT MODEL GIRLS HIGH SCHOOL FARID TOWN GUJRANWALA",
            "112080" =>"ST. MARY'S GIRLS HIGH SCHOOL MUNIR CHOWK CIVIL LINES, GUJRANWALA",
            "112081" =>"GOVT. GIRLS HIGH SCHOOL MUBARIK COLONY GUJRANWALA",
            "112083" =>"K.T. MODEL GIRLS HIGH SCHOOL GUJRANWALA",
            "112084" =>"AIZAR MODEL GIRLS HIGH SCHOOL SATELLITE TOWN GUJRANWALA",
            "112085" =>"SCIENCE FOUNDATION HIGH SCHOOL CIVIL LINES GUJRANWALA",
            "112087" =>"PIR MUHAMMAD TAMEER-E-MILLAT MODEL HIGH SCHOOL, (REGD) BHOMAAN BAATH DISTT. (GUJRANWALA)",
            "112088" =>"ROYAL GENIOUS CAMBRIDGE HIGH SCHOOL (GIRLS) KASHMIR ROAD PEOPLES COLONY, GUJRANWALA",
            "112089" =>"GOVT. GIRLS HIGH SCHOOL GUNNA AUR (GUJRANWALA)",
            "112090" =>"SPRING FIELD PUBLIC SCHOOL, GUJRANWALA",
            "112091" =>"PAKISTAN FOUNDATION MODEL GIRLS HIGH SCHOOL S/TOWN, GUJRANWALA",
            "112094" =>"ST.DENYS ENGLISH HIGH SCHOOL (GIRLS) 1.CHURCH ROAD CIVIL LINES GUJRANWALA.",
            "112095" =>"GRAMMAR PUBLIC SCHOOL, GUJRANWALA",
            "112096" =>"THE PUNJAB GIRLS HIGH SCHOOL SHAH PUR KHIALI GUJRANWALA",
            "112097" =>"PUNJAB GRAMMAR HIGH SCHOOL, (GIRLS) NIZAMPUR (GUJRANWALA)",
            "112098" =>"SIR SYED PILOT HIGHER SECONDARY SCHOOL MODEL COLONY WAZIRABAD (GUJRANWALA)",
            "112100" =>"GOVT. GIRLS HIGH SCHOOL, MANDIALA WARRAICH (GUJRANWALA)",
            "112102" =>"HAIDER MEMORIAL SECONDARY SCHOOL SAROKI TEH. WAZIRABAD (GUJRANWALA)",
            "112103" =>"JAMIA IDRESSIA GIRLS HIGH SCHOOL (REGD) GALA BARAF KHANA HAFIZABAD ROAD GUJRANWALA",
            "112104" =>"GOVT. GIRLS HIGH SCHOOL, HAZRAT KAILIANWALA (GUJRANWALA)",
            "112105" =>"BEST SCHOOL SYSTEMS 39-A, SATELLITE TOWN,GUJRANWALA",
            "112106" =>"THE PAKISTAN SCHOOL FOR GIRLS GUJRANWALA",
            "112107" =>"AMERICAN INTERNATIONAL SCHOOL FOR GIRLS S/TOWN GUJRANWALA",
            "112108" =>"USMAN GRAMMAR S. SCHOOL FOR GIRLS NEAR NIGAR PHATTAK, GUJRANWALA",
            "112110" =>"F.M. MEMORIAL HIGH SCHOOL G.T. ROAD RAHWALI GUJRANWALA",
            "112111" =>"GARISH HIGH SCHOOL FOR GIRLS DHULLEY GUJRANWALA",
            "112112" =>"AISHA GIRLS HIGH SCHOOL SHALIMAR TOWN GUJRANWALA",
            "112113" =>"KIN'S INTERNATIONAL PUBLIC GIRLS HIGH SCHOOL GUJRANWALA",
            "112114" =>"BIBI ,N, BABA GIRLS HIGH SCHOOL, GUJRANWALA",
            "112115" =>"LYCEUM CAMPUS, HIGH SCHOOL FOR GIRLS, B-1 WAPDA TOWN GUJRANWALA",
            "112117" =>"JINNAH INTERNATIONAL PUBLIC SCHOOL, KHOKHERKI SIALKOT ROAD, GUJRANWALA",
            "112118" =>"YOUNG SCHOLARS COMPUTER HIGH SCHOOL FOR GIRLS RAHWALI GUJRANWALA",
            "112119" =>"SCIENCE BASE GIRLS HIGH SCHOOL SATELLITE TOWN GUJRANWALA",
            "112120" =>"THE EDUCATORS GLOBAL ACADEMIC CAMPUS (GIRLS)  PAK TOWN, G.T. ROAD KAMOKE (GUJRANWALA)",
            "112121" =>"JADEED MUBBASHAR IDEAL GIRLS HIGH SCHOOL GUJRANWALA",
            "112123" =>"AZAM PUBLIC GIRLS HIGH SCHOOLGALA CH. IJAZ WALAQILA DIDAR SINGH GUJRANWALA",
            "112124" =>"AL-BADR GIRLS HIGH SCHOOL ASAD COLONY GUJRANWALA",
            "112125" =>"ASAAS NATIONAL SCHOOL (FOR GIRLS) SHAHRAH-E- QUAID-E- AZAM GUJRANWALA CANTT",
            "112126" =>"AL-BADAR GIRLS HIGH SCHOOL ZAHEER COLONY, GUJRANWALA",
            "112127" =>"SCIENCE LOCUS HIGH SCHOOL (FOR GIRLS) 132-D SATELLITE TOWN GUJRANWALA",
            "112129" =>"CITY CARDINAL HIGH SCHOOL 8-DC ROAD, GUJRANWALA",
            "112131" =>"BLUE BELLS KIDS CAMPUS FOR GIRLS 74-A S.TOWN GUJRANWALA",
            "112133" =>"ISLAMABAD  EDUCATIONAL CENTER GIRLS HIGH SCHOOL (REGD) PEOPLE'S COLONY GUJRANWALA PAKISTAN",
            "112134" =>"SCIENCE VERTEX, THE SCHOOL OF SCIENCES FOR GIRLS,DELTA ROAD, GUJRANWALA",
            "112135" =>"CITY PUBLIC MODEL HIGH SCHOOL, (FOR GIRLS) NOWSHERA ROAD,  GUJRANWALA",
            "112136" =>"NEW SCIENCE FOUNDATION SCHOOL (FOR GIRLS) KAMOKE GUJRANWALA",
            "112137" =>"CIVIL PILOT GIRLS HIGH SCHOOL GUJRANWALA",
            "112138" =>"ALLAMA IQBAL IDEAL GIRLS AND BOYS HIGH SCHOOL ALLAMA IQBAL TOWN SIALKOT ROAD JUGNA GUJRANWALA",
            "112139" =>"EDUCATION VERTEX HIGH SCHOOL (FOR GIRLS) MOHAFIZ TOWN, GUJRANWALA",
            "112140" =>"BATALA INTERNATIONAL PUBLIC SCHOOL, GUJRANWALA",
            "112141" =>"CITY STANDARD BOYS AND GIRLS HIGH SCHOOL HAFIZABAD ROAD, GUJRANWALA",
            "112142" =>"STUDY HOUSE SCHOOL SYSTEM FOR BOYS AND GIRLS, BAKHTAYWALA GUJRANWALA",
            "112143" =>"AL-MADNI MODEL GIRLS HIGH SCHOOL DADWALI SHARIF, TEH. WAZIRABAD (GUJRANWALA)",
            "112144" =>"CITY PUBLIC SCHOOL (REGD) COLLEGE ROAD PEOPLES COLONY, GUJRANWALA",
            "112145" =>"JAMAL MODEL HIGH SCHOOL NEAR KAMOKE (GUJRANWALA)",
            "112146" =>"DECENT MODEL SCIENCE SCHOOL (FOR GIRLS) MAIN ROAD BEHARY COLONY X BLOCK PEOPLE COLONY, GUJRANWALA",
            "112147" =>"MILLAT SCIENCE PUBLIC GIRLS HIGH SCHOOL, JALAL BALAGGAN (GUJRANWALA)",
            "112148" =>"USMANIA GIRLS HIGH SCHOOL (REGD) CHOWK KANGNIWALA, GUJRANWALA",
            "112149" =>"JINNAH SCIENCE FOUNDATION GIRLS HIGH SCHOOL, BHATTI BHANGO (GUJRANWALA)",
            "112150" =>"FAISAL MEMORIAL GIRLS HIGH SCHOOL, AROOP (GUJRANWALA)",
            "112151" =>"GOVT. M. C. GIRLS HIGH SCHOOL, KAMOKE (GUJRANWALA)",
            "112152" =>"LITTLE SCHOLARS PUBLIC SCHOOL, BAGHBANPURA, HAFIZABAD ROAD GUJRANWALA",
            "112153" =>"AZAM INTERNATIONAL SCHOOL ALIPUR CHATTAH DISTT: GUJRANWALA, PAKISTAN",
            "112154" =>"THE EDUCATORS CIVIL LINE CAMPUS FOR GIRLS, SESSION COURT ROAD, GUJRANWALA",
            "112155" =>"GOVT. GIRLS HIGH SCHOOL JALHAN (GUJRANWALA)",
            "112156" =>"GOVT GIRLS HIGH SCHOOL KASHMIR COLONY GUJRANWALA CANTT",
            "112157" =>"TALENT SCIENCE SCHOOL SATELLITE TOWN GUJRANWALA",
            "112158" =>"UMER GRAMMAR HIGH SCHOOL FOR GIRLS BEHARI COLONY GUJRANWALA",
            "112159" =>"PACIFIC INTERNATIONAL HIGH SCHOOL ASAD COLONY, SHEIKHPURA ROAD, GUJRANWALA",
            "112160" =>"PAK ITTEHAD ENGLISH HIGH SCHOOL, MOAFIWALA GUJRANWALA",
            "112161" =>"SEERAT HIGH SCHOOL (FOR GIRLS) FAIZ-E-ALAM TOWN GUJRANWALA",
            "112162" =>"THE ELITE EDUCATORS HIGH SCHOOL MANDIALA CHATHA (GUJRANWALA)",
            "112163" =>"DAWN PUBLIC HIGH SCHOOL 3- MAIN ROAD GARJAKH GUJRANWALA",
            "112164" =>"ZIA-E-ISLAM GIRLS HIGH SCHOOL TATLAY AALI (GUJRANWALA)",
            "112166" =>"MUSLIM IDEAL GIRLS HIGH SCHOOL MANDIALA TEGA (GUJRANWALA)",
            "112167" =>"NEW WAY MODEL GIRLS HIGH SCHOOL GALA MEHR BAGGUWALA GUJRANWALA",
            "112168" =>"SUNRISE PUBLIC HIGH SCHOOL FOR GIRLS ST NO 2 MOH: TARIQABAD GRW",
            "112169" =>"SUN RISE MODEL HIGH SCHOOL, RAHWALI",
            "112170" =>"THE PAKISTAN ENGLISH SCHOOL FOR GIRLS TOWER ROAD KHIALI GUJRANWALA",
            "112171" =>"SCIENCE WAY SCHOOL SYSTEM FOR GIRLS RACE COURSE ROAD, ALLAH BUKHSH COLONY,GUJRANWALA",
            "112172" =>"MUSLIM MODEL GIRLS HIGH SCHOOL CHOWK GHOSIA, KAMOKE, (GRW)",
            "112173" =>"F.J. SCIENCE HIGH SCHOOL NOWSHERA ROAD, GUJRANWALA",
            "112176" =>"IMPERIAL PUBLIC SCHOOL WAZIRABAD GUJRANWALA",
            "112177" =>"PAKISTAN ISLAMIC MODEL SCHOOL, FARID TOWN, GUJRANWALA",
            "112178" =>"IQRA MODEL HIGH SCHOOL (G) SHAHEENABAD GUJRANWALA",
            "112179" =>"LITTLE SCHOLARS SCHOOL SYSTEM TATLAY AALI GUJRANWALA",
            "112181" =>"AL-FAISAL GIRLS HIGH SCHOOL AHMAD NAGAR, DISTT GRW.",
            "112182" =>"DECENT PUBLIC SCHOOL (B/G) TOLEKEY ROAD KAMOKE GUJRANWALA",
            "112183" =>"QUAID AZAM PUBLIC HIGH SCHOOL AHMAD NAGER (GUJRANWALA)",
            "112184" =>"THE OXFORD SCHOOL (GIRLS) 1-A SATELLITE TOWN GUJRANWALA",
            "112186" =>"MARYLAND HIGH SCHOOL (FOR GIRLS) G.T. ROAD GHAKHAR CITY (GRW)",
            "112187" =>"DECENT PUBLIC GIRLS HIGH SCHOOL, KAMOKE",
            "112189" =>"AL-HAMD HIGH SCHOOL NOWSHERA ROAD, GUJRANWALA",
            "112190" =>"AL-FARABI MODEL HIGH SCHOOL (GIRLS) QUDRATABAD, WAZIRABAD GUJRANWALA",
            "112192" =>"BROOKFIELD IDEAL SCIENCE SCHOOL (FOR GIRLS) 10-RASHEED COLONY RACE COURSE ROAD GUJRANWALA",
            "112193" =>"M.S. MEMORIAL HIGH SCHOOL FAISAL COLONY NO.1 SHAH PUR KHIALI GUJRANWALA",
            "112194" =>"NASIR MEMORIAL HIGH SCHOOL GULSHAN COLONY SHEIKHPURA ROAD GUJRANWALA",
            "112195" =>"SCIENCE WAY SCHOOL SYSTEM FOR GIRLS MOH. SHOAIB NAGAR VERPAL CHATHA, (GRW)",
            "112196" =>"NEW JINNAH INTERNATIONAL PUBLIC SCHOOL, KALASKE (GUJRANWALA)",
            "112197" =>"SARDAR GRAMMAR SCHOOL SIDDIQUE-E-AKBAR TOWN, GUJRANWALA",
            "112198" =>"SUN RISE ISLAMIA GIRLS HIGH SCHOOL BHOMAN BATTH (GUJRANWALA)",
            "112199" =>"ASIAN PUBLIC GIRLS H/S GHAKKHAR (GUJRANWALA)",
            "112200" =>"ALLAMA EHSAN SHAHEED HIGH SCHOOL (G) KOT ISHAQ GUJRANWALA",
            "112201" =>"WHITE HOUSE SCHOOL PEOPLES COLONY GUJRANWALA",
            "112202" =>"THE EDUCATOR'S GIRLS MODEL TOWN, 327-A MODEL TOWN, GUJRANWALA",
            "112203" =>"THE EDUCATORS WAZIRABAD CAMPUS WAZIRABAD",
            "112204" =>"NEW LORETTO HOUSE SCHOOL, SYSTEM FOR GIRLS JINNAH ROAD, LINK D.C. ROAD, GUJRANWALA",
            "112205" =>"TALENT KIDS CAMPUS FOR GIRLS KASHMIR ROAD PEOPLES COLONY GUJRANWALA",
            "112206" =>"CRESCENT PUBLIC HIGH SCHOOL (FOR GIRLS) MORE EMINABAD, GUJRANWALA",
            "112207" =>"MUMTAZ GRAMMAR SCHOOL (FOR GIRLS) G.T. ROAD WAZIRABAD GUJRANWALA",
            "112209" =>"AL-FAROOQ ENGLISH HIGH SCHOOL TOWER ROAD KHIALI (GUJRANWALA)",
            "112210" =>"GLASGOW PUBLIC SCHOOL SYSTEM (FOR GIRLS) QILA DIDAR SING (GRW)",
            "112211" =>"THE EDUCATOR'S IQBAL CAMPUS FOR GIRLS",
            "112213" =>"PAK LAND MODEL SCHOOL G.T ROAD RAHWALI GUJRANWALA",
            "112214" =>"A.K.KIDS CAMPUS FOR GIRLS GUJRANWALA",
            "112215" =>"THE DAWN SCHOOL 29-ARAFAT COLONY GUJRANWALA",
            "112216" =>"PAKISTAN MODEL HIGH SCHOOL FOR GIRLS RAHWALI",
            "112217" =>"GARDEN PUBLIC GIRLS HIGH SCHOOL WAZIRABAD",
            "112218" =>"CANTT VIEW PUBLIC SCHOOL FOR GIRLS GUJRANWALA",
            "112221" =>"SAINT JOSEPH'S HIGH SCHOOL  HAFIZABAD ROAD GUJRANWALA",
            "112222" =>"SAINT PAUL'S HIGH SCHOOL SALEEM COLONY GUJRANWALA",
            "112223" =>"NEW HORIZON INSTITUTE OF SCIENCES FOR GIRLS Y-BLOCK PEOPLE'S COLONY",
            "112224" =>"ZAFAR IDEAL GIRLS HIGH SCHOOL QILA DIDAR SINGH DISTT. GUJRANWALA",
            "112225" =>"BRIGHT WAY PUBLIC HIGH SCHOOL GIRLS AABADI MEHAR WAZIR NOWSHEHRA ROAD GUJRANWALA",
            "112226" =>"WORKERS WELFARE SCHOOL FOR GIRLS GULSHAN COLONY GUJRANWALA",
            "112227" =>"GOVT. GIRLS HIGH SCHOOL JAMKE CHATTHA GUJRANWALA",
            "112228" =>"GOVT. GIRLS HIGH SCHOOL MAJJU CHAK GUJRANWALA",
            "112229" =>"GOVT. GIRLS HIGH SCHOOL JALAL BALAGAN GUJRANWALA",
            "112230" =>"GOVT. GIRLS HIGH SCHOOL CHAK CHOWDHRY GUJRANWALA",
            "112231" =>"WAZIR HASSAN MEMORIAL SCHOOL FOR GIRLS ALI PUR CHATTHA GUJRANWALA",
            "112232" =>"GREEN CASTLE SCHOOL SYSTEM  FOR GIRLS QILA DIDAR SINGH DIST. GUJRANWALA",
            "112233" =>"GOVT. GIRLS HIGH SCHOOL JANDIALA BAGH WALA GUJRANWALA",
            "112234" =>"SIRAT-UL JANNAH DIVISIONAL SCHOOL FOR GIRLS HAFIZABAD ROAD GUJRANWALA",
            "112235" =>"GHAZALI EDUCATIONAL COMPLEX (FOR GIRLS )ALI PARK , FAREED TOWN , GUJRANWALA",
            "112236" =>"IQRA HUFFAZ GIRLS SECONDARY SCHOOL GUJRANWALA",
            "112237" =>"I.D. MODEL SCIENCE SCHOOL (GIRLS) SIDDIQUE COLONY GUJRANWALA",
            "112239" =>"PUBLIC SCIENCE GIRLS HIGH SCHOOL GILL ROAD, GUJRANWALA",
            "112240" =>"HAFIZ MODEL HIGH SCHOOL FOR GIRLS FARID TOWN GUJRANWALA",
            "112241" =>"GOVT. GIRLS HIGH SCHOOL KOT LADHA GUJRANWALA",
            "112242" =>"GOVT. GIRLS HIGH SCHOOL ADIL GARH GUJRANWALA",
            "112243" =>"GOVT. GIRLS HIGH SCHOOL NOKHAR DIST. GUJRANWALA",
            "112244" =>"GOVT. GIRLS HIGH SCHOOL MARALIWALA GUJRANWALA",
            "112246" =>"KIDS HOUSE ENGLISH SCHOOL FOR GIRLS GUJRANWALA 1-REHMAT PURA B, NOWSHERA ROAD, GUJRANWALA",
            "112247" =>"ZIA-E-MADINA SECONDARY  SCHOOL FOR GIRLS WAZIRABAD (GUJRANWALA)",
            "112248" =>"GOVT. GIRLS HIGH SCHOOL JANDIALA DHABWALA TEH. WAZIRABAD DIST. GRW",
            "112249" =>"SCHOLARS HIGH SCHOOL (FOR GIRLS) G.T. ROAD, NIZAMABAD WAZIRABAD (GUJRANWALA)",
            "112250" =>"AL-MASHRIQ PUBLIC HIGH SCHOOL FOR GIRLS NOWSHERA ROAD GUJRANWALA",
            "112251" =>"HIJAB PUBLIC SECONDARY SCHOOL FOR GIRLS KALASKE GUJRANWALA",
            "112252" =>"THE ISLAMIC SCIENCE FOCUS SCHOOL MADHOKHALIL (GUJRANWALA)",
            "112253" =>"THE UNIQUE SECONDARY SCHOOL (GIRLS) SIALKOT ROAD, GUJRANWALA",
            "112254" =>"GOVT. GIRLS HIGH SCHOOL BHIRI SHAH REHMAN (GUJRANWALA)",
            "112255" =>"UNIVERSAL SCIENCE SECONDARY SCHOOL FOR GIRLS BHATTI BHANGO GUJRANWALA",
            "112256" =>"JALAL MODEL HIGH SCHOOL FOR GIRLS BARKAT COLONY GUJRANWALA",
            "112257" =>"DOCTOR PUBLIC HIGH SCHOOL FOR GIRLS. WAYAN WALI WAZIRABAD, GUJRANWALA",
            "112258" =>"NEW CRESCENT PUBLIC HIGH SCHOOL (FOR GIRLS) MORE EMINABAD, GUJRANWALA",
            "112259" =>"ISLAMIA HIGH SCHOOL FOR GIRLS NOWSHERA VIRKAN DISTT. GUJRANWALA",
            "112260" =>"AIMS GRAMMAR HIGH SCHOOL, JINNAH ROAD, KHIALI, GUJRANWALA",
            "112261" =>"KING EDWARD GRAMMAR HIGH SCHOOL (FOR GIRLS) GUJRANWALA.",
            "112262" =>"ALLIED SCHOOL FOR GIRLS CIVIL LINES SESSION COURT ROAD GUJRANWALA",
            "112263" =>"THE EDUCATORS SCHOOL FOR GIRLS EMINABAD G.T. ROAD GUJRANWALA",
            "112264" =>"GOVT. GIRLS HIGH SCHOOL MUGHAL CHAK KALAN GUJRANWALA",
            "112265" =>"EDUCATION HEART SECONDARY SCHOOL FOR GIRLS, ASGHAR COLONY, GUJRANWALA",
            "112266" =>"NEW TAMEER-E-MILLAT HIGH SCHOOL FOR GIRLS, MANDIALA TEGA, KAMOKE, GUJRANWALA",
            "112267" =>"COMPREHENSIVE SCHOOL SYSTEM FOR GIRLS, G.T. ROAD, KAMOKE, GUJRANWALA",
            "112268" =>"SCIENCE LOCUS ISLAMIC SCHOOL FOR GIRLS, SADHOKE, KAMOKE, GUJRANWALA",
            "112269" =>"PRIMA STANDARD HIGH SCHOOL FOR GIRLS, G.T. ROAD, KAMOKE, GUJRANWALA",
            "112270" =>"NATIONAL CHILDREN ENGLISH HIGH SCHOOL FOR GIRLS, 14-WAHDAT COLONY, GUJRANWALA",
            "112271" =>"THE SPIRIT HIGH SCHOOL FOR GIRLS, TOLEKEY ROAD, KAMOKE, GUJRANWALA",
            "112272" =>"AL-MUSTAFA MODEL HIGH SCHOOL FOR GIRLS, FAREED TOWN, GUJRANWALA",
            "112273" =>"NEW CAMBRIDGE SCHOOL SYSTEM FOR GIRLS TOLEKEY ROAD, KAMOKE, GUJRANWALA",
            "112274" =>"LIGHT WAY SCHOOL FOR GIRLS, PEOPLES COLONY, GUJRANWALA",
            "112276" =>"SOUTH EASTERN SCIENCE SCHOOL FOR GIRLS, GUJRANWALA",
            "112277" =>"MUSLIM HANDS SCHOOL OF EXCELLENCE FOR GIRLS, SOHDRA MOR WAZIRABAD, GUJRANWALA",
            "112279" =>"IQRA GIRLS HIGH SCHOOL TATLAY AALI NOWSHERA VIRKAN GUJRANWALA ",
            "112282" =>"ABBASIYA INTERNATIONAL HIGH SCHOOL FOR GIRLS CHAK AZIZ, WAZIRABAD, GUJRANWALA",
            "112283" =>"PAKISTAN PILOT SECONDARY SHOOL FOR GIRLS  BHROKE CHEEMA TEHSIL WAZIRABAD DISTRICT GUJRANWALA",
            "112284" =>"ISLAMIC SCHOOL OF SCIENCE FOR GIRLS TALWANIDI KAHJOOR WALI GUJRANWALA",
            "112285" =>"THE EDEN KIDS CAMPUS & HIGH SCHOOL FOR GIRLS, NEAR GOVT. SCHOOL ADHOROY ROAD, MUMTAZABAD, MORE EMINA",
            "112286" =>"ALLIED SCHOOL (APC) CAMPUS FOR GIRLS, RAILWAY ROAD ALI PUR CHATTHA, GUJRANWALA",
            "112287" =>"PUNJAB LYCEUM SCHOOL FOR GIRLS, PROFESSORS COLONY AROOP ROAD, GUJRANWALA.",
            "112288" =>"ALLIED SCHOOL WAZIRABAD CAMPUS FOR GIRLS, SHADMAN TOWN NEAR UMAR MARRIAGE HALL WAZIR ABAD GUJRANWALA",
            "112289" =>"GUJRANWALA CITY GRAMMAR SCHOOL FOR GIRLS, PURANI CHUNGI, HAFIZABAD ROAD, GUJRANWALA",
            "112290" =>"PAKISTAN MODEL SECONDARY SCHOOL FOR GIRLS, SCHOOL ROAD, FEROZEWALA GUJRANWALA",
            "112291" =>"ASAD PUBLIC HIGH SCHOOL FOR GIRLS, NEAR QILA MAIN SING, MAIN KHABAYKEY ROAD, GUJRANWALA",
            "112292" =>"HAROON INTERNATIONAL SCHOOL FOR GIRLS, HAROON STREET D.C. ROAD, GUJRANWALA",
            "112293" =>"AL-BARAKAAT MODEL HIGH CHOOL FOR GIRLS, CHAHAL KALAN, GUJRANWALA",
            "112294" =>"PUNJAB GROUP HIGH SCHOOL FOR GIRLS, G.T ROAD BY PASS, WAZIRABAD",
            "112295" =>"PAKISTAN FOUNDATION SCHOOL FOR GIRLS, GUJRANWALA CANTT",
            "112296" =>"AL-ZAHRA GIRLS SECONDARY SCHOOL, AZIZ CHAK,WAZIRABAD,GUJRANWALA",
            "112297" =>"MAJEED MEMORIAL MODEL HIGH SCHOOL FOR GIRLS,MUSTAFA COLONY,SUI GAS ROAD,GUJRANWALA",
            "112298" =>"OXFORD COMPUTER HIGH SCHOOL FOR GIRLS, VERPAL CHATTHA, WAZIRABAD",
            "112299" =>"DAR-E-ARQAM HIGH SCHOOL FOR GIRLS,DHONKAL ROAD,WAZIRABAD.",
            "112300" =>"MY SCHOOL EDUCATION SYSTEM FOR GIRLS,107-SATELLITE TOWN,GUJRANWALA",
            "112301" =>"GREEN HOUSE MODEL HIGH SCHOOL FOR GIRLS BHARA GALA PATANKEY ROAD AHMAD NAGAR TEHSIL WAZIRABAD GUJRAN",
            "112302" =>"GOVT. GIRLS HIGH SCHOOL BOTALA SHARAM SINGH, GUJRANWALA",
            "112303" =>"GOVT. GIRLS HIGH SCHOOL BOTALA SHARAM SINGH, GUJRANWALA",
            "112304" =>"GOVT. GIRLS SCHOL TRIGRI TEHS & DISTT GUJRANWALA",
            "112305" =>"GOVT. GIRLS HIGH SCHOOL NO 2 LAKH DATA, GAKHAR TEHSIL WAZIRABAD DISTT GUJRANWALA",
            "112306" =>"GOVT. GIRLS HIGH SCHOOL CHABBA SANDHWAN TEHSIL NOSHEHRA VIRKAN, GUJRANWALA",
            "112307" =>"GOVT.GIRLS HIGH SCHOOL, GHAKKA MITTER, WAZIRABAD, GUJRANWALA",
            "112308" =>"GOVT. GIRLS HIGH SCHOOL, SAROKI CHEEMA TEHSIL WAZIRABAD, GUJRANWALA",
            "112309" =>"GOVT. GIRLS HIGH SCHOOL, SAHARAN CHATTHA TEHSIL WAZIRABAD, GUJRANWALA",
            "112310" =>"GOVT. GIRLS HIGH SCHOOL, BENKA CHEEMA TEHSIL WAZIRABAD, GUJRANWALA",
            "112311" =>"GOVT. GIRLS HIGH SCHOOL,DADWALI TEHSIL WAZIRABAD, GUJRANWALA",
            "112312" =>"GOVT. GIRLS HIGH SCHOOL, MARI BHINDRAN TEHSIL NOWSHEHRA VIRKAN, GUJRANWALA",
            "112313" =>"GOVT. GIRLS HIGH SCHOOL, TAMBOLI TEHSIL KAMOKE, GUJRANWALA",
            "112315" =>"ASSET GREEN TREE GIRLS HIGH SCHOOL DHOOP CHARI NEAR CHANDALA, KAMOKE, GUJRANWALA",
            "112316" =>"PAK AIMS GIRLS HIGH SCHOOL, KOT SHERA TEHSIL & DISTRICT GUJRANWALA",
            "112318" =>"ALI GARH BOARDING SCHOOL FOR GIRLS, NEAR RAILWAY PHATAK, DASKA ROAD, WAZIRABAD, GUJRANWALA",
            "112319" =>"AL-NOOR PUBLIC HIGH SCHOOL FOR GIRLS, LADY PARK ROAD, KAMOKE, GUJRANWALA",
            "112320" =>"EDEN HOME SCHOOL SYSTEM FOR GIRLS, SATELLITE TOWN, GUJRANWALA",
            "112321" =>"IMPERIAL HIGH SCHOOL SYSTEM FOR GIRLS,FAREED TOWN DISTRICT GUJRANWALA",
            "112322" =>"ALLIED SCHOOL ISHAQ CAMPUS FOR GIRLS,G.T ROAD, MORE AMINABAD,GUJRANWALA",
            "112323" =>"CATHEDRAL SCHOOL FOR GIRLS,SMALL LINES, GUJRANWALA",
            "112325" =>"DAR-E-AMAL SCHOOL SYSTEM FOR GIRLS,CHAURA TEHSIL WAZIRABAD,GUJRANWALA",
            "112326" =>"GEPCO GRAMMER SCHOOL FOR GIRLS, WAPDA COLONY, CAMPING GROUND G.T ROAD, GUJRANWALA",
            "112327" =>"GOVT. GIRLS HIGH SCHOOL, KOTLI NAWAB, KAMOKE, GUJRANWALA",
            "112329" =>"GOVT. GIRLS HIGH SCHOOL, NOWSHEHRA SANSI, GUJRANWALA",
            "112330" =>"GOVT. GIRLS HIGH SCHOOL, AULAKH BHAIKE TEH. NOWSHEHRA VIRKAN, GUJRANWALA",
            "112331" =>"GOVT. MIAN BADAR DIN MODEL GIRLS HIGH SCHOOL, SIALKOT ROAD, CIVIL LINE, GUJRANWALA",
            "112332" =>"GOVT. GIRLS HIGH SCHOOL, BADOKE SEIKHWAN, TEH. NOWSHEHRA VIRKAN, GUJRANWALA",
            "112333" =>"GOVT. GIRLS HIGH SCHOOL, PHILOKI TEH. NOWSHEHRA VIRKAN, GUJRANWALA",
            "112334" =>"GOVT. GIRLS HIGH SCHOOL, BALOKI VIRKAN, TEH. NOWSHEHRA VIRKAN, GUJRANWALA",
            "112335" =>"GOVT. GIRLS HIGH SCHOOL, BOTALA JHANDA SINGH, GUJRANWALA",
            "112336" =>"GOVT. GIRLS HIGH SCHOOL, KOT BHWANIDAS, GUJRANWALA",
            "112337" =>"THE PUNJAB GIRLS HIGH SCHOOL, CANTT VIEW TOWN NEAR D.C COLONY, GUJRANWALA CANTT",
            "112338" =>"GOVT. GIRLS HIGH SCHOOL, NEAR GOVT. H/S NO. 1, QILA DIDAR SINGH, GUJRANWALA",
            "112339" =>"GOVT. GIRLS HIGH SCHOOL, LADHEWALA CHEEMA, TEH. WAZIRABAD, GUJRANWALA",
            "112340" =>"GOVT. GIRLS HIGH SCHOOL, DANDIAN TEH. KAMOKE, GUJRANWALA",
            "112342" =>"GOVT. GIRLS HIGH SCHOOL, BADDOKI GOSSAIAN, GUJRANWALA",
            "112343" =>"GOVT. GIRLS HIGH SCHOOL, HAMEED PUR KALAN, KAMOKE, GUJRANWALA",
            "112344" =>"GOVT. GIRLS HIGH SCHOOL, AMIN PUR SYEDAN, GUJRANWALA",
            "112345" =>"BRIGHT CAREER SCHOOL SYSTEM FOR GIRLS, 198-B MODEL TOWN, GUJRANWALA",
            "112346" =>"ALLIED SCHOOL (NAJJAF CAMPUS) FOR GIRLS, COLLEGE ROAD, GUJRANWALA",
            "112347" =>"GOVT. GIRLS HIGH SCHOOL, MANZOORABAD, WAZIRABAD, GUJRANWALA",
            "112348" =>"AL-HADI TRUST HIGH SCHOOL FOR GIRLS, CHAK NIZAM, CHOWK DHARM KOT, GUJRANWALA",
            "112349" =>"THE SPIRIT SCHOOL FOR GIRLS, 128-D SATELLITE TOWN, GUJRANWALA",
            "112350" =>"HUSSAIN GIRLS HIGH SCHOOL, ALI PUR CHATTHA, WAZIRABAD, GUJRANWALA",
            "112351" =>"GOVT. M.C GIRLS HIGH SCHOOL, MOTI BAZAR, WAZIRABAD, GUJRANWALA",
            "112352" =>"PAK GRAMMER GIRLS PUBLIC HIGH SCHOOL, WAHNDO, KAMOKE, GUJRANWALA",
            "112353" =>"THE SCHOOL FOR GIRLS, PAK TOWN, NEAR ZTBL, G.T ROAD, KAMONKE, GUJRANWALA",
            "112354" =>"THE KNOWLEDGE SCHOOL (MOLANA ZAFAR ALI KHAN CAMPUS) FOR GIRLS, WAZIRABAD, GUJRANWALA",
            "112355" =>"GOVT. GIRLS HIGH SCHOOL, JABBOKE, KAMOKE, GUJRANWALA",
            "112356" =>"FARAN HIGH SCHOOL FOR GIRLS, NEAR KHIALI ADDA, GUJRANWALA",
            "112357" =>"ALLIED SCHOOL FOR GIRLS, HAFIZABAD ROAD, QILA DIDAR SINGH, GUJRANWALA",
            "112358" =>"RACHNA GRAMMAR HIGH SCHOOL FOR GIRLS, G.T ROAD RAHWALI, GUJRANWALA",
            "112359" =>"ALLIED SCHOOL (KHIALI CAMPUS) FOR GIRLS, ASAD COLONY, MAIN SHEIKHUPURA ROAD, KHIALI, GUJRANWALA",
            "112360" =>"GOVT. GIRLS HIGH SCHOOL, SAGHEER SHAHEED PARK, NOWSHEHRA ROAD, GUJRANWALA",
            "112361" =>"GOVT. GIRLS HIGH SCHOOL, TOLEKEE, KAMOKE, GUJRANWALA",
            "112362" =>"GOVT. GIRLS HIGH SCHOOL, RATTA BAJWA, GUJRANWALA",
            "112363" =>"GOVT. GIRLS HIGH SCHOOL, BHEEKO PUR, KACHA FATTOMAND ROAD, GUJRANWALA",
            "112364" =>"HEAVEN SCHOOL SYSTEM FOR GIRLS, OPP. THANA QILA DIDAR SINGH, GUJRANWALA",
            "112365" =>"THE GUJRANWALA PUBLIC SCHOOL FOR GIRLS, X-BLOCK, PEOPLES COLONY, GUJRANWALA",
            "112366" =>"ALLIED SCHOOL PASRUR ROAD CAMPUS FOR GIRLS, THATHA AZAM KHAN MORE, GUJRANWALA",
            "112367" =>"ALLIED SCHOOL (FAIZ CAMPUS) FOR GIRLS, BISMILLAH COLONY, SIALKOT BYPASS, GUJRANWALA",
            "112368" =>"ALLIED SCHOOL FOR GIRLS MODEL TOWN CAMPUS, 64-B, MODEL TOWN, GUJRANWALA",
            "112369" =>"A+ SCHOOL SYSTEM FOR GIRLS, SHAHRA-E-QUAID-E-AZAM, ALLAMA IQBAL TOWN, GUJRANWALA CANTT",
            "112370" =>"RILLS (RESOURCES OF INNOVATIVE & LIVELY LEARNING SKILLS) SCHOOL FOR GIRLS, KAMOKE, GUJRANWALA",
            "112371" =>"ALLIED SCHOOL KAMOKE CAMPUS FOR GIRLS, TAJ TOWN, G.T ROAD, KAMOKE, GUJRANWALA",
            "112372" =>"CRESCENT MODEL GIRLS HIGH SCHOOL, SUI GAS OFFICE ROAD, GULSHAN TOWN, GUJRANWALA",
            "112373" =>"ALLIED SCHOOL (D.C ROAD CAMPUS) FOR GIRLS, COMMISSIONER ROAD, GUJRANWALA",
            "112374" =>"INTERNATIONAL ISLAMIC UNIVERSITY ISLAMABAD SCHOOL FOR GIRLS, HAFIZABAD ROAD, ALIPUR CHATTHA, GUJRANWALA",
            "112375" =>"INTERNATIONAL ISLAMIC UNIVERSITY SCHOOL FOR GIRLS, 3/58 D.C ROAD, GUJRANWALA",
            "112376" =>"ZAM ZAM ISLAMIA PUBLIC HIGH SCHOOL FOR GIRLS, HAFIZABAD ROAD, GUJRANWALA",
            "112377" =>"ALLIED SCHOOL (GHAKHAR CAMPUS) FOR GIRLS, NOORA KOT ROAD, GHAKHAR, GUJRANWALA",
            "112378" =>"ALLIED SCHOOL (NANDIPUR CAMPUS) FOR GIRLS, NIZAMPUR, SIALKOT ROAD, GUJRANWALA",
            "112379" =>"THE EDUCATORS (AL-KALEEM CAMPUS) FOR GIRLS, NOWSHERA VIRKAN, GUJRANWALA",
            "112380" =>"GOHEER CAMBRIDGE SECONDARY SCHOOL FOR GIRLS, NOWSHERA VIRKAN, GUJRANWALA",
            "112381" =>"THE ELITE SCHOOL FOR GIRLS, 162-D DASTGIR ROAD, SATELLITE TOWN, GUJRANWALA",
            "112382" =>"RAFIQUE GIRLS HIGH SCHOOL MADHRIANWALA KALAR, KAMOKE, GUJRANWALA",
            "112383" =>"COMMUNITY MODEL GIRLS HIGH SCHOOL KALAIR UNCHA, WAZIRABAD, GUJRANWALA",
            "112384" =>"GOVT. DEAF & DEFECTIVE HEARING HIGH SCHOOL FOR GIRLS, 4-Z BLOCK, PEOPLES COLONY, GUJRANWALA",
            "112385" =>"OASIS INTERNATIONAL HIGH SCHOOL FOR GIRLS, SECTOR-3, CANAL VIEW HOUSING SCHEME, GUJRANWALA",
            "112386" =>"ALLIED SCHOOL CANAL CAMPUS FOR GIRLS, PASRUR ROAD, FARID TOWN, GUJRANWALA",
            "112387" =>"IDEAL SCIENCE SCHOOL FOR GIRLS, 81-X MAIN ROAD, PEOPLES COLONY, GUJRANWALA",
            "112388" =>"NATIONAL SCIENCE HIGH SCHOOL FOR GIRLS, STREET NO.7, BLOCK-C, GULSHAN IQBAL ROAD, SHAHEEN ",
            "112389" =>"BROOK FIELD SCIENCE SCHOOL FOR GIRLS, MANDIALA TEGA TEHSIL KAMOKE, GUJRANWALA",
            "112390" =>"GOVT. GIRLS HIGH SCHOOL, MANDIALA CHATHA TEHSIL WAZIRABAD, GUJRANWALA",
            "112391" =>"S.Z.ELAHI MODEL SCHOOL FOR GIRLS, MAIN G.T ROAD NEAR AL-MATWAKLE FLOUR MILL, WAZIRAB",
            "112392" =>"KNOWLEDGE BASE SCHOOL SYSTEM FOR GIRLS, KASHMIR ROAD, ZAHID COLONY, GUJRANWALA",
            "112393" =>"AL-BAYAN PUBLIC SCHOOL FOR GIRLS, GALA ZULFIQAR KHOKHAR WALA, SAMANABAD, GUJRANWALA",
            "112394" =>"AZEEM IDEAL SCHOOL OF SCIENCE & ARTS FOR GIRLS, STREET HAJI IBRAHIM, MOHALLAH CHAH CHOHAN,",
            "112395" =>"PACE SCHOOL SYSTEM FOR GIRLS, BAZAR SAIN SATTAR WALA, SIALKOT ROAD, BHEEKOPUR, GUJRANWALA",
            "112396" =>"GOVT. GIRLS HIGH SCHOOL, DHAROWAL TEHSIL WAZIRABAD, GUJRANWALA",
            "112397" =>"GOVT. GIRLS HIGH SCHOOL, SADHOKE TEHSIL KAMOKE, GUJRANWALA",
            "112398" =>"GOVT. GIRLS HIGH SCHOOL, CHAK JAGNA, SIALKOT ROAD, GUJRANWALA",
            "112399" =>"GOVT. GIRLS HIGH SCHOOL, WADDALA CHEEMA TEHSIL WAZIRABAD, GUJRANWALA",
            "112400" =>"GOVT. GIRLS HIGH SCHOOL, BAIG PUR TEHSIL NOSHERA VIRKAN, GUJRANWALA",
            "112401" =>"GOVT. GIRLS HIGH SCHOOL, BUTRANWALI, GUJRANWALA",
            "112402" =>"GOVT. GIRLS HIGH SCHOOL, KOT ANAYAT KHAN TEHSIL WAZIRABAD, GUJRANWALA",
            "112403" =>"GOVT. GIRLS HIGH SCHOOL, KASHMIR COLONY NO.2 NEAR MURAD EYE HOSPITAL, G.T. ROAD, GUJRANWAL",
            "112404" =>"GOVT. GIRLS HIGH SCHOOL, KHANKE HEAD TEHSIL WAZIRABAD, GUJRANWALA",
            "112405" =>"GOVT. GIRLS HIGH SCHOOL, SHAMEER TEHSIL KAMOKE, GUJRANWALA",
            "112406" =>"GOVT. GIRLS HIGH SCHOOL, DEHLA CHATHA TEHSIL WAZIRABAD, GUJRANWALA",
            "112407" =>"GOVT. GIRLS HIGH SCHOOL, SAHOKE VIRKAN TEHSIL NOWSHERA VIRKAN, GUJRANWALA",
            "112408" =>"GOVT. GIRLS HIGH SCHOOL, KATHOR KALAN TEHSIL WAZIRABAD, GUJRANWALA",
            "112409" =>"GOVT. GIRLS HIGH SCHOOL, LEEL VIRKAN TEHSIL NOWSHEHRA VIRKAN, GUJRANWALA",
            "112410" =>"GOVT. GIRLS HIGH SCHOOL, BHAROKE CHEEMA TEHSIL WAZIRABAD, GUJRANWALA",
            "112411" =>"GOVT. GIRLS HIGH SCHOOL, KURLKEY P/O THATHO MANAK TEHSIL NOWSHEHRA VIRKAN, GUJRANWALA",
            "112412" =>"NEW MILLENIUM SCIENCE CAMPUS FOR GIRLS, ASHFAQ TOWN, G.T. ROAD, MORE EMINABAD TEHSIL KAMOK",
            "112413" =>"SHAH WALI ULLAH SECONDARY SCHOOL FOR GIRLS, G.T ROAD, ATTAWA, GUJRANWALA",
            "112414" =>"ALLIED SCHOOL (AZAM CAMPUS) FOR GIRLS, G.T ROAD, MANDIALA WARRAICH, GUJRANWALA",
            "112415" =>"GHAZALI MODEL HIGH SCHOOL FOR GIRLS, NEAR GRID STATION, G.T ROAD, GHAKHAR TEHSIL WAZIRABAD",
            "112416" =>"THE SMART SCHOOL AL-NOOR CAMPUS FOR GIRLS, JALIL TOWN, ST.# 1, CHANDA QILA, GUJRANWALA",
            "112417" =>"FUTURE VISION SECONDARY SCHOOL FOR GIRLS, 30-FEET BAZAR, SHAHEENABAD, GUJRANWALA",
            "112418" =>"THE CAMBRIDGE EDUCATION SYSTEM FOR GIRLS, SPAL COLONY, G.T ROAD, WAZIRABAD, GUJRANWALA",
            "112419" =>"SUFFAH MODEL SCHOOL FOR GIRLS, MIAN ZIA UL HAQ ROAD, GUJRANWALA",
            "112420" =>"GOVT. MIAN REHMAT ALI MEMORIAL GIRLS HIGH SCHOOL, GUJRANWALA",
            "112421" =>"ALLIED SCHOOL (HARRAM CAMPUS) FOR GIRLS, CHANDA QILA, JALIL TOWN, GUJRANWALA",
            "112422" =>"GOVT. GIRLS, HIGH SCHOOL, BUCHA CHATHA TEHSIL WAZIRABAD, GUJRANWALA",
            "112423" =>"GOVT. R.A ISLAMIA GIRLS HIGH SCHOOL, CHAMMAN SHAH ROAD, GUJRANWALA",
            "112424" =>"GOVT. GIRLS HIGH SCHOOL, PASRUR ROAD, SULAKHANABAD, GUJRANWALA",
            "112425" =>"GOVT. GIRLS HIGH SCHOOL, BASSI WALA, GUJRANWALA",
            "112426" =>"GOVT. GIRLS HIGH SCHOOL, UGGO BHINDER TEHSIL KAMOKE, GUJRANWALA",
            "112427" =>"LIFE WAY SECONDARY SCHOOL FOR GIRLS, NEAR GRID STATION, SHAHEENABAD, GUJRANWALA",
            "112428" =>"GOVT. GIRLS HIGH SCHOOL, BABBAR TEHSIL NOWSHERA VIRKAN, GUJRANWALA",
            "112506" =>"GOVT. COMMUNITY MODEL GIRLS HIGH SCHOOL, GONDLANWALA (GUJRANWALA)",
            "112508" =>"GOVT. COMMUNITY GIRLS HIGH SCHOOL AND INTER COLLEGE GILLWALA WAZIRABAD (GUJRANWALA)",
            "112514" =>"GOVT. COMMUNITY MODEL GIRLS SCHOOL AND COLLEGE, TRIGRI (GUJRANWALA)",
            "112520" =>"GOVT. COMMUNITY GIRLS HIGH SCHOOL, NIZAMPUR (GUJRANWALA)",
            "112523" =>"GOVT. COMMUNITY MODEL GIRLS INTER COLLEGE PEER KOT ROAD, GHAKKHAR (GUJRANWALA)",
            "112526" =>"GOVT. COMMUNITY GIRLS MODEL HIGH SCHOOL RANA COLONY GUJRANWALA",
            "112527" =>"GOVT. FATIMA JINNAH C.M. GIRLS COLLEGE, KAMONKE (GUJRANWALA)",
            "112528" =>"GOVT. GIRLS COMMUNITY MODEL SCHOOL BADDOKI GHOSIAN (GUJRANWALA)",
            "112531" =>"GOVT. COMMUNITY MODEL HIGH SCHOOL NO. 2 G.T. ROAD, GHAKHAR (GUJRANWALA)",
            "112535" =>"GOVT. COMMUNITY MODEL GIRLS INTER COLLEGE ADIL GRAH, GHAKHAR (GUJRANWALA)",
            "112542" =>"GOVT. COMMUNITY MODEL GIRLS HIGH SCHOOL, QILA DIDAR SINGH (GUJRANWALA)",
            "112543" =>"GOVT. GIRLS C.M.H/ SCHOOL BHAROKE - CHEEMA, GRW",
            "112546" =>"COMMUNITY MODEL HIGH SCHOOL RAJKOT, GUJRANWALA",
            "112547" =>"GOVT. GIRLS HIGH SCOOL, ATTAWA G.T ROAD GUJRANWALA",
            "112548" =>"GOVT. GIRLS HIGH SCHOOL DHULLEY GUJRANWALA",
            "112549" =>"THE ROYAL SCHOOL OF SCIENCE FOR GIRLS, MUSLIM BAZAR ST.NO.14 SHAH PUR KHIALI, GUJRANWALA",
            "112550" =>"AIZAR KINDERGARTEN AND SECONDARY SCHOL FOR GIRLS,22-A/A SATELLITE TOWN, GUJRANWALA",
            "112551" =>"DAR-E-ARQAM SCHOOL FOR GIRLS, MAIN ROAD, PEOPLES COLONY, GUJRANWALA",
            "112552" =>"ALLIED SCHOOL PEOPLES COLONY CAMPUS FOR GIRLS, KASHMIR ROAD, PEOPLES COLONY, GURJANWALA",
            "121001" =>"GOVT. HIGH SCHOOL AMRA KALAN (GUJRAT)",
            "121002" =>"GOVT. HIGH SCHOOL ALAM GARH (GUJRAT)",
            "121003" =>"GOVT. HIGH SCHOOL AJNALA (GUJRAT)",
            "121004" =>"GOVT. HIGH SCHOOL AWAN SHARIF (GUJRAT)",
            "121005" =>"GOVT. HIGH SCHOOL BEHLOL PUR (GUJRAT)",
            "121006" =>"NISHAN-E- HAIDER AZIZ SHAHEED GOVT. HIGH SCHOOL BHURCH (GUJRAT)",
            "121007" =>"GOVT. ISLAMIA HIGH SCHOOL BAZURGWAL (GUJRAT)",
            "121008" =>"GOVT. HIGH SCHOOL BHOTA (GUJRAT)",
            "121009" =>"GOVT. HIGH SCHOOL BARU (GUJRAT)",
            "121010" =>"GOVT. HIGH SCHOOL BHAKHREWALI (GUJRAT)",
            "121011" =>"GOVT. ISLAMIA HIGH SCHOOL BARNALI (GUJRAT)",
            "121012" =>"GOVT. MILLAT HIGH SCHOOL BEOWALI (GUJRAT)",
            "121013" =>"GOVT. HIGH SCHOOL BHADDAR (GUJRAT)",
            "121014" =>"GOVT. HIGH SCHOOL BHAGOWAL KHURD (GUJRAT)",
            "121016" =>"GOVT. HIGH SCHOOL BAHARWAL (GUJRAT)",
            "121017" =>"GOVT. PUBLIC HIGH SCHOOL BHAGOWAL KALAN (GUJRAT)",
            "121018" =>"GOVT. HIGH SCHOOL BARILA (GUJRAT)",
            "121019" =>"GOVT. HIGH SCHOOL BAISA KALAN (GUJRAT)",
            "121020" =>"GOVT. HIGH SCHOOL BULANI (GUJRAT)",
            "121021" =>"GOVT. HIGH SCHOOL BHAG NAGAR (GUJRAT)",
            "121022" =>"GOVT. HIGH SCHOOL CHAK KAMALA (GUJRAT)",
            "121023" =>"MILLAT HIGH SCHOOL CHANNAN (GUJRAT)",
            "121024" =>"GOVT. HIGH SCHOOL CHAKORI BHELOWAL (GUJRAT)",
            "121025" =>"GOVT. ISLAMIA HIGH SCHOOL CHHANI DEONA (GUJRAT)",
            "121026" =>"GOVT. ISLAMIA HIGH SCHOOL CHAK MIANA BHARGRAN (GUJRAT)",
            "121027" =>"GOVT. ISLAMIA HIGH SCHOOL CHOPALA (GUJRAT)",
            "121028" =>"GOVT. HIGH SCHOOL CHECHIAN (GUJRAT)",
            "121029" =>"GOVT. HIGH SCHOOL, QASIM ABAD (CHOAMAL), (GUJRAT)",
            "121030" =>"GOVT. HIGH SCHOOL CHHOKAR KALAN (GUJRAT)",
            "121031" =>"GOVT. HIGH SCHOOL CHAK SAADA (GUJRAT)",
            "121032" =>"GOVT. HIGH SCHOOL DITTEWAL (GUJRAT)",
            "121033" =>"GOVT. HIGH SCHOOL DAULAT NAGAR (GUJRAT)",
            "121036" =>"GOVT. HIGH SCHOOL DHAKKARANWALL (GUJRAT)",
            "121037" =>"GOVT. HIGH SCHOOL DHUNNI (GUJRAT)",
            "121038" =>"GOVT. HIGH SCHOOL DILAWAR PUR (GUJRAT)",
            "121039" =>"GOVT. ISLAMIA HIGH SCHOOL DHORIA (GUJRAT)",
            "121040" =>"GOVT. HIGH SCHOOL DHING (GUJRAT)",
            "121042" =>"GOVT. BOYS HIGH SCHOOL DAK CHIBBAN (GUJRAT)",
            "121043" =>"GOVT. HIGH SCHOOL FATEH PUR (GUJRAT)",
            "121044" =>"GOVT. HIGH SCHOOL GUNJA (GUJRAT)",
            "121045" =>"GOVT. HIGH SCHOOL GANDRA KALAN (GUJRAT)",
            "121046" =>"GOVT. HIGH SCHOOL GAKHRA KALAN (GUJRAT)",
            "121047" =>"GOVT. HIGH SCHOOL GOLEKI (GUJRAT)",
            "121048" =>"GOVT. HIGH SCHOOL GOCHH (GUJRAT)",
            "121050" =>"GOVT. COMPREHENSIVE HIGH SCHOOL, GUJRAT",
            "121051" =>"GOVT. CHRISTIAN HIGH SCHOOL GUJRAT",
            "121052" =>"GOVT. ZAMINDAR HIGH SCHOOL GUJRAT",
            "121053" =>"PUBLIC MODEL HIGH SCHOOL RAILWAY ROAD GUJRAT",
            "121054" =>"GRAMMAR BOYS HIGH SCHOOL JALALPUR ROAD GUJRAT",
            "121056" =>"PAKISTAN INTERNATIONAL PUBLIC SCHOOL GUJRAT",
            "121057" =>"GOVT. PUBLIC HIGH SCHOOL NO.1 GUJRAT",
            "121058" =>"GOVT. PUBLIC HIGH SCHOOL NO.2 RAILWAY ROAD GUJRAT",
            "121059" =>"GOVT. MUSLIM HIGH SCHOOL GUJRAT",
            "121060" =>"GOVT. ISLAMIA HIGH SCHOOL GUJRAT",
            "121062" =>"FARAN PUBLIC HIGH SCHOOL, GUJRAT",
            "121063" =>"SHAUKAT MODEL HIGH SCHOOL NO.2 GUJRAT",
            "121065" =>"FAUJI FOUNDATION MODEL SCHOOL GUJRAT",
            "121066" =>"HASHMI ROYAL SECONDARY SCHOOL GUJRAT",
            "121067" =>"GOVT. HIGH SCHOOL HAZARA MUGHLAN (GUJRAT)",
            "121068" =>"GOVT. HIGH SCHOOL HAJI WALA (GUJRAT)",
            "121069" =>"GOVT. ISLAMIA HIGH SCHOOL NO.1 JALAL PUR JATTAN (GUJRAT)",
            "121070" =>"GOVT. ISLAMIA HIGH SCHOOL NO.2 JALAL PUR JATTAN (GUJRAT)",
            "121071" =>"GOVT. TALEEM UD DIN HIGH SCHOOL JALAL PUR JATTAN (GUJRAT)",
            "121072" =>"GOVT. HIGH SCHOOL JAURAH KARNANA",
            "121073" =>"GOVT. HIGH SCHOOL JALAL PUR SOBTIAN (GUJRAT)",
            "121074" =>"GOVT. HIGH SCHOOL JHEURANWALI (GUJRAT)",
            "121075" =>"GOVT. HIGH SCHOOL JANDANWALA AT MURALA (GUJRAT)",
            "121076" =>"GOVT. HIGH SCHOOL KHORI ALAM (GUJRAT)",
            "121078" =>"GOVT. ISLAMIA HIGH SCHOOL KUNJAH (GUJRAT)",
            "121080" =>"GOVT. HIGH SCHOOL KAKRALI (GUJRAT)",
            "121081" =>"GOVT. HIGH SCHOOL KOTLI BHAGWAN (GUJRAT)",
            "121082" =>"GOVT. HIGH SCHOOL KARIANWALA (GUJRAT)",
            "121083" =>"GOVT. HIGH SCHOOL KHARIAN (GUJRAT)",
            "121084" =>"GOVT. TALEEM UL ISLAM HIGH SCHOOL KHARIAN (GUJRAT)",
            "121085" =>"GOVT. TALEEM UL QURAN HIGH SCHOOL KHARIAN (GUJRAT)",
            "121086" =>"GOVT. HIGH SCHOOL KARNANA (GUJRAT)",
            "121087" =>"GOVT. HIGH SCHOOL KANG CHANNAN (GUJRAT)",
            "121088" =>"GOVT. HIGH SCHOOL LANGRIAL (GUJRAT)",
            "121089" =>"GOVT. HIGH SCHOOL LAKHANWAL (GUJRAT)",
            "121090" =>"GOVT. HIGH SCHOOL LADHA SADHA (GUJRAT)",
            "121091" =>"GOVT. JAMIA GHAUSIA HIGH SCHOOL LALAMUSA (GUJRAT)",
            "121092" =>"GOVT. MODEL HIGH SCHOOL LALAMUSA (GUJRAT)",
            "121093" =>"GOVT. PAKISTAN HIGH SCHOOL LALAMUSA (GUJRAT)",
            "121094" =>"GOVT. ISLAMIA HIGH SCHOOL LALAMUSA (GUJRAT)",
            "121095" =>"GOVT. RIZVIA HIGH SCHOOL LANGAY (GUJRAT)",
            "121096" =>"GOVT. T.I. HIGH SCHOOL MURARIAN (GUJRAT)",
            "121097" =>"GOVT. HIGH SCHOOL MACHHIWAL (GUJRAT)",
            "121098" =>"GOVT. R.A. HIGH SCHOOL MADINA (GUJRAT)",
            "121099" =>"GOVT. HIGH SCHOOL MIRZA TAHIR (GUJRAT)",
            "121100" =>"GOVT. HIGH SCHOOL MOHRI SHARIF (GUJRAT)",
            "121101" =>"GOVT. HIGH SCHOOL MALIK PUR MIRZA (GUJRAT)",
            "121102" =>"GOVT. HIGH SCHOOL MALHU KHOKHAR (GUJRAT)",
            "121103" =>"GOVT. HIGH SCHOOL MOEEN UD DIN PUR (GUJRAT)",
            "121104" =>"GOVT. ISLAMIA HIGH SCHOOL MALKA (GUJRAT)",
            "121105" =>"GOVT. HIGH SCHOOL MAKIANA (GUJRAT)",
            "121106" =>"GOVT. HIGH SCHOOL, MANGOWAL GHARBI (GUJRAT)",
            "121107" =>"GOVT. HIGH SCHOOL NAGRIAN (GUJRAT)",
            "121108" =>"GOVT. HIGH SCHOOL NAROWALI (GUJRAT)",
            "121109" =>"GOVT. HIGH SCHOOL NINDOWAL (GUJRAT)",
            "121110" =>"GOVT. HIGH SCHOOL PERO SHAH (GUJRAT)",
            "121111" =>"GOVT. HIGH SCHOOL PUNJAN KISSANA (GUJRAT)",
            "121112" =>"GOVT. PAKISTAN ISLAMIA HIGH SCHOOL SHADIWAL (GUJRAT)",
            "121113" =>"GOVT. HIGH SCHOOL SHEIKH PUR (GUJRAT)",
            "121114" =>"GOVT. HIGH SCHOOL SEHNA (GUJRAT)",
            "121115" =>"GOVT. NATIONAL HIGH SCHOOL SAROKI (GUJRAT)",
            "121116" =>"GOVT. HIGH SCHOOL SOOK KALAN (GUJRAT)",
            "121117" =>"GOVT. HIGH SCHOOL SIKERYALI (GUJRAT)",
            "121118" =>"GOVT. HIGH SCHOOL SAGHAR (GUJRAT)",
            "121119" =>"GOVT. HIGH SCHOOL SARRIA (GUJRAT)",
            "121120" =>"GOVT. B. A. MEMORIAL ISLAMIA HIGH SCHOOL SHAMPUR KHOKHRAN (GUJRAT)",
            "121121" =>"GOVT. HIGH SCHOOL THATTA POUR (GUJRAT)",
            "121122" =>"GOVT. HIGH SCHOOL THIKRIAN (GUJRAT)",
            "121123" =>"GOVT. HIGH SCHOOL THATTA MUSA (GUJRAT)",
            "121124" =>"GOVT. HIGH SCHOOL THIKERIAN MONIAN (GUJRAT)",
            "121125" =>"GOVT. HIGH SCHOOL THUTHA RAI BAHADUR (GUJRAT)",
            "121127" =>"GOVT. MUSLIM HIGH SCHOOL TAPIALA (GUJRAT)",
            "121128" =>"GOVT. HIGH SCHOOL KHARKA KHADRIALA (GUJRAT)",
            "121129" =>"GOVT. HIGH SCHOOL KARIALA (GUJRAT)",
            "121130" =>"GOVT. HIGH SCHOOL QASBA KARYALI (GUJRAT)",
            "121131" =>"GOVT. HIGH SCHOOL PURAN (GUJRAT)",
            "121132" =>"GOVT. HIGH SCHOOL SARAI ALAMGIR (GUJRAT)",
            "121133" =>"GOVT. HIGH SCHOOL SAADAT PUR (GUJRAT)",
            "121135" =>"GOVT. HIGH SCHOOL PIR KHANA (GUJRAT)",
            "121137" =>"GOVT. HIGH SCHOOL BHAGWAL (GUJRAT)",
            "121140" =>"GOVERNMENT HIGH SCHOOL - RARIALA (Kharian-Gujrat)",
            "121142" =>"GOVT. MUNICIPAL MODEL HIGH SCHOOL FOR BOYS MUSLIMABAD GUJRAT",
            "121143" =>"JINNAH PUBLIC SCHOOL (FOR BOYS) HAFIZ HAYAT ROAD GUJRAT",
            "121144" =>"SAINT FRANCIS EXCLUSIVE HIGH SCHOOL (BOYS) SARAI ALAMGIR (GUJRAT)",
            "121145" =>"AL-HIJAZ PUBLIC HIGH SCHOOL, JALALPUR JATTAN (GUJRAT)",
            "121146" =>"PUNJAB PUBLIC HIGH SCHOOL KALRA KALAN (GUJRAT)",
            "121147" =>"SERVICE ACADEMY HIGH SCHOOL G.T. ROAD GUJRAT",
            "121148" =>"COUNTY PUBLIC HIGH SCHOOL(BOYS) JINNAH ROAD, GUJRAT",
            "121149" =>"O.P.F. PUBLIC SCHOOL GUJRAT",
            "121150" =>"MADINA MODEL HIGH SCHOOL MADINA, GUJRAT",
            "121151" =>"PAKISTAN OVERSEAS ACADEMY MANDEER, KHARIAN (GUJRAT)",
            "121152" =>"THE CATHEDRAL SCHOOL JALAL PUR JATTAN (GUJRAT)",
            "121153" =>"BEACON HOUSE SCHOOL SYSTEMS (BOYS BRANCH) GUJRAT",
            "121154" =>"THE VILLAGE PUBLIC SCHOOL (BOYS), BHADDAR GUJRAT",
            "121155" =>"WORKERS WELFARE SCHOOL (BOYS), GUJRAT",
            "121158" =>"C.B.A. HIGH SCHOOL, JANDALA KOTLA ARAB ALI KHAN (GUJRAT)",
            "121161" =>"BEACONHOUSE SCHOOL SYSTEMS (BOYS BRANCH) KHARIAN (GUJRAT)",
            "121162" =>"CATHEDRAL SCHOOL MEHMDA ROAD GUJRAT",
            "121163" =>"DAR-E-ARQAM MODEL HIGH SCHOOL FOR BOYS, GUJRAT",
            "121164" =>"THE VILLAGE PUBLIC SCHOOL BHADDAR,GUJRAT",
            "121165" =>"MASUD UNIVERSAL MODEL HIGH SCHOOL (FOR BOYS) JINNAH ROAD, GUJRAT",
            "121166" =>"COUNTY PUBLIC HIGH SCHOOL (BOYS) QAMAR SIALVI ROAD, GUJRAT (PAKISRAN)",
            "121167" =>"KIDS GALAXY  HIGH SCHOOL GUJRAT",
            "121168" =>"MINHAJ MODEL SECONDARY SCHOOL CHAK PIRANA G.T. ROAD, KHARIAN",
            "121169" =>"NEW NAVEED-E-SAHAR MODEL SCHOOL EIDGAH ROAD, LALAMUSA",
            "121170" =>"SARDAR MEMORIAL BOYS SECONDARY EDUCATIONAL INSTITUTE DANDI TEH. SARAI ALAMGIR (GUJRAT)",
            "121171" =>"SYED COMPREHENSIVE  HIGH SCHOOL SARAI ALAMGIR (GUJRAT)",
            "121172" =>"THE CHENAB SCHOOL OF SCIENCES FOR BOYS KHALID ABAD GUJRAT",
            "121173" =>"THE EDUCATORS BARADARI CAMPUS BOYS BRANCH, NEAR ZAHOOR ELLAHI STADIUM GUJRAT",
            "121174" =>"MINHAJ MODEL SECONDARY SCHOOL CHAK PIRANA, KHARIAN, GUJRAT",
            "121176" =>"LINC SCHOOL SYSTEM (BOYS), LALAMUSA (GUJRAT)",
            "121177" =>"NATIONAL PUBLIC MODEL SCHOOL TERO CHAK (AAMANA ABAD) KHARIAN (GUJRAT)",
            "121178" =>"CITIZEN PUBLIC SCHOOL G. T. ROAD, SARAI ALAMGIR (GUJRAT)",
            "121179" =>"REHMAN PUBLIC SCHOOL KHOHAR, SARAI ALAMGIR (GUJRAT)",
            "121180" =>"THE CAMBRIDGE SCHOOL FOR BOYS, LALAMUSA (GUJRAT)",
            "121181" =>"JINNAH HIGH SCHOOL, TANDA (GUJRAT)",
            "121183" =>"SAJID MEMORIAL SECONDARY SCHOOL BHUMLA (GUJRAT)",
            "121184" =>"VEGA SCHOOL SYSTEM, DINGA (GUJRAT)",
            "121185" =>"PROGRESSIVE PUBLIC SCHOOL BOYS KUNJAH (GUJRAT)",
            "121186" =>"CITY PUBLIC (BOYS) HIGH SCHOOL G. T. ROAD KHARIAN JANDANWALA (GUJRAT)",
            "121187" =>"PAKISTAN SCHOOL OF SCIENCES FOR BOYS. KALRA KALAN, GUJRAT",
            "121188" =>"MOUNTY PUBLIC SCHOOL QAMMER SIALVI ROAD GUJRAT",
            "121190" =>"QUAID CAMBRIDGE HIGH SCHOOL. FATEHPUR (GUJRAT)",
            "121191" =>"DAR-US-SALAM H/S KHARIAN",
            "121192" =>"SAINT MARY'S HIGH SCHOOL POLICE LINE GUJRAT",
            "121193" =>"SYED-NA-ABDULLAH SECONDARY SCHOOL FOR BOYS, DHODA SHARIF GUJRAT",
            "121195" =>"AL-SYEDA FATIMA-TU-ZAHRA MODEL HIGH SCHOOL (FOR BOYS)  BHALOTE SHERA (GUJRAT)",
            "121196" =>"HASSAN PUBLIC HIGH SCHOOL SIDH (GUJRAT)",
            "121197" =>"KIDS BEACON HIGH SCHOOL JAIL ROAD GUJRAT",
            "121200" =>"HUSSAIN MODEL BOYS HIGH SCHOOL BHAGOWAL KALAN (GUJRAT)",
            "121201" =>"WEBSTERS INTERNATIONAL HIGH SCHOOL SARDAR PURA GUJRAT",
            "121202" =>"MISS FARIDA SHEIKH MODEL HIGH SCHOOL BARA DARI ROAD GUJRAT",
            "121203" =>"GOVT HIGH SCHOOL CHANDALA. (GUJRAT)",
            "121204" =>"ALI PUBLIC SCHOOL SYSTEM FOR BOYS NASEERA KHARIAN",
            "121205" =>"MEHSUM FOUNDATION SCHOOL MEHSUM, GUJRAT",
            "121206" =>"QUAID-E-AZAM PUBLIC SCHOOL KOTLA ARAB ALI (GUJRAT)",
            "121207" =>"THE EDUCATOR (FATIMA JINNAH CAMPUS LALAMASA) GUJRAT",
            "121208" =>"AL-MALIK HIGH SCHOOL THOON ROAD SARAI ALAMGIR (GUJRAT)",
            "121210" =>"IQRA PUBLIC SCHOOL HASHAM (GUJRAT)",
            "121211" =>"ROOTS FOUNDATION HIGH SCHOOL (FOR BOYS) GUJRAT",
            "121213" =>"TRUST MODEL SCHOOL NEAR KMMW-TRUST HOUSE JPJ-GUJRAT ROAD JALAPURJATTAN DISTRICT GUJRAT",
            "121214" =>"GOVT. HIGH SCHOOL GOTERIALA GUJRAT",
            "121215" =>"AL-NOOR GRAMMAR BOYS HIGH SCHOOL TANDA (GUJRAT)",
            "121216" =>"GUJRAT PUBLIC SCHOOL (FOR BOYS) DHAMTHAL MORE KARIANWALA (GUJRAT)",
            "121218" =>"BAHAWAL PUBLIC SCHOOL FOR BOYS SARGODHA ROAD GUJRAT",
            "121219" =>"QUAID CAMBRIDGE HIGH SCHOOL FOR BOYS KOTLA ARAB ALI KHAN GUJRAT",
            "121220" =>"THE RISERS BRIGHT STAR EDUCATION SYSTEM FOR BOYS DEONA MANDI GUJRAT",
            "121221" =>"THE CHENAB SCHOOL FOR BOYS G.T ROAD GUJRAT",
            "121222" =>"JINNAH MODEL HIGH SCHOOL (FOR BOYS) KARIANWALA",
            "121223" =>"LAUREL HOME SECONDARY SCHOOL (FOR BOYS) G.T.ROAD GUJRAT",
            "121224" =>"TAYYAB MODEL HIGH SCHOOL BOYS GHAREEB PURA GUJRAT",
            "121225" =>"GOVT. BOYS HIGH SCHOOL NAGERIANWALA",
            "121226" =>"GOVT. HIGH SCHOOL FOR BOYS QILA DAR GUJRAT",
            "121227" =>"GOVT. HIGH SCHOOL FOR BOYS NAGRIAN WALA",
            "121228" =>"TAYYAB MODEL HIGH SCHOOL FOR BOYS ANJUM ROAD GHAREEB PURA GUJRAT",
            "121229" =>"ALI GAR MODEL HIGH SCHOOL FOR BOYS, G.T. ROAD, LALA MUSA, GUJRAT",
            "121230" =>"THE EDUCATORS ALKARAM CAMPUS BOYS, KOTLA ARAB ALI KHAN, KHARIAN, GUJRAT",
            "121231" =>"N.E.C. INTERNATIONAL HIGH SCHOOL FOR BOYS, NASEERA, GUJRAT",
            "121232" =>"THE EDUCATORS (AL-MUSTAFA CAMPUS) FOR BOYS, S.ALAMGIR",
            "121233" =>"ALLAH DAD MEMORIAL MODEL HIGH SCHOOL FOR BOYS KHORI RASUL PUR GUJRAT",
            "121234" =>"GOVT. HIGH SCHOOL FOR BOYS KOTLI KOHALA GUJRAT",
            "121235" =>"ROZE BELT SCHOOL SYSTEM FOR BOYS, GULIANA GUJRAT",
            "121237" =>"ALLIED SCHOOL GUJRAT SOUTH CAMPUS FOR BOYS, NOOR STREET SHADMAN COLONY, REHMAN SHAHEED ROAD, GUJRAT",
            "121238" =>"GHAZALI MODEL HIGH SCHOOL FOR BOYS, AKBAR MANDI, MANGOWAL, GUJRAT",
            "121239" =>"THE PUNJAB SCHOOL FOR BOYS, QUTAB ABAD, GALA NO.2 SARGODHA ROAD GUJRAT",
            "121240" =>"ALLIED SCHOOL HAJI ASHIQ CAMPUS HIGH SCHOOL,BHIMBER RAOD KOTLA KHARIAN,GUJRAT",
            "121241" =>"GOVT. HIGH SCHOOL KHEPRANWALA P/O PHULAR WAN TEHS & DISTT GUJRAT",
            "121242" =>"GOVT. HIGH SCHOOL KHOJIANWALI, KUNJAH DISTRICT GUJRAT",
            "121243" =>"WISDOM HOUSE HIGH SCHOOL FOR BOYS, CHANNAN TEHSIL KHARIAN, DISTRICT GUJRAT",
            "121244" =>"ALLIED SCHOOL (JALAL PUR JATTAN CAMPUS) FOR BOYS. GUJRAT ROAD,JALAL PUR JATTAN DISTRICT GUJRAT",
            "121245" =>"GOVT. HIGH SCHOOL, KEERANWALA SYEDAN, GUJRAT",
            "121246" =>"NEW JINNAH PUBLIC HIGH SCHOOL FOR BOYS, CHAK SAJAWAL P/O DOGA, KHARIAN, GUJRAT",
            "121247" =>"ALLIED SHCOOL KHARIAN CAMPUS FOR BOYS, OPP. KHARIAN FLOUR MILLS G.T ROAD, KHARIAN, GUJRAT",
            "121249" =>"AYESHA PUBLIC HIGH SCHOOL FOR BOYS,GULIANA ROAD, KHARIAN, GUJRAT",
            "121250" =>"CRESCENT PUBLIC HIGH SHCOOL, NEAR PSO PETROL PUMP,DINGA MANDI ROAD,DINGA,TEHSIL KHARIAN, GUJRAT",
            "121251" =>"GOVT.BOYS HIGH SCHOOL, KHAMBI TEHSIL SARAI ALAMGIR GUJRAT ",
            "121252" =>"THE EDUCATORS JALALPUR CAMPUS FOR BOYS, JALAL PUR JATTAN, GUJRAT",
            "121253" =>"DAR-E-ARQAM MODEL HIGH SCHOOL FOR BOYS, G.T ROAD LALAMUSA, KHARIAN, GUJRAT",
            "121254" =>"DAR-E-ARQAM MODEL HIGH SCHOOL FOR BOYS, TRIKHA ROAD, SHADIWAL, GUJRAT",
            "121255" =>"ALLIED SCHOOL LALAMUSA (BOYS CAMPUS), NEAR GREEN FEUL CNG, G.T ROAD, LALAMUSA, GUJRAT",
            "121256" =>"HAYAT PUBLIC SCHOOL, HAJIWALA, GUJRAT",
            "121258" =>"GHAZALI MODEL HIGH SCHOOL, KUNJAH NEAR SHABIR SHAHEED HOSPITAL, GUJRAT",
            "121259" =>"GOVT. BOYS HIGH SCHOOL, KHUNAN P/O NOONANWALI, KHARIAN, GUJRAT",
            "121260" =>"THE EXAA SCHOOL FOR BOYS, NEW SHADMAN, GUJRAT",
            "121261" =>"LAHORE GRAMMER SCHOOL FOR BOYS, MODEL TOWN, BHIMBER ROAD, GUJRAT",
            "121262" =>"PUNJAB GROUP HIGH SCHOOL FOR BOYS, BISMILLAH CHOWK, G.T ROAD, KHARIAN, GUJRAT",
            "121263" =>"AL-FALAH SECONDARY SCHOOL FOR BOYS, DEONA MANDI, GUJRAT",
            "121264" =>"DAR-E-ARQAM MODEL HIGH SCHOOL FOR BOYS, CHHAMB ROAD, TANDA, GUJRAT",
            "121265" =>"DANISH INTERNATIONAL GRAMMAR SCHOOL FOR BOYS, KARIANWALA ROAD, DUDHRAY SHARQI, GUJRAT",
            "121266" =>"ALLIED SCHOOL DEONA MANDI CAMPUS FOR BOYS, DEONA MANDI, GUJRAT",
            "121267" =>"IQRA MODEL SCHOOL SYSTEM FOR BOYS, DALIBANTH, DINGA ROAD, GUJRAT",
            "121268" =>"OXFORD SCHOOL SYSTEM FOR BOYS, MANGOWAL GHARBI, GUJRAT",
            "121269" =>"THE EDUCATORS GUJRAT CAMPUS FOR BOYS, UMAIR TOWN, BHIMBER ROAD, GUJRAT",
            "121270" =>"ELYSIAN HIGH SCHOOL FOR BOYS, G.T ROAD BEHIND OLD FRUIT MANDI, KHARIAN, GUJRAT",
            "121271" =>"AL-MUDASSAR SPECIAL EDUCATION COMPLEX HIGH SCHOOL FOR BOYS, BAHARWAL TEHSIL KHARIAN, GUJRA",
            "121272" =>"BRITISH STANDARD HIGH SCHOOL FOR BOYS, MANDAHAR P/O BANGIAL, VIA KOTLA TEHSIL KHARIAN, GUJ",
            "121273" =>"GHAZALI MODEL SCHOOL FOR BOYS, QAMAR SIALVI ROAD, GUJRAT",
            "121274" =>"ALLIED SCHOOL OFFICERS CAMPUS FOR BOYS, SARGODHA ROAD, KUNJAH, GUJRAT",
            "121275" =>"AL-SERAJ MODEL HIGH SCHOOL FOR BOYS, SHAHBAZ PUR ROAD, JALAL PUR JATTAN, GUJRAT",
            "121276" =>"THE SPIRIT SCHOOL GUJRAT, MEHMDA ROAD, GUJRAT",
            "121277" =>"AL-ASR EDUCATION SYSTEM FOR BOYS, MALIK PUR CHARA, GUJRAT",
            "121278" =>"THE SPIRIT SCHOOL KHARIAN CAMPUS FOR BOYS, THAPLA BY PASS, G.T. ROAD, KHARIAN, GUJRAT",
            "121279" =>"MINHAJ UL QURAN MODEL SCHOOL FOR BOYS, P.O BOX JAURA TEHSIL KHARIAN, GUJRAT",
            "121280" =>"GOVT. HIGH SCHOOL (BOYS), KARARIWALA KALAN TEHSIL KHARIAN, GUJRAT",
            "121281" =>"GOVT. HIGH SCHOOL (BOYS), SANTAL P/O HAJIWALA, GUJRAT",
            "121282" =>"HASSAAN MODEL HIGH SCHOOL NO.2 FOR BOYS, BAKHSHU PURA, OUT SIDE SHAH FAISAL GATE, GUJRAT",
            "121502" =>"MUNICIPAL BOYS COMMUNITY MODEL HIGH SCHOOL GUJRAT",
            "121503" =>"GOVT. HIGH SCHOOL FOR BOYS, GORALI, GUJRAT",
            "121504" =>"GOVT. HIGH SCHOOL FOR BOYS VILLAGE AND P/O KHARANA TEHSIL KHARIAN DISTRICT GUJRAT",
            "121505" =>"GOVT. HIGH SCHOOL FOR BOYS MALKI GUJRAT",
            "121506" =>"GOVT. HIGH SCHOOL FOR BOYS CHIRYAWALA GUJRAT",
            "121507" =>"GOVT. HIGH SCHOOL FOR BOYS MOH. AMINABAD FEROZABAD GUJRAT",
            "121508" =>"GOVT. HIGH SCHOOL FOR BOYS SABOUR KHARIAN GUJRAT",
            "121509" =>"GOVT. HIGH SCHOOL FOR BOYS LUNDPUR GUJRAT",
            "121510" =>"GOVT. HIGH SCHOOL FOR BOYS KHAWASPUR LALAMUSA GUJRAT",
            "121511" =>"ALLIED SCHOOL FOR BOYS, JANI CHAK ROAD NEAR PTCL EXCHANGE DINGA, GUJRAT",
            "121512" =>"GOVT. HIGH SCHOOL FOR BOYS, RAWALKAY, ALI PUR, GUJRAT",
            "121513" =>"GHAZALI MODEL HIGH SCHOOL, MANGOWAL ROAD HAIDER CHOWK DINGA, KHARIAN, GUJRAT",
            "122001" =>"GOVT. GIRLS HIGH SCHOOL IKHLAS GARH (GUJRAT)",
            "122002" =>"GOVT. GIRLS HIGH SCHOOL AJNALA (GUJRAT)",
            "122003" =>"GOVT. GIRLS HIGH SCHOOL BHAGOWAL KALAN (GUJRAT)",
            "122004" =>"GOVT. GIRLS HIGH SCHOOL BHAGWAL (GUJRAT)",
            "122005" =>"GOVT. GIRLS HIGH SCHOOL BHAG NAGAR (GUJRAT)",
            "122006" =>"GOVT. GIRLS HIGH SCHOOL BULANI (GUJRAT)",
            "122007" =>"GOVT. WAZIR KHAN GIRLS HIGH SCHOOL BAZURGWAL (GUJRAT)",
            "122008" =>"GOVT. GIRLS HIGH SCHOOL BHADDAR (GUJRAT)",
            "122010" =>"GOVT. GIRLS HIGH SCHOOL CHAK KAMALA (GUJRAT)",
            "122011" =>"WISDOM HOUSE GIRLS HIGH SCHOOL CHANNAN (GUJRAT)",
            "122012" =>"GOVT. GIRLS HIGH SCHOOL CHANNAN (GUJRAT)",
            "122013" =>"GOVT. GIRLS HIGH SCHOOL DAULAT NAGAR (GUJRAT)",
            "122014" =>"GOVT. GIRLS HIGH SCHOOL DINGA (GUJRAT)",
            "122015" =>"GOVT. GIRLS HIGH SCHOOL DHORIA (GUJRAT)",
            "122017" =>"GOVT. GIRLS HIGH SCHOOL DOGHA (KHARIAN GUJRAT)",
            "122018" =>"GOVT. GIRLS HIGH SCHOOL DAK CHIBBAN (GUJRAT)",
            "122020" =>"MUNICIPAL MODEL HIGH SCHOOL GUJRAT",
            "122022" =>"GOVT. MISSION GIRLS HIGH SCHOOL, GUJRAT",
            "122023" =>"GOVT. MISS FATIMA JINNAH M.B. GIRLS MODEL HIGH SCHOOL, GUJRAT",
            "122025" =>"GOVT. DABEERISTAN FATIMA TAZ ZAHRA GIRLS SCHOOL  GUJRAT",
            "122026" =>"PUBLIC MODEL HIGH SCHOOL RAILWAY ROAD GUJRAT",
            "122029" =>"SHAUKAT MODEL HIGH SCHOOL NO. 1 OUTSIDE SHAH FAISAL GATE, GUJRAT",
            "122031" =>"GRAMMAR GIRLS HIGH SCHOOL JALALPUR ROAD GUJRAT",
            "122033" =>"GOVT. JAVAID GIRLS HIGH SCHOOL, GUJRAT",
            "122034" =>"GOVT. KAMBLIWALA GIRLS HIGH SCHOOL GUJRAT",
            "122035" =>"GOVT. MISS FEROZE UD DIN ISLAMIA GIRLS HIGH SCHOOL GUJRAT",
            "122036" =>"GOVT. MUSLIM PARDA GIRLS HIGH SCHOOL GUJRAT",
            "122037" =>"GOVT. SHAH HUSSAIN GIRLS HIGH SCHOOL GUJRAT",
            "122040" =>"GOVT. S. B. GIRLS HIGH SCHOOL, GUJRAT",
            "122042" =>"GOVT. GIRLS HIGH SCHOOL HAJIWALA (GUJRAT)",
            "122044" =>"GOVT. GIRLS HIGH SCHOOL JALAL PUR JATTAN (GUJRAT)",
            "122045" =>"MUNICIPAL MODEL GIRLS HIGH SCHOOL JALAL PUR JATTAN (GUJRAT)",
            "122046" =>"GOVT. ISLAMIA GIRLS HIGH SCHOOL JALAL PUR JATTAN (GUJRAT)",
            "122047" =>"GOVT. GIRLS HIGH SCHOOL JHEURANWALI (GUJRAT)",
            "122048" =>"GOVT. GIRLS HIGH SCHOOL JAURA KARNANA (GUJRAT)",
            "122052" =>"GOVT. GIRLS HIGH SCHOOL KUNJAH (GUJRAT)",
            "122053" =>"GOVT. ISLAMIA GIRLS HIGH SCHOOL KUNJAH (GUJRAT)",
            "122054" =>"GOVT. GIRLS HIGH SCHOOL KEERANWALA SYEDAN (GUJRAT)",
            "122056" =>"GOVT. GIRLS HIGH SCHOOL LANGAY (GUJRAT)",
            "122058" =>"GOVT. GIRLS HIGH SCHOOL LANGRIAL (GUJRAT)",
            "122059" =>"GOVT. GIRLS HIGH SCHOOL KHAMBI (GUJRAT)",
            "122060" =>"GOVT. GIRLS HIGH SCHOOL LAKHANWAL (GUJRAT)",
            "122061" =>"GOVT. M.B. GIRLS HIGH SCHOOL LALAMUSA (GUJRAT)",
            "122062" =>"GOVT. SHAMIM GIRLS HIGH SCHOOL LALAMUSA (GUJRAT)",
            "122063" =>"GOVT. GIRLS HIGH SCHOOL MACHHIWAL (GUJRAT)",
            "122064" =>"GOVT. GIRLS HIGH SCHOOL MOHRI SHARIF (GUJRAT)",
            "122065" =>"GOVT. GIRLS HIGH SCHOOL MALIK PUR CHARAH (GUJRAT)",
            "122066" =>"GOVT. GIRLS HIGH SCHOOL MOIN UD DIN PUR (GUJRAT)",
            "122067" =>"GOVT. GIRLS HIGH SCHOOL MANGOWAL GHARBI (GUJRAT)",
            "122068" =>"GOVT. GIRLS HIGH SCHOOL MANGLIA (GUJRAT)",
            "122069" =>"GOVT. ISLAMIA GIRLS HIGH SCHOOL MADINA (GUJRAT)",
            "122070" =>"GOVT. GIRLS HIGH SCHOOL PANJAN KISSANA (GUJRAT)",
            "122071" =>"GOVT. GIRLS HIGH SCHOOL PINDI HASHIM (GUJRAT)",
            "122072" =>"GOVT. GIRLS HIGH SCHOOL PINDI SULTAN PUR (GUJRAT)",
            "122073" =>"GOVT. GIRLS HIGH SCHOOL PURAN (GUJRAT)",
            "122075" =>"GOVT. GIRLS HIGH SCHOOL SOOK KALAN (GUJRAT)",
            "122076" =>"GOVT. GIRLS HIGH SCHOOL SABOWAL (GUJRAT)",
            "122078" =>"GOVT. GIRLS HIGH SCHOOL SAROKI (GUJRAT)",
            "122079" =>"GOVT. GIRLS HIGH SCHOOL SHADIWAL (GUJRAT)",
            "122080" =>"GOVT. GIRLS HIGH SCHOOL SIDH (GUJRAT)",
            "122081" =>"GOVT. GIRLS HIGH SCHOOL SARYIA (GUJRAT)",
            "122083" =>"GOVT. GIRLS HIGH SCHOOL SARAI ALAMGIR (GUJRAT)",
            "122084" =>"GOVT. GIRLS HIGH SCHOOL SHAKREELA (GUJRAT)",
            "122086" =>"GOVT. GIRLS HIGH SCHOOL THATTA MUSA (GUJRAT)",
            "122087" =>"GOVT. GIRLS HIGH SCHOOL TANDA (GUJRAT)",
            "122088" =>"FAUJI FOUNDATION MODEL SCHOOL (FOR GIRLS) GUJRAT",
            "122089" =>"REHMAT KHAN MEMORIAL MODEL GIRLS HIGH SCHOOL DHEERKEY KALAN (GUJRAT)",
            "122090" =>"GOVT. GIRLS HIGH SCHOOL NO.2, KHARIAN (GUJRAT)",
            "122091" =>"GOVT. GIRLS HIGH SCHOOL SEHNA (GUJRAT)",
            "122092" =>"ISLAMIC MODEL HIGH SCHOOL DINGA (GUJRAT)",
            "122094" =>"MASUD UNIVERSAL MODEL SCHOOL RANG PURA NAZ STREET, GUJRAT",
            "122096" =>"PAKISTAN INTERNATIONAL PUBLIC SCHOOL, GUJRAT",
            "122097" =>"OPF PUBLIC HIGH SCHOOL FOR GIRLS, GUJRAT",
            "122098" =>"COUNTY PUBLIC HIGH SCHOOL FOR GIRLS QAMAR SIALVI ROAD, GUJRAT",
            "122099" =>"BEACON HOUSE SCHOOL SYSTEM (FOR GIRLS), GUJRAT",
            "122100" =>"JINNAH PUBLIC SCHOOL (FOR GIRLS) HAFIZ HAYAT ROAD GUJRAT",
            "122101" =>"AISHA SIDDIQA GIRLS HIGH SCHOOL, BHURCHH BASOHA (GUJRAT)",
            "122104" =>"MISS FARIDA SHEIKH MODEL HIGH SCHOOL, BARA DARI ROAD GUJRAT",
            "122105" =>"DAR-E-ARQAM MODEL HIGH SCHOOL FOR GIRLS, GUJRAT",
            "122106" =>"KIDS GALAXY HIGH SCHOOL FOR GIRLS, GUJRAT",
            "122107" =>"WORKERS WELFARE SCHOOL FOR GIRLS, BHIMBER ROAD, GUJRAT",
            "122108" =>"CAPITAL SCIENCE SCHOOL FOR GIRLS, LALA MUSA (GUJRAT)",
            "122109" =>"BEACONHOUSE SCHOOL SYSTEM (GIRLS BRANCH), KHARIAN (GUJRAT)",
            "122111" =>"GOVT. GIRLS HIGH SCHOOL NO. 1 KHARIAN (GUJRAT)",
            "122112" =>"ROOTS FOUNDATION HIGH SCHOOL GUJRAT",
            "122114" =>"LINC SCHOOL SYSTEM (GIRLS) LALAMUSA (GUJRAT)",
            "122116" =>"CATHEDRAL SCHOOL AFFILIATED WITH B.I.S.E. GRW MEHMDA ROAD, GUJRAT",
            "122117" =>"WEBSTERS INTERNATIONAL HIGH SCHOOL SARDAR PURA, GUJRAT",
            "122118" =>"THE EDUCATORS BARA DARI CAMPUS, GUJRAT",
            "122119" =>"GOVT. GIRLS HIGH SCHOOL, GHATTLIAN KALAN (SIALKOT)",
            "122120" =>"GOVT. MUNICIPAL SIR SYED GIRLS SCHOOL LALAMUSA  (GUJRAT)",
            "122121" =>"QUAID GRAMMER GIRLS HIGH SCHOOL SOOK KALAN (GUJRAT)",
            "122122" =>"BRITISH  STANDARD GIRLS HIGH SCHOOL MANDAHAR (GUJRAT)",
            "122123" =>"BRIGHT STAR MODEL SCHOOL DEONA MANDI (GUJRAT)",
            "122124" =>"AKHTAR PUBLIC MODEL HIGH SCHOOL JALAL PUR SOBTIAN",
            "122126" =>"KIDS BEACON GIRLS HIGH SCHOOL JAIL ROAD GUJRAT",
            "122127" =>"MOUNTY PUBLIC SCHOOL QAMMER SIALVI ROAD GUJRAT",
            "122128" =>"THE CHENAB SCHOOL OF SCIENCES FOR GIRLS KHALID ABAD GUJRAT",
            "122129" =>"HUSSAIN GIRLS MODEL HIGH SCHOOL BHAGOWAL KALAN (GUJRAT)",
            "122132" =>"QUAID-E-MILLAT MODEL GIRLS HIGH SCHOOL, SARAI ALAMGIR (GUJRAT)",
            "122133" =>"VEGA SCHOOL SYSTEM, DINGA (GUJRAT)",
            "122134" =>"SAINT FRANCIS EXCLUSIVE HIGH SCHOOL (FOR GIRLS), SARAI ALAMGIR (GUJRAT)",
            "122137" =>"HUSSAIN GIRLS MODEL HIGH SCHOOL, BHAGOWAL KALAN (GUJRAT)",
            "122138" =>"THE LAUREL HOUSE, KHOJA (GUJRAT)",
            "122139" =>"PROGRESSIVE PUBLIC SCHOOL, KUNJAH (GUJRAT)",
            "122140" =>"CITY PUBLIC (GIRLS) HIGH SCHOOL G.T. ROAD KHARIAN JANDANWALA (GUJRAT)",
            "122141" =>"PAKISTAN SCHOOL OF SCIENCES FOR GIRLS, KALRA KALAN (GUJRAT)",
            "122142" =>"NATIONAL PUBLIC MODEL SCHOOL (FOR GIRLS)  TERO CHAK (AAMANA ABAD) KHARIAN GUJRAT",
            "122143" =>"GOVT. GIRLS C. P. P. HIGH SCHOOL  BHURCH (GUJRAT)",
            "122144" =>"ALIGARH MODEL HIGH SCHOOL, LALAMUSA (GUJRAT)",
            "122145" =>"SAYAM GIRLS HIGHER SECONDARY SCHOOL  JALALPUR SOBATIAN (GUJRAT)",
            "122146" =>"CATHEDRAL SCHOOL AFFILIATED WITH B.I.S.E. GRW. JALAL PUR JATTAN.",
            "122148" =>"SAINT MARY'S HIGH SCHOOL POLICE LINE GUJRAT",
            "122149" =>"YASIN PUBLIC HIGH SCHOOL ATTOWALA (GUJRAT)",
            "122151" =>"RAFIQ MODEL HIGH SCHOOL FOR GIRLS KALRA PUNWAN GUJRAT",
            "122152" =>"H.B.A. GIRLS H.S.S. PEROSHAH (GUJRAT)",
            "122153" =>"CHENAB GIRLS MODEL HIGH SCHOOL DHIRKE KALAN GUJRAT",
            "122154" =>"DUKHTARAN-E-MILLAT HIGHER SECONDARY SCHOOL MANDEER",
            "122155" =>"GOVT. GIRLS HIGH SCHOOL MALHU KHOKHAR (GUJRAT)",
            "122156" =>"AL-SYEDA FATIMA-TU-ZAHRA MODEL HIGH SCHOOL (FOR GIRLS)  BHALOTE SHERA (GUJRAT)",
            "122158" =>"THE VILLAGE PUBLIC H/S FOR GIRLS BHADDAR. GUJRAT",
            "122160" =>"JINNAH GIRLS HIGH SCHOOL TANDA (GUJRAT)",
            "122161" =>"LITTLE ANGELS GIRLS HIGH SCHOOL CHARAGH PURA LALAMUSA.",
            "122162" =>"MINHAJ MODEL GIRLS SECONDARY SCHOOL CHAK PIRANA, KHARIAN, GUJRAT",
            "122164" =>"ALI PUBLIC SCHOOL SYSTEM FOR GIRLS NASEERA KHARIAN",
            "122165" =>"GOVT. GIRLS HIGH SCHOOL FATEH PUR GUJRAT",
            "122166" =>"GOVT. GIRLS HIGH SCHOOL BAGRIANWALA (GUJRAT)",
            "122167" =>"QUAID CAMBRIDGE HIGH SCHOOL FATEHPUR",
            "122168" =>"GOVT. GIRLS H/S BAHARWAL TEH. KHARIAN (GUJRAT)",
            "122169" =>"MEHSUM FOUNDATION SCHOOL MEHSUM, GUJRAT",
            "122170" =>"AMERICAN STANDARD HIGH SCHOOL KOTLA ARAB ALI KHAN  (GUJRAT)",
            "122171" =>"WISDOM PUBLIC SCHOOL BAHARWAL KHARIAN (GUJRAT)",
            "122172" =>"SYEDA FATIMA-TU-ZAHRA PUBLIC SCHOOL EDUCATION HOME GULIANA TEH KHARIAN DISTT. GUJRAT",
            "122174" =>"GOVT. GIRLS HIGH SCHOOL KOTLA QASIM KHAN (LALAMUSA)",
            "122175" =>"JOHAR MEMORIAL PUBLIC SCIENCE ACADEMY FOR GIRLS DANDI NAZAM",
            "122176" =>"WISDOM PUBLIC GIRLS HIGH SCHOOL BAHARWAL TSHSIL KHARIAN DISTT GUJRAT",
            "122177" =>"MINHAJ-UL-QURAN GIRLS MODEL HIGH SCHOOL BHAGOWAL KHALAN (GRT)",
            "122178" =>"SYEDA MODEL SECONDARY SCHOOL FOR GIRLS QADAR COLONY BHIMBER ROAD GUJRAT",
            "122179" =>"GOVT. GIRLS HIGH SCHOOL ALAM GARH (GUJRAT)",
            "122180" =>"GOVT. GIRLS HIGH SCHOOL MEHMOODABAD (CHORANWALI) DISTT. GUJRAT",
            "122181" =>"GOVT. GIRLS HIGH SCHOOL HASSAN PATHAN GUJRAT",
            "122182" =>"GOVT. GIRLS HIGH SCHOOL BHOTA (GUJRAT)",
            "122183" =>"GOVT. GIRLS HIGH SCHOOL NAGRIAN (GUJRAT)",
            "122185" =>"GOVT. GIRLS HIGH SCHOOL AWAN SHARIF (GUJRAT)",
            "122186" =>"GOVT. GIRLS HIGH SCHOOL GUNJA TEHSIL KHARIAN (GUJRAT)",
            "122187" =>"GOVT. GIRLS HIGH SCHOOL RARIALA (GUJRAT)",
            "122188" =>"GOVT. GIRLS HIGH SCHOOL GILLANWALA (GUJRAT)",
            "122189" =>"GOVT. GIRLS HIGH SCHOOL AWAN SHARIF GUJRAT",
            "122190" =>"G.G.H.S., QASBA KARYALL",
            "122192" =>"GOVT. GIRLS HIGH SCHOOL GIHAL ZAIREEN TEH. S.A.GIR GUJRAT",
            "122193" =>"GOVT. GIRLS HIGH SCHOOL SEEKARYALI (GUJRAT)",
            "122194" =>"GUJRAT PUBLIC SCHOOL (FOR GIRLS) DHAMTHAL MORE KARIANWALA (GUJRAT)",
            "122195" =>"GOVT. GIRLS HIGH SCHOOL FAROZABAD (GUJRAT)",
            "122197" =>"BAHAWAL PUBLIC SCHOOL FOR GIRLS SARGODHA ROAD GUJRAT",
            "122198" =>"GOVT. GIRLS HIGH SCHOOL HAZARA MUGHLAN GUJRAT",
            "122199" =>"SCHOLARS MODEL HIGH SCHOOL FOR GIRLS AWAN SHARIF GUJRAT",
            "122200" =>"WAHEED INTERNATIONAL SCHOOL OF EDUCATION FOR GIRLS GOLEKI (GUJRAT)",
            "122202" =>"VENUS INTERNATIONAL PUBLIC HIGH SCHOOL FOR GIRLS GUJRAT",
            "122203" =>"GHAZALI PUBLIC GIRLS HIGH SCHOOL, SOOK KALAN (GUJRAT)",
            "122204" =>"QUAID CAMBRIDGE HIGH SCHOOL FOR GIRLS KOTLA ARAB ALI KHAN GUJRAT.",
            "122205" =>"GOVT. GIRLS HIGH SCHOOL GAKHRA KALAN GUJRAT.",
            "122207" =>"GOVT. GIRLS HIGH SCHOOL GAKHRA KALAN GUJRAT",
            "122208" =>"AL KARAM MODEL HIGH SCHOOL FOR GIRLS, MOH. DASWANDHI PURA, GUJRAT",
            "122209" =>"HIRA HIGH SCHOOL FOR GIRLS, TANDA, GUJRAT",
            "122210" =>"ABDUL MAJEED GIRLS HIGHER SECONDARY SCHOOL JHANS DISTRICT GUJRAT",
            "122211" =>"THE CHENAB HIGH SCHOOL FOR GIRLS, TRIKHA, GUJRAT",
            "122213" =>"N.E.C. INTERNATIONAL HIGH SCHOOL FOR GIRLS, NASEERA, GUJRAT",
            "122214" =>"THE EDUCATORS (AL-MUSTAFA CAMPUS) FOR GIRLS, S.ALAMGIR",
            "122216" =>"ALLIED SCHOOL GUJRAT SOUTH CAMPUS FOR GIRLS, SHADMAN COLONY,  GUJRAT",
            "122217" =>"DAR-E-ARQAM MODEL HIGH SCHOOL FOR GIRLS, THIRKHA ROAD, SHAHDIWAL, GUJRAT",
            "122218" =>"DAR-E-ARQAM MODEL HIGH SCHOOL, G.T. ROAD KHARIAN, GUJRAT",
            "122219" =>"DAR-UL-ISLAM HIGH SCHOOL FOR GIRLS, OPPOSITE CIVIL HOSPITAL G.T. ROAD KHARIAN, GUJRAT",
            "122220" =>"THE EDUCATORS (AL-KARAM CAMPUS) HIGH SCHOOL FOR GIRLS, KOTLA ARABA ALI KHAN, GUJRAT",
            "122221" =>"THE PUNJAB SCHOOL FOR GIRLS, QUTAB ABAD GALA NO.2 SARGODHA ROAD GUJRAT",
            "122222" =>"AL-KAUSAR GIRLS HIGH SCHOOL, SURKHPURA, GUJRAT",
            "122223" =>"JINNAH MODEL HIGH SCHOOL FOR GILRS, V. & KARIANWALA, GUJRAT",
            "122224" =>"ALLIED SCHOOL HAJI ASHIQ CAMPUS FOR GIRLS,BHIMBER ROAD KOTLA ARAB ALI KHAN KHARIAN GUJRAT",
            "122225" =>"GOVT. GIRLS HIGH SCHOOL, AMRAH KALAN, KHARAIN, GUJRAT",
            "122226" =>"GOVT. GIRLS HIGH SCHOOL, AMRAH KALAN, KHARIAN, GUJRAT",
            "122227" =>"GOVT. GIRLS HIGH SCHOOL, AMRAH KALAN, KHARIAN, GUJRAT",
            "122228" =>"GOVT. HIGH SCHOOL KHEPRANWALA P/O PHULAR WAN TEHS & DISTT GUJRAT",
            "122229" =>"GOVT. GIRLS HIGH SCHOOL, SADWAL KALAN TEHSIL KHARIAN, GUJRAT",
            "122230" =>"GOVT GIRLS HIGH  SCHOOL MIRZA TAHIR, KHARIAN, GUJRAT",
            "122231" =>"GOVT. GIRLS HIGH SCHOOL, DILAWARPUR VIA KOTLA ARAB ALI KHAN TEHSIL KHARIAN GUJRAT",
            "122232" =>"ALLIED SCHOOL (JALAL PUR JATTAN CAMPUS) FOR GIRLS GUJRAT ROAD,JALAL PUR JATTAN DISTRICT GUJRAT",
            "122233" =>"GOVT. GIRLS HIGH SCHOOL, JASSKI DISTRICT GUJRAT",
            "122234" =>"GOVT. GIRLS HIGH SCHOOL, P/O CHAK PINDI TEHSIL AND DSITRICT GUJRAT",
            "122235" =>"MADINA MODEL GIRLS HIGH SCHOOL, NEAR IMAMIA MASJID, MADINA GUJRAT ",
            "122236" =>"GOVT, GIRLS HIGH SCHOOL, MIANA CHAK VIA LALA MUSA TEHSIL KHARIAN, GUJRAT",
            "122237" =>"STAR LIGHT MODEL GIRLS HIGH SCHOOL INSIDE STAFF GALA, MOHALLAH MIANA PURA SARGODHA ROAD, GUJRAT",
            "122238" =>"ALFALAH EDUCATION HOUSE FOR GIRLS, CHAK SAJAWAL P/O DOGA, KHARIAN, GUJRAT",
            "122239" =>"SYED COMPREHENSIVE HIGH SCHOOL FOR GIRLS, JINNAH COLONY NEAR RHC, SARAI ALAMGIR, GUJRAT",
            "122240" =>"ALLIED SCHOOL KHARIAN CAMPUS FOR GIRLS, OPP. KHARIAN FLOUR MILLS G.T ROAD, KHARIAN GUJRAT",
            "122241" =>"IQRA PUBLIC MODEL HIGH SCHOOL FOR GIRLS,HAJIWALA TEHSIL & DISTRICT GUJRAT",
            "122242" =>"GHAZALI MODEL HIGH SCHOOL FOR GIRLS, AKBAR MANDI, MANGOWAL, GUJRAT",
            "122243" =>"GOVT. GIRLS MODEL HIGH SHCOOL,SHADIWAL,GUJRAT",
            "122244" =>"GOVT. GIRLS HIGH SCHOOL, CHANDALA, GUJRAT",
            "122245" =>"ALLIED SCHOOL LALAMUSA (GIRLS CAMPUS), NEAR GREEN FEUL CNG, G.T ROAD, LALAMUSA, GUJRAT",
            "122246" =>"GHAZALI MODEL HIGH SCHOOL FOR GIRLS, TAIMOOR CHOWK, JAIL ROAD, GUJRAT",
            "122247" =>"QUAID PUBLIC HIGH SCHOOL FOR GIRLS, MOH. FAIZ ABAD, SARGODHA ROAD, GUJRAT",
            "122248" =>"THE CHENAB SCHOOL FOR GIRLS, G.T ROAD, NEAR STATE LIFE BUILDING, GUJRAT",
            "122249" =>"CRESCENT PUBLIC HIGH SCHOOL FOR GIRLS, TAHIR ABAD, DINGA, GUJRAT",
            "122250" =>"INTERNATIONAL MODEL SCHOOL FOR GIRLS, VILLAGE UDA, KHARIAN, GUJRAT",
            "122251" =>"NEW MOON LIGHT GIRLS HIGH SCHOOL, SHAH JAHANGIR ROAD, GUJRAT",
            "122252" =>"GOVT. GIRLS HIGH SCHOOL, BHAWANJ TEH. SARAI ALAMGIR, GUJRAT",
            "122253" =>"GOVT. GIRLS HIGH SCHOOL, MATWANWALA, KHARIAN, GUJRAT",
            "122254" =>"TRUST MODEL HIGH SCHOOL FOR GIRLS, JALALPUR JATTAN, GUJRAT",
            "122255" =>"ALLIED SCHOOL AASHIR CAMPUS FOR GIRLS, SHAKREELA, SARAI ALAMGIR, GUJRAT",
            "122256" =>"COMMUNITY MODEL GIRLS HIGH SCHOOL, AKRAM ALI KHAN ROAD, GUJRAT",
            "122257" =>"LAHORE GRAMMER SCHOOL FOR GIRLS, MODEL TOWN, BHIMBER ROAD, GUJRAT",
            "122258" =>"DANISH INTERNATIONAL GRAMMAR SCHOOL FOR GIRLS, KARIANWALA ROAD, DUDHRAY SHARQI, GUJRAT",
            "122259" =>"PUNJAB GROUP HIGH SCHOOL FOR GIRLS, BISMILLAH CHOWK, G.T ROAD, KHARIAN, GUJRAT",
            "122260" =>"AL-FALAH SECONDARY SCHOOL FOR GIRLS, DEONA MANDI, GUJRAT",
            "122261" =>"DAR-E-ARQAM MODEL HIGH SCHOOL FOR GIRLS, TANDA ROAD, JALALPUR JATTAN, GUJRAT",
            "122262" =>"GHAZALI MODEL HIGH SCHOOL FOR GIRLS, MANGOWAL ROAD, HAIDER CHOWK, DINGA, KHARIAN, GUJRAT",
            "122263" =>"ALLIED SCHOOL FOR GIRLS DEONA MANDI CAMPUS, DEONA MANDI, GUJRAT",
            "122264" =>"IQRA MODEL SCHOOL SYSTEM FOR GIRLS, DALIBANTH, DINGA ROAD, GUJRAT",
            "122265" =>"THE EDUCATORS FATIMA JINNAH CAMPUS FOR GIRLS, LALAMUSA, KHARIAN, GUJRAT",
            "122266" =>"OXFORD SCHOOL SYSTEM (SIR SYED CAMPUS) FOR GIRLS, MANGOWAL GHARBI, GUJRAT",
            "122267" =>"GOVT. GIRLS HIGH SCHOOL MACHHIANA, VIA KUNJAH, GUJRAT",
            "122268" =>"ISLAMIC COMPREHENSIVE HIGH SCHOOL FOR GIRLS THATHA RAI BAHADUR, KHARIAN, GUJRAT",
            "122269" =>"GOVT. EXCELENT GIRLS HIGH SCHOOL, ATTACHED WITH G.C FOR ELEMENTARY TEACHERS (M) CIRCULAR ROAD, LALAMUSA, KHARIAN, GUJRAT",
            "122270" =>"GOVT. GIRLS HIGH SCHOOL, SARDAR PURA ROAD NEAR EID GAAH MASJID, LALAMUSA, GUJRAT",
            "122271" =>"THE EXAA SCHOOL FOR GIRLS, NEW SHADMAN COLONY, GUJRAT",
            "122273" =>"GOVT. GIRLS HIGH SCHOOL, KHOJIANWALI, GUJRAT",
            "122274" =>"GOVT. GIRLS HIGH SCHOOL, CHOPALA, GUJRAT",
            "122275" =>"CITIZEN PUBLIC SCHOOL ALTAF CAMPUS FOR GIRLS, CANAL VIEW, G.T ROAD, SARAI ALAMGIR, GUJRAT",
            "122276" =>"GOVT. CAPTAIN JAWAD ASLAM SHAHEED GIRLS HIGH SCHOOL, KALRA KALAN, GUJRAT",
            "122277" =>"GOVT. GIRLS HIGH SCHOOL, MANGOWAL SHARQI, GUJRAT",
            "122278" =>"AL-SARAJ MODEL GIRLS HIGH SCHOOL, SHAHBAZ PUR ROAD, JALAL PUR JATTAN, GUJRAT",
            "122279" =>"ALLIED SCHOOL OFFICERS CAMPUS FOR GIRLS, SARGODHA ROAD, KUNJAH, GUJRAT",
            "122280" =>"AL-ASR EDUCATION SYSTEM FOR GIRLS, MALIK PUR CHARA, GUJRAT",
            "122281" =>"THE SPIRIT SCHOOL KHARIAN CAMPUS FOR GIRLS, THAPLA BY PASS, G.T. ROAD, KHARIAN, GUJRAT",
            "122282" =>"GOVT. GIRLS HIGH SCHOOL, SIMBLI TEHSIL SARAI ALAMGIR, GUJRAT",
            "122283" =>"GOVT. GIRLS HIGH SCHOOL, JALAL PUR SOBTIAN, GUJRAT",
            "122284" =>"GOVT. GIRLS HIGH SCHOOL, SANTAL P/O HAJIWALA, GUJRAT",
            "122285" =>"GOVT. GIRLS HIGH SCHOOL, CHAKORI BHELOWAL TEHSIL KHARIAN, GUJRAT",
            "122286" =>"GOVT. GIRLS HIGH SCHOOL, KARARIWALA KHURD TEHSIL KHARIAN, GUJRAT",
            "122287" =>"GOVT. GIRLS HIGH SCHOOL, SHEIKHPUR, GUJRAT",
            "122520" =>"SHADMAN COMMUNITY HIGH SCHOOL SHADMAN COLONY, GUJRAT",
            "122522" =>"GOVT GIRLS HIGH SCHOOL KHURNANA, TEHSIL KHARIAN, DISTRICT GUJRAT",
            "122523" =>"GOVT. GIRLS HIGH SCHOOL KHUNAN KHARIAN GUJRAT",
            "122524" =>"GOVT. NAWAZ SHARIF GIRLS HIGH SCHOOL LALA MUSA GUJRAT",
            "122525" =>"GOVT. GIRLS HIGH SCHOOL CHEECHIYAN, JORAH, TEH. KHARIAN, DISTT.  GUJRAT",
            "122526" =>"GOVT. GIRLS HIGH SCHOOL GOTERIALA KHARIAN GUJRAT",
            "122527" =>"GOVT. GIRLS HIGH SCHOOL BEGA GUJRAT",
            "122528" =>"GOVT. GIRLS HIGH SCHOOL CHAK SADA GUJRAT",
            "122529" =>"GOVT. GIRLS HIGH SCHOOL BHAGOWAL KHURD P/O JALAL PUR JATTAN GUJRAT",
            "122530" =>"GOVT. GIRLS HIGH SCHOOLMURALA KHARIAN GUJRAT",
            "122531" =>"GOVT. GIRLS HIGH SCHOOL JANDANWALA NEAR KHARIAN CANTT GUJRAT",
            "122532" =>"GOVT. GIRLS HIGH SCHOOL GHANSIA GUJRAT",
            "122533" =>"GOVT. GIRLS HIGH SCHOOL FTEH PUR S.ALAMGIR GUJRAT",
            "122534" =>"GOVT. GIRLS HIGH SCHOOL MALKA KHARIAN GUJRAT",
            "122535" =>"GOVT. GIRLS HIGH SCHOOL BARNALI KHARIAN GUJRAT",
            "122536" =>"GOVT. GIRLS HIGH SCHOOL CHIRYAWALA GUJRAT",
            "122537" =>"GOVT. GIRLS HIGH SCHOOL KAKRALI KHARIAN GUJRAT",
            "122538" =>"GOVT. GIRLS HIGH SCHOOL DLLI BANTH GUJRAT",
            "122539" =>"GOVT. GIRLS HIGH SCHOOL SABOUR KHARIAN GUJRAT",
            "122540" =>"GOVT. GIRLS HIGH SCHOOL GOCH KHARIAN GUJRAT",
            "122541" =>"GOVT. GIRLS HIGH SCHOOL MARARRIAN KHARIAN GUJRAT",
            "122542" =>"GOVT. GIRLS HIGH SCHOOL KHURANA KHARIAN GUJRAT",
            "122543" =>"GOVT. GIRLS HIGH SCHOOL BHURCHH KHARIAN GUJRAT",
            "122544" =>"GOVT. GIRLS HIGH SCHOOL DOGA DAULAT NAGAR GUJRAT",
            "122545" =>"GOVT. GIRLS HIGH SCHOOL BEOWALI LALALPUR ROAD GUJRAT",
            "122546" =>"GOVT. GIRLS HIGH SCHOOL NAROWALI GUJRAT",
            "122547" =>"GOVT GIRLS HIGH SCHOOL KANG SAHALI GUJRAT",
            "122549" =>"GOVT. GIRLS HIGH SCHOOL KOT ALLAH BAKHSH GUJRAT",
            "122550" =>"GOVT. GIRLS HIGH SCHOOL TIBBI GORIAN NEAR STAFFGALA SARGODHA ROAD GUJRAT",
            "122551" =>"GOVT. GIRLS HIGH SCHOOL KOTLA QASIM KHAN KHARIAN GUJRAT",
            "122552" =>"GOVT. GIRLS HIGH SCHOOL BHELOT MUKHDOOM KHARIAN GUJRAT",
            "122553" =>"GOVT. GIRLS HIGH SCHOOL PERO SHAH GUJRAT",
            "122554" =>"GOVT. GIRLS HIGH SCHOOL MARI KHOKHARAN GUJRAT",
            "122555" =>"GOVT. GIRLS HIGH SCHOOL MEHMIDA SHARQI GUJRAT",
            "122556" =>"GOVT. GIRLS HIGH SCHOOL DHERU GHUNA GUJRAT",
            "122557" =>"ALLIED SCHOOL FOR GIRLS, MAIN KHARIAN MANDI ROAD DINGA, GUJRAT",
            "131001" =>"GOVT. HIGH SCHOOL BURJ DARA (HAFIZABAD)",
            "131002" =>"GOVT. HIGH SCHOOL CHAK BHATTI (HAFIZABAD)",
            "131003" =>"GOVT. HIGH SCHOOL DHERANKE MIR DADKE (HAFIZABAD)",
            "131004" =>"GOVT. HIGH SCHOOL NO.1 HAFIZABAD",
            "131005" =>"GOVT. HIGH SCHOOL NO.2 HAFIZABAD",
            "131006" =>"GOVT. MUSLIM HIGH SCHOOL HAFIZABAD",
            "131007" =>"GOVT. PUBLIC HIGH SCHOOL JALAL PUR BHATTIAN (HAFIZABAD)",
            "131008" =>"GOVT. HIGH SCHOOL JANDOKE (HAFIZABAD)",
            "131009" =>"QAZI ACADEMY FOR SECONDARY EDUCATION JALALPUR BHATTIAN (HAFIZABAD)",
            "131010" =>"GOVT. HIGH SCHOOL JURIAN (HAFIZABAD)",
            "131011" =>"GOVT. HIGH SCHOOL KALIANWALA (HAFIZABAD)",
            "131012" =>"GOVT. HIGH SCHOOL KOT HASSAN KHAN (HAFIZABAD)",
            "131013" =>"GOVT. HIGH SCHOOL KASSOKE (HAFIZABAD)",
            "131014" =>"GOVT. HIGH SCHOOL KOLO TARAR (HAFIZABAD)",
            "131016" =>"GOVT. HIGH SCHOOL KHURAM CHORERA (HAFIZABAD)",
            "131017" =>"GOVT. HIGH SCHOOL KOT NAKKA (HAFIZABAD)",
            "131018" =>"GOVT. HIGH SCHOOL KASSESAY (HAFIZABAD)",
            "131019" =>"GOVT. HIGH SCHOOL MADHRIANWALA (HAFIZABAD)",
            "131020" =>"GOVT. HIGH SCHOOL MIAN RAHEEMAN (HAFIZABAD)",
            "131021" =>"GOVT. HIGH SCHOOL MIRZA BHATTIAN (HAFIZABAD)",
            "131022" =>"GOVT. HIGH SCHOOL NOTHEIN (HAFIZABAD)",
            "131023" =>"GOVT. HIGH SCHOOL PINDI BAWAREY (HAFIZABAD)",
            "131024" =>"GOVT. HIGH SCHOOL NO.1 PINDI BHATTIAN (HAFIZABAD)",
            "131025" =>"GOVT. HIGH SCHOOL NO.2 PINDI BHATTIAN (HAFIZABAD)",
            "131026" =>"GOVT. HIGH SCHOOL, QILA RAM KOUR (HAFIZABAD)",
            "131028" =>"GOVT. SECONDARY SCHOOL RASUL PUR TARAR (HAFIZABAD)",
            "131029" =>"GOVT. HIGH SCHOOL SAGAR KALAN (HAFIZABAD)",
            "131030" =>"GOVT. HIGH SCHOOL SUKHEKE MANDI (HAFIZABAD)",
            "131032" =>"GOVT. HIGH SCHOOL TAHLI GORAYA (HAFIZABAD)",
            "131033" =>"GOVT. HIGH SCHOOL THATA MANAK (HAFIZABAD)",
            "131034" =>"GOVT. HIGH SCHOOL WACHOKE KALAN (HAFIZABAD)",
            "131035" =>"GOVT. HIGH SCHOOL VINNI (HAFIZABAD)",
            "131036" =>"GOVT. HIGH SCHOOL SOOIANWALA (HAFIZABAD)",
            "131037" =>"GOVT. HIGH SCHOOL VANIKE TARAR (HAFIZABAD)",
            "131038" =>"GOVT. HIGH SCHOOL ZAKHIRA BERAN WALA (HAFIZABAD)",
            "131039" =>"GOVT. SECONDARY SCHOOL RAMKE CHATTHA (HAFIZABAD)",
            "131040" =>"BEACON HOUSE SCHOOL SYSTEM, HAFIZABAD",
            "131041" =>"DISTRICT PUBLIC SCHOOL (FOR BOYS), HAFIZABAD",
            "131042" =>"M.H. SUFI FOUNDATION SECONDARY SCHOOL KOT ISHAQ (HAFIZABAD)",
            "131043" =>"GOVT. MODEL HIGH SCHOOL HAFIZABAD",
            "131044" =>"GRAMMAR MODEL HIGH SCHOOL DEF. ROAD HAFIZABAD",
            "131045" =>"MISALI PUBLIC SCHOOL HAFIZABAD",
            "131046" =>"JINNAH SCHOLARS INN HAFIZABAD",
            "131047" =>"CRESCENT PUBLIC SCHOOL (BOYS) HAFIZABAD",
            "131048" =>"PARADISE MODEL SCHOOL SUKHEKI HAFIZABAD",
            "131050" =>"THE CRESCENT SCHOOL PINDI BHATTIAN DISTRICT HAFIZABAD",
            "131051" =>"SIR SYED SCHOLARS INN. HAFIZABAD",
            "131055" =>"THE EDUCATOR SCHOOL HAFIZABAD CAMPUS",
            "131056" =>"MISALI SCHOOL OF SCIENCE FOR BOYS KASSOKI ROAD HAFIZABAD",
            "131057" =>"NEW MISALI PUBLIC SECONDARY SCHOOL FOR BOYS, JALAL PUR BHATTIAN, HAFIZABAD",
            "131058" =>"GOVT HIGH SCHOOL JALAL PUR BHATTIAN, HAFIZABAD",
            "131059" =>"GOVT BOYS HIGH SCHOOL QILA MURAD BUX ROAD KOT BELA PINDI BHATTIAN HAFIZABAD",
            "131060" =>"GOVT. HIGH SCHOOL FOR BOYS MACHONKE PINDI BHATTIAN HAFIZABAD",
            "131061" =>"ALLIED SCHOOLS HAFIZABAD COMPUS FOR BOYS, SERGODHA ROAD BY PASS NEAR DISTRICT COMPLEX, HAFIZABAD",
            "131062" =>"GOVT HIGH SCHOOL SHORI MANEKA. P/O THATHA KHAIRO MUTMAL, PINDI BHATIAN, HAFIZABAD",
            "131063" =>"GOVT. SECONDARY SCHOOL, SAKHI TEHSIL PINDI BHATIAN, HAFIZABAD",
            "131064" =>"SUPERIOR PUBLIC SCHOOL FOR BOYS, LAHORE ROAD, PINDI BHATIAN, HAFIZABAD",
            "131065" =>"GOVT. SECONDARY SCHOOL, MANGAT NEECHA, HAFIZABAD",
            "131066" =>"GOVT. HIGH SCHOOL FOR BOYS, THATHA KHERO MATMAL, TEH. PINDI BHATTIAN, HAFIZABAD",
            "131067" =>"BAB-UL-ILM SECONDARY SCHOOL FOR BOYS, HAFIZABAD ROAD, PINDI BHATTIAN, HAFIZABAD",
            "131068" =>"AGA KHAN SECONDARY SCHOOL FOR BOYS, KOLO TARAR ROAD NEAR BASHIR HOSPITAL, HAFIZABAD",
            "131069" =>"GOVT. BOYS HIGH SCHOOL, MIRZA BHANGSINKA TEHSIL PINDI BHATTIAN, HAFIZABAD",
            "132001" =>"GOVT. GIRLS HIGH SCHOOL NO.1 HAFIZABAD",
            "132002" =>"GOVT. DOUBLE SECTION GIRLS HIGH SCHOOL HAFIZABAD",
            "132003" =>"GOVT. GIRLS HIGH SCHOOL JALAL PUR BHATTIAN (HAFIZABAD)",
            "132006" =>"GOVT. GIRLS HIGH SCHOOL, RAMKAE CHATTHA (HAFIZABAD)",
            "132007" =>"GOVT. GIRLS HIGH SCHOOL RASUL PUR TARAR (HAFIZABAD)",
            "132009" =>"GOVT. GIRLS HIGH SCHOOL SOOIANWALA (HAFIZABAD)",
            "132012" =>"GOVT. SECONDARY SCHOOL QADIRABAD COLONY (HAFIZABAD)",
            "132013" =>"DISTRICT PUBLIC HIGH SCHOOL (GIRLS), SARGODA ROAD, NEAR RAILWAY CROSSING, HAFIZABAD",
            "132014" =>"M.H. SUFI FOUNDATION GIRLS SECONDARY SCHOOL KOT ISHAQ (HAFIZABAD)",
            "132015" =>"SABRIA SIRAJIA MODEL HIGH SCHOOL (CHAH QAZIAN) HAFIZABAD",
            "132016" =>"GOVT. MODEL GIRLS HIGH SCHOOL HAFIZABAD",
            "132017" =>"THE CRESCENT SCHOOL (GIRLS) PINDI BHATTIAN DISTRICT HAFIZABAD",
            "132018" =>"CRESCENT PUBLIC SCHOOL (GIRLS ) HAFIZABAD",
            "132019" =>"GRAMMAR MODEL HIGH SCHOOL DEF. ROAD HAFIZABAD",
            "132021" =>"GREEN LAND GIRLS HIGH SCHOOL ALI PUR ROAD HAFIZABAD",
            "132022" =>"UNIQUE FAROOQI GIRLS HIGH SCHOOL HAFIZABAD",
            "132023" =>"SAINT MARYS HIGH SCHOOL KASSOKI ROAD, HAFIZABAD",
            "132025" =>"IMRAN SECONDARY SCHOOL JALALPUR BHATTIAN DISTRICT HAFIZABAD",
            "132026" =>"GOVT. KHAIR-UN-NISA GIRLS HIGH SCHOOL BEMIANWALA HAFIZABAD",
            "132027" =>"MONTESSORI KIDS CAMPUS SHEIKHUPURA ROAD HAFIZABAD",
            "132028" =>"GOVT. GIRLS HIGH SCHOOL MUSTAFAABAD (HAFIZABAD)",
            "132029" =>"GOVT. GIRLS HIGH SCHOOL GHABREKA DISTT. HAFIZABAD",
            "132030" =>"GOVT. GIRLS SECONDARY SCHOOL KOT NAKKA (HFD)",
            "132031" =>"GOVT. GIRLS HIGH SCHOOL BHOON KALAN (HAFIZABAD)",
            "132032" =>"GOVT.GIRLS SECONDARY SCHOOL JANDOKEE HAFIZABAD",
            "132033" =>"MIAN NABI BAKHSH MEMORIAL ISLAMIA GIRLS HIGH SCHOOL JALALPUR BHATTIAN DIST.(HFD)",
            "132034" =>"GOVT. GIRLS HIGH SCHOOL KALIANWALA (HAFIZABAD)",
            "132035" =>"GOVT. GIRLS HIGH SCHOOL MANGAT NEECHA (HFD)",
            "132036" =>"IQRA SCIENCE MODEL SCHOOL KOLO TARAR DIST. HAFIZABAD",
            "132037" =>"THE EDUCATORS SCHOOL FOR GIRLS HAFIZABAD",
            "132038" =>"MISALI SCHOOL OF SCIENCE FOR GIRLS KASSOKI ROAD HAFIZABAD",
            "132039" =>"GOVT. GIRLS HIGH SCHOOL KOT SARWAR PINDI BHATTIAN HAFIZABAD",
            "132040" =>"GOVT. GIRLS HIGH SCHOOL KOT HASSAN KHAN HAFIZABAD",
            "132041" =>"GOVT. GIRLS HIGH SCHOOL LAHORE ROAD THATHA KHEROMUTMAL PINDI BHATTIAN",
            "132042" =>"GOVT. GIRLS HIGH SCHOOL 10 KM QILA MURAD BUZ ROAD KOT BELA PINDI BHATIAN",
            "132043" =>"GOVT. GIRLS HIGH SCHOOL WACHOKE KALAN HAFIZABAD",
            "132044" =>"GOVT. GIRLS HIGH SCHOOL JURIAN HAFIZABAD",
            "132045" =>"GOVT. GIRLS HIGH SCHOOL, VILLAGE & P/O MAIN RAHEEMAN, TEHSIL & DISTRICT HAFIZABAD",
            "132046" =>"ALLIED SCHOOLS HAFIZABAD COMPUS FOR GIRLS, SERGODHA ROAD BY PASS NEAR DISTRICT COMPLEX, HAFIZABAD",
            "132047" =>"UNIVERSAL MODEL SCHOOL FOR GIRLS, TEACHER COLONY HAFIZABAD",
            "132048" =>"BEACON HOUSE SCHOOL SYSTEM FOR GIRLS VANIKEY ROAD HAFIZABAD",
            "132049" =>"PARADISE MODEL SCHOOL FOR GIRLS, SUKHEKE MANDI, HAFIZABAD",
            "132051" =>"GOVT. GIRLS HIGH SCHOOL, BURJ DARA P/O KALEKE MANDI TEHSIL & DISTRICT HAFIZ ABAD",
            "132052" =>"GOVT. GIRLS HIGH SCHOOL, MADHRIANWALA TEHSIL AND DISTRICT HAFIZABAD",
            "132053" =>"GOVT. GIRLS HIGH SCHOOL, KOT NANAK TEHSIL AND DSITRICT HAFIZABAD",
            "132054" =>"GOVT.GIRLS HIGH SCHOOL, CHAK CHATTHA TEHSIL & DISTRICT HAFIZ ABAD",
            "132055" =>"GOVT. GIRLS HIGH SCHOOL,LAWARY KALAN TEHSIL & DISTRICT HAFIZABAD",
            "132056" =>"GOVT. GIRLS HIGH SCHOOL, TAHLI GORAYA TEHSIL PINDI BHATTIAN, HAFIZABAD",
            "132057" =>"GOVT GIRLS HIGH SCHOOL, KASSOKE TEHSIL & DISTT. HAFIZABAD",
            "132058" =>"SUPERIOR PUBLIC SCHOOL FOR GIRLS, LAHORE ROAD PINDI BHATIAN, HAFIZABAD",
            "132059" =>"GOVT. GIRLS HIGH SCHOOL, DHERANKE LALKE, VANIKE TARAR ROAD, HAFIZABAD",
            "132060" =>"GOVT. GIRLS HIGH SCHOOL, MADHORA KALAN, PINDI BHATIAN, HAFIZABAD",
            "132061" =>"BAB-UL-ILM SECONDARY SCHOOL FOR GIRLS, HAFIZABAD ROAD, PINDI BHATTIAN, HAFIZABAD",
            "132062" =>"AGA KHAN SECONDARY SCHOOL FOR GIRLS, KOLO TARAR ROAD NEAR BASHIR HOSPITAL, HAFIZABAD",
            "132063" =>"GOVT. GIRLS HIGH SCHOOL, NEAR TAXI STAND, CHAK BHATTI, HAFIZABAD",
            "132064" =>"SIR SYED SCHOLARS INN SECONDARY SCHOOL FOR GIRLS, PARK ROAD, HAFIZABAD",
            "141001" =>"GOVT. HIGH SCHOOL AHLA (MANDI BAHA-UD-DIN)",
            "141002" =>"GOVT. HIGH SCHOOL BAR MUSA (MANDI BAHA-UD-DIN)",
            "141003" =>"GOVT. ABBAS HIGH SCHOOL BUKKAN (MANDI BAHA-UD-DIN)",
            "141006" =>"GOVT. HIGH SCHOOL BHEROWAL (MANDI BAHA-UD-DIN)",
            "141007" =>"GOVT. HIGH SCHOOL BHOA HASSAN (MANDI BAHA-UD-DIN)",
            "141008" =>"GOVT. HIGH SCHOOL CHAK NO.26, MANDI BAHA-UD-DIN",
            "141009" =>"GOVT. HIGH SCHOOL CHILLIANWALA (MANDI BAHA-UD-DIN)",
            "141010" =>"GOVT. HIGH SCHOOL CHAK NO.1, MANDI BAHA-UD-DIN",
            "141011" =>"GOVT. HIGH SCHOOL CHOTE DHEERAN (MANDI BAHA-UD-DIN)",
            "141012" =>"GOVT. MODEL HIGH SCHOOL CHAK NO.40 (MANDI BAHA-UD-DIN)",
            "141013" =>"GOVT. HIGH SCHOOL CHAK NO. 44 (MANDI BAHA-UD-DIN)",
            "141014" =>"GOVT. HIGH SCHOOL CHHIMMON (MANDI BAHA-UD-DIN)",
            "141015" =>"GOVT. HIGH SCHOOL CHORUND (MANDI BAHA-UD-DIN)",
            "141016" =>"GOVT. HIGH SCHOOL CHAK NO.3 (MANDI BAHA-UD-DIN)",
            "141017" =>"GOVT. IQBAL HIGH SCHOOL CHAK NO.14 (MANDI BAHA-UD-DIN)",
            "141019" =>"GOVT. HIGH SCHOOL DHERAKAN KALAN (MANDI BAHA-UD-DIN)",
            "141020" =>"GOVT. SHAHID MUNIR SHAHEED SECONDARY SCHOOL DHOUL RANJHA (MANDI BAHA-UD-DIN)",
            "141021" =>"GOVT. HIGH SCHOOL DHUNNI KLAN (MANDI BAHA-UD-DIN)",
            "141022" =>"GOVT. HIGH SCHOOL GOJRA (MANDI BAHA-UD-DIN)",
            "141024" =>"GOVT. ISLAMIA HIGH SCHOOL HELAN (MANDI BAHA-UD-DIN)",
            "141025" =>"GOVT. NASEEM HIGH SCHOOL HASLANWALA (MANDI BAHA-UD-DIN)",
            "141026" =>"GOVT. HIGH SCHOOL JOKALIAN (MANDI BAHA-UD-DIN)",
            "141027" =>"GOVT. HIGH SCHOOL KUTHIALA SHEIKHAN (MANDI BAHA-UD-DIN)",
            "141028" =>"GOVT. HIGH SCHOOL KADHAR (MANDI BAHA-UD-DIN)",
            "141030" =>"GOVT. HIGH SCHOOL MIANA GONDAL (MANDI BAHA-UD-DIN)",
            "141031" =>"GOVT. ISLAMIA MILLAT HIGH SCHOOL MAMDANA CHAK NO.46 (MANDI BAHA-UD-DIN)",
            "141032" =>"GOVT. HIGH SCHOOL MONA DEPOT (MANDI BAHA-UD-DIN)",
            "141033" =>"GOVT. HIGH SCHOOL MANO CHAK (MANDI BAHA-UD-DIN)",
            "141034" =>"GOVT. HIGH SCHOOL MALAKWAL (MANDI BAHA-UD-DIN)",
            "141035" =>"GOVT. HIGH SCHOOL MONG (MANDI BAHA-UD-DIN)",
            "141036" =>"GOVT. HIGH SCHOOL MANDI BAHA-UD-DIN",
            "141037" =>"GOVT. PUBLIC HIGH SCHOOL WASOO TEHSIL & DISTT. MANDI BAHA-UD-DIN",
            "141038" =>"GOVT. SIR SYED HIGH SCHOOL MANDI BAHA-UD-DIN",
            "141039" =>"GOVT. MUSLIM HIGH SCHOOL MANDI BAHA-UD-DIN",
            "141040" =>"GOVT. ISLAMIA HIGH SCHOOL MANDI BAHA-UD-DIN",
            "141041" =>"GOVT. TAMEER-I-MILLAT HIGH SCHOOL MANDI BAHA-UD-DIN",
            "141043" =>"GOVT. HIGH SCHOOL MAJHI (MANDI BAHA-UD-DIN)",
            "141044" =>"GOVT. HIGH SCHOOL MANGAT (MANDI BAHA-UD-DIN)",
            "141045" =>"GOVT. HIGH SCHOOL MUSA KALAN (MANDI BAHA-UD-DIN)",
            "141046" =>"GOVT. ISLAMIA MILLAT HIGH SCHOOL MADHRAY RATTOWAL(MANDI BAHA-UD-DIN)",
            "141047" =>"GOVT. RAFI-UL-ISLAM HIGH SCHOOL, MALAKWAL (MANDI BAHA-UD-DIN)",
            "141048" =>"GOVT. PUBLIC ISLAMIA HIGH SCHOOL. MIANWAL RANJHA",
            "141049" =>"GOVT. HIGH SCHOOL NARANG (MANDI BAHA-UD-DIN)",
            "141050" =>"GOVT. PUBLIC HIGH SCHOOL PINDI KALU (MANDI BAHA-UD-DIN)",
            "141051" =>"GOVT. ISLAMIA HIGH SCHOOL PANDOWAL (MANDI BAHA-UD-DIN)",
            "141052" =>"GOVT. HIGH SCHOOL, PAHRIANWALI (MANDI BAHA-UD-DIN)",
            "141053" =>"GOVT. PILOT SECONDARY SCHOOL PHALIA (MANDI BAHA-UD-DIN)",
            "141054" =>"GOVT. ISLAMIA HIGH SCHOOL PHALIA (MANDI BAHA-UD-DIN)",
            "141055" =>"GOVT. HIGH SCHOOL PIND MAKKO (MANDI BAHA-UD-DIN)",
            "141057" =>"GOVT. HIGH SCHOOL RERKA BALA (MANDI BAHA-UD-DIN)",
            "141058" =>"GOVT. SECONDARY SCHOOL RUKKAN (MANDI BAHA-UD-DIN)",
            "141059" =>"GOVT. HIGH SCHOOL SIVIA (MANDI BAHA-UD-DIN)",
            "141061" =>"GOVT. HIGH SCHOOL SAIDA SHARIF (MANDI BAHA-UD-DIN)",
            "141062" =>"GOVT. LIAQAT MODEL HIGH SCHOOL SAHNA (MANDI BAHA-UD-DIN)",
            "141063" =>"GOVT. ISLAMIA HIGH SCHOOL WARA ALAM SHAH (MANDI BAHA-UD-DIN)",
            "141064" =>"GOVT. HIGH SCHOOL HARIA (MANDI BAHA-UD-DIN)",
            "141065" =>"SIR SYED PUBLIC MODEL BOYS HIGH SCHOOL MANDI BAHA-UD-DIN",
            "141067" =>"FARAN PUBLIC HIGH SCHOOL MANDI BAHAUDDIN",
            "141069" =>"AL-NOOR PUBLIC SECONDARY SCHOOL MANDI BAHAUDDIN",
            "141070" =>"MUSTAFAI SCIENCE MODEL SCHOOL(R) ADDA PAHRIANWALI (M.B.DIN)",
            "141071" =>"GHAZALI MODEL HIGH SCHOOL, PHALIA (MANDI BAHA-UD-DIN)",
            "141072" =>"LASANI MODEL HIGH SCHOOL, SOHAWA BOLABNI (MANDI BAHA-UD-DIN)",
            "141073" =>"F.F. MODEL SCHOOL MANDI BAHAUDDIN",
            "141074" =>"GLOBAL REVOLUTIONARY PUBLIC HIGH SCHOOL (FOR BOYS) OLD RASUL ROAD M.B.DIN",
            "141075" =>"BEACON EDUCATION HOUSE MALAKWAL (M.B.DIN)",
            "141076" =>"BAHRIA FOUNDATION HIGH SCHOOL MANDI BAHAUDDIN",
            "141077" =>"FARAN BOYS SECONDARY SCHOOL, MALAKWAL (M.B.DIN)",
            "141078" =>"PILOT MODEL BOYS SECONDARY SCHOOL MANDI BAHAUDDIN",
            "141079" =>"DISTRICT JINNAH PUBLIC SCHOOL (FOR BOYS) MANDI BAHA-UD-DIN",
            "141080" =>"FARAN PUBLIC SCHOOL, MANDI BAHAUDDIN",
            "141082" =>"USMAN SCIENCE SCHOOL, MALAKWAL (MANDI BAHAUDDIN)",
            "141083" =>"GHAZALI PUBLIC HIGH SCHOOL FOR BOYS, MALAKWAL, MANDI BAHAHUDDIN",
            "141084" =>"THE EDUCATORS PHALIA CAMPUS, PHALIA DISST. MANDI BAHA-UD-DIN",
            "141085" =>"DAR-E-ARQAM MODEL HIGH SCHOOL FOR BOYS MANDI BAHA-UD-DIN",
            "141086" =>"PILOT S.S. BHAIROWAAL (M.B.DIN)",
            "141087" =>"GOVT.Z.A BHUTTO SHAHEED HIGH SCHOOL SAINTHAL DISTT. M.B DIN",
            "141088" =>"ZIA-E-MADINA BOYS SECONDARY SCHOOL ADDA KUTHIALA KHURD TEHSIL MALAKWAL (M.B.DIN)",
            "141089" =>"GHAZALI MODEL HIGH SCHOOL GOJRA (M.B.DIN)",
            "141090" =>"GOVT. BANEZIR BHUTTO SHAHEED HIGH SCHOOL SULEMAN M.B.DIN",
            "141091" =>"GHAZALI MODEL HIGH SCHOOL WAPDA COLONY ROAD M.B.DIN",
            "141092" =>"MISALI RAVIAN SCIENCE HIGH SCHOOL M.B.DIN",
            "141094" =>"GHAZALI MODEL SECONDARY SCHOOL QADIRABAD(M.B.DIN)",
            "141095" =>"GOVT. ZULFIQAR ALI BHUTTO SHAHEED HIGH SCHOOL LASURI KALAN",
            "141096" =>"ALLIED SCHOOL FOR BOYS, WAPDA COLONY ROAD, MANDI BAHAUDDIN",
            "141097" =>"FARABI SCHOOL FOR BOYS, PHALIA CITY, MANDI BAHAUDDIN",
            "141098" =>"THE DAFFODILS SCHOOLING CONCEPTS FOR BOYS MODEL TOWN MANDI BAHAUDDIN",
            "141099" =>"MISALI MODEL HIGH SCHOOL FOR BOYS, OLD RASOOL ROAD, M.B.DIN",
            "141100" =>"EMAN HIGH SCHOOL FOR BOYS, MOHALLA MUGHAL PURA NEAR BOYS DEGREE COLLEGE, M.B.DIN",
            "141101" =>"GHAZALI MODEL HIGH SCHOOL FOR BOYS, ADDA PAHRIANWALI, MANDI BAHA UD DIN",
            "141102" =>"THE EDUCATORS RASOOL CAMPUS (FOR BOYS), M.B.DIN",
            "141103" =>"ALLIED SCHOOL (MALAKWAL CAMPUS) FOR BOYS, SUMRA TOWN, MALAKWAL, MANDI BAHA UD DIN",
            "141104" =>"THE MOTIVATORS SECONDARY SCHOOL FOR BOYS,NEAR KADHAR PUL,MAKKAYWAL,SAMANABAD ROAD,MANDI BAHAUDDIN",
            "141105" =>"THE VILLAGE HOUSE SCHOOL FOR BOYS, QANCHI ADDA, KUTHIALA SHEIKHAN, MANDI BAHAUDDIN",
            "141106" =>"ALLIED SCHOOL (CHANAB CAMPUS) SARGODHA ROAD, ADDA PAHRIANWALA, PHALIA, MANDI BAHAUDDIN.",
            "141107" =>"GOVT. HIGH SCHOOL FOR BOYS, KOT BLOCH, KHARIAN ROAD, MANDI BAHAUDDIN",
            "141108" =>"AL-NOOR MEMORIAL PUBLIC SECONDARY SCHOOL FOR BOYS, RERKA BALA, TEHSIL PHALIA, MANDI BAHAUD",
            "141109" =>"GHAZALI MODEL BOYS HIGH SCHOOL, THANA ROAD, KUTHIALA SHEIKHAN, MANDI BAHAUDDIN",
            "141110" =>"GOVT. MILLAT HIGH SCHOOL, HEAD RASUL (MANDI BAHAUDDIN)",
            "141111" =>"THE EDUCATORS MALIKWAL CAMPUS FOR BOYS, GHAZI TOWN, MALIKWAL, MANDI BAHAUDDIN",
            "141112" =>"INTERNATIONAL ISLAMIC UNIVERSITY ISLAMABAD SCHOOL (BOYS), AZIZ ABAD COLONY, GHANIAN ROAD, ",
            "141113" =>"GOVT. HIGH SCHOOL FOR BOYS, HARDO BOHAT, MANDI BAHAUDDIN",
            "141114" =>"GOVT. HIGH SCHOOL, CHAK NO.2 JANUBI, MANDI BAHAUDDIN",
            "141115" =>"GOVT. HIGH SCHOOL, CHAK FATEH SHAH, MANDI BAHAUDDIN",
            "141116" =>"GOVT. HIGH SCHOOL (BOYS), NOOR PUR PIRAN TEHSIL MALAKWAL, MANDI BAHAUDDIN",
            "141501" =>"COMMUNITY MODEL HIGH SCHOOL NAIN RANJHA (M.B. DIN)",
            "141504" =>"QIAUD-E-AZAM HIGH SCHOOL FOR BOYS MANDI ROAD PHALIA M.B.DIN",
            "141505" =>"GOVT. HIGH SCHOOL FOR BOYS CHAK BASAWA M.B.DIN",
            "141506" =>"GOVT. HIGH SCHOOL FOR BOYS P/O JHOLANA MANDI BHAUDDIN",
            "141507" =>"GOVT. HIGH SCHOOL FOR BOYS PINDI RAWAN MALAKWAL M.B.DIN",
            "141508" =>"GOVT. HIGH SCHOOL FOR BOYS GHANIAN PHALIA M.B.DIN",
            "141509" =>"BEACON HOUSE SCHOOL SYSTEM FOR BOYS, SUFI CITY, MANDI BAHAUDDIN",
            "142001" =>"GOVT. GIRLS HIGH SCHOOL BAR MUSA (MANDI BAHA-UD-DIN)",
            "142002" =>"GOVT. GIRLS HIGH SCHOOL CHILLIANWALA (MANDI BAHA-UD-DIN)",
            "142003" =>"GOVT. GIRLS HIGH SCHOOL DHOK NAWAN LOK (MANDI BAHA-UD-DIN)",
            "142004" =>"GOVT. GIRLS HIGH SCHOOL JOKALIAN (MANDI BAHA-UD-DIN)",
            "142006" =>"GOVT. GIRLS HIGH SCHOOL MANDI BAHA-UD-DIN",
            "142007" =>"SIR SYED PUBLIC MODEL GIRLS HIGH SCHOOL MANDI BAHA-UD-DIN",
            "142008" =>"GOVT. PUBLIC GIRLS HIGH SCHOOL MANDI BAHA-UD-DIN",
            "142009" =>"GOVT. GIRLS HIGH SCHOOL MANGAT (MANDI BAHA-UD-DIN)",
            "142011" =>"GOVT. GIRLS HIGH SCHOOL MURALA (MANDI BAHA-UD-DIN)",
            "142013" =>"GOVT. GIRLS HIGH SCHOOL MONA DEPOT (MANDI BAHA-UD-DIN)",
            "142014" =>"GOVT. MUNICIPAL MODEL GIRLS HIGH SCHOOL, MANDI BAHA-UD-DIN",
            "142015" =>"GOVT. GIRLS HIGH SCHOOL PIND MUKO (MANDI BAHA-UD-DIN)",
            "142016" =>"GOVT. GIRLS HIGH SCHOOL PAHRIANWALI (MANDI BAHA-UD-DIN)",
            "142017" =>"GOVT. GIRLS HIGH SCHOOL PHALIA (MANDI BAHA-UD-DIN)",
            "142018" =>"GOVT. GIRLS HIGH SCHOOL QADIR ABAD (MANDI BAHA-UD-DIN)",
            "142019" =>"GOVT. GIRLS HIGH SCHOOL RUKKAN (MANDI BAHA-UD-DIN)",
            "142020" =>"GOVT. GIRLS HIGH SCHOOL SAHNA (MANDI BAHA-UD-DIN)",
            "142021" =>"GOVT. GIRLS HIGH SCHOOL KOT SHER MUHAMMAD (MANDI BAHA-UD-DIN)",
            "142022" =>"GOVT. GIRLS COMMUNITY HIGH SCHOOL, JHULANA (MANDI BAHA-UD-DIN)",
            "142023" =>"MUSTAFAI SCIENCE MODEL (GIRLS) SCHOOL, ADDA PAHARIYANWALI, MANDI BAHA-UD-DIN",
            "142024" =>"SHAHTAJ MODEL HIGH SCHOOL FOR GIRLS, MANDI BAHAU-UD-DIN",
            "142025" =>"AL-NOOR PUBLIC SECONDARY SCHOOL MANDI BAHA-UD-DIN",
            "142026" =>"GOVT. GIRLS HIGH SCHOOL, WASU (MANDI BAHA-UD-DIN)",
            "142027" =>"POPULAR SCIENCE SECONDARY SCHOOL MALAKWAL (M.B.DIN)",
            "142028" =>"GLOBAL REVOLUTIONARY PUBLIC HIGH SCHOOL (FOR GIRLS) OLD RASUL ROAD M.B.DIN",
            "142029" =>"AISHA GIRLS SCHOOL MALAKWAL",
            "142031" =>"GOVT. GIRLS HIGH SCHOOL DHERAKAN KALAN (M.B.DIN)",
            "142032" =>"BAHRIA FOUNDATION HIGH SCHOOL MANDI BAHAUDDIN",
            "142033" =>"FARAN PUBLIC SCHOOL FOR GIRLS MANDI BAHAUDDIN",
            "142034" =>"PILOT MODEL GIRLS SECONDARY SCHOOL MANDI BAHAUDDIN",
            "142036" =>"F.F. HIGH SCHOOL FOR GIRLS MANDI BAHAUDDIN",
            "142037" =>"DISTRICT JINNAH PUBLIC SCHOOL (FOR GIRLS) MANDI BAHA -UD-DIN",
            "142040" =>"GHAZALI MODEL GIRLS HIGH SCHOOL, PHALIA  (MANDI BAHAUDDIN)",
            "142042" =>"PAKISTAN SCIENCE GIRLS HIGH SCHOOL, GOJRA  (MANDI BAHAUDDIN)",
            "142043" =>"REHMAT-UL-LILALAMIN (PBUH) HIGH SCHOOL FOR GIRLS, CHHOHRANWALA  (MANDI BAHAUDDIN)",
            "142044" =>"BEACON EDUCATION HOUSE MALAKWAL (M.B.DIN)",
            "142045" =>"DAR-UL-ILAM SC. GIRLS HIGH SCHOOL MANDI BAHAUDDIN",
            "142046" =>"LASANI GIRLS MODEL H/SCHOOL SOHOWA BOLANI, MANDI BAHAUDDIN",
            "142048" =>"ARSHAD SCIENCE HIGH SCHOOL MAJHI (M.B.DIN)",
            "142049" =>"THE EDUCATORS PHALIA CAMPUS, PHALIA DISST. MANDI BAHA-UD-DIN",
            "142050" =>"BAB-UL-ILM PUBLIC MODEL HIGH SCHOOL PINDI KALU M.B. DIN",
            "142051" =>"GOVT. BENAZIR BHUTTO SHAHEED GIRLS HIGH SCHOOL KAILU (M.B.DIN)",
            "142052" =>"GOVT. BENAZIR BHUTTO SHAHEED GIRLS HIGH SCHOOL MAKEN TEH. PHALIA (M.B.DIN)",
            "142053" =>"CITY MODEL GIRLS HIGH SCHOOL MALAKWAL M.B.DIB",
            "142054" =>"MALAKWAL FOUNDATION GIRLS HIGH SCHOOL MALAKWAL M.B.DIN",
            "142055" =>"THE DAFFODILS SCHOOLING CONCEPTS FOR GIRLS ARSHAD TOWN M.B.DIN",
            "142056" =>"GOVT. BANEZIR BHUTTO SHAHEED GIRLS HIGH SCHOOL RANMAL SHARIF M.B.DIB",
            "142057" =>"ZIA-E-MADINA GIRLS SECONDARY SCHOOL ADDA KUTHIALA KHURD TEHSIL MALAKWAL (M.B.DIN)",
            "142058" =>"GHAZALI MODEL GIRLS HIGH SCHOOL KUTHIALA SHEIKHAN",
            "142059" =>"GOVT. BANIZEER BHUTTO SHAHEED GIRLS HIGH SCHOOL  MADHRAY M.B.DIN",
            "142060" =>"GHAZALI MODEL GIRLS HIGH SCHOOL WAPDA COLONY ROAD M.B.DIN",
            "142061" =>"MUSLIM MODEL GIRLS HIGH SCHOOL PULLY RANSIKAY M.B.DIN",
            "142062" =>"THE MUSTAFAI SCIENCE MODEL SCHOOL FOR GIRLS DHOK NAWAN LOK M.B.DIN",
            "142063" =>"AL-NOOR PUBLIC MODEL GIRLS HIGH SCHOOL CHAK JANO KALAN MANDI BAHA-UD-DIN",
            "142064" =>"RAH-E-AMAL SECONDARY SCHOOL FOR GIRLS RUKKAN (M.B. DIN)",
            "142065" =>"GHAZALI MODEL GIRLS HIGH SCHOOL PAHARIANWALI (M.B.DIN)",
            "142066" =>"PILOT S.S.GIRLS CAMPUS BHAIROWAAL(M.B.DIN)",
            "142067" =>"SHAN-E-PAKISTAN GIRLS HIGH SCHOOL  MANDI BAHAUDDIN",
            "142068" =>"DAR-E-ARQAM MODEL HIGH SCHOOL FOR GIRLS MANDI BAHA-UD-DIN",
            "142069" =>"THE MOTIVATORS MAKKAYWAL CAMPUS (M.B.DIN)",
            "142070" =>"GOVT. GIRLS BENAZIR BHUTTO SHAHEED HIGH SCHOOL CHARRAN WALA PHALIA MANDI BAHAUDDIN",
            "142071" =>"GOVT. HIGH SCHOOL FOR GIRLS SUFI PURA MANDI BAHAUDDIN",
            "142072" =>"GOVT. GIRLS BENAZIR BHUTTO SHAHEED HIGH SCHOOL HASLANWALA PHALIA MANDI BAHAUDDIN",
            "142076" =>"PEHLA QADAM MODEL SCHOOL FOR GIRLS, PURANA GUJRAT ROAD, PHALIA, MANDI BAHAUDDIN",
            "142077" =>"QADIR MEMORIAL HIGH SCHOOL FOR GIRLS, CHAK MANO, PHALIA, MANDIBAHAUDDIN",
            "142078" =>"ALLIED SCHOOL FOR GIRLS, WAPDA COLONY ROAD, MANDI BAHAUDDIN",
            "142079" =>"EMAN HIGH SCHOOL SYSTEM FOR GIRLS, MUGHAL PURA, MANDI BAHAUDDIN",
            "142080" =>"FARABI SCHOOL FOR GIRLS, PHALIA CITY, MANDI BAHAUDDIN",
            "142081" =>"GOVT. GIRLS HISH SCHOOL, GOJRA TEHSIL MALKWAL DISTRICT MANDI BAHAUDDIN.",
            "142082" =>"GOVT. GIRLS HIGH SCHOOL, KHARIAN ROAD MOJIANWALA DISTRICT MANDI BAHAUDDIN",
            "142083" =>"GOVT. GIRLS HIGH SCHOOL, CHOT DHEERAN, MALAKWAL, DISTRICT MANDI BAHAUDDAIN",
            "142084" =>"GOVT. GIRLS HIGH SCHOOL, KOT BALOCH, DISTRICT MANDI BAHAUDDIN",
            "142085" =>"GOVT. GIRLS HIGH SCHOOL NO. 2, JANUBI, DISTRICT MANDI BAHAUDDIN",
            "142086" =>"GOVT. GIRLS HIGH SCHOOL, PANDOWAL, DISTRICT MANDI BAHAUDDIN",
            "142087" =>"GOVT. GIRLS HIGH SCHOOL, BHIKHI SHARIF, DISTRICT MANDI BAHAUDDIN",
            "142088" =>"GOVT. GIRLS HIGH SCHOOL,L RATTOWAL DISTRICT MANDIA BAHAUDDIN",
            "142089" =>"GOVT. GIRLS HIGH SCHOOL, DHOK SAHARAN, DISTRICT MANDI BAHAUDDIN",
            "142090" =>"GOVT. GIRLS HIGH SCHOOL, KUTHIALA SHIEKHAN, DISTRICT MANDI BAHAUDDIN",
            "142091" =>"GOVT. GIRLS HIGH SCHOOL, BHEKHO, DISTRICT MANDI BAHAUDDIN",
            "142092" =>"GOVT. GIRLS HIGH SCHOOL, GOJRA TEHSIL MALKWAL DISTRICT MANDI BAHAUDDIN.",
            "142093" =>"GOVT. GIRLS HIGH SCHOOL, KHARIAN ROAD, MOJIANWALA DISTRICT MANDI BAHAUDDIN",
            "142094" =>"GOVT. GIRLS HIGH SCHOOL, CHOT DHEERAN, MALKWAL, MANDI BAHAUDDIN.",
            "142095" =>"GOVT. GIRLS HIGH SCHOOL, KOT BALOCH DISTRICT MANDI BAHAUDDIN",
            "142096" =>"GOVT. GIRLS HIGH SCHOOL SAIDA SHARIF PHALIA MANDI BAHAUDDIN",
            "142097" =>"GOVT. GIRLS HIGH SCHOOL DHAL PHALIA MANDI BAHAUDDIN",
            "142098" =>"GOVT. GIRLS HIGH SCHOOL PINDI RAWAN MANDI BAHAUDDIN",
            "142099" =>"GOVT. MC GIRLS HIGH SCHOOL NEAR FRUIT MANDI DISTT MANDI BAHAUDDIN",
            "142100" =>"GOVT GIRLS HIGH SCHOOL, PINDI KALU TEHSIL PHALIA , DISTRICT MANDI BAHAUDDIN",
            "142101" =>"GOVT. GIRLS HIGH SCHOOL, AHLA, MALAKWAL ROAD TEHSIL AND DISTRICT MANDI BAHAUDDIN",
            "142102" =>"GOVT. GIRLS HIGH SCHOOL, RAKH MINAR GARH DISTRICT MANDI BAHAUDDIN",
            "142103" =>"GOVT. GIRLS HIGH SCHOOL, CHAK NO.13 DISTRICT MANDI BAHAUDDIN",
            "142104" =>"GOVT. GIRLS HIGH SCHOOL, BHOA HASSAN TEHSIL & DISTRICT MANDI BAHAUDDIN",
            "142105" =>"GOVT GIRLS HIGH SCHOOL, LAKHENWALA MANDI BAHAUDDIN",
            "142106" =>"GOVT. GIRLS HIGH SCHOOL, SIVIA TEHSIL AND DISTRICT MANDI BAHAUDDIN",
            "142107" =>"GOVERNMENT GIRLS HIGH SCHOOL MALAKWAL M.B.DIN",
            "142108" =>"GOVT.BENAZIR BHUTTO GIRLS HIGH SCHOOL,SAINTHAL, THESIL PHALIA DISTRICT MANDI BAHAUDDIN",
            "142109" =>"GARRISON GRAMMAR HIGH SCHOOL FOR GIRLS, NEAR JANNAT PETROL PUMP, PHALIA ROAD, MANDI BAHA UD DIN",
            "142111" =>"GHAZALI PUBLIC HIGH SCHOOL FOR GIRLS, RAILWAY ROAD, MALAKWAL, MANDI BAHAUDDIN",
            "142112" =>"THE EUDUCATORS RASOOL CAMPUS (FOR GIRLS), M.B.DIN",
            "142113" =>"ALLIED SCHOOL (MALAKWAL CAMPUS) FOR GIRLS, SUMRA TOWN, MALAKWAL, MANDI BAHA UD DIN",
            "142114" =>"THE VILLAGE HOUSE SCHOOL FOR GIRLS, QANCHI ADDA, KUTHIALA SHEIKHAN, MANDI BAHAUDDIN",
            "142115" =>"GOVT. GIRLS HIGH SCHOOL, MANO CHAK, PHALIA, MANDI BAHAUDDIN",
            "142116" =>"GOVT. GIRLS HIGH SCHOOL, CHORUND, MANDI BAHAUDDIN",
            "142117" =>"GOVT. GIRLS HIGH SCHOOL, HERDO BOHAT, MANDI BAHAUDDIN",
            "142118" =>"SUFFAH MODEL HIGH SCHOOL FOR GIRLS, RANMAL SHARIF, PHALIA, MANDI BAHAUDDIN",
            "142119" =>"ALLIED SCHOOL FOR GIRLS (CHANAB CAMPUS) SARGODHA ROAD, ADDA PAHRIANWALA, PHALIA, MANDI BAHAUDDIN.",
            "142120" =>"GOVT. GIRLS HIGH SCHOOL RAKH BALOCH KALAN, MANDI BAHAUDDIN",
            "142121" =>"GOVT GIRLS HIGH SCHOOL MAKHNANWALI MANDI BAHA UD DIN",
            "142122" =>"GOVT. GIRLS HIGH SCHOOL, MOHALLAH KANDHANWALA, MANDI BAHAUDDIN",
            "142123" =>"GOVT. GIRLS HIGH SCHOOL, CHAK JANO KALAN TEHSIL PHALIA, MANDI BAHAUDDIN",
            "142124" =>"GOVT. GIRLS HIGH SCHOOL, SOHAWA BOLANI, MANDI BAHAUDDIN",
            "142125" =>"GOVT. GIRLS HIGH SCHOOL, SHAHEEDANWALI, MANDI BAHAUDDIN",
            "142126" =>"GOVT. GIRLS HIGH SCHOOL, RASOOL ROAD, PINDI BAHAUDDIN, MANDI BAHAUDDIN",
            "142127" =>"GOVT. GIRLS HIGH SCHOOL, CHAK NO.2 SHUMALI, MANDI BAHAUDDIN",
            "142128" =>"AL-NOOR MEMORIAL PUBLIC SECONDARY SCHOOL FOR GIRLS, RERKA BALA, TEHSIL PHALIA, MANDI BAHAUD DIN",
            "142129" =>"THE EDUCATORS MALIKWAL CAMPUS FOR GIRLS, GHAZI TOWN, MALIKWAL, MANDI BAHAUDDIN",
            "142130" =>"INTERNATIONAL ISLAMIC UNIVERSITY ISLAMABAD SCHOOL FOR GIRLS, AZIZ ABAD COLONY, GHANIAN ROA",
            "142131" =>"GOVT. GIRLS HIGH SCHOOL, WAPDA COLONY, MANDI BAHAUDDIN",
            "142132" =>"GOVT. GIRLS HIGH SCHOOL, HAIGARWALA TEHSIL PHALIA, MANDI BAHAUDDIN",
            "142133" =>"GOVT. GIRLS HIGH SCHOOL, KHEWA, MANDI BAHAUDDIN",
            "142134" =>"GOVT. GIRLS HIGH SCHOOL, PINDI LALA TEHSIL PHALIA, MANDI BAHAUDDIN",
            "142135" =>"GOVT. GIRLS HIGH SCHOOL, KALUWALI, MANDI BAHAUDDIN",
            "142136" =>"GOVT. GIRLS HIGH SCHOOL, SHAHANALOK, MANDI BAHAUDDIN",
            "142524" =>"GOVT. COMMUNITY MODEL HIGH SCHOOL FOR GIRLS, MALIK ABAD (M.B.DIN)",
            "142525" =>"COMMUNITY GIRLS HIGH SCHOOL , FAQIRIAN (M.B.DIN)",
            "142529" =>"GOVT. GIRLS HIGH SCHOOL GHANIAN PHALIA M.B.DIN",
            "142530" =>"GOVT. GIRLS HIGH SCHOOL RERKA BALA M.B.DIN",
            "142531" =>"GOVT. GIRLS HIGH SCHOOL SIREY PHALIA M.B.DIN",
            "142532" =>"GOVT. GIRLS HIGH  SCHOOL DHAUL RANHA PHALIA M.B.DIN",
            "142533" =>"GOVT. GIRLS HIGH SCHOOL BADSHAH PUR MALAKWAL M.B.DIN",
            "142534" =>"GOVT. GIRLS HIGH SCHOOL NARANG PHALIA M.B.DIN",
            "142535" =>"GOVT. GIRLS B.B.S. HIGH SCHOOL BHEROWAL PHALIA M.B.DIN",
            "142536" =>"GOVT. GIRLS HIGH SCHOOL HARIA MALAKWAL M.B.DIN",
            "142537" =>"GOVT. GIRLS HIGH SCHOOL SOHAWA DILLOANA M.B.DIN",
            "142538" =>"GOVT. GIRLS HIGH SCHOOL KADHAR M.B.DIN",
            "142539" =>"BEACON HOUSE SCHOOL SYSTEM FOR GIRLS, SUFI CITY, MANDI BAHAUDDIN",
            "151001" =>"GOVT. HIGH SCHOOL AHAL GHUMMANAN (NAROWAL)",
            "151002" =>"GOVT. HIGH SCHOOL IKHLAS PUR (NAROWAL)",
            "151003" =>"GOVT. HIGH SCHOOL AURANG ABAD (NAROWAL)",
            "151004" =>"GOVT. HIGH SCHOOL ALI PUR SYEDAN (NAROWAL)",
            "151005" =>"GOVT. ISLAMIA HIGH SCHOOL BADDOMALHI (NAROWAL)",
            "151006" =>"GOVT. MUSLIM HIGH SCHOOL BADDOMALHI (NAROWAL)",
            "151007" =>"GOVT. MUSLIM MODEL HIGH SCHOOL BHERI KHURD (NAROWAL)",
            "151009" =>"GOVT. I.T HIGH SCHOOL BARA MANGA (NAROWAL)",
            "151010" =>"GOVT. HIGH SCHOOL BHAJNA (NAROWAL)",
            "151011" =>"GOVT. HIGH SCHOOL BUBAK MARALI (NAROWAL)",
            "151012" =>"GOVT. HIGH SCHOOL BARA PIND (NAROWAL)",
            "151013" =>"GOVT. HIGH SCHOOL BHAGOR KALAN (NAROWAL)",
            "151014" =>"GOVT. HIGH SCHOOL CHANDARKE MANGOLAY (NAROWAL)",
            "151015" =>"GOVT. HIGH SCHOOL CHATRANA (NAROWAL)",
            "151016" =>"GOVT. ISLAMIA HIGH SCHOOL DUDHU CHAK (NAROWAL)",
            "151017" =>"GOVT. HIGH SCHOOL DAUD (NAROWAL)",
            "151018" =>"GOVT. HIGH SCHOOL DARMAN (NAROWAL)",
            "151019" =>"GOVT. HIGH SCHOOL DEHLRA (NAROWAL)",
            "151020" =>"GOVT. HIGH SCHOOL DOMALA (NAROWAL)",
            "151021" =>"GOVT. H. U. HIGH SCHOOL DHARAG MIANA (NAROWAL)",
            "151022" =>"GOVT. HIGH SCHOOL DHAMTHAL (NAROWAL)",
            "151023" =>"GOVT. HIGH SCHOOL GUMTALA (NAROWAL)",
            "151027" =>"GOVT. HIGH SCHOOL JASSAR (NAROWAL)",
            "151030" =>"GOVT. HIGH SCHOOL KHANNA (NAROWAL)",
            "151032" =>"GOVT. HIGH SCHOOL KHAIRA (NAROWAL)",
            "151033" =>"GOVT. HIGH SCHOOL LESSER KALAN (NAROWAL)",
            "151034" =>"GOVT. HIGH SCHOOL LANGAH (NAROWAL)",
            "151037" =>"GOVT. HIGH SCHOOL MALOKE (NAROWAL)",
            "151038" =>"GOVT. HIGH SCHOOL MASRUR (NAROWAL)",
            "151039" =>"GOVT. HIGH SCHOOL MANAK (NAROWAL)",
            "151040" =>"GOVT. NATIONAL SECONDARY SCHOOL NAROWAL",
            "151041" =>"C.M.S HIGH SCHOOL, NAROWAL",
            "151042" =>"GOVT. MUSLIM HIGH SCHOOL NAROWAL",
            "151043" =>"GOVT. HIGH SCHOOL NAROWAL",
            "151045" =>"GOVT. ISLAMIA HIGH SCHOOL NONAR (NAROWAL)",
            "151046" =>"GOVT. HIGH SCHOOL NADALA SULEHRIAN (NAROWAL)",
            "151047" =>"GOVT. HIGH SCHOOL NIDDOKE (NAROWAL)",
            "151048" =>"GOVT. HIGH SCHOOL NOURANG ABAD (NAROWAL)",
            "151049" =>"GOVT. HIGH SCHOOL PINDI UMRA (NAROWAL)",
            "151050" =>"GOVT. ISLAMIA HIGH SCHOOL PAKHOKE (NAROWAL)",
            "151051" =>"GOVT. HIGH SCHOOL PHAGWARI (NAROWAL)",
            "151052" =>"GOVT. HIGH SCHOOL AHMAD ABAD (NAROWAL)",
            "151053" =>"GOVT. G.F. AL-MUJAHID HIGH SCHOOL SAHARI (NAROWAL)",
            "151054" =>"GOVT. HIGH SCHOOL RUPO CHAK (NAROWAL)",
            "151056" =>"GOVT. I.T. HIGH SCHOOL SHAH GHARIB (NAROWAL)",
            "151057" =>"GOVT. HIGH SCHOOL SADDOWALA (NAROWAL)",
            "151058" =>"GOVT. HIGH SCHOOL SHAKARGARH (NAROWAL)",
            "151059" =>"GOVT. MUSLIM MODEL HIGH SCHOOL SHAKARGARH (NAROWAL)",
            "151060" =>"GOVT. I.T. HIGH SCHOOL SHAKARGARH (NAROWAL)",
            "151061" =>"GOVT. HIGH SCHOOL SANKHATRA (NAROWAL)",
            "151062" =>"GOVT. HIGH SCHOOL SUKHU CHAK (NAROWAL)",
            "151063" =>"GOVT. HIGH SCHOOL SARJAL (NAROWAL)",
            "151064" =>"GOVT. C. D. ISLAMIA HIGH SCHOOL TALWANDI BHINDRAN (NAROWAL)",
            "151065" =>"GOVT. HIGH SCHOOL ZAFARWAL (NAROWAL)",
            "151067" =>"JINNAH HIGH SCHOOL SHAKARGARH (NAROWAL)",
            "151068" =>"C.M.S. HIGH SCHOOL NAROWAL",
            "151069" =>"HASSAN SCHOLARS PUBLIC SCHOOL (FOR BOYS) DHABLIWALA (NAROWAL)",
            "151071" =>"SAINT JOHN'S HIGH SCHOOL NAROWAL",
            "151072" =>"GALAXY SCHOOL SYSTEM BOYS HIGH SCHOOL SHAKAR GARH (NAROWAL)",
            "151074" =>"GHAZALI PUBLIC HIGH SCHOOL, ZAFARWAL (NAROWAL)",
            "151076" =>"THE PAKISTAN FOUNDATION SCHOOL (BOYS) NAROWAL",
            "151078" =>"MISALI SCIENCE SECONDARY SCHOOL NAROWAL",
            "151079" =>"THE EDUCATORS NAROWAL CAMPUS NAROWAL",
            "151080" =>"AL-BADAR ISLAMIC MODEL SCHOOL TALWANDI BHINDRAN (NAROWAL)",
            "151083" =>"IQBAL PUBLIC MODEL SCHOOL AZIZ PUR TEH SHAKARGARH (NWL)",
            "151085" =>"RANGERS BOYS PUBLIC SCHOOL SHAKARGARH",
            "151087" =>"SUPERIOR EDUCATION SYSTEM NONAR TEH. AND DISTT. NAROWAL",
            "151090" =>"GOVT. HIGHER SECONDARY SCHOOL, RAMBRI",
            "151093" =>"FAUJI FOUNDATION MODEL SCHOOL FOR BOYS, SHAKARGARH, NAROWAL",
            "151095" =>"RANGERS PUBLIC HIGH SCHOOL FOR BOYS, NAROWAL",
            "151096" =>"GOVT HIGH SCHOOL, DERIANWALA, NAROWAL",
            "151097" =>"GOVT HIGH SCHOOL BOLA BAJWA NAROWAL",
            "151098" =>"GOVT. HIGH SCHOOL FOR BOYS SOHAWARA SHAKARGARH NAROWAL",
            "151099" =>"GOVT. HIGH SCHOOL FOR BOYS RANSINWAL NAROWAL",
            "151100" =>"GOVT. HIGH SCHOOL FOR BOYS CHANDERKE RAJPUTAN NAROWAL",
            "151101" =>"GOVT. HIGH SCHOOL, ARUD AFGANAN, NAROWAL",
            "151102" =>"GOVT. HIGH SCHOOL, DHBLIWALA, NAROWAL",
            "151103" =>"GOVT HIGH SCHOOL FOR BOYS, KHAN KHASA, NAROWAL",
            "151104" =>"GOVT HIGH SCHOOL. NATLAH KALAN SHAKARGARH, NAROWAL",
            "151105" =>"GOVT. HIGH SCHOOL, CHHAMAL SHAKARGARH, NAROWAL",
            "151106" =>"GOVT. HIGH SCHOOL, ARUD AFGANAN, NAROWAL",
            "151107" =>"GOVT. HIGH SCHOOL DHABLIWALA, NAROWAL",
            "151108" =>"GOVT. HIGH SCHOOL FOR BOYS, KHAN KHASA, NAROWAL",
            "151109" =>"GOVT. HIGH SCHOOL FOR BOYS, SHAH PUR BHANGO SHAKARGARH, NAROWAL",
            "151110" =>"GOVT. HIGH SCHOOL FOR BOYS GORALA, SHAKARGARH, NAROWAL",
            "151111" =>"HASSAN SCHOLARS PUBLIC SCHOOL FOR BOYS, JANDIALA ROAD, ZAFARWAL, NAROWAL",
            "151113" =>"NEELAM EDUCATION SYSTEM AND TRAINING SCHOOL FOR BOYS, REHMANI MOHALLAH, ZAFARWAL,NAROWAL",
            "151114" =>"GOVT. HIGH SCHOOL KHOKHERWALI DISTT NAROWAL",
            "151115" =>"GOVT. HIGH SCHOOL BHATLI U C NAGWAL P/O MUHWAL TEH ZAFARWAL DISTT NAROWAL",
            "151116" =>"GOVT. HIGH SCHOOL KHAN PUR BOLAR NAROWAL",
            "151117" =>"GOVT. HIGH SCHOOL SAHARAN TEH & DISTT NAROWAL",
            "151118" =>"GOVT. HIGH SCHOOL VEERUM P/O KANJRUR SHAKARGARH NAROWAL",
            "151119" =>"GOVT. HIGH SCHOOL, BATHANWALA TEHSIL AND DISTRICT NAROWAL",
            "151120" =>"GOVT. HIGH SCHOOL FOR BOYS, GANGRAN, SHAKARGARH, NAROWAL",
            "151121" =>"GOVT.HIGH SCHOOL,SATHIALA TEHSIL ZAFARWAL, NAROWAL",
            "151122" =>"THE HOUSE OF KNOWLEDGE FOR BOYS, NONAR, ZAFARWAL, NAROWAL",
            "151123" =>"HASSAN SCHOLARS PUBLIC SCHOOL FOR BOYS, OLD KUCHEHRY ROAD, NAROWAL",
            "151124" =>"ALLAMA IQBAL STANDAR K.G HIGH SCHOOL, BADOMALHI, NAROWAL",
            "151125" =>"PUNJAB SCHOOL FOR BOYS, RAIBA MOR, ZAFARWAL ROAD, SHAKARGARH, NAROWAL",
            "151126" =>"THE ZAFARWAL PUBLIC HIGH SCHOOL FOR BOYS, MOH. NANGALI GATE, ZAFARWAL, NAROWAL",
            "151127" =>"TCF SECONDARY SCHOOL FOR BOYS (TLLAT ZAGHAM CAMPUS), DARMAN ROAD MORARA, ZAFARWAL, NAROWAL",
            "151128" =>"AL HAVI MODEL SCHOOL FOR BOYS, QILA AHMAD ABAD, NAROWAL",
            "151129" =>"GILLANI PUBLIC SCHOOL FOR BOYS, NEAR UNION COUNCIL, NONAR, ZAFARWAL, NAROWAL",
            "151130" =>"TABINDA PUBLIC HIGH SCHOOL FOR BOYS, KOHLIAN, SHAKARGARH, NAROWAL",
            "151131" =>"GOVT. HIGH SCHOOL FOR BOYS, LAKHNOOR, SHAKARGARH, NAROWAL",
            "151132" =>"SUROSH MODEL BOYS HIGH SCHOOL, DEHLRA, ZAFARWAL, NAROWAL",
            "151133" =>"MINHAJ-UL-HUSSAIN PUBLIC MODEL HIGH SCHOOL FOR BOYS, HADNAL, SHAKARGARH, NAROWAL",
            "151134" =>"SUFFA SCIENCE MODEL HIGH SCHOOL FOR BOYS, DARMAN, ZAFARWAL, NAROWAL",
            "151135" =>"GHAZALI EDUCATION TRUST SCHOOL FOR BOYS, IKHLASPUR, SHAKARGARH, NAROWAL",
            "151136" =>"ITTEHAD IJAZ PUBLIC MODEL HIGH SCHOOL FOR BOYS, MANGRI, SHAKARGARH, NAROWAL",
            "151137" =>"DAR-E-ARQAM SCHOOL FOR BOYS (ALI CAMPUS), HOSPITAL ROAD, BADDOMALHI, NAROWAL",
            "151138" =>"SHAKARGARH PUBLIC SCHOOL (BOYS), NOOR KOT ROAD, SHAKARGARH, NAROWAL",
            "151139" =>"GOVT. HIGH SCHOOL FOR BOYS, JALALA TEHSIL SHAKARGARH, NAROWAL",
            "151140" =>"GOVT HIGH SCHOOL FOR BOYS MORARA  TEHSIL ZAFARWAL  NAROWAL",
            "151141" =>"AFZAL MODEL SCHOOL BHELOWALI FOR BOYS, BHELOWALI BUS STOP P/O BADDOMALHI, NAROWAL",
            "151142" =>"HAIDER FOUNDATION SCHOOL FOR BOYS, FAROOZ PUR TEHSIL ZAFARWAL, NAROWAL",
            "151143" =>"NEW UNIQUE HIGH SCHOOL FOR BOYS, NAROWAL ROAD, ZAFARWAL, NAROWAL",
            "151144" =>"GHAZALI PUBLIC HIGH SCHOOL FOR BOYS, DARMAN TEHSIL ZAFARWAL, NAROWAL",
            "151145" =>"GHAZALI PUBLIC HIGH SCHOOL FOR BOYS, PINDI POOR BIAN TEHSIL ZAFARWAL, NAROWAL",
            "152001" =>"GOVT. GIRLS HIGH SCHOOL IKHLAS PUR (NAROWAL)",
            "152002" =>"GOVT. GIRLS HIGH SCHOOL, BADDOMALHI (NAROWAL)",
            "152003" =>"GOVT. GIRLS HIGH SCHOOL, BUSTAN AFGHANAN (NAROWAL)",
            "152004" =>"GOVT. GIRLS HIGH SCHOOL BHATTI AFGHANA (NAROWAL)",
            "152005" =>"GOVT. GIRLS HIGH SCHOOL BARA MANGA (NAROWAL)",
            "152006" =>"GOVT. GIRLS HIGH SCHOOL CHAK DOLA (NAROWAL)",
            "152007" =>"GOVT. GIRLS HIGH SCHOOL CHATRANA (NAROWAL)",
            "152008" =>"GOVT. GIRLS HIGH SCHOOL DUDHU CHAK (NAROWAL)",
            "152009" =>"GOVT. GIRLS HIGH SCHOOL DERIANWALA (NAROWAL)",
            "152010" =>"GOVT. GIRLS HIGH SCHOOL DARMAN (NAROWAL)",
            "152011" =>"GOVT. GIRLS HIGH SCHOOL DHAMTHAL (NAROWAL)",
            "152012" =>"GOVT. GIRLS HIGH SCHOOL GUMTALA (NAROWAL)",
            "152014" =>"GOVT. GIRLS HIGH SCHOOL JASSAR (NAROWAL)",
            "152016" =>"GOVT. GIRLS HIGH SCHOOL KOT NAINAN (NAROWAL)",
            "152017" =>"GOVT. GIRLS HIGH SCHOOL GUNGRAN (NAROWAL)",
            "152018" =>"GOVT. GIRLS SECONDARY SCHOOL KHAIRULLAH PUR (NAROWAL)",
            "152019" =>"GOVT. GIRLS HIGH SCHOOL LESSAR KALAN (NAROWAL)",
            "152020" =>"GOVT. GIRLS HIGH SCHOOL MAINGRI (NAROWAL)",
            "152021" =>"GOVT. GIRLS HIGH SCHOOL MADDO KAHLWAN (NAROWAL)",
            "152023" =>"GOVT. M. B. GIRLS HIGH SCHOOL NAROWAL",
            "152024" =>"GOVT. MUSLIM GIRLS HIGH SCHOOL NAROWAL",
            "152025" =>"GOVT. GIRLS HIGH SCHOOL NONAR (NAROWAL)",
            "152026" =>"GOVT. GIRLS HIGH SCHOOL PINDI UMRA (NAROWAL)",
            "152028" =>"GOVT. GIRLS HIGH SCHOOL, RAYYA KHAS (NAROWAL)",
            "152029" =>"GOVT. GIRLS HIGH SCHOOL RUPO CHAK (NAROWAL)",
            "152030" =>"GOVT. GIRLS HIGH SCHOOL SADDOWALA UNCHA (NAROWAL)",
            "152031" =>"GOVT. GIRLS HIGH SCHOOL SANKHATRA (NAROWAL)",
            "152032" =>"GOVT. GIRLS HIGH SCHOOL SHAKARGARH (NAROWAL)",
            "152033" =>"GOVT. GIRLS HIGH SCHOOL SHAHABDIKE (NAROWAL)",
            "152034" =>"GOVT. GIRLS HIGH SCHOOL SUKHO CHAK (NAROWAL)",
            "152035" =>"GOVT. GIRLS HIGH SCHOOL SAHAREE (NAROWAL)",
            "152036" =>"GOVT. GIRLS HIGH SCHOOL TALWANDI BHINDRAN (NAROWAL)",
            "152037" =>"GOVT. GIRLS HIGH SCHOOL ZAFARWAL (NAROWAL)",
            "152040" =>"ST, MARGRATES GIRLS HIGH SCHOOL NAROWAL",
            "152041" =>"THE PAKISTAN FOUNDATION HIGH SCHOOL (FOR GIRLS) NAROWAL",
            "152042" =>"GOVT. GIRLS HIGH SCHOOL SATHIALA (NAROWAL)",
            "152044" =>"HASSAN SCHOLARS PUBLIC SCHOOL (FOR GIRLS) DHABLIWALA (NAROWAL)",
            "152046" =>"SAINT JOHN'S GIRLS HIGH SCHOOL, NAROWAL",
            "152049" =>"TALEEM-UL-ISLAM HIGH SCHOOL LILBANAT BADDOMALHI",
            "152050" =>"ST. PAUL'S GIRLS HIGH SCHOOL NAROWAL",
            "152053" =>"M.D PUBLIC MODEL SCHOOL JASSAR (NAROWAL)",
            "152054" =>"GOVT. GIRLS HIGH SCHOOL BOLAR(NAROWAL)",
            "152055" =>"THE EDUCATOR NAROWAL CAMPUS",
            "152056" =>"GOVT. GIRLS HIGH SCHOOL GHULLAY BAJWA (NWL)",
            "152059" =>"RANGERS PUBLIC SCHOOL GIRLS SHAKARGARH",
            "152060" =>"GOVT. GIRLS HIGH SCHOOL BARAN TEHSIL SHAKARGARH NAROWAL",
            "152061" =>"GOVT GIRLS HIGH SCHOOL NAROWAL",
            "152062" =>"UNIQUE PUBLIC GIRLS HIGH SCHOOL DHABLIWALA NAROWAL",
            "152064" =>"MINHAJ-UL-HUSSAIN PUBLIC MODEL GIRLS HIGH SCHOOL HADNAL (REGD)",
            "152065" =>"TCF HIGH SCHOOL FOR GIRLS MORARA, DARMAN ROAD ZAFARWAL NAROWAL",
            "152067" =>"NEELUM EDUCATION SYSTEM AND TRAINING SCHOOL FOR GIRLS ZAFARWAL DISTRICT NAROWAL",
            "152068" =>"GOVT. GIRLS HIGH SCHOOL NO.2 SHAKAR GARH NAROWAL",
            "152070" =>"FAUJI FOUNDATION MODEL SCHOOL FOR GIRLS, SHAKARGARH, NAROWAL",
            "152071" =>"ROYAL GRAMMAR SCHOOL FOR GIRLS, CIRCULAR ROAD, NAROWAL",
            "152072" =>"RANGERS PUBLIC HIGH SCHOOL FOR GIRLS, NAROWAL",
            "152073" =>"GOVT GIRLS HIGH SCHOOL CHANDOWAL KALAN, NAROWAL",
            "152074" =>"GOVT GIRLS HIGH SCHOOL DUBLIWALA, NAROWAL",
            "152075" =>"GOVT GIRLS HIGH SCHOOL BUDDAH DHOLA, NAROWAL",
            "152076" =>"GOVT GIRLS HIGH SCHOOL THILLEY KALAN, NAROWAL",
            "152077" =>"GOVT GIRLS HIGH SCHOOL MANAK NAROWAL",
            "152078" =>"GOVT. AMAN GIRLS HIGH SCHOOL, SIDDIQUE PURA, DISTRICT NAROWAL",
            "152079" =>"GOVT. GIRLS HIGH SCHOOL, DATEWAL, NAROWAL",
            "152080" =>"GOVT. GIRLS HIGH SCHOOL, BOLA BAJWA, NAROWAL",
            "152081" =>"GOVT. GIRLS HIG SCHOOL, MALOOK PUR, NAROWAL",
            "152082" =>"GOVT. GIRLS HIGH SCHOOL, JEWAN BHINDER, NAROWAL",
            "152083" =>"GOVT. GIRLS HIGH SCHOOL HALLOWAL, TEHSIL & DISTRICT, NAROWAL",
            "152084" =>"GOVT. GIRLS HIGH SCHOOL, KHAN KHASA, NAROWAL",
            "152085" =>"GOVT. GIRLS HIGH SCHOOL, DONGIAN DISTRICT NAROWAL",
            "152086" =>"GOVT. GIRLS HIGH SCHOOL AROOD AFGANA TEHSIL & DSTRICT NAROWAL",
            "152087" =>"HASSAN SCHOLARS PUBLIC SCHOOL FOR GIRLS, JANDIALA ROAD, ZAFARWAL, NAROWAL",
            "152089" =>"GOVT. GIRLS HIGH SCHOOL MALOKE NAROWAL",
            "152090" =>"GOVT. GIRLS HIGH SCHOOL CHANDER KE RAJPUTAN NAROWAL",
            "152091" =>"GOVT. GIRLS HIGH SCHOOL PEJOWALI KALAN NAROWAL",
            "152092" =>"GOVT. GIRLS HIGH SCHOOL DEHLRA TEH ZAFARWAL DISTT NAROWAL",
            "152093" =>"GOVT. GIRLS HIGH SCHOOL KULLAH MANDIALA P/O BADOMALIHI DISTT NAROWAL",
            "152094" =>"GOVT. GIRLS HIGH SCHOOL JABBAL ZAFARWAL NAROWAL",
            "152095" =>"GOVT. GIRLS HIGH SCHOOL, SARJAL TEHSIL SHAKARGARH, NAROWAL",
            "152096" =>"GOVT. GIRLS HIGH SCHOOL, GORALA TEHSIL SHAKARGARH, NAROWAL",
            "152097" =>"GOVT. GIRLS HIGH SCHOOL,SATOWAL P/O KANJRUR, SHAKAR GAR, NAROWAL",
            "152098" =>"GOVT.GIRLS HIGH SCHOOL,CHANDERKEY MANGOLEY TEHSIL & DISTRICT NAROWAL",
            "152099" =>"GOVT.GIRLS HIGH SCHOOL, PINDI PURBIAN THESIL ZAFARWAL, NAROWAL",
            "152100" =>"GOVT.GIRLS HIGH SCHOOL, BHATTIAN DEWAN TEHSIL ZAFARWAL, NAROWAL",
            "152101" =>"BRIGHT FUTURE ISLAMIA HIGH SCHOOL FOR GIRLS.TOTAY WALI SADDO WALA, NAROWAL",
            "152103" =>"GOVT. GIRLS HIGH SCHOOL, MUNDA BAJWA TEH. ZAFARWAL, NAROWAL",
            "152104" =>"GOVT. GIRLS HIGH SCHOOL, PAKHOKEY, LAHORE ROAD, NAROWAL",
            "152105" =>"AL HAVI MODEL SCHOOL FOR GIRLS, QILA AHMAD ABAD, NAROWAL",
            "152106" =>"THE HOUSE OF KNOWLEDGE FOR GIRLS, NONAR, ZAFARWAL, NAROWAL",
            "152107" =>"HASSAN SCHOLARS PUBLIC SCHOOL FOR GIRLS, OLD KUCHEHRY ROAD, NAROWAL",
            "152108" =>"AL BADAR GIRLS PUBLIC MODEL HIGH SCHOOL, NWAN PIND ROAD, ZAFARWAL, NAROWAL",
            "152110" =>"GOVT. GIRLS HIGH SCHOOL, GUNGOHAR, MURIDKE TO NAROWAL ROAD, BUDHA DHOLA, NAROWAL",
            "152111" =>"AFZAL MODEL HIGH SCHOOL FOR GIRLS, BHELOWALI BUS STOP, BADDOMALHI, NAROWAL",
            "152112" =>"SUROSH MODEL GIRLS HIGH SCHOOL, DEHLRA, ZAFARWAL, NAROWAL",
            "152113" =>"GOVT. GIRLS HIGH SCHOOL, LANGARKEY P/O SANKHATRA, ZAFARWAL, NAROWAL",
            "152114" =>"GOVT. GIRLS HIGH SCHOOL, SARRIYA GUJRAN P/O RAMBRI, SHAKARGARH, NAROWAL",
            "152115" =>"GOVT. GIRLS HIGH SCHOOL, BUBAK MARALI, NAROWAL",
            "152116" =>"GOVT. GIRLS HIGH SCHOOL FATWAL, SHAKARGARH, NAROWAL",
            "152117" =>"GILLANI PUBLIC SCHOOL FOR GIRLS, NEAR UNION COUNCIL, NONAR, ZAFARWAL, NAROWAL",
            "152118" =>"TABINDA PUBLIC HIGH SCHOOL FOR GIRLS, KOHLIAN, SHAKARGARH, NAROWAL",
            "152119" =>"GOVT. GIRLS HIGH SCHOOL, JANDIALA, ZAFARWAL, NAROWAL",
            "152120" =>"SHAHEEN ENGLISH MODEL GIRLS HIGH SCHOOL, MALIK PUR, SHAKARGARH, NAROWAL",
            "152121" =>"IQBAL PUBLIC MODEL HIGH SCHOOL (GIRLS), AZIZ PUR, ZAFARWAL, NAROWAL",
            "152122" =>"NEW PUNJAB PUBLIC HIGH SCHOOL FOR GIRLS, TARAPUR, ZAFARWAL, NAROWAL",
            "152123" =>"BRIGHT FUTURE PUBLIC HIGH SCHOOL FOR GIRLS, JARPAL, ZAFARWAL, NAROWAL",
            "152125" =>"NAQSH-E-LASANI GIRLS HIGH SCHOOL, ZAFARWAL ROAD, SHAKARGARH, NAROWAL",
            "152126" =>"ANWAR PUBLIC MODEL HIGH SCHOOL FOR GIRLS, PHAGWARI, SHAKARGARH, NAROWAL",
            "152127" =>"SHAKARGARH PUBLIC SCHOOL (GIRLS), NOOR KOT ROAD, SHAKARGARH, NAROWAL",
            "152128" =>"GOVT. GIRLS HIGH SCHOOL BADDOMALHI NO. 2, NAROWAL",
            "152129" =>"GOVT. GIRLS HIGH SCHOOL, BATHANWALA, NAROWAL",
            "152130" =>"NASIR PUBLIC HIGH SCHOOL FOR GIRLS, LATKO CHAK TEHSIL SHAKARGARH, NAROWAL",
            "152132" =>"LASANI FOUNDATION GIRLS HIGH SCHOOL, KOT NAINAN TEHSIL SHAKARGARH, NAROWAL",
            "152133" =>"QADRI SCHOLARS PUBLIC HIGH SCHOOL FOR GIRLS, JANDIALA TEHSIL ZAFARWAL, NAROWAL",
            "152135" =>"PARADISE HIGH SCHOOL FOR GIRLS, RAILWAY ROAD, SHAKARGARH, NAROWAL",
            "152136" =>"INTERNATIONAL ISLAMIC UNIVERSITY ISLAMABAD GIRLS SCHOOLS, RAILWAY ROAD, SHAKARGARH, NAROWA",
            "152137" =>"TAAJ SCHOLARS PUBLIC GIRLS HIGH SCHOOL, LASSER KALAN TEHSIL ZAFARWAL, NAROWAL",
            "152138" =>"HAIDER FOUNDATION SCHOOL FOR GIRLS, FAROOZ PUR TEHSIL ZAFARWAL, NAROWAL",
            "152140" =>"GHAZALI PUBLIC HIGH SCHOOL FOR GIRLS, DARMAN TEHSIL ZAFARWAL, NAROWAL",
            "152141" =>"GHAZALI PUBLIC HIGH SCHOOL FOR GIRLS, PINDI POOR BIAN TEHSIL ZAFARWAL, NAROWAL",
            "152142" =>"GOVT. GIRLS HIGH SCHOOL, MELU SALU TEHSIL SHAKARGARH, NAROWAL",
            "161001" =>"GOVT. HIGH SCHOOL ALHAR (SIALKOT)",
            "161002" =>"GOVT. HIGH SCHOOL ADAMKE CHEEMA (SIALKOT)",
            "161003" =>"GOVT. HIGH SCHOOL BADIANA (SIALKOT)",
            "161004" =>"GOVT. HIGH SCHOOL BHAGOWAL (SIALKOT)",
            "161005" =>"GOVT. HIGH SCHOOL BHILO MAHAR (SIALKOT)",
            "161006" =>"GOVT. HIGH SCHOOL BOGRAY (SIALKOT)",
            "161007" =>"GOVT. HIGH SCHOOL BUDHA GORAYA (SIALKOT)",
            "161008" =>"GOVT. HIGH SCHOOL BHAGIARI (SIALKOT)",
            "161009" =>"GOVT. HIGH SCHOOL BAMBANWALA (SIALKOT)",
            "161010" =>"GOVT. HIGH SCHOOL BHAGAT PUR (SIALKOT)",
            "161011" =>"GOVT. HIGH SCHOOL BEGOWALA (SIALKOT)",
            "161012" =>"GOVT. HIGH SCHOOL BHOPALWALA (SIALKOT)",
            "161013" =>"GOVT. HIGH SCHOOL BAN BAJWA (SIALKOT)",
            "161014" =>"GOVT. HIGH SCHOOL CHOBARA",
            "161015" =>"GOVT. HIGH SCHOOL CHARWA (SIALKOT)",
            "161016" =>"GOVERNMENT HIGH SCHOOL, CHAWINDA",
            "161017" =>"GOVT. T.I.HIGH SCHOOL CHAWINDA (SIALKOT)",
            "161018" =>"GOVT. HIGH SCHOOL CHAPRAR (SIALKOT)",
            "161019" =>"GOVT. HIGH SCHOOL CHANNU MOME (SIALKOT)",
            "161020" =>"GOVT. HIGH SCHOOL CHITTI SHEIKHAN (SIALKOT)",
            "161021" =>"GOVT. HIGH SCHOOL DASKA (SIALKOT)",
            "161022" =>"GOVT. CHRISTIAN HIGH SCHOOL DASKA (SIALKOT)",
            "161023" =>"GOVT. HIGH SCHOOL DASKA KALAN (SIALKOT)",
            "161024" =>"M.I. PAK PUBLIC HIGH SCHOOL, DASKA (SIALKOT)",
            "161025" =>"ALLAMA IQBAL IDEAL HIGH SCHOOL DASKA (SIALKOT)",
            "161026" =>"FAROOQIA HIGH SCHOOL DASKA (SIALKOT)",
            "161027" =>"SAINT MARKS HIGH SCHOOL DASKA (SIALKOT)",
            "161028" =>"GOVT. HIGH SCHOOL DHANANWALI (SIALKOT)",
            "161029" =>"GOVT. HIGH SCHOOL DHODA (SIALKOT)",
            "161030" =>"GOVT. HIGH SCHOOL DALLOWALI (SIALKOT)",
            "161031" =>"GOVT. HIGH SCHOOL GUNNA KALAN (SIALKOT)",
            "161032" =>"GOVT. HIGH SCHOOL GOINDKE (SIALKOT)",
            "161034" =>"GOVT. HIGH SCHOOL GONDAL (SIALKOT)",
            "161035" =>"GOVT. HIGH SCHOOL GALOTIAN KALAN (SIALKOT)",
            "161036" =>"WATAN IDEAL HIGH SCHOOL GOJRA (SIALKOT)",
            "161037" =>"GOVT. T.I. HIGH SCHOOL, GHATTIALIAN (SIALKOT)",
            "161038" =>"GOVT. PUBLIC HIGH SCHOOL GHARTAL (SIALKOT)",
            "161039" =>"GOVT. HIGH SCHOOL HEAD MARALA (SIALKOT)",
            "161040" =>"SAINT MARY'S HIGH SCHOOL JAMKE CHEEMA (SIALKOT)",
            "161041" =>"GOVT. HIGH SCHOOL JAMKE CHEEMA (SIALKOT)",
            "161042" =>"GOVT. HIGH SCHOOL KHANPUR SYEDAN (SIALKOT)",
            "161043" =>"GOVT. HIGH SCHOOL KANWANLIT (SIALKOT)",
            "161045" =>"GOVT. HIGH SCHOOL KULLUWAL (SIALKOT)",
            "161046" =>"GOVT. HIGH SCHOOL KANPUR  (SIALKOT)",
            "161047" =>"GOVT. HIGH SCHOOL KHAROTA SYEDAN (SIALKOT)",
            "161048" =>"GOVT. HIGH SCHOOL KAMMAN WALA (SIALKOT)",
            "161049" =>"GOVT. HIGH SCHOOL KUTHIALA (SIALKOT)",
            "161050" =>"GOVT. HIGH SCHOOL KUNDAN PUR (SIALKOT)",
            "161051" =>"GOVT. ISLAMIA HIGH SCHOOL KALASWALA (SIALKOT)",
            "161052" =>"GOVT. HIGH SCHOOL KOTLI BEHRAM SIALKOT",
            "161053" =>"GOVT. HIGH SCHOOL KALA GHUMMANAN (SIALKOT)",
            "161054" =>"GOVT. KASHMIR HIGH SCHOOL KOTLI FAQIR CHAND (SIALKOT)",
            "161055" =>"GOVT. HIGH SCHOOL LURHIKI (SIALKOT)",
            "161056" =>"GOVT. HIGH SCHOOL LADHAR (SIALKOT)",
            "161057" =>"GOVT. HIGH SCHOOL, MUNDEKI GORAYA (SIALKOT)",
            "161059" =>"GOVT. HIGH SCHOOL MALIPUR (SIALKOT)",
            "161060" =>"GOVT. HIGH SCHOOL MARAKIWAL (SIALKOT)",
            "161061" =>"GOVT. HIGH SCHOOL MAJRA (SIALKOT)",
            "161062" =>"GOVT. HIGH SCHOOL, MALKEY KALAN (SIALKOT)",
            "161063" =>"GOVT. ISLAMIA HIGH SCHOOL MITRANWALI (SIALKOT)",
            "161064" =>"GOVT. HIGH SCHOOL NO.1 PASRUR (SIALKOT)",
            "161065" =>"GOVT. HIGH SCHOOL NO.2 PASRUR (SIALKOT)",
            "161068" =>"GOVT. HIGH SCHOOL PHUKLIAN (SIALKOT)",
            "161069" =>"GOVT. SIR SYED HIGH SCHOOL PAKKI KOTLI (SIALKOT)",
            "161071" =>"GOVT. ISLAMIA HIGH SCHOOL RATTA JATHOL (SIALKOT)",
            "161072" =>"GOVT. HIGH SCHOOL RASULPUR BHALLIAN (SIALKOT)",
            "161073" =>"GOVT. R. M. HIGH SCHOOL SAUKAN WIND (SIALKOT)",
            "161074" =>"GOVT. KASHMIR HIGH SCHOOL SOHAWA (SIALKOT)",
            "161075" =>"GOVT. HIGH SCHOOL SHAHZADA (SIALKOT)",
            "161076" =>"GOVT. HIGH SCHOOL SAHOWALA (SIALKOT)",
            "161077" =>"GOVT. MUSLIM AWAMI HIGH SCHOOL SAMBRIAL (SIALKOT)",
            "161078" =>"GOVT. ISLAMIA HIGH SCHOOL SAMBRIAL (SIALKOT)",
            "161079" =>"SIR SYED PUBLIC BOYS HIGH SCHOOL SAMBRIAL (SIALKOT)",
            "161080" =>"GOVT. AWAMI HIGH SCHOOL SATRAH (SIALKOT)",
            "161081" =>"GOVT. ISLAMIA HIGH SCHOOL SIRANWALI, SIALKOT",
            "161082" =>"GOVT.COMPREHENSIVE HIGH SCHOOL SIALKOT",
            "161083" =>"GOVT. PILOT SECONDARY SCHOOL SIALKOT",
            "161085" =>"GOVT. CHRISTIAN HIGH SCHOOL SIALKOT CITY",
            "161086" =>"SAINT ANTHONY HIGH SCHOOL, SIALKOT",
            "161087" =>"GOVT. ARABIC HIGH SCHOOL SIALKOT",
            "161088" =>"GOVT. QAUMI HIGH SCHOOL SIALKOT",
            "161089" =>"GOVT. ISLAMIA HIGH SCHOOL SIALKOT CITY",
            "161090" =>"GOVT. MUSLIM HIGH SCHOOL SIALKOT CITY",
            "161092" =>"GOVT. JINNAH EFFICIENCY MODEL HIGH SCHOOL SIALKOT CANTT.",
            "161094" =>"C.T.I. HIGH SCHOOL BARA PATHAR SIALKOT",
            "161095" =>"CITY PUBLIC HIGH SCHOOL JAIL ROAD, SIALKOT",
            "161096" =>"CRESCENT MODEL HIGH SCHOOL ABBOT ROAD, SIALKOT",
            "161098" =>"NEW CANTT. PUBLIC  HIGH SCHOOL SIALKOT CANTT.",
            "161099" =>"SAINT MARY'S HIGH SCHOOL WAZIRABAD ROAD, HARAR (SIALKOT)",
            "161100" =>"ALLAMA IQBAL PUBLIC HIGH SCHOOL (FOR BOYS) SIALKOT CANTT.",
            "161102" =>"GOVT. HIGH SCHOOL THRO MANDI (SIALKOT)",
            "161103" =>"GOVT. HIGH SCHOOL TALHARA  (SIALKOT)",
            "161105" =>"GOVT. HIGH SCHOOL WADALA SANDHWAN (SIALKOT)",
            "161106" =>"CAMBRIDGE PUBLIC HIGH SCHOOL KULLUWAL ROAD, KAURPUR (SIALKOT)",
            "161107" =>"IMAM IBN-E-TAIMYA HIGH SCHOOL MOUTRAH, SIALKOT",
            "161109" =>"QUAID-E-AZAM PUBLIC SCHOOL, SIALKOT",
            "161110" =>"CADET COLLEGE, KOTLI NOONAN (SIALKOT)",
            "161111" =>"SIALKOT PUBLIC SECONDARY SCHOOL (FOR BOYS) SIALKOT",
            "161113" =>"AMERICAN GRAMMAR SCHOOL SIALKOT CANTT",
            "161114" =>"QUAID PUBLIC HIGH SCHOOL (BOYS), ISLAMABAD, NAI ABADI, SIALKOT",
            "161115" =>"UNIQUE EFFICIENCY HIGH SCHOOL (RECOGNIZED) SAMBRIAL (SIALKOT)",
            "161116" =>"AL-FARID ISLAMIC  MODEL SCHOOL,(REGD.) QILA KALAR WALA (SIALKOT)",
            "161117" =>"SIALKOT GRAMMAR HIGH SCHOOL BHOPALWALA (SIALKOT)",
            "161118" =>"DAR-E-ARQAM HIGH SCOOOL (BOYS), MAIN SHAHAB PURA ROAD, SIALKOT",
            "161119" =>"CITY MODEL BOYS HIGH SCHOOL NEKA PURA, SIALKOT",
            "161121" =>"CIVIL PUBLIC BOYS HIGH SCHOOL BHOPALWALA (SIALKOT)",
            "161122" =>"MISALI ZAKARIYIA PUBLIC HIGH SCHOOL NEAR DEGREE COLLEGE CHOWK, SIALKOT ROAD DASKA",
            "161124" =>"DAR-E-ARQAM HIGH SCHOOL BHOPAL WALA DISTT. SIALKOT",
            "161125" =>"CATHEDRAL HIGH SCHOOL NO.1 (BOYS) CHRISTIAN TOWN SIALKOT-2",
            "161126" =>"CREATIVE SCHOOL SYSTEM CANTT. ROAD SIALKOT",
            "161127" =>"OXFORD GRAMMER PUBLIC HIGH SCHOOL, DASKA (SIALKOT)",
            "161128" =>"PAK GRAMMAR HIGH SCHOOL FATHA GARH, SIALKOT",
            "161129" =>"QUAID PUBLIC MODEL HIGH SCHOOL KHADIM ALI ROAD, SIALKOT",
            "161130" =>"JOHN AND SCOTT ENGLISH SCHOOL, SIALKOT",
            "161131" =>"AZAM SCIENCE SECONDARY SCHOOL DEFENCE ROAD, SIALKOT",
            "161132" =>"HARVARD GRAMMAR HIGH SCHOOL (FOR BOYS) COURT ROAD, SIALKOT",
            "161133" =>"SUROSH PUBLIC HIGH SCHOOL NAUL WAZIRABAD ROAD, SIALKOT",
            "161134" =>"KALSOOM GRAMMAR SCHOOL, BHARTH (SIALKOT)",
            "161135" =>"NATIONAL PUBLIC HIGH SCHOOL, LANGERIALI (SIALKOT)",
            "161136" =>"AIR PUBLIC HIGH SCHOOL CHOWK DHARAM KOT (SIALKOT)",
            "161138" =>"AAMIR PUBLIC HIGH SCHOOL DHALLEY WALI (SIALKOT)",
            "161139" =>"AL-UMER HIGH SCHOOL DEFENCE ROAD (S.I.E.), SIALKOT",
            "161140" =>"NAQSH-E-LASANI HIGH SCHOOL FOR BOYS, MAHR TOWN, SIALKOT",
            "161141" =>"JINNAH MODEL HIGH SCHOOL FOR BOYS, JAMMU ROAD DALOWALI SIALKOT",
            "161142" =>"MADRASSA TUZ-ZAHRA BOYS HIGH SCHOOL TOORABAD SIALKOT",
            "161143" =>"HAFEEZ PUBLIC HIGH SCHOOL FOR BOYS DASKA ROAD P.O. FATEH GARH, SIALKOT",
            "161144" =>"MARY'S SECONDARY PUBLIC SCHOOL SIALKOT CANTT",
            "161145" =>"DANISH PUBLIC HIGH SCHOOL SAMBRIAL  (SIALKOT)",
            "161147" =>"GOVT. HIGH SCHOOL JAURIAN KALAN, (SIALKOT)",
            "161148" =>"SCHOLARS PUBLIC SCHOOL KALASWALA",
            "161149" =>"SUPERIOR SCIENCE PUBLIC HIGH SCHOOL, URA CHOWK, SIALKOT",
            "161150" =>"THE NOBLE PUBLIC HIGH SCHOOL (FOR BOYS) WAZIRABAD ROAD, HARRAR, SIALKOT",
            "161152" =>"THE EDUCATION CITY SIALKOT ROAD DASKA",
            "161153" =>"AL-NOOR EDUCATION SYSTEM SIALKOT",
            "161154" =>"NEW MODEL PUBLIC HIGH SCHOOL FOR BOYS KHAROTA SIALKOT",
            "161155" =>"ANGELS SCHOOL SYSTEM BOYS CAMPUS COLLEGE ROAD DASKA",
            "161156" =>"THE CITI SCHOOL COLLEGE ROAD, DASKA",
            "161157" =>"CLASSIC SCHOOL SYSTEM MODEL TOWN, SIALKOT",
            "161158" =>"QUAID-E-MILLAT PUBLIC HIGH SCHOOL SHAHAH ABAD ESTATEHAJI PURA ROAD, SIALKOT",
            "161159" =>"GOVT. HIGH SCHOOL, BADDOKE CHEEMA, DISTRICT SIALKOT",
            "161160" =>"CENTRAL MODEL HIGH SCHOOL RANG PURA (BOYS), SIALKOT",
            "161161" =>"SUNRISE PUBLIC SCHOOL KHROTA SYEDAN SIALKOT",
            "161162" =>"GOVT. HIGH SCHOOL RANDHIR BAGRIAN DISTT SIALKOT",
            "161163" =>"O.P.F. PUBLIC HIGH SCHOOL FOR BOYS , SIALKOT",
            "161165" =>"THE CITY SCHOOL IQBAL CAMPUS SIALKOT",
            "161166" =>"AL-HIRA BOYS HIGH SCHOOL PASRUR",
            "161167" =>"RAI EDUCATION SYSTEM FOR BOYS, SIALKOT.",
            "161168" =>"NEW QUAID PUBLIC HIGH SCHOOL FOR BOYS SATRAH",
            "161170" =>"KASHIF MODEL HIGH SCHOOL FOR BOYS SHAHAB PURA, SIALKOT",
            "161171" =>"THE SCIENCE SECONDARY SCHOOL CHAWINDA (SIALKOT)",
            "161172" =>"IQRA SCIENCE HIGH SCHOOL SATRAH (SIALKOT)",
            "161173" =>"TABANI SCHOLARS FOR  BOYS SCHOOL KAPUROWALI, SIALKOT",
            "161174" =>"THE EDUCATORS BOYS HIGH SCHOOL CITY CAMPUS, PASRUR BYPASS ROAD, DASKA, SIALKOT",
            "161175" =>"THE EDUCATORS HIGH SCHOOL FOR BOYS CANTONMENT PLAZA SIALKOT",
            "161177" =>"GOVT. HIGH SCHOOL MALKHANWALA (SIALKOT)",
            "161178" =>"SHAHAB-U-DIN HIGH SCHOOL LURRIHIKI BANGLA TEHSIL DASKA SIALKOT",
            "161179" =>"SIALKOT MODEL HIGH SCHOOL (BOYS) SIALKOT",
            "161180" =>"BRAIN SCHOOL OF SCIENCES (FOR BOYS) DASKA",
            "161181" =>"MISALI ABDALIAN SECONDARY SCHOOL FOR BOYS, NAROWAL ROAD, PASRUR, SIALKOT",
            "161182" =>"PAK SIJ HIGH SCHOOL, SAMBRIAL (SIALKOT)",
            "161183" =>"LEARNING ZONE IQBAL TOWN DEFENCE ROAD SIALKOT",
            "161184" =>"VIP MODEL HIGH SCHOOL FOR BOYS ADDA GOPALPUR SIALKOT",
            "161185" =>"THE PUNJAB HIGH SCHOOL FOR BOYS SIALKOT",
            "161187" =>"THE LEARNERS HIGH SCHOOL FOR BOYS CHAWINDA PASRUR (SIALKOT)",
            "161188" =>"FAUJI FOUNDATION MODEL SCHOOL FOR BOYS MOH. UMEED PURA PASRUR SIALKOT",
            "161189" =>"BEACON HOUSE SCHOOL SYSTEM FOR BOYS, SIALKOT",
            "161190" =>"LEADS GRAMMAR SCHOOL FOR BOYS, NEAR ALLAMA IQBAL LIBRARY PARIS ROAD SIALKOT",
            "161191" =>"SCIENCE FOUNDATION HIGH SCHOOL FOR BOYS.MITRANWALI TEHSIL DASKA DISTRICT SIALKOT",
            "161192" =>"A TO Z PUBLIC HIGH SCHOOL FOR BOYS,MOH,SHUJA ABAD,NEKA PURA, SIALKOT",
            "161193" =>"THE EDUCATORS HIGH SCHOOL,CHWINDA CAMPUS, NEAR BOARDING HOUSE,SIALKOT ROAD CHWINDA,PASRUR,SIALKOT",
            "161194" =>"GOVT. HIGH SCHOOL FOR BOYS PINDI BHAGO P/O PINDI BHAGO TEH PASRUR DISTT SIALKOT",
            "161195" =>"GOVT. HIGH SCHOOL, PEERO CHAK TEHSIL DASKA, SIALKOT",
            "161196" =>"THE SKY SCHOOL FOR BOYS, COMMISSIONER ROAD, SIALKOT",
            "161197" =>"CADET COLLEGE PASRUR, NAROWAL ROAD, PASRUR, SIALKOT",
            "161198" =>"ALLIED SCHOOL (HUSSNAIN CAMPUS). DASKA ROAD SAMBRIAL DISTRICT SIALKOT",
            "161199" =>"ASGHAR IDEAL HIGH SCHOOL FOR BOYS,CHOWK DHARM KOT, EMINABAD ROAD TEHSIL DASKS, SIALKOT",
            "161200" =>"THE HOPE HIGH SCHOOL FOR BOYS, PASRUR ROAD NEAR TELEPHONE EXCHANGE SIALKOT",
            "161201" =>"ALLIED SCHOOL FATIMA CAMPUS FOR BOYS, COLLEGE ROAD, DASKA, DISTT. SIALKOT",
            "161202" =>"GOVT. HIGH SCHOOL, PHILORA TEHSIL PASRUR, SIALKOT",
            "161203" =>"GOVT.HIGH SCHOOL, VIRK P/O BHAGOWAL TEHSIL PASRUR SIALKOT",
            "161204" =>"GOVT. HIGH SCHOOL FOR BOYS, KANDAN SIAN, DASKA, SIALKOT",
            "161205" =>"ALLIED SCHOOL (DOBURJI CAMPUS) FOR BOYS, CHOWK DOBURJI MALLIAN, DASKA ROAD, SIALKOT",
            "161206" =>"WORKERS WELFARE SCHOOL (BOYS), CHAWINDA, PASRUR, SIALKOT",
            "161207" =>"THE KNOWLEDGE HIGH SCHOOL FOR BOYS, 1-KM DASKA ROAD, PASRUR, SIALKOT",
            "161208" =>"ALLAMA IQBAL SCHOOL FOR SPECIAL EDUCATION (BOYS), MASJID ROAD, SIALKOT CANTT",
            "161209" =>"HASSAN SCHOLARS PUBLIC SCHOOL FOR BOYS, MISYAL ROAD, KINGRA, PASRUR, SIALKOT",
            "161210" =>"AT-TAQWA SCIENCE HIGH SCHOOL FOR BOYS, KHAN MEHAL ROAD, SIALKOT",
            "161211" =>"SIALKOT GRAMMAR SCHOOL FOR BOYS, COLLEGE ROAD, DASKA, SIALKOT",
            "161212" =>"THE EDUCATOR SCHOOL FOR BOYS, KALASWALA ROAD, PASRUR, SIALKOT",
            "161213" =>"FAZAL SARDAR PUBLIC SCHOOL, KINGRA ROAD KOTLI LALA, PASRUR, SIALKOT",
            "161215" =>"GOVT. HIGH SCHOOL BALLANWALA, SIALKOT",
            "161216" =>"GOVT. HIGH SCHOOL FOR BOYS, BHARTH, SIALKOT",
            "161217" =>"GOVT. HIGH SCHOOL, ROHAILA P/O BEGOWALA, SAMBRIAL, SIALKOT",
            "161218" =>"GOVT. HIGH SCHOOL RORAS, SAMBRIAL, SIALKOT",
            "161219" =>"ALLIED SCHOOL ABDUL HAMEED CAMPUS FOR BOYS, MODEL TOWN, UGOKI, SIALKOT",
            "161220" =>"ALLIED SCHOOL ADDA MOUTRA CAMPUS FOR BOYS, MOUTRA, DASKA, SIALKOT",
            "161221" =>"PUNJAB SCHOOL FOR BOYS, BHOBHANGI, DASKA, SIALKOT",
            "161222" =>"M.A.F-UL HUSNAIN SCHOOL FOR BOYS, QILA KALAR WALA, PASRUR, SIALKOT",
            "161223" =>"THE KNOWLEDGE SCHOOL FOR BOYS, KLASSWALA, PASUR, SIALKOT",
            "161224" =>"GOVT. SHAHZEB SHAHEED BOYS HIGH SCHOOL QILA KALARWALA, PASRUR, SIALKOT",
            "161225" =>"EDUCATIONAL SCHOOL SYSTEM FOR BOYS, QILA KALARWALA, PASRUR, SIALKOT",
            "161226" =>"ROYAL INTERNATIONAL GRAMMAR HIGH SCHOOL FOR BOYS, KANDAN SIAN, DASKA, SIALKOT",
            "161227" =>"THE PAKISTAN PUBLIC HIGH SCHOOL FOR BOYS, BHOPALWALA, SAMBRIAL, SIALKOT",
            "161228" =>"FATIMA PUBLIC HIGH SCHOOL FOR BOYS, SULTAN PURA, SAMBRIAL, SIALKOT",
            "161229" =>"SIALKOT GRAMMAR HIGH SCHOOL FOR BOYS, AIRPORT ROAD, SAMBRIAL, SIALKOT",
            "161230" =>"SIALKOT GRAMMAR HIGH SCHOOL FOR BOYS, ALLAMA IQBAL TOWN, SIALKOT",
            "161231" =>"THE ISLAMIC EDUCATORS SCHOOL SYSTEM FOR BOYS, SABAZ PIR MORE, CHARWA ROAD, PASRUR, SIALKOT",
            "161232" =>"HIGH AIMS SECONDARY SCHOOL FOR BOYS, THRO MANDI, PASRUR, SIALKOT",
            "161233" =>"ALLIED SCHOOL OURA CAMPUS FOR BOYS, OURA CHOWK, KINGRA ROAD, LANGRIALI, SIALKOT",
            "161234" =>"THE SPIRIT SCHOOL FOR BOYS, SAID PUR GONDAL ROAD, SIALKOT",
            "161235" =>"THE BALANCE SCHOOL FOR BOYS, 95-AZIZ SHAHEED ROAD, SIALKOT CANTT",
            "161236" =>"GOVT. HIGH SCHOOL, MANDRANWALA TEHSIL DASKA, SIALKOT",
            "161237" =>"QURESHI PUBLIC HIGH SCHOOL FOR BOYS, WAZIRABAD ROAD, UGOKI, SIALKOT",
            "161238" =>"AL-NOOR GRAMMAR SCHOOL FOR BOYS, SAID PUR GONDAL ROAD, BHARTH, SIALKOT",
            "161239" =>"ISLAM INTERNATIONAL SCHOOL FOR BOYS, DASKA ROAD, SIALKOT",
            "161240" =>"MISALI SHAHEEN SECONDARY SCHOOL FOR BOYS, MAJRA ROAD, AIR PORT TOWN, SAMBRIAL, SIALKOT",
            "161241" =>"IQRA EDUCATION SYSTEM FOR BOYS, NEAR CANAL BRIDGE, BAROKAY ROAD, DASKA, SIALKOT",
            "161242" =>"THE SPIRIT SCHOOL KUBE CHAK CAMPUS FOR BOYS, KUBE CHAK, SAID PUR ROAD, SIALKOT",
            "161243" =>"LEARNING KINGDOM SCHOOL SYSTEM FOR BOYS, MANDRANWALA TEHSIL DASKA, SIALKOT",
            "161244" =>"AR-REHMAN GRAMMER SCHOOL FOR BOYS, JAMKE CHEEMA TEHSIL DASKA, SIALKOT",
            "161246" =>"ALLIED SCHOOL FOR BOYS SAMBRIAL CAMPUS, WAZIRABAD/UNIVERSITY ROAD, SAMBRIAL, SIALKOT",
            "161247" =>"THE SMART SCHOOL FOR BOYS (CANTT CAMPUS), KALMA CHOWK, SAIDPUR GONDAL ROAD, SIALKOT",
            "161248" =>"MARCHING BELL SCHOOL SYSTEM FOR BOYS, RASOOLPUR BHALLIAN (SIALKOT)",
            "161249" =>"UNIQUE PUBLIC HIGH SCHOOL FOR BOYS, WAJEED WALI ROAD, CHAWINDA TEHSIL PASRUR, SIALKOT",
            "161250" =>"GOVT. HIGH SCHOOL (BOYS) DASKA KOT, KATCHEHRY ROAD, DASKA, SIALKOT",
            "161251" =>"GOVT. BOYS HIGH SCHOOL, SAID PUR, SIALKOT",
            "161252" =>"CONCEPT SCHOOL SYSTEM FOR BOYS, PARIS ROAD, SIALKOT",
            "161503" =>"SECURE STUDY SCHOOL FOR BOYS, CAPITAL ROAD, MODEL TOWN SIALKOT",
            "161504" =>"ALLIED SCHOOL (BOYS CAMPUS), SAID PUR GONDAL ROAD, SIALKOT",
            "161505" =>"GRAND HEIGHTS GRAMMAR HIGH SCHOOL FOR BOYS 13-TALIB COLONY BHOPALWALA SAMBRIAL SIALKOT",
            "161506" =>"GOVT. HIGH SCHOOL , JATHIKAY, SIALKOT",
            "161507" =>"LAHORE GRAMMAR SCHOOL FOR BOYS, KALMA CHOWK, SAID PUR ROAD, SIALKOT",
            "162001" =>"GOVT. GIRLS HIGH SCHOOL ADAMKE NAGRA (SIALKOT)",
            "162002" =>"GOVT. GIRLS HIGH SCHOOL, ALO MOHAR (SIALKOT)",
            "162004" =>"GOVT. GIRLS HIGH SCHOOL BAJRA GARHI (SIALKOT)",
            "162005" =>"GOVT. GIRLS HIGH SCHOOL BEGOWALA (SIALKOT)",
            "162007" =>"GOVT. GIRLS HIGH SCHOOL BHOPALWALA (SIALKOT)",
            "162008" =>"GOVT. GIRLS HIGH SCHOOL BAMBANWALA (SIALKOT)",
            "162009" =>"GOVT. GIRLS HIGH SCHOOL, BHALOWALI (SIALKOT)",
            "162010" =>"GOVT. GIRLS HIGH SCHOOL BHARATH (SIALKOT)",
            "162011" =>"GOVT. GIRLS HIGH SCHOOL BHAGAT PUR (SIALKOT)",
            "162013" =>"GOVT. GIRLS HIGH SCHOOL CHAPRAR (SIALKOT)",
            "162014" =>"GOVT. GIRLS MODEL HIGH SCHOOL DASKA (SIALKOT)",
            "162015" =>"GOVT. ISLAMIA GIRLS HIGH SCHOOL DASKA (SIALKOT)",
            "162016" =>"M.I. PAK PUBLIC HIGH SCHOOL (FOR GIRLS), DASKA (SIALKOT)",
            "162018" =>"SAINT MARK'S GIRLS HIGH SCHOOL DASKA (SIALKOT)",
            "162019" =>"FAZAT PUBLIC GIRLS HIGH SCHOOL DHIDOWALI, DASKA, SIALKOT",
            "162021" =>"GOVT. GIRLS HIGH SCHOOL GOJRA, SIALKOT ",
            "162022" =>"GOVT. GIRLS HIGH SCHOOL GALOTIAN KHURD,(SIALKOT)",
            "162023" =>"GOVT. GIRLS HIGH SCHOOL GOINDKE (SIALKOT)",
            "162024" =>"GOVT. GIRLS HIGH SCHOOL GADGORE (SIALKOT)",
            "162025" =>"GOVT. GIRLS HIGH SCHOOL GHUINIKE (SIALKOT)",
            "162026" =>"GOVT. GIRLS HIGH SCHOOL GONDAL (SIALKOT)",
            "162027" =>"GOVT. GIRLS HIGH SCHOOL GUNNA KALAN (SIALKOT)",
            "162029" =>"GOVT. GIRLS HIGH SCHOOL HAMMU GHAKHAR (SIALKOT)",
            "162031" =>"GOVT. GIRLS HIGH SCHOOL JUDHALA (SIALKOT)",
            "162032" =>"GOVT. GIRLS HIGH SCHOOL JAMKE CHEEMA (SIALKOT)",
            "162033" =>"GOVT. GIRLS HIGH SCHOOL JETHIKEY (SIALKOT)",
            "162035" =>"GOVT. GIRLS HIGH SCHOOL KALASWALA (SIALKOT)",
            "162037" =>"GOVT. GIRLS HIGH SCHOOL KHAROTA SYEDAN (SIALKOT)",
            "162038" =>"GOVT. GIRLS HIGH SCHOOL KOTLI BEHRAM (SIALKOT)",
            "162040" =>"GOVT. GIRLS HIGH SCHOOL LURHIKI (SIALKOT)",
            "162041" =>"GOVT. GIRLS HIGH SCHOOL MARAKIWAL (SIALKOT)",
            "162042" =>"GOVT. GIRLS HIGH SCHOOL MERAJKE (SIALKOT)",
            "162043" =>"GOVT. GIRLS HIGH SCHOOL MITRANWALI (SIALKOT)",
            "162044" =>"GOVT. GIRLS HIGH SCHOOL MUNDAKE GORAYA (SIALKOT)",
            "162045" =>"GOVT. GIRLS HIGH SCHOOL MANDRANWALA (SIALKOT)",
            "162046" =>"GOVT. GIRLS HIGH SCHOOL MASYAL (SIALKOT)",
            "162047" =>"GOVT. GIRLS HIGH SCHOOL PINDI BHAGO (SIALKOT)",
            "162048" =>"GOVT. GIRLS HIGH SCHOOL PURA HEERAN (SIALKOT)",
            "162049" =>"GOVT. GIRLS HIGH SCHOOL PHUKLIAN (SIALKOT)",
            "162050" =>"GOVT. GIRLS HIGH SCHOOL PASRUR (SIALKOT)",
            "162051" =>"GOVT. GIRLS HIGH SCHOOL DOGRI KALAN (SIALKOT)",
            "162052" =>"GOVT. GIRLS HIGH SCHOOL QILA KALARWALA (SIALKOT)",
            "162053" =>"GOVT. GIRLS HIGH SCHOOL RASOOLPUR BHALIAN (SIALKOT)",
            "162054" =>"GOVT. GIRLS HIGH SCHOOL RANDHEER (SIALKOT)",
            "162055" =>"GOVT. GIRLS HIGH SCHOOL RORAS (SIALKOT)",
            "162056" =>"GOVT. GIRLS HIGH SCHOOL SHAHZADA (SIALKOT)",
            "162057" =>"GOVT. GIRLS HIGH SCHOOL SAUKIN WIND (SIALKOT)",
            "162059" =>"GOVT. GIRLS HIGH SCHOOL SAHOWALA (SIALKOT)",
            "162060" =>"GOVT. GIRLS HIGH SCHOOL SABAZ KOT (SIALKOT)",
            "162061" =>"GOVT. GIRLS HIGH SCHOOL SAMBRIAL (SIALKOT)",
            "162062" =>"SIR SYED PUBLIC GIRLS HIGH SCHOOL SAMBRIAL (SIALKOT)",
            "162063" =>"GOVT. GIRLS HIGH SCHOOL ADALAT GARH SIALKOT",
            "162064" =>"GOVT. GIRLS HIGH SCHOOL HABIB PURA SIALKOT",
            "162067" =>"GOVT. CHRISTIAN GIRLS HIGH SCHOOL BARA PATHER SIALKOT",
            "162070" =>"GOVT. MUSLIM GIRLS HIGH SCHOOL RAMTALAI ROAD, SIALKOT",
            "162071" =>"GOVT. MUSLIM MODEL GIRLS HIGH SCHOOL MUHAMMAD PURA SIALKOT",
            "162072" =>"GOVT. CHRISTIAN GIRLS HIGH SCHOOL HAJI PURA SIALKOT",
            "162073" =>"GOVT. FATEH GARH HOME ECONOMICS GIRLS HIGH SCHOOL SIALKOT",
            "162074" =>"GOVT. ISLAMIA GIRLS HIGH SCHOOL SIALKOT",
            "162075" =>"GOVT. AHMEDIA GIRLS HIGH SCHOOL, SIALKOT",
            "162076" =>"GOVT. MIR HASSAN GIRLS HIGH SCHOOL SIALKOT",
            "162079" =>"ISLAMIA GIRLS HIGH SCHOOL GOHAD PUR SIALKOT",
            "162080" =>"CRESCENT MODEL GIRLS HIGH SCHOOL ABBOTT ROAD, SIALKOT",
            "162081" =>"CITY PUBLIC GIRLS HIGH SCHOOL KUTCHERY ROAD SIALKOT",
            "162082" =>"NEW CANTT. PUBLIC SCHOOL FOR GIRLS SIALKOT CANTT",
            "162084" =>"ALLAMA IQBAL PUBLIC HIGH SCHOOL FOR GIRLS SIALKOT CANTT",
            "162085" =>"CONVENT OF JESUS AND MARY GIRLS' HIGH SCHOOL",
            "162087" =>"GOVT. GIRLS HIGH SCHOOL VEROWALA (SIALKOT)",
            "162088" =>"GOVT. GIRLS HIGH SCHOOL BUDHA GORAYA (SIALKOT)",
            "162089" =>"GOVT. GIRLS HIGH SCHOOL BAN BAJWA (SIALKOT)",
            "162090" =>"GOVT. GIRLS HIGH SCHOOL PERO CHAK (SIALKOT)",
            "162091" =>"SYEDA AIESHA GIRLS HIGH SCHOOL, WAZIRABAD ROAD, SIALKOT",
            "162092" =>"GOVT. GIRLS HIGH SCHOOL VERUO (SIALKOT)",
            "162093" =>"GOVT. GIRLS HIGH SCHOOL KANWAN LIT (SIALKOT)",
            "162094" =>"O.P.F. PUBLIC HIGH SCHOOL, SIALKOT",
            "162095" =>"ST. MARY'S SCHOOL (FOR GIRLS)WAZIRABAD ROAD HARAR SIALKOT",
            "162096" =>"AMERICAN GRAMMAR SCHOOL SIALKOT CANTT",
            "162097" =>"JINNAH PUBLIC GIRLS HIGH SCHOOL RANGPURA, SIALKOT",
            "162098" =>"GOVT. GIRLS HIGH SCHOOL, TORANWAL (SIALKOT)",
            "162099" =>"UNIQUE EFFICIENCY GIRLS HIGH SCHOOL(RECOGNIZED), SAMBRIAL (SIALKOT)",
            "162101" =>"ST. JOSEPH'S CONVENT SCHOOL FATEGRAH SIALKOT",
            "162102" =>"QUAID-E-AZAM PUBLIC SCHOOL, SIALKOT",
            "162103" =>"JOHN AND SCOTT HIGH SCHOOL SIALKOT",
            "162104" =>"NOOR PUBLIC GIRLS HIGH SCHOOL MUBARAK PURA, SIALKOT",
            "162105" =>"JINNAH MODEL HIGH SCHOOL FOR GIRLS DALOWALI SIALKOT",
            "162106" =>"SIALKOT PUBLIC SECONDARY SCHOOL (GIRLS) PASRUR ROAD SIALKOT",
            "162107" =>"QUAID PUBLIC HIGH SCHOOL (GIRLS) MOH. ISLAMABAD NAI ABADI SIALKOT",
            "162108" =>"CITY MODEL GIRLS HIGH SCHOOL NEKA PURA SIALKOT",
            "162109" =>"UMER GIRLS HIGH SCHOOL DEFENCE ROAD (S.I.E.), SIALKOT",
            "162110" =>"APEX SCIENCE INSTITUTE (S.S FOR GIRLS), PASRUR SIALKOT",
            "162111" =>"ISLAMIC PUBLIC HIGH SCHOOL RANG PURA, SIALKOT",
            "162112" =>"GOVT.GIRLS  HIGH SCHOOL CHOBARA (SIALKOT)",
            "162113" =>"GOVT. GIRLS HIGH SCHOOL CHATTI SHEIKHAN SIALKOT",
            "162114" =>"TABANI SCHOLARS GIRLS HIGH SCHOOL KAPUROWALI, SIALKOT",
            "162115" =>"GOVT. GIRLS HIGH SCHOOL CHAHOOR TEH: PASRUR DIST. SIALKOT",
            "162116" =>"GOVT. GIRLS HIGH SCHOOL. KANDAN SIAN SIALKOT",
            "162119" =>"GOVT. GIRLS HIGH SCHOOL NAWAN PIND ARRIAN, SIALKOT",
            "162120" =>"GOVT. GIRLS HIGH SCHOOL BHAGOWAL (SIALKOT)",
            "162121" =>"ST. ANTHONY'S CONVENT GIRLS SCHOOL COLLEGE ROAD, SIALKOT",
            "162122" =>"MUNIM-UD-DIN GIRLS MODEL HIGH SCHOOL SIALKOT",
            "162123" =>"FATIMA JINNAH GIRLS HIGH SCHOOL FOR SCIENCE CHAWINDA (SIALKOT)",
            "162124" =>"PALL SCIENCE SECONDARY SCHOOL (GIRLS) CIRCULAR ROAD, SIALKOT",
            "162125" =>"GOVT. GIRLS HIGH SCHOOL KOTLI BAWA FAQIR CHAND (PASRUR)",
            "162126" =>"GOVT. GIRLS HIGH SCHOOL CHICHERYALI (PASRUR)",
            "162127" =>"AL-YAQOOB (MM) GIRLS HIGH SCHOOL BADIANA (SIALKOT)",
            "162128" =>"PAKISTAN SCIENCE HIGH SCHOOL FOR GIRLS QUAID-E-AZAM STREET, PASRUR ROAD, SIALKOT",
            "162129" =>"HAFEEZ PUBLIC HIGH SCHOOL DASKA ROAD, SIALKOT",
            "162130" =>"SIALKOT GRAMMAR GIRLS HIGH SCHOOL BHOPALWALA (SIALKOT)",
            "162131" =>"GOVT. GIRLS HIGH SCHOOL GHATIALIAN",
            "162132" =>"GOVT. GIRLS HIGH SCHOOL NEW SOHAWA TEH. PASRUR",
            "162133" =>"THE LEARNERS GIRLS HIGH SCHOOL CHAWINDA PASRUR (SIALKOT)",
            "162134" =>"ST. MARKS GIRLS HIGH SCHOOL, DASKA (SIALKOT)",
            "162135" =>"OXFORD GRAMMAR PUBLIC HIGH SCHOOL, DASKA (SIALKOT)",
            "162136" =>"HARVARD GRAMMAR HIGH SCHOOL (FOR GIRLS) COURT ROAD, SIALKOT",
            "162138" =>"PAK GRAMMER HIGH SCHOOL FOR GIRLS, MOH. REHMAN PURA, FATEH GARH, SIALKOT ",
            "162139" =>"THE CHENAB GIRLS HIGH SCHOOL, MIANWALI BANGLA (SIALKOT)",
            "162140" =>"IQRA SCIENCE GIRLS HIGH SCHOOL, SATRAH (SIALKOT)",
            "162141" =>"CATHEDRAL GIRLS HIGH SCHOOL-II, BARAH PATHER (SIALKOT)",
            "162144" =>"ISLAMIC CENTRED MODEL SCHOOL (FOR GIRLS) GHARTAL, DASKA (SIALKOT)",
            "162145" =>"MALIK PUBLIC GIRLS HIGH SCHOOL, BHAGWAL AWAN (SIALKOT)",
            "162146" =>"KALSOOM GRAMMAR SCHOOL, BHARTH (SIALKOT)",
            "162147" =>"IQRA MODEL GIRLS HIGH SCHOOL, MARAKIWAL (SIALKOT)",
            "162148" =>"AIR PUBLIC HIGH SCHOOL CHOWK DHARAM KOT,(SIALKOT",
            "162149" =>"DANISH PUBLIC GIRLS HIGH SCHOOL, SAMBRIAL (SIALKOT)",
            "162150" =>"GOVT. GIRLS HIGH SCHOOL MALKHANWALA (SIALKOT)",
            "162151" =>"QUAID PUBLIC MODEL HIGH SCHOOL KHADIM ALI ROAD, SIALKOT CITY",
            "162152" =>"NEW PILOT SCIENCE GIRLS HIGH SCHOOL (RANG PURA NORTH) SIALKOT",
            "162153" =>"MADRASSA TUZ-ZAHRA GIRLS HIGH SCHOOL TOORABAD (SIALKOT)",
            "162154" =>"ST, MARY'S GIRLS HIGH SCHOOL ADDAH (SIALKOT)",
            "162155" =>"PAK SIJ GIRLS HIGH SCHOOL SAMBRIAL (SIALKOT)",
            "162156" =>"F.K MODEL GIRLS HIGH SCHOOL MULLHU CHITT SIALKOT",
            "162157" =>"DAR-E-ARQAM HIGH SCOOOL (GIRLS), ADALAT GARH UGOKI ROAD, SIALKOT",
            "162158" =>"CREATIVE SCHOOL SYSTEM CANTT. ROAD SIALKOT",
            "162159" =>"THE SPIRIT SCHOOL FOR GIRLS, FARAZ SHAHEED ROAD, SIALKOT",
            "162160" =>"AL-GHANI FRONT RANK PUBLIC HIGH SCHOOL FOR GIRLS, BEENI SULEHRIAN (SIALKOT)",
            "162161" =>"GOVT. GIRLS HIGH SCHOOL CHARWA DISST. SIALKOT",
            "162162" =>"GOVT. GIRLS HIGH SCHOOL, BADDOKE CHEEMA (SIALKOT)",
            "162163" =>"AL HIRA GIRLS HIGH SCHOOL PASRUR (SIALKOT)",
            "162165" =>"IBN-E-SENA HIGH SCHOOL FOR GIRLS HARRAR (SIALKOT)",
            "162166" =>"THE NOBLE PUBLIC HIGH SCHOOL (FOR GIRLS) WAZIRABAD ROAD, HARRAR, SIALKOT",
            "162167" =>"FAISAL JUNIOR MODEL SCHOOL SHAHAB PURA, SIALKOT",
            "162168" =>"CIVIL PUBLIC HIGH SCHOOL BHOPALWALA (SIALKOT)",
            "162169" =>"ST. MARY'S HIGH SCHOOL (FOR GIRLS) DASKA ROAD, SAMBRIAL",
            "162170" =>"BRAIN SCHOOL OF SCIENCES DASKA (SIALKOT)",
            "162171" =>"ANGELS SCHOOL SYSTEM MODEL TOWN DASKA (SIALKOT)",
            "162172" =>"THE CITI SCHOOL COLLEGE ROAD, DASKA (SIALKOT)",
            "162173" =>"CLASSIC SCHOOL SYSTEM MODEL TOWN, SIALKOT",
            "162174" =>"QUAID-E-MILLAT PUBLIC HIGH SCHOOL SHAHAH ABAD ESTATE HAJI PURA ROAD, SIALKOT",
            "162176" =>"GOVT. GIRLS HIGH SCHOOL BAKHREWALI (SIALKOT)",
            "162177" =>"RAI EDUCATION SYSTEM FOR GIRLS, SIALKOT.",
            "162178" =>"GOVT. GIRLS HIGH SCHOOL DASKA KALAN (SIALKOT)",
            "162179" =>"GOVT. GIRLS HIGH SCHOOL JASSERWALA (SIALKOT)",
            "162180" =>"THE EDUCATION CITY (GIRLS) SIALKOT ROAD DASKA",
            "162182" =>"DAR-E-ARQAM HIGH SCHOOL BHOPALWALA SIALKOT",
            "162183" =>"AAMIR PUBLIC GIRLS HIGH SCHOOL DHALLEY WALI (SIALKOT)",
            "162184" =>"KASHIF MODEL GIRLS HIGH SCHOOL SHAHAB PURA, SIALKOT.",
            "162185" =>"RAZA-I-MUSTAFA PUBLIC SCHOOL FOR  BHURE KE (SIALKOT)",
            "162188" =>"WATAN IDEAL GIRLS HIGH SCHOOL GOJRA (SIALKOT)",
            "162189" =>"NEW QUAID PUBLIC HIGH SCHOOL FOR GIRLS  SATRAH (SIALKOT)",
            "162190" =>"THE CITY SCHOOL GIRLS CAMPUS SIALKOT",
            "162191" =>"CITY PRIDE PUBLIC SCHOOL FOR GIRLS (SIALKOT)",
            "162192" =>"IDARA-E-HAZRAT MARIAM JAMKE CHEEMA, DISTT SIALKOT",
            "162193" =>"TAKBIR MODLE HIGH SCHOOL AND COLLEGE PHUKLIAN BAJWAT SLK",
            "162194" =>"CONCEPT SCHOOL SYSTEM FOR GIRLS, PARIS ROAD SIALKOT",
            "162195" =>"AL-NOOR EDUCATION SYSTEM (FOR GIRLS) SIALKOT",
            "162196" =>"THE EDUCATORS DASKA PASRUR BY PASS DASKA",
            "162197" =>"THE EDUCATORS HIGH SCHOOL FOR GIRLS CANTONMENT PLAZA SIALKOT",
            "162198" =>"MODEL GIRLS HIGHER SECONDARY SCHOOL MODEL TOWN NO.1 (UGOKI) SIALKOT",
            "162199" =>"FATIMA PUBLIC HIGH SCHOOL FOR GIRLS SULTAN PURA SAMBRIAL SIALKOT",
            "162200" =>"GOVT.GIRLS HIGH SCHOOL NOSHERA KAKEYZIAN TEHSIL PASUR SIALKOT",
            "162201" =>"GOVT.GIRLS HIGH SCHOOL HUSSA JAJJA TEHSIL PASUR SIALKOT",
            "162202" =>"THE OXON SCHOOL FATIMA CAMPUS 09/127 ZAFER ALI SIALKOT CANTT",
            "162203" =>"GOVT. GIRLS HIGH SCHOOL LAPAY WALI TEHSIL PASRUR DISTT. SIALOKT",
            "162204" =>"GOVT.HIGH SCHOOL TAKHET PUR TEHSIL PASRUR",
            "162205" =>"GOVT. GIRLS HIGH SCHOOL LANGAY PASRUR",
            "162206" =>"GOVT. GIRLS HIGH SCHOOL JHARANWALA DISTT. SIALKOT",
            "162207" =>"GOVT. GIRLS HIGH SCHOOL MALO MEHY DISTRICT SIALKOT",
            "162208" =>"GOVT. GIRLS HIGH SCHOOL KOURPUR SIALKOT",
            "162209" =>"GOVT. GIRLS HIGH SCHOOL NAJWAL SIALKOT",
            "162210" =>"GOVT. GIRLS HIGH SCHOOL KAPUR WALI SIALKOT",
            "162211" =>"GOVT. GIRLS HIGH SCHOOL DHANANWALI SIALKOT",
            "162212" =>"IQRA FOUNDATION GIRLS HIGH SCHOOL DASKA",
            "162213" =>"AZAM GIRLS SECONDARY SCHOOL DEFENCE ROAD SIALKOT",
            "162214" =>"ZIA SCIENCE SECONDARY SCHOOL FOR GIRLS WADALA SUNDHWAN SIALKOT",
            "162215" =>"CHRISTIAN CHURCH GIRLS HIGH SCHOOL HUNTERPURA, SIALKOT",
            "162216" =>"THE EDUCATORS SCHOOL (GIRLS) PASRUR",
            "162217" =>"SIALKOT MODEL HIGH SCHOOL (GIRLS) NIKA PURA SIALKOT",
            "162218" =>"LORETTO HOUSE SCHOOL SYSTEM (FOR GIRLS) KHAN MAHAL ROAD SIALKOT",
            "162219" =>"GRAND HEIGHTS GRAMMAR GIRLS HIGH SCHOOL BHOPALWALA SIALKOT",
            "162220" =>"IQBAL GIRLS HIGH SCHOOL BHILO MAHAR DASKA SIALKOT",
            "162221" =>"GOVT. GIRLS HIGH SCHOOL BHAGWAL AWAN SIALKOT",
            "162222" =>"GOVT. .GIRLS HIGH SCHOOL DALLOWALI SIALKOT",
            "162223" =>"GOVT. AISHA GIRLS HIGH SCHOOL PASRUR SIALKOT",
            "162224" =>"GOVT. GIRLS HIGH SCHOOL SEHJOKALA,  SIALKOT",
            "162225" =>"GOVT. GIRLS HIGH SCHOOL KHAN PUR SYEDAN SIALKOT",
            "162226" =>"PUNJAB SCHOOL OF SCIENCES MODEL TOWM DASKA",
            "162227" =>"THE PUNJAB PUBLIC SCHOOL SHATAB GARAH ROAD SIALKOT",
            "162228" =>"SCHOLARS INN GIRLS HIGH SCHOOL CHAWINDA SIALKOT",
            "162229" =>"AT-TAQWA SCIENCE SCHOOL KHAN MEHAL ROAD SIALKOT",
            "162230" =>"GOVT. GIRLS HIGH SCHOOL BALLAN WALA SIALKOT",
            "162231" =>"REHMAN PUBLIC GIRLS HIGH SCHOOL SAUKINWIND (SIALKOT)",
            "162232" =>"EDEN GARDEN GRAMMAR HIGH SCHOOL  MUGHAL PURA SIALKOT",
            "162233" =>"LEARNING ZONE FOR GIRLS IQBAL TOWN DEFENCE ROAD SIALKOT",
            "162234" =>"GOVT. GIRLS HIGH SCHOOL BHOLA MUSA, DISTRICT SIALKOT",
            "162235" =>"GOVT. GIRLS HIGH SCHOOL KAMAL PUR CHISTIAN PASRUR",
            "162237" =>"GOVT. GIRLS HIGH SCHOOL KHANNA, SIALKOT",
            "162238" =>"GOVT. GIRLS HIGH SCHOOL DHIDOWALI, DISTRICT SILAKOT",
            "162239" =>"NATIONAL SECONDARY SCHOOL FOR GIRLS PASRUR ROAD GUNNA KALAN SIALKOT",
            "162240" =>"GOVT. GIRLS HIGH SCHOOL,SEOKEY, DISTRICT SIALKOT",
            "162241" =>"GOVT. GIRLS HIGH SCHOOL, LOONI, SIALKOT",
            "162242" =>"RAZIA INSTITUTE OF SUPERIOR EDUCATION HIGH SCHOOL  FOR GIRLS, KOTLI NOONA, SAMBRIAL, SIALKOT",
            "162244" =>"FAUJI FOUNDATION MODEL SCHOOL FOR GIRLS, MOH. UMEED PURA, PASRUR, SIALKOT",
            "162245" =>"THE CITY PUBLIC SCHOOL FOR GIRLS, REHMAN PURA, PASRUR, SIALKOT",
            "162246" =>"THE PUNJAB SECONDARY SCHOOL FOR GIRLS KAAMAN WALA ROAD BHOTH SIALKOT",
            "162247" =>"BEACON HOUSE SCHOOL SYSTEM FOR GIRLS, SIALKOT",
            "162249" =>"SHAHAB-UD-DIN HIGH SCHOOL FOR GIRLS, LURHIKI BANGLA, DASKA",
            "162250" =>"FATIMA JINNAH GIRLS SECONDARY SCHOOL, KOTLI BHUTTA WAZIRABAD ROAD, SIALKOT",
            "162251" =>"TIMES SCHOOL SYSTEM FOR GIRLS, CHAUDHARY TOWN NEAR HAMZA GHAUS, SIALKOT",
            "162252" =>"LEADS GRAMMAR SCHOOL FOR GIRLS, NEAR ALLAMA IQBAL LIBRARY PARIS ROAD SIALKOT",
            "162253" =>"THE BALANCE SCHOOL FOR GIRAL,95-AZIZ SHAHEED ROAD SIALKOT CANTT.",
            "162254" =>"A TO Z PUBLIC HIGH SCHOOL FOR GIRLS, MOH, SHUJA ABAD,NEKA PURA,SIALKOT",
            "162255" =>"UNIQUE PUBLIC HIGH SCHOOL FOR GIRLS,CHWINDA, PASRUR,SIALKOT",
            "162256" =>"GOVT. GIRLS HIGH SIRANWALI TEH DASKA DISTT SIALKOT",
            "162257" =>"GOVT. GIRLS HIGH SCHOOL PARTANWALI DISTT SIALKOT",
            "162258" =>"GOVT. GIRLS HIGH SCHOOL FATEH GARH DISTRICT SIALKOT",
            "162259" =>"GOVT. GIRLS HIGH SCHOOL, THRO HARIAN TEHSIL PASRUR, SIALKOT",
            "162260" =>"GOVT. GIRLS HIGH SCHOOL, GOPALPUR DISTRICT SIALKOT",
            "162261" =>"GOVT GIRLS HIGH SCHOOL MUNDHAIR KHURD, TEHSIL SAMBRIAL, SAILKOT",
            "162262" =>"THE SKY SCHOOL FOR GIRLS, COMMISSIONER ROAD, SIALKOT",
            "162263" =>"ALLIED SCHOOL, (HUSSNAIN CAMPUS) FOR GIRLS, DASKA ROAD SAMBRIAL DISTT. SIALKOT",
            "162264" =>"ASGHAR IDEAL HIGH SCHOOL FOR GIRLS,CHOWK DHARM KOT, EMINABAD ROAD TEHSIL DASKA, SIALKOT",
            "162265" =>"THE HOPE HIGH SCHOOL FOR GIRLS, PASRUR ROAD NEAR TELEPHONE EXCHANGE,SIALKOT",
            "162266" =>"MILLAT ISLAMIA HIGH SCHOOL FOR GIRLS, DABURJI ARAYAN BEHIND GULSHAN IQBAL PARK,PASRUR ROAD,SIALKOT",
            "162267" =>"ALLIED SCHOOL FATIMA CAMPUS FOR GIRLS, COLLEGE ROAD, DASKA, DISTT. SIALKOT",
            "162268" =>"GOVT. GIRLS HIGH SCHOOL, CHAHAR BAJWA, PASRUR, SIALKOT",
            "162269" =>"GOVT. GIRLS HIGH SCHOOL, WAHID CHOWK, MALKEY KALAN, SIALKOT",
            "162270" =>"GOVT. GIRLS HIGH SCHOOL, BALLANWALA, SIALKOT",
            "162271" =>"GOVT. GIRLS HIGH SCHOOL, KOPRA KHURD, SAMBRIAL, SIALKOT",
            "162272" =>"GOVT. GIRLS HIGH SCHOOL, LANGRIWALI, SIALKOT",
            "162273" =>"GOVT. GIRLS HIGH SCHOOL, MALIPUR, PASRUR, SIALKOT",
            "162274" =>"GOVT. GIRLS HIGH SCHOOL, EMINABAD ROAD, AKBAR CHOWK, DASKA, SIALKOT",
            "162275" =>"GOVT. GIRLS HIGH SCHOOL, WAN TEH. SAMBRIAL, SIALKOT",
            "162276" =>"SUNRISE PUBLIC SCHOOL FOR GIRLS, FARAZ SHAHEED ROAD, JAIRAM PUR, SIALKOT",
            "162277" =>"GOVT. GIRLS HIGH SCHOOL, MUNDAYKE BARIAN, TEH. PASRUR, DISTT. SIALKOT",
            "162278" =>"ALLIED SCHOOL (DOBURJI CAMPUS) FOR GIRLS, CHOWK DOBURJI MALLIAN, DASKA ROAD, SIALKOT",
            "162279" =>"COMMUNITY GIRLS HIGH SCHOOL, DHADO BASRA, DASKA, SIALKOT",
            "162280" =>"DECENT KIDS GIRLS HIGH SCHOOL, FAISAL COLONY, PASRUR, SIALKOT",
            "162281" =>"WORKERS WELFARE SCHOOL (GIRLS), CHAWINDA, PASRUR, SIALKOT",
            "162282" =>"THE KNOWLEDGE HIGH SCHOOL FOR GIRLS, 1-KM DASKA ROAD, PASRUR, SIALKOT",
            "162283" =>"ALLAMA IQBAL SCHOOL FOR SPECIAL EDUCATION (GIRLS), MASJID ROAD, SIALKOT CANTT",
            "162284" =>"SUBHAN FOUNDATION HIGH SCHOOL FOR GIRLS, HEAD MARALA ROAD, SHERPUR, SIALKOT",
            "162285" =>"MARCHING BELL SCHOOL SYSTEM FOR GIRLS, RASOOL PUR BHALIAN, SIALKOT",
            "162286" =>"ISLAMIC EDUCATIONAL FOUNDATION SCHOOL FOR GIRLS, DEFENCE ROAD, FATEH GARH, SIALKOT",
            "162287" =>"HASSAN SCHOLARS PUBLIC SCHOOL FOR GIRLS, MISYAL ROAD, KINGRA, PASRUR, SIALKOT",
            "162288" =>"SIALKOT GRAMMAR GIRLS HIGH SCHOOL, AIRPORT ROAD, LOPOWALI, SAMBRIAL, SIALKOT",
            "162289" =>"SIALKOT GRAMMAR GIRLS HIGH SCHOOL, ALLAMA IQBAL TOWN, DEFENCE ROAD, SIALKOT",
            "162290" =>"FAZAL SARDAR PUBLIC HIGH SCHOOL FOR GIRLS, KINGRA ROAD KOTLI LALA, PASRUR, SIALKOT",
            "162291" =>"ALLIED SCHOOL ABDUL HAMEED CAMPUS FOR GIRLS, MODEL TOWN, UGOKI, SIALKOT",
            "162292" =>"SUPERIOR SCIENCE SCHOOL FOR GIRLS, BHAROKEY KALAN P/O MUSAY WALA, DASKA, SIALKOT",
            "162293" =>"GOVT. GIRLS HIGH SCHOOL, MUSA PUR, PASRUR, SIALKOT",
            "162294" =>"ALLIED SCHOOL FOR GIRLS DASKA SIALKOT ROAD MOTRA CAMPUS, MOTRA, DASKA ROAD, SIALKOT",
            "162295" =>"PUNJAB SCHOOL FOR GIRLS, BHOBHANGI, DASKA, SIALKOT",
            "162296" =>"SULTAN SCHOOL SYSTEM FOR GIRLS, CHAPRAR ROAD, KAMANWALA, SIALKOT",
            "162297" =>"EDUCATIONAL SCHOOL SYSTEM FOR GIRLS, QILA KALAR WALA, PASRUR, SIALKOT",
            "162298" =>"THE KNOWLEDGE SCHOOL FOR GIRLS, KLASSWALA, PASUR, SIALKOT",
            "162299" =>"ROYAL INTERNATIONAL GRAMMAR HIGH SCHOOL FOR GIRLS, KANDAN SIAN, DASKA, SIALKOT",
            "162300" =>"BAB-UL-ILM SCHOOL FOR GIRLS, MITRANWALI, DASKA, SIALKOT",
            "162301" =>"HIGH AIMS SECONDARY SCHOOL FOR GIRLS, THRO MANDI, PASRUR, SIALKOT",
            "162302" =>"ALLIED SCHOOL OURA CAMPUS FOR GIRLS, OURA CHOWK, KINGRA ROAD, LANGRIALI, SIALKOT",
            "162303" =>"GOVT. GIRLS HIGH SCHOOL, RAM ARIAN KHURD, P/O TALHARA TEHSIL DASKA, SIALKOT",
            "162304" =>"GOVT. GIRLS HIGH SCHOOL, DOGRI HARRIAN, ZAFARWAL CHAWINDA ROAD TEHSIL PASRUR, SIALKOT",
            "162305" =>"NATIONAL GRAMMAR SCHOOL FOR GIRLS, MARALA ROAD, MURAD PUR, SIALKOT",
            "162306" =>"GOVT. GIRLS HIGH SCHOOL, KANPUR, SIALKOT",
            "162307" =>"GOVT. GIRLS HIGH SCHOOL, MIANI, SIALKOT",
            "162308" =>"GOVT. GIRLS HIGH SCHOOL, ZAHOORA, SIALKOT",
            "162309" =>"GOVT. GIRLS HIGH SCHOOL, PINDI PANJORAN, SIALKOT",
            "162310" =>"AL-NOOR GRAMMAR SCHOOL FOR GIRLS, SAIDPUR GONDAL ROAD, BHARTH, SIALKOT",
            "162311" =>"ISLAM INTERNATIONAL SCHOOL FOR GIRLS, DASKA ROAD, SIALKOT",
            "162312" =>"IQRA EDUCATION SYSTEM FOR GIRLS IQRA CAMPUS, NEAR CHEEMA CANAL BRIDGE, DASKA, SIALKOT",
            "162313" =>"GOVT. GIRLS HIGH SCHOOL, KUNDAN PUR, SIALKOT",
            "162314" =>"THE SMART SCHOOL FOR GIRLS SAMBRIAL CAMPUS, WADDA BAGH, WAZIRABAD ROAD, SAMBRIAL, SIALKOT",
            "162315" =>"LEARNING KINGDOM SCHOOL SYSTEM FOR GIRLS, MANDRANWALA TEHSIL DASKA, SIALKOT",
            "162316" =>"ALLIED SCHOOL SHAYAN CAMPUS FOR GIRLS, GHUINKE TEHSIL DASKA, SIALKOT",
            "162317" =>"HASSNAIN IDEAL GIRLS HIGH SCHOOL, KOTLI SAID AMIR P/O ZAHOORA, SIALKOT",
            "162318" =>"ALLIED SCHOOL FOR GIRLS SAMBRIAL CAMPUS, WAZIRABAD/UNIVERSITY ROAD, SAMBRIAL, SIALKOT",
            "162319" =>"THE SMART SCHOOL FOR GIRLS (CANTT CAMPUS), KALMA CHOWK, SAIDPUR GONDAL ROAD, SIALKOT",
            "162320" =>"COMPREHENSIVE PUNJAB SECONDARY SCHOOL FOR GIRLS, MURRAY COLLEGE ROAD, SIALKOT",
            "162321" =>"SIALKOT GRAMMAR GIRLS HIGH SCHOOL, COLLEGE ROAD, DASKA, SIALKOT",
            "162322" =>"GOVT. GIRLS HIGH SCHOOL, DHEERA SANDHA, SIALKOT",
            "162323" =>"GOVT. GIRLS HIGH SCHOOL, KAMANWALA, SIALKOT",
            "162324" =>"GOVT. GIRLS HIGH SCHOOL, GUJRANWALI, SIALKOT",
            "162325" =>"GOVT. GIRLS HIGH SCHOOL, CHOHAN TEHSIL PASRUR, SIAKOT",
            "162326" =>"GOVT. GIRLS HIGH SCHOOL, OTHIAN TEHSIL DASKA, SIALKOT",
            "162327" =>"GOVT. GIRLS HIGH SCHOOL, KOREKEY TEHSIL DASKA, SIALKOT",
            "162328" =>"GOVT. GIRLS HIGH SCHOOL, TALWARA MUGHLAN, SIALKOT",
            "162329" =>"GOVT. GIRLS HIGH SCHOOL, DOBURJI CHANDA SINGH TEHSIL SAMBRIAL, SIALKOT",
            "162330" =>"GOVT. GIRLS HIGH SCHOOL, PIPLIWALA TEHSIL SAMBRIAL, SIALKOT",
            "162331" =>"GOVT. GIRLS HIGH SCHOOL, RAWAL (SIALKOT)",
            "162332" =>"GOVT. GIRLS HIGH SCHOOL, TALHARA TEHSIL DASKA, SIALKOT",
            "162503" =>"CUMMUNITY MODEL GIRLS HIGH SCHOOL PADALI TEHSIL DASKA (SIALKOT)",
            "162516" =>"COMMUNITY MODEL GIRLS HIGH SCHOOL UDDOWAR, TEH. DASKA (SIALKOT)",
            "162519" =>"ALLIED SCHOOL (GIRLS CAMPUS), SAID PUR GONDAL ROAD, SIALKOT",
            "162520" =>"GOVT. GIRLS HIGH SCHOOL GODHA DISTRICT SIALKOT",
            "162521" =>"GOVT. GIRLS HIGH SCHOOL DHODA PASRUR SIALKOT",
            "162522" =>"GOVT. GIRLS HIGH SCHOOL SAYYAN DISTRICT SIALKOT",
            "162523" =>"GOVT. GIRLS HIGH SCHOOL MAJRA KALAN SIALKOT",
            "162524" =>"GOVT. GIRLS HIGH SCHOOL DEGREE KALAN DASKA SIALKOT",
            "162525" =>"LAHORE GRAMMAR SCHOOL FOR GIRLS, KALMA CHOWK, SAID PUR ROAD, SIALKOT",
            "311025" =>"WORKERS WELFARE HIGHER SECONDARY SCHOOL FOR BOYS PEOPLES COLONY, GUJRAWALA",
            "311035" =>"GOVT. HIGHER SECONDARY SCHOOL GAKKHAR DISTRICT GUJRANWALA",
            "311042" =>"GOVT. HIGHER SECONDARY SCHOOL (BOYS) EMINABAD GUJRANWALA",
            "311044" =>"MILLAT IDEAL HIGHER SECONDARY SCHOOL (FOR BOYS)  HAFIZABAD ROAD GUJRANWALA",
            "311053" =>"GOVT. HIGHER SECONDARY SCHOOL MANDIALA TEGA (GUJRANWALA)",
            "311083" =>"GOVT. HIGHER SECONDARY SCHOOL WAHNDO (GUJRANWALA)",
            "311091" =>"GOVT. HIGHER SECONDARY SCHOOL G. T. ROAD GUJRANWALA",
            "311104" =>"K. T. MODEL HIGHER SECONDARY SCHOOL, GUJRANWALA",
            "311131" =>"SHAH WALI ULLAH HIGHER SECONDARY SCHOOL, ATAWA (GUJRANWALA)",
            "311145" =>"MASHRAQ SCIENCE HIGHER SECONDARY SCHOOL MUHAFIZ TOWN, GUJRANWALA",
            "311188" =>"AL-KABIR UNIVERSAL HIGHER SECONDARY SCHOOL, DELTA ROAD, GRW",
            "311193" =>"THE PUNJAB HIGHER SECONDARY SCHOOL KHIALI SHAH PUR GUJRANWALA",
            "311242" =>"PAKISTAN MODEL HIGHER SECONDARY SCHOOL FOR BOYS  SCHOOL ROAD FEROZEWALA",
            "311260" =>"HAIDER MEORIAL HIGHER SECONDARY SCHOOL FOR BOYS, SAROKI CHEEMA, WAZIRABAD, GUJRANWALA.",
            "311261" =>"GOVT HIGHER SECONDARY SCHOOL, GAKHAR, DISTRICT GURJRANWALA,",
            "311262" =>"GOVT HIGHER SECONDARY SCHOOL FOR BOYS, AHMED NAGAR TEHSIL WAZIRABAD, GUJRANWALA",
            "311264" =>"COMMUNITY MODEL HIGHER SECONDARY FOR BOYS,QILA DIDAR SINGH,GUJRANWALA",
            "311296" =>"GOVT. HIGHER SECONDARY SCHOOL, LADHEWALA WARRAICH, GUJRANWALA",
            "311297" =>"WAPDA TOWN HIGHER SECONDARY SCHOOL FOR BOYS, WAPDA TOWN, GUJRANWALA",
            "311298" =>"GOVT. HIGHER SECONDARY SCHOOL, TATLAY AALI TEHSIL NOWSHERA VIRKAN, GUJRANWALA",
            "311299" =>"GOVT. HIGHER SECONDARY SCHOOL FOR BOYS, NOKHAR TEHSIL NOWSHERA VIRKAN, GUJRANWALA",
            "312001" =>"GOVT. GIRLS HIGHER SECONDARY SCHOOL AHMAD NAGAR (GUJRANWALA)",
            "312010" =>"GOVT. GIRLS HIGHER SECONDARY SCHOOL EMINABAD (GUJRANWALA)",
            "312012" =>"GOVT. GIRLS HIGHER SECONDARY SCHOOL GAKHAR (GUJRANWALA)",
            "312017" =>"QUAID-E-AZAM DIVISIONAL PUBLIC HIGHER SECONDARY SCHOOL FOR GIRLS, GUJRANWALA",
            "312042" =>"GOVT. GIRLS HIGHER SECONDARY SCHOOL RASUL NAGAR (GUJRANWALA)",
            "312048" =>"HIJAB PUBLIC HIGHER SECONDARY SCHOOL (FOR GIRLS) KALASKE, DISTT. GUJRANWALA",
            "312060" =>"GOVT. GIRLS HIGHER SECONDARY SCHOOL NO.1 GUJRANWALA",
            "312070" =>"JAMIA TUL BANAT HIGHER SECONDARY SCHOOL MODEL TOWN, GUJRANWALA",
            "312086" =>"WORKERS WELFARE HIGHER SECONDARY SCHOOL FOR GIRLS PEOPLES COLONY GUJRANWALA",
            "312093" =>"MASHRIQ SCIENCE HIGHER SECONDARY SCHOOL FOR GIRLS, KANGNIWALA, G.T ROAD, GUJRANWALA",
            "312109" =>"MILLAT IDEAL HIGHER SECONDARY SCHOOL (FOR GIRLS) HAFIZABAD ROAD GUJRANWALA",
            "312122" =>"AL-REHMAN IDEAL HIGHER SECONDARY SCHOOL, 15-FAISALABAD, GUJRANWALA",
            "312128" =>"JAMIA-TUL-BANAT HIGHER SECONDARY SCHOOL MAAN DISTT. GUJRANWALA",
            "312191" =>"AL-SYED GIRLS HIGHER SECONDARY SCHOOL TATLAY AALI (GRW)",
            "312192" =>"BRIGHT FUTURE HIGHER SECONDARY SCHOOL FOR GIRLS, TATLEY AALI, NOWSHEHRA ROAD, GUJRANWALA",
            "312193" =>"SIR SYED PILOT HIGHER SECONDARY SCHOOL FOR GIRLS,WAZIRABAD GUJRANWALA",
            "312195" =>"GOVT.GIRLS HIGHER SECONDARY SCHOOL, AROOP, GUJRANWALA",
            "312196" =>"WAPDA TOWN HIGHER SECONDARY SCHOOL FOR GIRLS, WAPDA TOWN, GUJRANWALA",
            "312324" =>"PAKISTAN MODEL HIGHER SECONDAY SCHOOL FOR GIRLS, SAROKI CHEEMA, GUJRANWALA",
            "312325" =>"COMMUNITY MODEL GIRLS HIGHER SECONDARY SCHOOL, NOKHAR, NOWSHEHRA VIRKAN, GUJRANWALA",
            "312326" =>"GOVT. GIRLS HIGHER SECONDARY SCHOOL, TATLAY AALI, NOWSHEHRA VIRKAN, GUJRANWALA",
            "312328" =>"CHRISTIAN HIGHER SECONDARY SCHOOL FOR GIRLS, CIVIL LINES, CHURCH ROAD, GUJRANWALA",
            "312329" =>"COMMUNITY MODEL HIGHER SECONDARY SCHOOL FOR GIRLS, KALASKE, GUJRANWALA",
            "312539" =>"COMMUNITY MODEL GIRLS HIGHER SECONDARY SCHOOL WAYIANWALI (GUJRANWALA)",
            "312540" =>"GOVT. C. M. GIRLS HIGHER SECONDARY SCHOOL DERA SHAH JAMAL (GUJRANWALA)",
            "315090" =>"GOVT. HIGHER SECONDARY SCHOOL, RAMBRI",
            "321015" =>"GOVT. HIGHER SECONDARY SCHOOL BAGRIAN WALA (GUJRAT)",
            "321034" =>"GOVT. HIGHER SECONDARY SCHOOL DINGA (GUJRAT)",
            "321043" =>"GOVT. HIGHER SECONDARY SCHOOL, GULIANA  TEH. KHARIAN DISTT. GUJRAT",
            "321079" =>"GOVT. PUBLIC HIGHER SECONDARY SCHOOL KUNJAH (GUJRAT)",
            "321126" =>"GOVT. HIGHER SECONDARY SCHOOL TANDA (GUJRAT)",
            "321134" =>"GOVT. HIGHER SECONDARY SCHOOL, THILL (GUJRAT)",
            "321136" =>"GOVT. HIGHER SECONDARY SCHOOL KHOHAR (GUJRAT)",
            "321157" =>"GOVT. HIGHER SECONDARY SCHOOL FOR BOYS, KOTLA ARAB ALI  KHAN (GUJRAT)",
            "321159" =>"CITY PUBLIC HIGHER SECONDARY SCHOOL LALAMUSA (GUJRAT)",
            "321175" =>"GHAZALI PUBLIC HIGHER SECONDARY SCHOOL (FOR BOYS) SADKAL KHARIAN (GUJRAT)",
            "321182" =>"EDUCATION HOUSE HIGHER SECONDARY SCHOOL, DAULAT NAGAR (GUJRAT)",
            "321189" =>"KINZA HIGHER SECONDARY SCHOOL (BOYS) LALAMUSA (GUJRAT)",
            "321198" =>"ZIA PUBLIC HIGHER SECONDARY SCHOOL DAULAT NAGAR",
            "321199" =>"MADER-E-MILLAT FATIMA JINNAH BOYS HIGHER SECONDARY SCHOOL KOTLA ARAB ALI KHAN (GUJRAT)",
            "321212" =>"SAYAM BOYS HIGHER SECONDARY SCHOOL JALAPUR SOBATIAN (GUJRAT)",
            "321213" =>"GOVT. HIGHER SECONDARY SCHOOL FOR BOYS KATHALA CHENAB GUJRAT",
            "321214" =>"PAKISTAN OVERSEAS HIGHER SECONDARY SCHOOL MANDEER, DINGA ROAD KHARIAN GUJRAT",
            "321215" =>"GOVT. HIGHER SECONDARY SCHOOL, DANDI NIZAM, SARAI ALAMGIR, GUJRAT",
            "321216" =>"INTERNATIONAL MODEL HIGHER SECONDARY SCHOOL FOR BOYS, UDA P/O SIDH TEHSIL KHARIAN, GUJRAT",
            "322006" =>"GOVT. GIRLS HIGHER SECONDARY SCHOOL KOTLA ARAB ALI KHAN (GUJRAT)",
            "322011" =>"GOVT. GIRLS HIGHER SECONDARY SCHOOL, SARAI ALAMGIR (GUJRAT)",
            "322024" =>"SHAUKAT GIRLS  HIGH SCHOOL NO 1, OUT SIDE  SHAH FAISAL GATE, GUJRAT",
            "322027" =>"GOVT. GIRLS HIGHER SECONDARY SCHOOL, KARIANWALA (GUJRAT)",
            "322037" =>"GHAZALI GIRLS HIGHER SECONDARY SCHOOL, SADKAL (DISTT. GUJRAT)",
            "322038" =>"LAURAL HOME HIGHER SECONDARY SCHOOL FOR GIRLS G.T. ROAD GUJRAT",
            "322039" =>"SIR SYED GIRLS HIGHER SECONDARY SCHOOL, SHAH HUSSAIN ROAD, GUJRAT",
            "322042" =>"GOVT. GIRLS HIGHER SECONDARY SCHOOL KHOHAR (GUJRAT)",
            "322046" =>"GOVT. GIRLS HIGHER SECONDARY SCHOOL, GOLEKI (GUJRAT)",
            "322047" =>"GOVT. GIRLS HIGHER SECONDARY SCHOOL NINDOWAL (GUJRAT)",
            "322049" =>"GOVT. GIRLS HIGHER SEC. SCHOOL THUTHA RAI BAHADUR (GUJRAT)",
            "322050" =>"GOVT. GIRLS HIGHER SECONDARY SCHOOL KHARIAN (GUJRAT)",
            "322060" =>"GIRLS COMMUNITY MODEL HIGHER SECONDARY SCHOOL, JEWRANWALI (GUJRAT)",
            "322074" =>"COMMUNITY MODEL GIRLS HIGHER SECONDARY SCHOOL BEGA (GUJRAT)",
            "322075" =>"GOVT. GIRLS MODEL HIGHER SECONDARY SCHOOL (GUJRAT)",
            "322082" =>"GOVT. GIRLS HIGHER SECONDARY SCHOOL SARAI ALAMGIR (GUJRAT)",
            "322093" =>"PUNJAB PUBLIC GIRLS HIGHER SECONDARY SCHOOL KALRA KALAN, GUJRAT",
            "322095" =>"JAMIA GHOSIA NAEEMIA HIGHER SECONDARY SCHOOL FOR GIRLS, GUJRAT",
            "322110" =>"C.B.A. MODEL HIGHER SECONDARY SCHOOL GIRLS, JANDALA (GUJRAT)",
            "322113" =>"PAKISTAN QUALITY PUBLIC HIGHER SECONDARY SCHOOL GIRLS DINGA (GUJRAT)",
            "322115" =>"GOVT. GIRLS HIGHER SECONDARY SCHOOL, NINDOWAL (GUJRAT)",
            "322135" =>"MADAR-E-MILLAT FATIMA JINNAH GIRLS HIGHER SECONDARY SCHOOL, KOTLA ARAB ALI KHAN (GUJRAT)",
            "322136" =>"KINZA HIGHER SECONDARY SCHOOL (GIRLS), LALAMUSA (GUJRAT)",
            "322173" =>"GOVT. GIRLS HIGHER SECONDARY SCHOOL, GULYANA KHARIAN (GUJRAT)",
            "322184" =>"SARDAR MEMORIAL (GIRLS) HIGHER SECONDARY EDUCATIONAL INSTITUTE DANDI TEH. SARAI ALAMGIR",
            "322201" =>"EDUCATION HOUSE HIGHER SECONDARY SCHOOL DAULAT NAGAR (GUJRAT)",
            "322206" =>"SYEDA AMINA GIRLS HIGHER SECONDARY SCHOOL DARBAR-E-ALIA  DHODA SHARIF DISTRICT GUJRAT",
            "322216" =>"NEW NAVEED-E-SAHAR HIGHER SECONDARY SCHOOL FOR GIRLS, ISLAMIA HIGH SCHOOL ROAD, NEAR BARKAT PARK, LALA MUSA",
            "322217" =>"SARDAR MEMORIAL GIRLS HIGHER SECONDARY EDUCATIONAL INSTITUTE, DANDI NIZAM TEHSIL SARAI ALAMGIR, GUJRAT",
            "322218" =>"THE CAMBRIDGE HIGHER SECONDARY SCHOOL FOR GIRLS, G.T ROAD, LALAMUSA, GUJRAT",
            "322219" =>"OFFICER HIGHER SECONDARY SCHOOL FOR GIRLS, MAIN ROAD, SHADIWAL, GUJRAT",
            "322506" =>"COMMUNITY MODEL GIRLS HIGHER SECONDARY SCHOOL, BEHLPUR (GUJRAT)",
            "322523" =>"GOVT GIRLS HIGHER SECONDARY SCHOOL, SARIYA, KHARIAN, GUJRAT",
            "322524" =>"GOVT GIRLS HIGHER SECONDARY SCHOOL, DEONA, GUJRAT",
            "322525" =>"GOVT. GIRLS HIGHER SECONDARY SCHOOL KATHALA CHENAB GUJRAT",
            "322526" =>"GOVT. GIRLS HIGHER SECONDARY SCHOOL, SOHAL KHURD, GUJRAT",
            "322527" =>"GOVT. GIRLS HIGHER SECONDARY SCHOOL, SOHAL KHURD, GUJRAT",
            "331013" =>"GOVT. HIGHER SECONDARY SCHOOL, KOLO TARAR DISTRICT, HAFIZABAD",
            "331015" =>"GOVT. HIGHER SECONDARY SCHOOL KALEKE MANDI (HAFIZABAD)",
            "331018" =>"GOVT HIGHER SECONDARY SCHOOL VANIKE TARAR HAFIZABAD",
            "331027" =>"GOVT. SECONDARY SCHOOL QADIR ABAD COLONY (HAFIZABAD)",
            "331031" =>"GOVT. RASHID MINHAS HIGHER SECONDARY SCHOOL, SUKHEKE MANDI (HAFIZABAD)",
            "331037" =>"GOVT. HIGHER SECONDARY SCHOOL VANIKE TARAR (HAFIZABAD)",
            "331038" =>"GOVT. PUBLIC HIGHER SECONDARY SCHOOL  JALAL PUR BHATTAIN (HAFIZABAD)",
            "331039" =>"GOVT HIGHER SECONDARY SCHOOL FOR BOYS, KASSOKE TEHSIL & DISTRICT HAFIZABAD",
            "331040" =>"GOVT. PUBLIC HIGHER SECONDARY SCHOOL JALAL PUR BHATTIAN, HAFIZABAD",
            "331041" =>"GOVT. MODEL HIGHER SECONDARY SCHOOL, NEAR BUS STOP, HAFIZABAD",
            "332001" =>"GOVT. GIRLS HIGHER SECONDARY SCHOOL, PINDI BHATTIAN (HAFIZABAD)",
            "332004" =>"GOVT. GIRLS HIGHER SECONDARY SCHOOL, KOLO TARAR (HAFIZABAD)",
            "332005" =>"GOVT. GIRLS HIGHER SECONDARY SCHOOL KALEKE MANDI (HAFIZABAD)",
            "332008" =>"GOVT. GIRLS HIGHER SECONDARY SCHOOL PINDI BHATTIAN (HAFIZABAD)",
            "332010" =>"GOVT. GIRLS HIGHER SECONDARY SCHOOL, SUKHEKE MANDI (HAFIZABAD)",
            "332011" =>"GOVT. GIRLS HIGHER SECONDARY SCHOOL VANIKE TARAR (HAFIZABAD)",
            "332012" =>"GOVT. GIRLS HIGHER SECONDARY SCHOOL NO.1 (CENTERS OF EXCELLENCE), MOH. USMAN GUNJ, ST. NO.",
            "332502" =>"GOVT GIRLS HIGER SECONDARY SCHOOL SOOIANWALA, HAFIZABAD",
            "341004" =>"GOVT. HIGHER SECONDARY SCHOOL,  BOSAL (MANDI BAHA-UD-DIN)",
            "341005" =>"GOVT. HIGHER SECONDARY SCHOOL BHIKHI SHARIF (MANDI BAHA-UD-DIN)",
            "341018" =>"GOVT. HIGHER SECONDARY SCHOOL DHOK KASIB (MANDI BAHA-UD-DIN)",
            "341029" =>"GOVT. HIGHER SECONDARY SCHOOL, KHEWA (MANDI BAHA-UD-DIN)",
            "341042" =>"GOVT. HIGHER SECONDARY SCHOOL MAKHNANWALI (MANDI BAHA-UD-DIN)",
            "341056" =>"GOVT. HIGHER SECONDARY SCHOOL, QADIRABAD (MANDI BAHA-UD-DIN)",
            "341057" =>"GOVT. MAJOR QAISER MEHMOOD SAHI SHAHEED HIGHER SECONDARY SCHOOOL FOR BOYS, DHOK KASIB, MAN",
            "341058" =>"DISTRICT JINNAH PUBLIC HIGHER SECONDARY SCHOOL FOR BOYS,NEAR NEW DISTRICT COMPLEX, MURALA ",
            "341059" =>"FARABI HIGHER SECONDARY SCHOOL FOR BOYS, FARABI CHOWK, PHALIA, MANDI BAHAUDDIN",
            "341503" =>"GOVT HIGHER SECONDARY SCHOOL, SOHAWA BOLANI M B.DIN",
            "342005" =>"GOVT. GIRLS HIGHER SECONDARY SCHOOL MALAKWAL (MANDI BAHA-UD-DIN)",
            "342010" =>"GOVT. GIRLS HIGHER SECONDARY SCHOOL MONG (MANDI BAHA-UD-DIN)",
            "342038" =>"THE CHENAB HIGHER SECONDARY SCHOOL JOKALIAN (MANDI BAHAUDDIN)",
            "342041" =>"BISMILLAH MUHAMMAD HUSSAIN ZAMINDAR HIGHER SECONDARY SCHOOL, LASURI KALAN  (MANDI BAHAUDDIN)",
            "342047" =>"GOVT. GIRLS HIGHER SECONDARY SCHOOL NAI ABADI RASUL (M.B. DIN)",
            "342073" =>"GOVT. GIRLS HIGHER SECONDARY SCHOOL MIANWAL RANJHA (M.B.DIN)",
            "342074" =>"GOVT. GIRLS HIGHER SECONDARY SCHOOL HELAN (DISTT.M.B.DIN)",
            "342075" =>"NEW CHENAB HIGHER SECONDARY SCHOOL FOR GIRLS, JOKALIAN, PHALIA, MANDI BAHA UD DIN",
            "342076" =>"THE MOTIVATORS HIGHER SECONDARY SCHOOL FOR GIRLS, MAKAY WAL, MANDI BAHAUDDIN",
            "342077" =>"DISTRICT JINNAH PUBLIC HIGHER SECONDARY SCHOOL FOR GIRLS, NEAR NEW DISTRICT COMPLEX MURALA",
            "342078" =>"MUSTAFAI SCIENCE MODEL HIGHER SECONDARY SCHOOL FOR GIRLS. ADDA PAHRIANWALA PHALIA, M.B.DIN",
            "342079" =>"FARABI HIGHER SECONDARY SCHOOL FOR GIRLS, FARABI CHOWK, PHALIA, MANDI BAHAUDDIN",
            "342528" =>"GOVT GIRLS HIGHER SECONDARY SCHOOL, MIANA GONDAL, M.B.DIN",
            "351012" =>"NAROWAL PUBLIC HIGHER SECONDARY SCHOOL NAROWAL",
            "351013" =>"OXFORD HIGHER SECONDARY SCHOLL FOR BOYS SHAKRGARH NAROWAL",
            "351031" =>"GOVT. HIGHER SECONDARY SCHOOL, KOT NAINAN (NAROWAL)",
            "351035" =>"GOVT. G.D. ISLAMIA HIGHER SECONDARY SCHOOL MAINGRI (NAROWAL)",
            "351070" =>"BUBAK HIGHER SECONDARY SCHOOL EID-GAH ROAD NAROWAL",
            "351077" =>"GOVT. HIGHER SECONDARY SCHOOL BUA. NAROWAL",
            "351086" =>"UNIQUE BOYS HIGHER SECONDARY SCHOOL SHAKARGARH (NAROWAL)",
            "351089" =>"GOVT. HIGHER SECONDARY SCHOOL MADDU KAHLWAN FOR BOYS NAROWAL",
            "351090" =>"THE INNOVATORS HIGHER SECONDARY SCHOOL FOR BOYS  MARDOWAL ,SHAKARGARH NAROWAL",
            "351093" =>"THE EDUCATORS HIGHER SECONDARY SCHOOL FOR BOYS, MOTAY ROAD, SHAKARGARH, NAROWAL",
            "351095" =>"GOVT. HIGHER SECONDARY SCHOOL FOR BOYS BUA, SHAKARGARH, NAROWAL",
            "351096" =>"INTERNATIONAL ISLAMIC UNIVERSITY ISLAMABAD HIGHER SECONDARY SCHOOL, CHAMAN CHANDOWAL ROAD, NAROWAL",
            "351097" =>"GOVT. HIGHER SECONDARY SCHOOL HALLOWAL TEH & DISTT NAROWAL",
            "351098" =>"GOVT HIGHER SECONDARY SCHOOL FOR BOYS, RAYYA KHAS, NAROWAL",
            "351099" =>"GOVT, ISLAM HIGHER SECONDARY SCHOOL, KANJRUR, NAROWAL",
            "351100" =>"GHAZALI MODEL HIGHER SECONDARY SCHOOL FOR BOYS, NOORKOT ROAD,SHAKAR GARH DISTRICT NAROWAL",
            "351101" =>"GOVT. HIGHER SECONDARY SCHOOL, RAMBRI, NAROWAL",
            "351102" =>"NEW UNIQUE HIGHER SECONDARY SCHOOL FOR BOYS, NAROWAL ROAD, ZAFARWAL, NAROWAL",
            "351502" =>"GOVT HIGHER SECONDARY SCHOOL GHOTTA FATEH GARH, NAROWAL",
            "351503" =>"GOVT. MUSLIM MODEL HIGHER SECONDARY SCHOOL, KOTLA AFGHANA, P/O KNAJRUR, SHAKARGARH, NAROWAL",
            "351504" =>"GOVT HIGHER SECONDARY SCHOOL, JABBAL, ZAFARWAL, NAROWAL",
            "351505" =>"GOVT MUSLIM MODEL HIGHER SECONDARY SCHOOL, KOTLA  AFGHANA, P/O KANJRUR, SHAKARGARH, NAROWAL",
            "352006" =>"GOVT. GIRLS HIGHER SECONDARY SCHOOL, QILA AHMAD ABAD (NAROWAL)",
            "352007" =>"LASANI IDEAL GIRLS HIGHER SECONDARY SCHOOL SHAKARGARH",
            "352012" =>"NAROWAL PUBLIC HIGHER SECONDARY SCHOOL FOR GIRLS NAROWAL",
            "352038" =>"ISLAMIA GIRLS HIGHER SECONDARY SCHOOL NOOR KOT ROAD, SHAKARGARH (NAROWAL)",
            "352048" =>"OXFORD GIRLS MODEL HIGHER SECONDARY SCHOOL, SHAKARGARH (NAROWAL)",
            "352052" =>"UNIQUE GIRLS HIGHER SECONDARY SCHOOL SHAKARGARH",
            "352070" =>"THE INNOVATORS HIGHER SECONDARY SCHOOL FOR GIRLS SHAKARGARH NAROWAL",
            "352071" =>"MUSLIM MODEL HIGHER SECONDARY SCHOOL FOR GILRS, EID GAH ROAD, ZAFARWAL NAROWAL",
            "352072" =>"THE ZAFARWAL PUBLIC HIGHER SECONDARY SCHOOL FOR GIRLS, MOHALLA NANGALI GATE PURANA CHAWINDA ROAD ZAF",
            "352073" =>"GHAZALI MODEL HIGHER SECONDARY SCHOOL FOR GIRSL, NOORKOT ROAD, SHAKAR GARH DISTRICT NAROWAL",
            "352074" =>"THE LEADERSHIP HIGHER SECONARY SCHOOL FOR GIRLS, NAROWAL ROAD, ZAFARWAL, NAROWAL",
            "352075" =>"GOVT. GIRLS HIGHER SECONDARY SCHOOL, JABBAL TEHSIL ZAFARWAL, NAROWAL",
            "352076" =>"THE EDUCATORS HIGHER SECONDARY SCHOOL FOR GIRLS, NOOR KOT ROAD, SHAKARGARH, NAROWAL",
            "352077" =>"IDEAL PUBLIC HIGHER SECONDARY SCHOOL FOR GIRLS, MELLU SELLU TEHSIL SHAKARGARH, NAROWAL",
            "352078" =>"NEW UNIQUE HIGHER SECONDARY SCHOOL FOR GIRLS, NAROWAL ROAD, ZAFARWAL, NAROWAL",
            "352079" =>"SUPERIOR EDUCATION SYSTEM FOR GIRLS HIGHER SECONDARY SCHOOL, NONAR TEHSIL ZAFARWAL, NAROWA",
            "352501" =>"COMMUNITY GIRLS HIGHER SECONDARY SCHOOL, AIMA QAGZIAN (NAROWAL)",
            "352502" =>"GOVT. COMMUNITY MODEL GIRLS HIGHER SECONDARY SCHOOL AIMA QAZIAN DISTT. NAROWAL",
            "352503" =>"GOVT. GIRLS HIGHER SECONDARY SCHOOL, KANJRUR, NAROWAL",
            "352504" =>"GOVT. GIRLS HIGHER SECONDARY SCHOOL GHOTA FATEH GARH, NAROWAL",
            "352906" =>"GOVT. GIRLS HIGHER SECONDARY SCHOOL, MARYAL, SHAKARGARH, NAROWAL",
            "361033" =>"GOVT. HIGHER SECONDARY SCHOOL GHUINKE (SIALKOT)",
            "361034" =>"MISALI ZAKARIYA HIGHER SECONDARY SCHOOL DASKA (SIALKOT)",
            "361084" =>"GOVT. HIGHER SECONDARY SCHOOL NO.2, SIALKOT",
            "361091" =>"GOVT. CHRISTIAN HIGHER SECONDARY SCHOOL SIALKOT CANTT.",
            "361101" =>"GOVT. ALLAMA IQBAL MEMORIAL HIGHER SECONDARY SCHOOL, GOHADPUR MURADPUR (SIALKOT)",
            "361120" =>"GOVT. HIGHER SECONDARY SCHOOL, ADAMKE CHEEMA (SIALKOT)",
            "361121" =>"GOVT. HIGHER SECONDARY SCHOOL FOR BOYS, UGGOKI, SIALKOT",
            "361122" =>"GOVT. HIGHER SECONDARY SCHOOL, MERAJKE, PASRUR, SIALKOT",
            "361123" =>"ISLAM INTERNATIONAL HIGHER SECONDRY SCHOOL FOR BOYS, PAKKI KOTLI, DASKA ROAD, SIALKOT",
            "361124" =>"GOVT. PILOT HIGHER SECONDARY SCHOOL (CENTER OF EXCELLENCE), NEAR JINNAH STADIUM, CIRCULAR ",
            "361502" =>"GOVT HIGHER SECONDARY SCHOOL FOR BOYS, KOTLI LOHARAN, SIALKOT",
            "362003" =>"GOVT. GIRLS HIGHER SECONDARY SCHOOL BADIANA (SIALKOT)",
            "362004" =>"LADY ANDERSON GOVT. GIRLS HIGHER SECONDARY SCHOOL, SIALKOT CITY",
            "362005" =>"GOVT. GIRLS HIGHER SECONDARY SCHOOL, MODEL TOWN, SIALKOT",
            "362009" =>"GOVT. GIRLS HIGHER SECONDARY SCHOOL, CHAWINDA (SIALKOT)",
            "362012" =>"GOVT. GIRLS HIGHER SECONDARY SCHOOL CHAWINDA (SIALKOT)",
            "362013" =>"GOVT. GIRLS HIGHER SECONDARY SCHOOL BADIANA (SIALKOT)",
            "362014" =>"GOVT. GIRLS HIGHER SECONDARY SCHOOL, DHAROWAL (SIALKOT)",
            "362015" =>"ALLAMA IQBAL GIRLS HIGHER SECONDARY SCHOOL RORAS ROAD, KOTLI BHATTA, NEAR NWOL MOR SIALKOT",
            "362020" =>"GOVT. GIRLS HIGHER SECONDARY SCHOOL DHAROWAL (SIALKOT)",
            "362023" =>"GOVT. GIRLS HIGHER SECONDARY SCHOOL, HEAD MARALA (SIALKOT)",
            "362032" =>"GOVT. ZANIB  GIRLS HIGHER SECONDARY SCHOOL KOTLI LOHARAN WEST (SIALKOT)",
            "362043" =>"GOVT. GIRLS HIGHER SECONDARY SCHOOL VERYO, SIALKOT",
            "362055" =>"COMMUNITY MODEL GIRLS HIGHER SECONDARY SCHOOL, GOPALPUR ADDA (SIALKOT)",
            "362058" =>"GOVT. GIRLS HIGHER SECONDARY SCHOOL SATRAH (SIALKOT)",
            "362065" =>"GOVT. GIRLS HIGHER SECONDARY SCHOOL MODEL TOWN SIALKOT",
            "362066" =>"GOVT. GIRLS HIGHER SECONDARY SCHOOL, SIALKOT CANTT.",
            "362068" =>"GOVT. KHAWAJA SAFDAR GIRLS HIGHER SECONDARY SCHOOL, SIALKOT",
            "362069" =>"GOVT. L.A. GIRLS HIGHER SECONDARY SCHOOL SIALKOT",
            "362077" =>"GOVT. GIRLS HIGHER SECONDARY SCHOOL MURAD PUR SIALKOT",
            "362086" =>"GOVT. GIRLS HIGHER SECONDARY SCHOOL, UGOKI (SIALKOT)",
            "362087" =>"GOVT. GIRLS HIGHER SECONDARY SCHOOL, MURADPUR (SIALKOT)",
            "362118" =>"GOVT. GIRLS HIGHER SECONDARY SCHOOL, WADALA SANDHWAN, (SIALKOT)",
            "362236" =>"GOVT. GIRLS HIGHER SECONDARY SCHOOL KAMAL PUR",
            "362237" =>"COMMUNITY MODEL GIRLS HIGHER SECONDARY SCHOOL, SEOKE TEHSIL DASKA SIALKOT",
            "362238" =>"SIALKOT PUBLIC HIGHER SECONDARY SCHOOL FOR GIRLS.GUNNA KLAN,PASRUR ROAD,SIALKOT",
            "362239" =>"GOVT. GIRLS HIGHER SECONDARY SCHOOL, VILLAGE HUNDAL, SIALKOT",
            "362240" =>"AL-FARID ISLAMIC MODEL GIRLS HIGHER SECONDARY SCHOOL, QILA KALAR WALA, PASRUR, SIALKOT",
            "362241" =>"GOVT. GIRLS HIGHER SECONDARY SCHOOL, KULLUWAL, SIALKOT",
            "362242" =>"GOVT. GIRLS HIGHER SECONDARY SCHOOL, BEGOWALA, SAMBRIAL, SIALKOT",
            "362243" =>"TAMEER-E-MILLAT GIRLS HIGHER SECONDARY SCHOOL MITRANWALI, DASKA, SIALKOT",
            "362244" =>"CHRISTIAN GIRLS HIGHER SECONDARY SCHOOL, SATRAH ROAD, PASRUR, SIALKOT",
            "362245" =>"GOVT. GIRLS HIGHER SECONDARY SCHOOL, SABAZ KOT TEHSIL PASRUR, SIALKOT",
            "362246" =>"COMMUNITY MODEL HIGHER SECONDARY SCHOOL FOR GIRLS, GALOTIAN TEHSIL DASKA, SIALKOT",
            "362247" =>"ISLAM INTERNATIONAL HIGHER SECONDRY SCHOOL FOR GIRLS, PAKKI KOTLI, DASKA ROAD, SIALKOT",
            "362520" =>"GOVT. GIRLS HIGER SECONDARY SCHOOL, MUNDEKI GORAYA, DISTRICT SIALKOT",
            "362521" =>"GOVT. GIRLS HIGHER SECONDARY SCHOOL, KHAROLIAN, DISTRICT SIALKOT"


        );


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
}
