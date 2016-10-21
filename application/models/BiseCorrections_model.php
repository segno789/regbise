<?php
class BiseCorrections_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
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

    public function biseauth($username,$password) 
    {
        //  DebugBreak();
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
    public function getmigration($class)
    {
        if($class == 9)
        {
            $table1= TBLMIGRATION2;
            $table2= 'Registration..MA_P1_Reg_Adm2016';
            $this->db->select("$table2.RegGrp,$table2.formno,$table2.name,$table2.fname,$table2.Dob,$table2.grp_cd,$table2.PicPath,$table1.Migrated_to,$table1.Migrated_From");
            $this->db->from($table2);
            //join LEFT by default
            $this->db->join($table1, "$table1.formno=$table2.formno");
            $this->db->where("$table2.isdeleted = 0 and $table2.oldinst_cd = 0 and $table1.iyear =  2016 and $table1.class=9"); 
        }
        if($class == 10)
        {
            $table1= TBLMIGRATION1;
            $table2= TBLMIGRATION3;
            
           // $this->db->select('rno');
           // $this->db->from($table2);
            //$this->db->where("$table2.iyear =  2016 and $table2.class=9 and $table2.ismigrated =1");  
            $where_clause = "SELECT rno FROM $table2 WHERE $table2.iyear =  2016 and $table2.class=9 and $table2.ismigrated =1";
           
            
            $this->db->select("$table1.rno,$table1.name,$table1.fname,$table1.strregno,$table1.Migrated_to,$table1.Migrated_From,$table1.ismigrated");
            $this->db->from($table1);
            $this->db->where("$table1.iyear =  2016 and $table1.class=9 and $table1.ismigrated is null and $table1.rno NOT IN($where_clause) ");  
        }
           if($class == 11)
        {
        //DebugBreak();
            $table1= TBLMIGRATION2;
            $table2= 'Registration..IA_P1_Reg_Adm2016';
            $this->db->select("$table2.RegGrp,$table2.Formno,$table2.name,$table2.fname,$table2.grp_cd,$table2.PicPath,$table1.Migrated_to,$table1.Migrated_From");
            $this->db->from($table2);
            //join LEFT by default
            $this->db->join($table1, "$table1.formno=$table2.Formno");
            $this->db->where("$table2.isdeleted = 0 and ($table2.oldinst_cd = 0 or $table2.oldinst_cd is null) and $table1.iyear =  2016 and $table1.class=11"); 
        }
         if($class == 12)
        {
            $table1= TBLMIGRATION1;
            $table2= TBLMIGRATION3;
            
           // $this->db->select('rno');
           // $this->db->from($table2);
            //$this->db->where("$table2.iyear =  2016 and $table2.class=9 and $table2.ismigrated =1");  
            $where_clause = "SELECT rno FROM $table2 WHERE $table2.iyear =  2016 and $table2.class=11 and $table2.ismigrated =1";
           
            
            $this->db->select("$table1.rno,$table1.name,$table1.fname,$table1.strregno,$table1.Migrated_to,$table1.Migrated_From,$table1.ismigrated");
            $this->db->from($table1);
            $this->db->where("$table1.iyear =  2016 and $table1.class=11 and $table1.ismigrated is null and $table1.rno NOT IN($where_clause) ");  
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
            $table2= 'Registration..MA_P1_Reg_Adm2016';
            $this->db->select("$table2.RegGrp,$table2.formno,$table2.name,$table2.fname,$table2.Dob,$table2.grp_cd,$table2.PicPath,$table2.sch_cd,$table2.oldinst_cd");
            $this->db->from($table2);

            $this->db->where("$table2.isdeleted = 0 AND $table2.oldinst_cd <>0 "); 
        }
        else  if($class == 10)
        {
            $table1= TBLMIGRATION3;
            $this->db->select("$table1.rno,$table1.name,$table1.fname,$table1.strregno,$table1.Migrated_to,$table1.Migrated_From");
            $this->db->from($table1);

            $this->db->where("$table1.iyear =  2016 and $table1.class=9 and $table1.ismigrated = 1 ");     
        }
        else  if($class == 12)
        {
            $table1= TBLMIGRATION3;
            $this->db->select("$table1.rno,$table1.name,$table1.fname,$table1.strregno,$table1.Migrated_to,$table1.Migrated_From");
            $this->db->from($table1);

            $this->db->where("$table1.iyear =  2016 and $table1.class=11 and $table1.ismigrated = 1 ");     
        }
        else if($class == 11)
        {
            $table2= 'Registration..IA_P1_Reg_Adm2016';
            $this->db->select("$table2.RegGrp,$table2.formno,$table2.name,$table2.fname,$table2.grp_cd,$table2.PicPath,$table2.coll_cd,$table2.oldinst_cd");
            $this->db->from($table2);

            $this->db->where("$table2.isdeleted = 0 AND $table2.oldinst_cd <>0 "); 
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

        //  DebugBreak();

        $query = $this->db->get_where('Registration..MA_P1_Reg_Adm2016',  array('formNo' => $formno,'class'=>9,'iyear'=>2016,'sess'=>1));     
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
    public function GetInstNamebyId($isnt){
        $this->db->select('Name');
        $this->db->from('Admission_Online..tblInstitutes_all');
        $where = '(edu_lvl=1 or edu_lvl = 3)';
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
    public function Insert_SpecPermison($data)
    {
        $query = $this->db->insert('Registration..inst_Special_Permission_9th', $data);//,'Fname' => $father_name,'BForm'=>$bay_form,'FNIC'=>$father_cnic,'Dob'=>$dob,'CellNo'=>$mob_number));
        //DebugBreak();
        return $query;
    }

    public function Batch_List()
    {
        //DebugBreak();

        $q2         = $this->db->get_where('Registration..fl_reg_batch_test',array('flag'=>1,'Is_Delete'=>0));
        $result = $q2->result_array();
        return $result;
    }
    public function Batch_List_all()
    {
        //DebugBreak();

        $q2         = $this->db->get_where('Registration..fl_reg_batch_test',array('flag is'=>null,'Is_Delete'=>0));
        $result = $q2->result_array();
        return $result;
    }
    public function get9thCorrectionData()
    {
        //DebugBreak();

        $q2         = $this->db->get_where('Registration..MA_P1_Reg_Correction',array('IsDeleted'=>0,'IsCorr'=>1));
        $result = $q2->result_array();
        return $result;
    }
    
      public function get11thCorrectionData()
    {
        //DebugBreak();

        $q2         = $this->db->get_where('Registration..IA_P1_Reg_Correction',array('IsDeleted'=>0,'IsCorr'=>1));
        $result = $q2->result_array();
        return $result;
    }
    public function get11thCorrectionDataById($app_id)
    {
        //DebugBreak();

        $q2         = $this->db->get_where('Registration..IA_P1_Reg_Correction',array('IsDeleted'=>0,'IsCorr'=>1 , 'AppNo'=>$app_id));
        $result = $q2->result_array();
        return $result;
    }
    public function get9thCorrectionDataById($app_id)
    {
        //DebugBreak();

        $q2         = $this->db->get_where('Registration..MA_P1_Reg_Correction',array('IsDeleted'=>0,'IsCorr'=>1 , 'AppNo'=>$app_id));
        $result = $q2->result_array();
        return $result;
    }
     public function get11thCorrectionData_verified()
    {
        //DebugBreak();

        $q2         = $this->db->get_where('Registration..IA_P1_Reg_Correction',array('IsDeleted'=>0,'IsCorr'=>2));
        $result = $q2->result_array();
        return $result;
    }

    public function get9thCorrectionData_verified()
    {
        //DebugBreak();

        $q2         = $this->db->get_where('Registration..MA_P1_Reg_Correction',array('IsDeleted'=>0,'IsCorr'=>2));
        $result = $q2->result_array();
        return $result;
    }

    public function Batch_List_Deleted()
    {
        //DebugBreak();

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
        //DebugBreak();
        $query = $this->db->query("Registration..Update_corrections_new_1 $AppNo,$ckpo");
        $rowcount = $query->num_rows();
        return true;
    }
    
     public function reg11thCorrection_UPDATE($fetch_data)
    {

        // $Inst_cd = $fetch_data['Inst_Cd'];
        $AppNo = $fetch_data['AppNo'];
        $ckpo = $fetch_data['ckpo'];
        //DebugBreak();
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

        // DebugBreak();
        $data2 = array(
            'ckpo'=>$kpo,
            'cDate'=>date('Y-m-d H:i:s'),
            'IsDeleted'=>$isDeleted,
        );
        $this->db->where('formNo',$formno);
        $this->db->update("Registration..MA_P1_Reg_Adm2016", $data2);
    }

    //Restore_Form_UPDATE
    public function Restore_candidate_list($ckpo)
    {
        $q2         = $this->db->get_where('Registration..MA_P1_Reg_Adm2016',array('IsDeleted'=>1,'ckpo'=>$ckpo));
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
     public function update11MigData($formno,$newInst,$oldInst,$kpo)
    {

        $data2 = array(
            'coll_cd'=>$newInst,
            'oldinst_cd'=>$oldInst,
            'ckpo'=>$kpo,
            'cDate'=>date('Y-m-d H:i:s'),
        );
        $this->db->where('Formno',$formno);
        $res =  $this->db->update(TBLMIGRATION_11th, $data2);

        if ($res === FALSE) {
            return -1; // Or do whatever you gotta do here to raise an error
        } else {
            return $this->db->affected_rows();
        }
    }
    public function update10MigData($formno,$kpo,$isupdate,$newinst_cd){
       //   DebugBreak();
        if($isupdate == 1)
        {
           $stdinfo =  $this->getstdrecord($formno) ;
            $data2 = array(
                'Rno'=>$formno,
                'iyear'=>2016,
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
            
            $this->db->where("rno = $formno AND class=9 and iyear=2016");
            $res =  $this->db->update(TBLMIGRATION3, $data2);
        }

       

        if ($res === FALSE) {
            return -1; // Or do whatever you gotta do here to raise an error
        } else {
            return $this->db->affected_rows();
        }
    }
    public function update12MigData($formno,$kpo,$isupdate,$newinst_cd){
       //   DebugBreak();
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
            
            $this->db->where("rno = $formno AND class=11 and iyear=2016");
            $res =  $this->db->update(TBLMIGRATION3, $data2);
        }

       

        if ($res === FALSE) {
            return -1; // Or do whatever you gotta do here to raise an error
        } else {
            return $this->db->affected_rows();
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
}
?>
