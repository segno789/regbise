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
    public function get9thCorrectionDataById($app_id)
    {
        //DebugBreak();
       
        $q2         = $this->db->get_where('Registration..MA_P1_Reg_Correction',array('IsDeleted'=>0,'IsCorr'=>1 , 'AppNo'=>$app_id));
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
      public function Batch_List_RESTORE($fetch_data)
    {
        
        $Inst_cd = $fetch_data['Inst_Cd'];
        $Batch_Id = $fetch_data['BatchId'];
        $ckpo = $fetch_data['ckpo'];
        
        $query = $this->db->query("Registration..Restore_Batch_By_BoardOperator $Inst_cd,$Batch_Id,$ckpo");
        $rowcount = $query->num_rows();
        return true;
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
}
?>
