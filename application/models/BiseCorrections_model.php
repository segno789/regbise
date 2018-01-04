<?php
class BiseCorrections_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }
    public function EditEnrolementByinst($sch_cd)
    {



        $query = $this->db->get_where('Registration..tblreg9th',  array('sch_cd' => $sch_cd,'class'=>9,'iyear'=>YEAR,'sess'=>1, 'isdeleted'=>0));     
        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {
            return $query->result_array();
        }
        else
        {
            return  false;
        }
    }
    public function get9thObjectionStdData(){

        $table1= 'Registration..maP1blockrnobranch';
        $table2= 'matric_new..tblbiodata';
        $this->db->select("$table2.rno,$table2.name,$table2.formno,$table2.dob,$table2.fname");
        $this->db->from($table2);
        //join LEFT by default
        $this->db->join($table1, "$table1.rno=$table2.rno AND $table1.class=$table2.class AND $table1.iyear=$table2.iyear  AND $table1.sess=$table2.sess");
        $this->db->where($table2.'.class = 9 and '.$table2.'.iyear=2016 and '.$table2.'.sess=1 AND '.$table1.'.isactive=1');
        $query = $this->db->get();
        $rowcount = $this->db->count_all_results();
        if($rowcount > 0)
        {
            return $query->result_array();
        }
        else
        {
            return  0;
        }
    }
    public function updateslipData($rno,$kpo){

        $data2 = array(
            'isactive'=>0,
            'kpo'=>$kpo,
            'modified_date'=>date('Y-m-d H:i:s'),
        );
        $this->db->where('rno',$rno);
        $this->db->update("Registration..maP1blockrnobranch", $data2);
    }
    public function updateResData($rno,$kpo){

        $data2 = array(
            'isactive'=>1,
            'kpo'=>$kpo,
            'cdate'=>date('Y-m-d H:i:s'),
        );
        $this->db->where('inst_cd',$rno);
        $this->db->update("Admission_online..tblInstitutes_Deactivated", $data2);
    }
    public function updateRes11Data($rno,$kpo){

        $data2 = array(
            'isactive'=>1,
            'ckpo'=>$kpo,
            'cdate'=>date('Y-m-d H:i:s'),
        );
        $this->db->where('rno',$rno);
        $this->db->update("Registration..tblRegular_Inter_IA1p16_NOC", $data2);
    }
    public function biseauth($username,$password) 
    {

        //$query = $this->db->get_where('Admission_online..tblInstitutes_all', array('Inst_cd' => $username,'Inst_pwd' => $password));
        $query = $this->db->get_where('matric_new..tblEmployee', array('Emp_cd' => $username,'pass' => $password));
        $rowcount = $query->num_rows();
        if($rowcount >0)
        {

            return $query->row_array();
        }
        else
        {
            return  false;; 
        }
    }
    
    
    public function get9theligibilty()
    {



        $table1= 'Registration..tblReg9th';
        $table2= 'matric_new..tblSplCase';
        $this->db->select("$table2.spl_name,$table1.sch_cd,$table1.fnic,$table1.name,$table1.formno,$table1.fname,$table1.dob,$table2.spl_cd,$table1.grp_cd,$table1.grp_cd,matric_new.dbo.MSubAbre(sub1)+','+matric_new.dbo.MSubAbre(sub2)+','+matric_new.dbo.MSubAbre(sub3)+','+matric_new.dbo.MSubAbre(sub4)+','+matric_new.dbo.MSubAbre(sub5)+','+matric_new.dbo.MSubAbre(sub6)+','+matric_new.dbo.MSubAbre(sub7)+','+matric_new.dbo.MSubAbre(sub8) as sub_abr");
        $this->db->from($table2);
        //join LEFT by default
        $this->db->join($table1, "$table1.spl_cd=$table2.spl_cd");
        $this->db->where("$table1.spl_cd is not null and $table1.spl_cd not in (77) AND ($table1.isdeleted =0 OR  $table1.isdeleted IS NULL) AND $table1.batch_id>0");
        $query = $this->db->get();
        $rowcount = $this->db->count_all_results();
        if($rowcount > 0)
        {
            return $query->result_array();
        }
        else
        {
            return  false;
        }
    }
    public function active9theligibilty($formno,$kpo)
    {

        $data2 = array(
            'spl_cd'=>NULL,
            'ckpo'=>$kpo,
            'cdate'=>date('Y-m-d H:i:s'),
        );
        $this->db->where('formno',$formno);
        $res= $this->db->update("Registration..tblreg9th", $data2);


        return $res;
    }
    public function get9thDeactive($branch)
    {



        $table1= 'Admission_online..tblInstitutes_Deactivated';
        $table2= 'Admission_online..tblInstitutes_all';
        $this->db->select("$table2.name,$table1.inst_cd");
        $this->db->from($table2);
        //join LEFT by default
        $this->db->join($table1, "$table1.inst_cd=$table2.inst_cd");
        $this->db->where("$table1.isactive = 0 AND $table1.BranchName='$branch'");
        $query = $this->db->get();
        $rowcount = $this->db->count_all_results();
        if($rowcount > 0)
        {
            return $query->result_array();
        }
        else
        {
            return  false;
        }
    }
    public function get11thDeactive()
    {

        $table1= 'Registration..tblRegular_Inter_IA1p16_NOC';
        $this->db->select("$table1.rno,$table1.name,$table1.Fname,$table1.inst_cd,$table1.inst_name");
        $this->db->from($table1);

        $this->db->where("$table1.isactive = 0");
        $query = $this->db->get();
        $rowcount = $this->db->count_all_results();
        if($rowcount > 0)
        {
            return $query->result_array();
        }
        else
        {
            return  false;
        }
    }
    public function getmigration($class)
    {
        if($class == 9)
        {
            $table1= TBLMIGRATION2;
            $table2= 'Registration..tblreg9th';
            $this->db->select("$table2.RegGrp,$table2.formno,$table2.name,$table2.fname,$table2.Dob,$table2.grp_cd,$table2.PicPath,$table1.Migrated_to,$table1.Migrated_From,'' app_no");
            $this->db->from($table2);
            //join LEFT by default
            $this->db->join($table1, "$table1.formno=$table2.formno");
            $this->db->where("($table2.isdeleted = 0 or $table2.isdeleted is null) and $table2.oldinst_cd = 0 and $table1.iyear = ".YEAR." and $table1.class=9"); 
        }
        if($class == 10)
        {
            $table1= TBLMIGRATION1;
            $table2= TBLMIGRATION3;

            // $this->db->select('rno');
            // $this->db->from($table2);
            //$this->db->where("$table2.iyear =  2016 and $table2.class=9 and $table2.ismigrated =1");  
            $where_clause = "SELECT rno FROM $table2 WHERE $table2.iyear = 2017 and $table2.class=9 and $table2.ismigrated =1 and $table2.formno is null";


            $this->db->select("$table1.rno,$table1.name,$table1.fname,$table1.strregno,$table1.Migrated_to,$table1.Migrated_From,$table1.ismigrated ,'' app_no");
            $this->db->from($table1);
            $this->db->where("$table1.iyear = ".YEAR." and $table1.class=9 and $table1.ismigrated is null  and $table1.rno NOT IN($where_clause) ");  
        }
        if($class == 11)
        {

            $table1= TBLMIGRATION2;
            $table2= 'Registration..tblreg11th';
            $this->db->select("$table2.RegGrp,$table2.Formno,$table2.name,$table2.fname,$table2.grp_cd,$table2.PicPath,$table1.Migrated_to,$table1.Migrated_From,'' app_no");
            $this->db->from($table2);
            //join LEFT by default
            $this->db->join($table1, "$table1.formno=$table2.Formno");
            $this->db->where("$table2.isdeleted = 0 and ($table2.oldinst_cd = 0 or $table2.oldinst_cd is null) and $table1.iyear = ".YEAR." and $table1.class=11"); 
        }
        if($class == 12)
        {

            $table1= TBLMIGRATION1;
            $table2= TBLMIGRATION3;

            // $this->db->select('rno');
            // $this->db->from($table2);
            //$this->db->where("$table2.iyear =  2016 and $table2.class=9 and $table2.ismigrated =1");  
            $where_clause = "SELECT rno FROM $table2 WHERE $table2.iyear = ".YEAR." and $table2.class=11 and $table2.ismigrated =1 and $table2.formno is null";


            $this->db->select("$table1.rno,$table1.name,$table1.fname,$table1.strregno,$table1.Migrated_to,$table1.Migrated_From,$table1.ismigrated ,'' app_no");
            $this->db->from($table1);
            $this->db->where("$table1.iyear =  2016 and $table1.class=11 and $table1.ismigrated is null  and $table1.rno NOT IN($where_clause) ");  

            /*$table1= TBLMIGRATION1;
            $table2= TBLMIGRATION3;


            $where_clause = "SELECT rno FROM $table2 WHERE $table2.iyear =  2016 and $table2.class=11 and $table2.ismigrated =1 ";


            $this->db->select("$table1.rno,$table1.name,$table1.fname,$table1.strregno,$table1.Migrated_to,$table1.Migrated_From,$table1.ismigrated,'' app_no");
            $this->db->from($table1);
            $this->db->where("$table1.iyear =  2016 and $table1.class=11 and $table1.ismigrated is null and $table1.rno NOT IN($where_clause) ");  */
        }

        $query = $this->db->get();
        $rowcount = $this->db->count_all_results();
        if($rowcount > 0)
        {
            return $query->result_array();
        }
        else
        {
            return  false;
        }
    }


    public function getmigrationonline($class)
    {
        if($class == 9)
        {
            $table1= TBLMIGRATION3;
            $table2= 'Registration..tblreg9th';
            $this->db->select("$table2.RegGrp,$table2.formno,$table2.name,$table2.fname,$table2.Dob,$table2.grp_cd,$table2.PicPath,$table1.Migrated_to,$table1.Migrated_From,$table1.app_no");
            $this->db->from($table2);
            //join LEFT by default
            $this->db->join($table1, "$table1.formno=$table2.formno");
            $this->db->where("$table2.isdeleted = 0 and $table2.oldinst_cd = 0 and $table1.iyear = ".YEAR." and $table1.class=9 and $table1.formno is not null and $table1.ismigrated is null"); 
        }
        if($class == 10)
        {
            $table1= TBLMIGRATION3;


            $this->db->select("$table1.rno,$table1.name,$table1.fname,$table1.strregno,$table1.Migrated_to,$table1.Migrated_From,$table1.ismigrated, $table1.app_no");
            $this->db->from($table1);

            $this->db->where("$table1.iyear = ".YEAR." and $table1.class=9 and $table1.ismigrated is null and  $table1.formno is null and $table1.app_no is not null");  
        }
        if($class == 11)
        {

            $table1= TBLMIGRATION3;
            $table2= 'Registration..tblreg11th';
            $this->db->select("$table2.RegGrp,$table2.Formno,$table2.name,$table2.fname,$table2.grp_cd,$table2.PicPath,$table1.Migrated_to,$table1.Migrated_From,$table1.app_no");
            $this->db->from($table2);
            //join LEFT by default
            $this->db->join($table1, "$table1.formno=$table2.Formno");
            $this->db->where("$table2.isdeleted = 0 and ($table2.oldinst_cd = 0 or $table2.oldinst_cd is null) and $table1.iyear = ".YEAR." and $table1.class=11 and $table1.formno is not null and $table1.ismigrated is null"); 
        }
        if($class == 12)
        {
            $table1= TBLMIGRATION3;


            $this->db->select("$table1.rno,$table1.name,$table1.fname,$table1.strregno,$table1.Migrated_to,$table1.Migrated_From,$table1.ismigrated, $table1.app_no");
            $this->db->from($table1);

            $this->db->where("$table1.iyear = ".YEAR." and $table1.class=11 and $table1.ismigrated is null and  $table1.formno is null and $table1.app_no is not null");  
        }

        $query = $this->db->get();
        $rowcount = $this->db->count_all_results();
        if($rowcount > 0)
        {
            return $query->result_array();
        }
        else
        {
            return  false;
        }
    }

    public function getlistmigration($class)
    {
        if($class == 9)
        {
            $table2= 'Registration..tblreg9th';
            $this->db->select("$table2.RegGrp,$table2.formno,$table2.name,$table2.fname,$table2.Dob,$table2.grp_cd,$table2.PicPath,$table2.sch_cd,$table2.oldinst_cd, '' app_no ");
            $this->db->from($table2);

            $this->db->where("($table2.isdeleted = 0 or $table2.isdeleted is null)AND  $table2.oldinst_cd <>0 "); 
        }
        else  if($class == 10)
        {
            $table1= TBLMIGRATION3;
            $this->db->select("$table1.rno,$table1.name,$table1.fname,$table1.strregno,$table1.Migrated_to,$table1.Migrated_From,$table1.app_no");
            $this->db->from($table1);

            $this->db->where("$table1.iyear = ".YEAR." and $table1.class=9 and $table1.ismigrated = 1 and $table1.formno is null ");     
        }
        else  if($class == 12)
        {
            $table1= TBLMIGRATION3;
            $this->db->select("$table1.rno,$table1.name,$table1.fname,$table1.strregno,$table1.Migrated_to,$table1.Migrated_From,$table1.app_no");
            $this->db->from($table1);

            $this->db->where("$table1.iyear = ".YEAR." and $table1.class=11 and $table1.ismigrated = 1 ");     
        }
        else if($class == 11)
        {
            $table1= TBLMIGRATION2;
            $table2= 'Registration..tblreg11th';
            $this->db->select("$table2.RegGrp,$table2.Formno,$table2.name,$table2.fname,$table2.grp_cd,$table2.PicPath,$table1.Migrated_to as coll_cd,$table1.Migrated_From as oldinst_cd,'' app_no");
            $this->db->from($table2);
            //join LEFT by default
            $this->db->join($table1, "$table1.formno=$table2.Formno");
            $this->db->where("$table2.isdeleted = 0 and ($table2.oldinst_cd <> 0 or $table2.oldinst_cd is not null) and $table1.iyear = ".YEAR." and $table1.class=11"); 
        }

        $query = $this->db->get();
        $rowcount = $this->db->count_all_results();
        if($rowcount > 0)
        {
            return $query->result_array();
        }
        else
        {
            return  false;
        }
    }

    public function getlistmigrationonline($class)
    {
        if($class == 9)
        {
            $table1= TBLMIGRATION3;
            $table2= 'Registration..tblreg9th';
            $this->db->select("$table2.RegGrp,$table2.formno,$table2.name,$table2.fname,$table2.Dob,$table2.grp_cd,$table2.PicPath,$table2.sch_cd,$table2.oldinst_cd, $table1.app_no ");
            $this->db->from($table2);
            //join LEFT by default
            $this->db->join($table1, "$table1.formno=$table2.formno");
            $this->db->where("$table2.isdeleted = 0 and $table2.oldinst_cd <> 0 and $table1.iyear = ".YEAR." and $table1.class=9 and $table1.formno is not null and $table1.app_no is not null and $table1.ismigrated =1"); 
        }
        else  if($class == 10)
        {
            $table1= TBLMIGRATION3;
            $this->db->select("$table1.rno,$table1.name,$table1.fname,$table1.strregno,$table1.Migrated_to,$table1.Migrated_From");
            $this->db->from($table1);

            $this->db->where("$table1.iyear = ".YEAR." and $table1.class=9 and $table1.ismigrated = 1 ");     
        }
        else  if($class == 12)
        {
            $table1= TBLMIGRATION3;
            $this->db->select("$table1.rno,$table1.name,$table1.fname,$table1.strregno,$table1.Migrated_to,$table1.Migrated_From");
            $this->db->from($table1);

            $this->db->where("$table1.iyear = ".YEAR." and $table1.class=11 and $table1.ismigrated = 1 ");     
        }
        else if($class == 11)
        {
            $table1= TBLMIGRATION3;
            $table2= 'Registration..tblreg11th';
            $this->db->select("$table2.RegGrp,$table2.Formno,$table2.name,$table2.fname,$table2.grp_cd,$table2.PicPath,$table2.coll_cd,$table2.oldinst_cd,$table1.app_no");
            $this->db->from($table2);

            $this->db->join($table1, "$table1.formno=$table2.formno");
            $this->db->where("$table2.isdeleted = 0 and $table2.oldinst_cd <> 0 and $table1.iyear = ".YEAR." and $table1.class=11 and $table1.formno is not null and $table1.app_no is not null and $table1.ismigrated =1"); 

        }

        $query = $this->db->get();
        $rowcount = $this->db->count_all_results();
        if($rowcount > 0)
        {
            return $query->result_array();
        }
        else
        {
            return  false;
        }
    }
    public function EditEnrolement_data($formno)
    {



        $query = $this->db->get_where('Registration..tblreg9th',  array('formNo' => $formno,'class'=>9,'iyear'=>YEAR,'sess'=>1));     
        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {
            return $query->result_array();
        }
        else
        {
            return  false;
        }
    }
    public function EditEnrolementByinst11th($sch_cd)
    {



        $query = $this->db->get_where('Registration..tblreg11th',  array('coll_cd' => $sch_cd,'class'=>11,'iyear'=>YEAR,'sess'=>1, 'isdeleted'=>0));     
        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {
            return $query->result_array();
        }
        else
        {
            return  false;
        }
    }
    public function Insert_NewEnorlement_11th($data)
    {    

        $name = strtoupper($data['name']);
        $fname =strtoupper($data['Fname']);
        $BForm = $data['BForm'];
        $FNIC = $data['FNIC'];
        $Dob = $data['Dob'];
        $CellNo = $data['MobNo'];
        $medium = $data['medium'];
        $prevresult = strtoupper(@$data['prevResult']);
        $MarkOfIden =strtoupper(@$data['markOfIden']);
        $Speciality = $data['Speciality'];
        $nat = $data['nat'];
        $sex = $data['sex'];
        $IsHafiz = $data['IsHafiz'];
        $rel = $data['rel'];        
        $addr =strtoupper($data['addr']) ;
        $sub1= $data['sub1'];
        $sub2 = $data['sub2'];
        $sub3 = $data['sub3'];
        $sub4 = $data['sub4'];
        $sub5 = $data['sub5'];
        $sub6 = $data['sub6'];
        $sub7 = $data['sub7'];
        $sub8 = $data['sub8'];


        $sub1ap1 = $data['sub1ap1'];
        $sub2ap1 = $data['sub2ap1'];
        $sub3ap1 = $data['sub3ap1'];
        $sub4ap1 = $data['sub4ap1'];
        $sub5ap1 = $data['sub5ap1'];
        $sub6ap1 = $data['sub6ap1'];
        $sub7ap1 = $data['sub7ap1'];
        $sub8ap1 = $data['sub8ap1'];

        $UrbanRural = $data['RuralORUrban'];
        $Inst_cd = $data['Inst_cd_other'];
        $formno = $data['FormNo'];
        $RegGrp = $data['grp_cd'];
        $grp_cd = $data['grp_cd'];
        $sub1ap2 =  $data['sub1ap2'];
        $sub2ap2 =  $data['sub2ap2'];
        $sub3ap2 =  $data['sub3ap2'];
        $sub4ap2 =  $data['sub4ap2'];
        $sub5ap2 =  $data['sub5ap2'];
        $sub6ap2 =  $data['sub6ap2'];
        $sub7ap2 =  $data['sub7ap2'];
        $sub8ap2 =  $data['sub8ap2'];

        $cat09 = $data['cat09'];     
        $cat10 = $data['cat10'];     

        //-------Marks Improve CAT --------\\
        $dist_cd =  $data['dist'];
        $teh_cd =  $data['teh'];
        $zone_cd =  $data['zone'];
        $oldrno =  $data['rno'];
        $oldyear =  $data['Iyear'];
        $oldsess =  $data['sess'];
        $ckpo = $data['ckpo'];

        $exam_type = $data['exam_type'];
        $soldrno = $data['soldrno'];
        $soldyear = $data['soldyear'];
        $soldsess = $data['soldsess'];
        $soldboard = $data['sscbrd'];
        $Brd_cd =  @$data['Brd_cd'];
        $year = YEAR;

        //$old_class =  @$data['class'];

        /*$AdmProcFee =  @$data['AdmProcessFee'];

        $AdmFee = @$data['AdmFee'];

        $TotalAdmFee =  $AdmFee + $AdmProcFee;  */
        $IsHafiz = 0;
        $RegGrp = 0;

        $query = $this->db->query("Admission_online..MSAdm2016_sp_insert_otherboard_11th '$formno',11,$year,1,'$name','$fname','$BForm','$FNIC','$Dob','$CellNo',$medium,'".$MarkOfIden."',$Speciality,$nat,$sex,$rel,'".$addr."',$grp_cd,$sub1,$sub1ap1,$sub2,$sub2ap1,$sub3,$sub3ap1,$sub4,$sub4ap1,$sub5,$sub5ap1,$sub6,$sub6ap1,$sub7,$sub7ap1,$sub8,$sub8ap1,1,$oldrno,$oldyear,$oldsess,$IsHafiz,$Inst_cd,$UrbanRural,$RegGrp,$cat09,$cat10,$sub1ap2,$sub2ap2,$sub4ap2,$sub5ap2,$sub6ap2,$sub7ap2,$dist_cd,$teh_cd,$zone_cd,$Brd_cd,'$prevresult',$ckpo,$exam_type,$soldrno,$soldsess,$soldyear,$soldboard");
        return true;
    }
    public function Update_NewEnorlement($data)//$father_name,$bay_form,$father_cnic,$dob,$mob_number)  IA_P1_Reg_Adm2016_sp_Update
    {

        $name =strtoupper($data['name']) ;
        $fname =strtoupper($data['Fname']);
        $BForm = $data['BForm'];
        $FNIC = $data['FNIC'];
        $Dob = $data['Dob'];
        $CellNo = $data['MobNo'];
        $medium = $data['medium'];
        $Inst_Rno = strtoupper($data['classRno']);
        $MarkOfIden =strtoupper($data['markOfIden']);
        $Speciality = $data['Speciality'];
        $nat = $data['nat'];
        $sex = $data['sex'];
        $IsHafiz = $data['Ishafiz'];
        $rel = $data['rel'];
        $addr =strtoupper($data['addr']);
        /* if(($data['grp_cd'] == 1) or ($data['grp_cd'] == 7) or ($data['grp_cd'] == 8) )
        {
        $grp_cd = 1;    
        }
        else if($data['grp_cd'] == 2 )
        {
        $grp_cd = 2;        
        }
        else if($data['grp_cd'] == 5 )
        {
        $grp_cd = 5;        
        }*/
        $sub1= $data['sub1'];
        $sub2 = $data['sub2'];
        $sub3 = $data['sub3'];
        $sub4 = $data['sub4'];
        $sub5 = $data['sub5'];
        $sub6 = $data['sub6'];
        $sub7 = $data['sub7'];
        $sub8 = $data['sub8'];
        $sub1ap1 = $data['sub1ap1'];
        $sub2ap1 = $data['sub2ap1'];
        $sub3ap1 = $data['sub3ap1'];
        $sub4ap1 = $data['sub4ap1'];
        $sub5ap1 = $data['sub5ap1'];
        $sub6ap1 = $data['sub6ap1'];
        $sub7ap1 = $data['sub7ap1'];
        $sub8ap1 = $data['sub8ap1'];
        $UrbanRural = $data['ruralOrurban'];
        $Inst_cd = $data['Inst_cd'];
        $formno = $data['FormNo'];
        $RegGrp = $data['RegGrp'];
        $regoldrno = $data['regoldrno'];
        $regoldsess = $data['regoldsess'];
        $regoldclass = $data['regoldclass'];
        $regoldyear = $data['regoldyear'];
        $isreadm = $data['isreadm'];
        $SSC_RNo = $data['SSC_RNo'];
        $SSC_Year = $data['SSC_Year'];
        $SSC_Sess = $data['SSC_Sess'];
        $SSC_brd_cd = $data['SSC_brd_cd'];
        $IsBrdCrt = $data['IsBrdCrt'];
        $pic_base_64 = $data['Image'];
        $year = YEAR;

        $query = $this->db->query("Registration..IA_P1_Reg_Adm2016_sp_Update_correction '$formno',11,$year,1,'$name','$fname','$BForm','$FNIC','$Dob','$CellNo',$medium,'$Inst_Rno','$MarkOfIden',$Speciality,$nat,$rel,'$addr',$RegGrp,$sub1,$sub1ap1,$sub2,$sub2ap1,$sub3,$sub3ap1,$sub4,$sub4ap1,$sub5,$sub5ap1,$sub6,$sub6ap1,$sub7,$sub7ap1,$IsHafiz,$Inst_cd,$UrbanRural,'$pic_base_64','$SSC_RNo',$SSC_Year,$SSC_Sess,$SSC_brd_cd,$IsBrdCrt");
        //$query = $this->db->insert('msadmissions2015', $data);//,'Fname' => $father_name,'BForm'=>$bay_form,'FNIC'=>$father_cnic,'Dob'=>$dob,'CellNo'=>$mob_number));
        return true;
    }
    public function EditEnrolement_data11($data)
    {



        if($data['formno'] != "")
        {
            $query = $this->db->get_where('Registration..tblreg11th',  array('formNo' => $data['formno'],'class'=>11,'iyear'=>YEAR,'sess'=>1));   
        }
        else
        {
            $query = $this->db->get_where('Registration..tblreg11th',  array('matRno' => $data['matrno'],'yearOfPass'=>$data['year'],'sessOfPass'=>$data['sess'],'Brd_cd'=>$data['brd'],'class'=>11,'iyear'=>YEAR,'sess'=>1)); 
        }




        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {
            $matrno = $query->result_array[0]['matRno'];
            $yearOfPass = $query->result_array[0]['yearOfPass'];
            $sessOfPass = $query->result_array[0]['sessOfPass'];
            $brd_cd = $query->result_array[0]['Brd_cd'];
            if($brd_cd == 1)
            {

                $query_1 = $this->db->get_where('matric_new..tblbiodata',  array('rno' => $matrno,'class'=>10,'iyear'=>$yearOfPass,'sess'=>$sessOfPass));  
                $rowcount_1 = $query_1->num_rows();
                if($rowcount_1>1)
                {
                    $query->result_array[0]['name'] = $query_1->result_array[0]['name'];
                    $query->result_array[0]['Fname'] = $query_1->result_array[0]['Fname'];
                    //$query->result_array[0]['Dob'] = $query_1->result_array[0]['rno'];

                }


            }

            return $query->result_array();
        }
        else
        {
            return  false;
        }
    }
    public function GetInstbyId($isnt){
        $this->db->select('Name,allowed_mGrp,allowed_iGrp,edu_lvl,Inst_cd,IsGovernment,zone_cd,dist_cd,teh_cd');
        $this->db->from('Admission_Online..tblInstitutes_all');
        $where = '(edu_lvl=1 or edu_lvl = 3 OR  edu_lvl =  2)';
        $this->db->where('IsActive', 1);
        $this->db->where('inst_cd', $isnt);
        $this->db->where($where);


        $result_1 = $this->db->get()->result();
        return $result_1;
    }
    public function GetInstbyId_11th_otherboard($isnt)
    {
        $this->db->select('Name,allowed_mGrp,allowed_iGrp,edu_lvl,Inst_cd,IsGovernment,zone_cd,dist_cd,teh_cd,izone_cd');
        $this->db->from('Admission_Online..tblInstitutes_all');
        $where = '(edu_lvl=1 or edu_lvl = 3 OR  edu_lvl =  2)';
        //$this->db->where('IsActive', 1);
        $this->db->where('inst_cd', $isnt);
        $this->db->where($where);
        $result_1 = $this->db->get()->result();
        return $result_1;
    }
    public function GetInstNamebyId($isnt){
        $this->db->select('Name');
        $this->db->from('Admission_Online..tblInstitutes_all');
        $where = '(edu_lvl=1 or edu_lvl = 3 OR  edu_lvl =  2)';
        $this->db->where('IsActive', 1);
        $this->db->where('inst_cd', $isnt);
        $this->db->where($where);


        $result_1 = $this->db->get()->result();
        return $result_1;
    }
    public function GetAllInstList(){
        $this->db->select('Inst_cd, Name');
        $this->db->from('Admission_Online..tblInstitutes_all');
        $where = '(edu_lvl=1 or edu_lvl = 3)';
        $this->db->where('IsActive', 1);
        $this->db->where($where);


        $result_1 = $this->db->get()->result();
        return $result_1;
    }
     public function GetAllInstList_HSSC(){
        $this->db->select('Inst_cd, Name');
        $this->db->from('Admission_Online..tblInstitutes_all');
        $where = '(edu_lvl=2 or edu_lvl = 3)';
        $this->db->where('IsActive', 1);
        $this->db->where($where);


        $result_1 = $this->db->get()->result();
        return $result_1;
    }
    public function Insert_SpecPermison($data)
    {
        //DebugBreak();
        $isfeeded = $this->IsSpecPermison($data['Inst_cd']);
        if(isset($isfeeded[0]))
        {
        $this->db->where('Inst_cd',$data['Inst_cd']);
        $query = $this->db->update('Registration..inst_Special_Permission_9th', $data);//,'Fname' => $father_name,'BForm'=>$bay_form,'FNIC'=>$father_cnic,'Dob'=>$dob,'CellNo'=>$mob_number));
        }
        else
        {
         
        $query = $this->db->insert('Registration..inst_Special_Permission_9th', $data);//,'Fname' => $father_name,'BForm'=>$bay_form,'FNIC'=>$father_cnic,'Dob'=>$dob,'CellNo'=>$mob_number));
        }
        return $query;
    }
    public function IsSpecPermison($inst_cd)
    {
        $q2 = $this->db->query('select top 1 FeedingDate ,SpecialFee ,readmfine ,Inst_cd from Registration..inst_Special_Permission_9th where Inst_cd = '.$inst_cd.'');
        $result = $q2->result_array();
        return $result;
    }
    public function Batch_List()
    {
        $q2         = $this->db->get_where('Registration..fl_reg_batch_test',array('flag'=>1,'Is_Delete'=>0));
        $result = $q2->result_array();
        return $result;
    }
    public function Batch_List_all()
    {


        $q2         = $this->db->get_where('Registration..fl_reg_batch_test',array('flag is'=>null,'Is_Delete'=>0));
        $result = $q2->result_array();
        return $result;
    }
    public function get9thCorrectionData()
    {


        $q2         = $this->db->get_where('Registration..MA_P1_Reg_Correction',array('IsDeleted'=>0,'IsCorr'=>1));
        $result = $q2->result_array();
        return $result;
    }

    public function get11thCorrectionData()
    {


        $q2         = $this->db->get_where('Registration..IA_P1_Reg_Correction',array('IsDeleted'=>0,'IsCorr'=>1));
        $result = $q2->result_array();
        return $result;
    }
    public function get11thCorrectionDataById($app_id)
    {


        $q2         = $this->db->get_where('Registration..IA_P1_Reg_Correction',array('IsDeleted'=>0,'IsCorr'=>1 , 'AppNo'=>$app_id));
        $result = $q2->result_array();
        return $result;
    }
    public function get9thCorrectionDataById($app_id)
    {


        $q2         = $this->db->get_where('Registration..MA_P1_Reg_Correction',array('IsDeleted'=>0,'IsCorr'=>1 , 'AppNo'=>$app_id));
        $result = $q2->result_array();
        return $result;
    }
    public function get11thCorrectionData_verified()
    {


        $q2         = $this->db->get_where('Registration..IA_P1_Reg_Correction',array('IsDeleted'=>0,'IsCorr'=>2, 'iyear'=>YEAR));
        $result = $q2->result_array();
        return $result;
    }

    public function get9thCorrectionData_verified()
    {


       // $q2         = $this->db->get_where('Registration..MA_P1_Reg_Correction',array('IsDeleted'=>0,'IsCorr'=>2));
        $q2         = $this->db->query('select top 10 * from Registration..MA_P1_Reg_Correction where IsDeleted = 0 AND IsCorr = 2 order by edate desc');
        $result = $q2->result_array();
        return $result;
    }

    public function Batch_List_Deleted()
    {


        $q2         = $this->db->get_where('Registration..fl_reg_batch_test',array('Is_Delete'=>1));
        $result = $q2->result_array();
        return $result;
    }
    public function Batch_List_UPDATE($fetch_data)
    {

        $Inst_cd = $fetch_data['Inst_Cd'];
        $Batch_Id = $fetch_data['BatchId'];
        $ckpo = $fetch_data['ckpo'];
        $query = $this->db->query("Registration..Release_Batch_By_BoardOperator $Inst_cd,$Batch_Id,$ckpo");
        $rowcount = $query->num_rows();
        return true;
    }
    public function reg9thCorrection_UPDATE($fetch_data)
    {

        // $Inst_cd = $fetch_data['Inst_Cd'];
        $AppNo = $fetch_data['AppNo'];
        $ckpo = $fetch_data['ckpo'];

        $query = $this->db->query("Registration..Update_corrections_new_1 $AppNo,$ckpo");
        $rowcount = $query->num_rows();
        return true;
    }

    public function reg11thCorrection_UPDATE($fetch_data)
    {

        // $Inst_cd = $fetch_data['Inst_Cd'];
        $AppNo = $fetch_data['AppNo'];
        $ckpo = $fetch_data['ckpo'];

        $query = $this->db->query("Registration..Update_corrections_new_11 $AppNo,$ckpo");
        $rowcount = $query->num_rows();
        return true;
    }

    public function Batch_List_RESTORE($fetch_data)
    {

        $Inst_cd = $fetch_data['Inst_Cd'];
        $Batch_Id = $fetch_data['BatchId'];
        $ckpo = $fetch_data['ckpo'];

        $query = $this->db->query("Registration..Restore_Batch_By_BoardOperator $Inst_cd,$Batch_Id,$ckpo");
        $rowcount = $query->num_rows();
        return true;
    }
    public function updateCorrectionStatus11($app_id,$kpo){

        $data2 = array(
            'ckpo'=>$kpo,
            'cDate'=>date('Y-m-d H:i:s'),
            'IsCorr'=>2,
        );
        $this->db->where('AppNo',$app_id);
        $this->db->update("Registration..IA_P1_Reg_Correction", $data2);
    }
    public function updateCorrectionStatus($app_id,$kpo){

        $data2 = array(
            'ckpo'=>$kpo,
            'cDate'=>date('Y-m-d H:i:s'),
            'IsCorr'=>2,
        );
        $this->db->where('AppNo',$app_id);
        $this->db->update("Registration..MA_P1_Reg_Correction", $data2);
    }
    public function UpdateDeleteStatus($formno,$kpo,$isDeleted){


        $data2 = array(
            'ckpo'=>$kpo,
            'cDate'=>date('Y-m-d H:i:s'),
            'IsDeleted'=>$isDeleted,
        );
        $this->db->where('formNo',$formno);
        $this->db->update("Registration..tblreg9th", $data2);
    }
    public function UpdateDeleteStatus11($formno,$kpo,$isDeleted){


        $data2 = array(
            'ckpo'=>$kpo,
            'cDate'=>date('Y-m-d H:i:s'),
            'IsDeleted'=>$isDeleted,
        );
        $this->db->where('formNo',$formno);
        $this->db->update("Registration..tblreg11th", $data2);
    }

    //Restore_Form_UPDATE
    public function Restore_candidate_list($ckpo)
    {
        $q2         = $this->db->get_where('Registration..tblreg9th',array('IsDeleted'=>1,'ckpo'=>$ckpo));
        $result = $q2->result_array();
        return $result;
    }
    public function Restore_candidate_list11($ckpo)
    {
        $q2         = $this->db->get_where('Registration..tblreg11th',array('IsDeleted'=>1,'ckpo'=>$ckpo));
        $result = $q2->result_array();
        return $result;
    }

    public function updateMigData($formno,$newInst,$oldInst,$kpo)
    {

        $data2 = array(
            'Sch_cd'=>$newInst,
            'oldinst_cd'=>$oldInst,
            'ckpo'=>$kpo,
            'cDate'=>date('Y-m-d H:i:s'),
        );
        $this->db->where('formno',$formno);
        $res =  $this->db->update(TBLMIGRATION, $data2);

        if ($res === FALSE) {
            return -1; // Or do whatever you gotta do here to raise an error
        } else {
            return $this->db->affected_rows();
        }
    }
    public function updateMigDataOnline($formno,$newInst,$oldInst,$kpo,$app_no,$ismigrated)
    {

        $data2 = array(
            'Sch_cd'=>$newInst,
            'oldinst_cd'=>$oldInst,
            'ckpo'=>$kpo,
            'cDate'=>date('Y-m-d H:i:s'),
        );
        $this->db->where('formno',$formno);
        $res =  $this->db->update(TBLMIGRATION, $data2);   

        $data2 = array(
            'ismigrated'=>$ismigrated,
            'ckpo'=>$kpo,
            'cdate'=>date('Y-m-d H:i:s'),
        );
        $this->db->where('app_No',$app_no);
        $res =  $this->db->update(TBLMIGRATION3, $data2);


        if ($res === FALSE) {
            return -1; // Or do whatever you gotta do here to raise an error
        } else {
            return $this->db->affected_rows();
        }
    }


    public function update11MigData($formno,$newInst,$oldInst,$kpo,$app_no,$ismigrated)
    {
        $q = $this->db->get_where(TBLMIGRATION_11th,array('coll_cd'=>$newInst));
        $result = $q->result_array();
        $result;
        $data2 = array(
            'coll_cd'=>$newInst,
            'oldinst_cd'=>$oldInst,
            'ckpo'=>$kpo,
            'cDate'=>date('Y-m-d H:i:s'),
            'dist_cd'=>$result[0]['dist_cd'],
            'teh_cd'=>$result[0]['teh_cd'],
            'zone_cd'=>$result[0]['zone_cd'],
        );
        $this->db->where('Formno',$formno);
        $res =  $this->db->update(TBLMIGRATION_11th, $data2);

        if($app_no >0)
        {

            $data2 = array(
                'ismigrated'=>$ismigrated,
                'ckpo'=>$kpo,
                'cdate'=>date('Y-m-d H:i:s'),
            );
            $this->db->where('app_No',$app_no);
            $res =  $this->db->update(TBLMIGRATION3, $data2); 
        }

        if ($res === FALSE) {
            return -1; // Or do whatever you gotta do here to raise an error
        } else {
            return $this->db->affected_rows();
        }
    }
    public function update10MigData($formno,$kpo,$isupdate,$newinst_cd){

        if($isupdate == 1)
        {
            $stdinfo =  $this->getstdrecord($formno) ;
            $data2 = array(
                'Rno'=>$formno,
                'iyear'=>YEAR,
                'class'=>9,
                'name'=>$stdinfo[0]->name,
                'fname'=>$stdinfo[0]->fname,
                'Migrated_From'=>$stdinfo[0]->sch_cd,
                'Migrated_to'=>$newinst_cd,
                'ekpo'=>$kpo,
                'ismigrated'=>1  ,
                'isother'=>0  ,

            );  
            $res =  $this->db->insert(TBLMIGRATION3, $data2);

        }
        else if($isupdate == 2)
        {
            $data2 = array(
                'ismigrated'=>NULL,
                'ckpo'=>$kpo,
                'cDate'=>date('Y-m-d H:i:s'),  
            );  

            $this->db->where("rno = $formno AND class=9 and iyear=".YEAR);
            $res =  $this->db->update(TBLMIGRATION3, $data2);
        }

        else if($isupdate == 3)
        {
            $data2 = array(
                'ismigrated'=>1,
                'ckpo'=>$kpo,
                'cDate'=>date('Y-m-d H:i:s'),  
            );  

            $this->db->where("app_no = $formno AND class=9 and iyear=".YEAR);
            $res =  $this->db->update(TBLMIGRATION3, $data2);
        }
        else if($isupdate == 4)
        {
            $data2 = array(
                'ismigrated'=>NULL,
                'ckpo'=>$kpo,
                'cDate'=>date('Y-m-d H:i:s'),  
            );  

            $this->db->where("app_no = $formno AND class=9 and iyear=".YEAR);
            $res =  $this->db->update(TBLMIGRATION3, $data2);
        }
        if ($res === FALSE) {
            return -1; // Or do whatever you gotta do here to raise an error
        } else {
            return $this->db->affected_rows();
        }
    }
    public function update12MigData($formno,$kpo,$isupdate,$newinst_cd){

        if($isupdate == 1)
        {
            $stdinfo =  $this->getstdrecord($formno) ;
            $data2 = array(
                'Rno'=>$formno,
                'iyear'=>2016,
                'class'=>11,
                'name'=>$stdinfo[0]->name,
                'fname'=>$stdinfo[0]->fname,
                'Migrated_From'=>$stdinfo[0]->sch_cd,
                'Migrated_to'=>$newinst_cd,
                'ekpo'=>$kpo,
                'ismigrated'=>1  ,
                'isother'=>0  ,

            );  
            $res =  $this->db->insert(TBLMIGRATION3, $data2);

        }
        else if($isupdate == 2)
        {
            $data2 = array(
                'ismigrated'=>NULL,
                'ckpo'=>$kpo,
                'cDate'=>date('Y-m-d H:i:s'),  
            );  

            $this->db->where("rno = $formno AND class=11 and iyear=".YEAR);
            $res =  $this->db->update(TBLMIGRATION3, $data2);
        }
        else if($isupdate == 3)
        {
            $data2 = array(
                'ismigrated'=>1,
                'ckpo'=>$kpo,
                'cDate'=>date('Y-m-d H:i:s'),  
            );  

            $this->db->where("app_no = $formno AND class=11 and iyear=".YEAR);
            $res =  $this->db->update(TBLMIGRATION3, $data2);
        }
        else if($isupdate == 4)
        {
            $data2 = array(
                'ismigrated'=>NULL,
                'ckpo'=>$kpo,
                'cDate'=>date('Y-m-d H:i:s'),  
            );  

            $this->db->where("app_no = $formno AND class=11 and iyear=".YEAR);
            $res =  $this->db->update(TBLMIGRATION3, $data2);
        }

        if ($res === FALSE) {
            return -1; // Or do whatever you gotta do here to raise an error
        } else {
            return $this->db->affected_rows();
        }
    }

  public function Insert_NewEnorlement($data)
    {    

        $name = strtoupper($data['name']);
        $fname =strtoupper($data['Fname']);
        $BForm = $data['BForm'];
        $FNIC = $data['FNIC'];
        $Dob = $data['Dob'];
        $CellNo = $data['MobNo'];
        $medium = $data['medium'];
        $prevresult = strtoupper(@$data['prevResult']);
        $MarkOfIden =strtoupper(@$data['markOfIden']);
        $Speciality = $data['Speciality'];
        $nat = $data['nat'];
        $sex = $data['sex'];
        $IsHafiz = $data['IsHafiz'];
        $rel = $data['rel'];        
        $addr =strtoupper($data['addr']) ;

        if(($data['grp_cd'] == 1) || ($data['grp_cd'] == 7) || ($data['grp_cd'] == 8) )
        {
            $grp_cd = 1;    
        }
        else if($data['grp_cd'] == 2 )
        {
            $grp_cd = 2;        
        }
        else if($data['grp_cd'] == 5 )
        {
            $grp_cd = 5;        
        }
        else if ($data['grp_cd']==4)
        {
            $grp_cd = 4;        
        }

        $sub1= $data['sub1'];
        $sub2 = $data['sub2'];
        $sub3 = $data['sub3'];
        $sub4 = $data['sub4'];
        $sub5 = $data['sub5'];
        $sub6 = $data['sub6'];
        $sub7 = $data['sub7'];
        $sub8 = $data['sub8'];


        $sub1ap1 = $data['sub1ap1'];
        $sub2ap1 = $data['sub2ap1'];
        $sub3ap1 = $data['sub3ap1'];
        $sub4ap1 = $data['sub4ap1'];
        $sub5ap1 = $data['sub5ap1'];
        $sub6ap1 = $data['sub6ap1'];
        $sub7ap1 = $data['sub7ap1'];
        $sub8ap1 = $data['sub8ap1'];

        $UrbanRural = $data['RuralORUrban'];
        $Inst_cd = $data['Inst_cd_other'];
        $formno = $data['FormNo'];
        $RegGrp = $data['grp_cd'];
        $sub1ap2 =  $data['sub1ap2'];
        $sub2ap2 =  $data['sub2ap2'];
        $sub3ap2 =  $data['sub3ap2'];
        $sub4ap2 =  $data['sub4ap2'];
        $sub5ap2 =  $data['sub5ap2'];
        $sub6ap2 =  $data['sub6ap2'];
        $sub7ap2 =  $data['sub7ap2'];
        $sub8ap2 =  $data['sub8ap2'];

        $cat09 = $data['cat09'];     
        $cat10 = $data['cat10'];     

        //-------Marks Improve CAT --------\\
        $dist_cd =  $data['dist'];
        $teh_cd =  $data['teh'];
        $zone_cd =  $data['zone'];
        $oldrno =  $data['rno'];
        $oldyear =  $data['Iyear'];
        $oldsess =  $data['sess'];
        $ckpo = $data['ckpo'];

        $exam_type = $data['exam_type'];
        $Brd_cd =  @$data['Brd_cd'];


        //$old_class =  @$data['class'];

        /*$AdmProcFee =  @$data['AdmProcessFee'];

        $AdmFee = @$data['AdmFee'];

        $TotalAdmFee =  $AdmFee + $AdmProcFee;  */
        $IsHafiz = 0;
        $RegGrp = 0;
        $year = YEAR;
        $query = $this->db->query("Admission_online..MSAdm2016_sp_insert_otherboard_9th '$formno',9,$year,1,'$name','$fname','$BForm','$FNIC','$Dob','$CellNo',$medium,'".$MarkOfIden."',$Speciality,$nat,$sex,$rel,'".$addr."',$grp_cd,$sub1,$sub1ap1,$sub2,$sub2ap1,$sub3,$sub3ap1,$sub4,$sub4ap1,$sub5,$sub5ap1,$sub6,$sub6ap1,$sub7,$sub7ap1,$sub8,$sub8ap1,1,$oldrno,$oldyear,$oldsess,$IsHafiz,$Inst_cd,$UrbanRural,$RegGrp,$cat09,$cat10,$sub1ap2,$sub2ap2,$sub3ap2,$sub4ap2,$sub5ap2,$sub6ap2,$sub7ap2,$sub8ap2,$dist_cd,$teh_cd,$zone_cd,$Brd_cd,'$prevresult',$ckpo,$exam_type");
        return $query->result_array();
    }
    public function GetFormNo($inst_cd){

        $this->db->select('formno');
        $this->db->order_by("formno", "DESC");
        $formno =$this->db->get_where('Admission_online..tblAdmissionDataForSSC_otherBoard',array('Sch_cd'=>$inst_cd)); //
        $rowcount = $formno->num_rows();

        if($rowcount == 0 )
        {

            $this->db->select('formno');
            $this->db->order_by("formno", "DESC");
            $formno =$this->db->get_where('matric_new..vw9th17',array('Sch_cd'=>$inst_cd)); //tblAdmissionDataForSSC_otherBoard
            $rowcount = $formno->num_rows();
            $row  = $formno->result_array();
            $formno = $row[0]['formno']+1; //formnovalid+1;
            return $formno;
        }
        else
        {
            $row  = $formno->result_array();
            $formno = $row[0]['formno']+1;
            return $formno;
        }

    }
    public function getstdrecord($rno)
    {
        $this->db->select('name, fname, rno,class,iyear,sess,sch_cd');
        $this->db->from(TBLMIGRATION4);
        $this->db->where(array('rno' => $rno));
        $result_1 = $this->db->get()->result();
        return $result_1;
    }
    public function get9thcancel()
    {

        $query = $this->db->query("SELECT   t1.formno,t1.name,t1.fname, CONVERT(varchar(10), t1.dob, 105) RegDob,t1.fnic,t1.                                      bform,t1.sch_cd,t3.name,t2.rno,t2.name,t2.fname,t2.dob,t2.fnic,t2.bform
            from Registration..tblreg9th t1
            inner join matric_new..tblbiodata t2 on
            CONVERT(varchar(10), t1.dob, 105)= t2.dob AND 
            t1.name= t2.name AND
            t1.fname= t2.fname and  
            t1.fnic= t2.fnic  

            INNER JOIN admission_online..tblInstitutes_all t3
            on t1.sch_cd = t3.inst_cd
            where  ( t1.IsReAdm =1)  and t1.isdeleted =1  and t2.iyear=2016 and t2.class=9 and t2.sess=1 and (t2.status =1 OR t2.status =5) 

        order by t1.sch_cd");  

        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {
            return $query->result_array();
        }
        else
        {
            return  false;
        }


    }
    public function  updateReg9thData($formno,$kpo)
    {

        $data2 = array(
            'isdeleted'=>0,
            'ckpo'=>$kpo,
            'cDate'=>date('Y-m-d H:i:s'),  
        );  

        $this->db->where("formno = '$formno'");
        $res =  $this->db->update('Registration..tblreg9th', $data2);

        if ($res === FALSE) {
            return -1; // Or do whatever you gotta do here to raise an error
        } else {
            return $this->db->affected_rows();
        }
    }
    public function get11thelegibility($isyes)
    {

        $table1= 'Registration..tblReg11th';
        $table2= 'matric_new..tblSplCase';
        $this->db->select("$table2.spl_name,$table1.coll_cd,$table1.fnic,$table1.name,$table1.formno,$table1.fname,$table1.dob,$table2.spl_cd,$table1.grp_cd,$table1.grp_cd,matric_new.dbo.ISubAbre(sub1)+','+matric_new.dbo.ISubAbre(sub2)+','+matric_new.dbo.ISubAbre(sub3)+','+matric_new.dbo.ISubAbre(sub4)+','+matric_new.dbo.ISubAbre(sub5)+','+matric_new.dbo.ISubAbre(sub6)+','+matric_new.dbo.ISubAbre(sub7)+','+matric_new.dbo.ISubAbre(sub8) as sub_abr");
        $this->db->from($table2);
        //join LEFT by default
        $this->db->join($table1, "$table1.spl_cd=$table2.spl_cd");
        $this->db->where("$table1.spl_cd is not null and $table1.spl_cd not in (80,77) AND ($table1.isdeleted =0 OR  $table1.isdeleted IS NULL) AND $table1.batch_id>0");
        $query = $this->db->get();
        $rowcount = $this->db->count_all_results();
        if($rowcount > 0)
        {
            return $query->result_array();
        }
        else
        {
            return  false;
        }
    }
    public function GetFormNo_11th($inst_cd)
    {

        $this->db->select('formno');
        $this->db->order_by("formno", "DESC");
        $formno =$this->db->get_where('Admission_online..tblAdmissionDataForHSSC_otherBoard',array('coll_cd'=>$inst_cd)); //
        $rowcount = $formno->num_rows();

        if($rowcount == 0 )
        {

            $this->db->select('formno');
            $this->db->order_by("formno", "DESC");
            $formno =$this->db->get_where('matric_new..vwia1p16',array('coll_cd'=>$inst_cd)); //tblAdmissionDataForSSC_otherBoard
            $rowcount = $formno->num_rows();
            $row  = $formno->result_array();
            $formno = $row[0]['formno']+1; //formnovalid+1;
            return $formno;
        }
        else
        {
            $row  = $formno->result_array();
            $formno = $row[0]['formno']+1;
            return $formno;
        }

    }
    public function updateReg11Data($formno,$pkid,$kpo){

        $data2 = array
        (
            'IsDeleted'=>0,
            'ckpo'=>$kpo,
            'spl_cd'=>0,
            'cdate'=>date('Y-m-d H:i:s'),
        );
        $this->db->where('formno',$formno);
        $res= $this->db->update("Registration..tblreg11th", $data2);

       /* $data2 = array(
            'active'=>0,

        );   */
       // $this->db->where('pkid',$pkid);
      //  $res= true; //$this->db->update("Registration..tblElegibiltyReg11th", $data2);
        return $res;
    }
    public function getcorrection9th()
    {

        $this->db->select('Registration..temp9thcor.inst_cd, admission_online..tblInstitutes_all.name');    
        $this->db->join('admission_online..tblInstitutes_all', 'admission_online..tblInstitutes_all.inst_cd=Registration..temp9thcor.inst_cd');    
        $this->db->where('Registration..temp9thcor.inst_cd', '161149');    
        $this->db->group_by('Registration..temp9thcor.inst_cd,admission_online..tblInstitutes_all.name');
        $this->db->order_by('Registration..temp9thcor.inst_cd', 'ASC');    
        $query = $this->db->get('Registration..temp9thcor');

        if($query->result() == TRUE)    
        {    
            foreach($query->result_array() as $row)
            {
                $result[] = $row;
            }
            return $result;
        }
        else
        {
            return  false;; 
        }

    }
    public function getcorrection11th()
    {

        $this->db->select('Registration..temp11thcor.inst_cd, admission_online..tblInstitutes_all.name');    
        $this->db->join('admission_online..tblInstitutes_all', 'admission_online..tblInstitutes_all.inst_cd=Registration..temp11thcor.inst_cd');    
        //$this->db->where('Registration..temp11thcor.inst_cd', '211001');    
        $this->db->group_by('Registration..temp11thcor.inst_cd,admission_online..tblInstitutes_all.name');
        $this->db->order_by('Registration..temp11thcor.inst_cd', 'ASC');    
        $query = $this->db->get('Registration..temp11thcor');

        if($query->result() == TRUE)    
        {    
            foreach($query->result_array() as $row)
            {
                $result[] = $row;
            }
            return $result;
        }
        else
        {
            return  false;; 
        }

    }
    public function getcorrection11thbyinst($inst_cd)
    {

        $this->db->select('Registration..temp11thcor.formno, Registration..temp11thcor.columnName,Registration..temp11thcor.PreviousValue,Registration..temp11thcor.NewValue,Registration..temp11thcor.cdate,Registration..temp11thcor.bindno,Registration..temp11thcor.rno,Registration..temp11thcor.srno');    
        // $this->db->join('admission_online..tblInstitutes_all', 'admission_online..tblInstitutes_all.inst_cd=Registration..temp9thcor.inst_cd');    
        // $this->db->group_by('Registration..temp9thcor.inst_cd,admission_online..tblInstitutes_all.name');
        $this->db->where('Registration..temp11thcor.inst_cd', $inst_cd);    
        $this->db->order_by('Registration..temp11thcor.formno', 'ASC');    
        $query = $this->db->get('Registration..temp11thcor');

        if($query->result() == TRUE)    
        {    
            foreach($query->result_array() as $row)
            {
                $result[] = $row;
            }
            return $result;
        }
        else
        {
            return  false;; 
        }

    }
    public function getcorrection9thbyinst($inst_cd)
    {

        $this->db->select('Registration..temp9thcor.formno, Registration..temp9thcor.columnName,Registration..temp9thcor.PreviousValue,Registration..temp9thcor.NewValue,Registration..temp9thcor.cdate,Registration..temp9thcor.bindno');    
        // $this->db->join('admission_online..tblInstitutes_all', 'admission_online..tblInstitutes_all.inst_cd=Registration..temp9thcor.inst_cd');    
        // $this->db->group_by('Registration..temp9thcor.inst_cd,admission_online..tblInstitutes_all.name');
        $this->db->where('Registration..temp9thcor.inst_cd', '161149');    
        $this->db->order_by('Registration..temp9thcor.formno', 'ASC');    
        $query = $this->db->get('Registration..temp9thcor');

        if($query->result() == TRUE)    
        {    
            foreach($query->result_array() as $row)
            {
                $result[] = $row;
            }
            return $result;
        }
        else
        {
            return  false;; 
        }

    }

}
?>
