<?php

class Migration_model extends CI_Model 
{
    public function __construct()    
    {

        $this->load->database(); 



    }
     public function std9thclass($inst_cd)
    {

        $query = $this->db->query("Registration..[sp_get_regmigration] $inst_cd,9,2016,1");    
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
      public function std9thclass_byrollno($inst_cd)
    {
        $where = ' (spl_cd =  17 OR  spl_cd = 70 OR status=4 OR status=2)';
        $this->db->where('Sch_cd', $inst_cd);
        //   $query = $this->db->get_where(RE_ADMISSION_TBL,  array('rno' => $RollNo));
        $query = $this->db->where($where);
        $query = $this->db->get(RE_ADMISSION_TBL);
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
     public function readmission_check($rno)
    {
        //DebugBreak();
      //  $Inst_cd = $User_info_data['Inst_Id'];
        //$RollNo = $User_info_data['RollNo'];
        //$spl_cd = $User_info_data['spl_case'];

        // $forms_id = $User_info_data['forms_id'];

        $where = ' (spl_cd =  17 OR  spl_cd = 70 OR status=4 OR status=2)';
        $this->db->where('rno', $rno);
        //   $query = $this->db->get_where(RE_ADMISSION_TBL,  array('rno' => $RollNo));
        $query = $this->db->where($where);
        $query = $this->db->get(RE_ADMISSION_TBL11);
        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {

            $result_1 = $query->result_array();

            return  $result_1;
        }
        else
        {
            return  false;
        }
    }
    public function Print_challan_Form($fetch_data)
    {
        $Inst_cd = $fetch_data['Inst_cd'];
        $formno = $fetch_data['formno'];
      
     // DebugBreak();
        $query = $this->db->query("Registration..sp_get_regInfo_correction_challan $Inst_cd,9,2016,1,'$formno'");
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
    public function updatemigratefrom($info)
    {

         $this->db->select('app_No');
        $this->db->order_by("app_No", "DESC");
        $formno = $this->db->get_where(TBLMIGRATIONTESTING3);
        $rowcount = $formno->num_rows();
        // DebugBreak();
        if($rowcount == 0 )
        {
            $formno =  (NOC_APP_NO.'1' );
           // return $formno;
        }
        else
        {
            $row  = $formno->result_array();
            
            $formno = $row[0]['app_No']+1;
           // return $formno;
        }
        
        $app_no =   $formno;
       /* $queryX = $this->db->query("EXEC Registration..GenChallNo 1,1,1");
        $rowcountX = $queryX->num_rows();
       $res = $queryX->result_array();
        if($rowcountX > 0)
        {
            return $queryX->result_array();
        }
        else
        {
            return  false;
        }
        
        $challNo = $res;*/
        $data2 = array(
            'app_no'=>$app_no,
            'Formno'=>$info['formno'],
            'class'=>$info['myclass'],
            'iyear'=>2016,
            'sess'=>1,
            'name'=>$info['name'],
            'fname'=>$info['fname'],
            'fnic'=>$info['fnic'],
            'Migrated_From'=>$info['migfrom'],
            'Migrated_to'=>$info['migto'],
            'ekpo'=>$info['migfrom'],
            'sex'=>$info['sex'],
            'isother'=>0,

        );  
        $res =  $this->db->insert(TBLMIGRATIONTESTING3, $data2);
        return $res;
    }
    public function updatemigratefrom_byRollNo($info)
    {

         $this->db->select('app_No');
        $this->db->order_by("app_No", "DESC");
        $formno = $this->db->get_where(TBLMIGRATIONTESTING3);
        $rowcount = $formno->num_rows();
//         DebugBreak();
        if($rowcount == 0 )
        {
            $formno =  (NOC_APP_NO.'1' );
           // return $formno;
        }
        else
        {
            $row  = $formno->result_array();
            
            $formno = $row[0]['app_No']+1;
           // return $formno;
        }
        
        $app_no =   $formno;
       /* $queryX = $this->db->query("EXEC Registration..GenChallNo 1,1,1");
        $rowcountX = $queryX->num_rows();
       $res = $queryX->result_array();
        if($rowcountX > 0)
        {
            return $queryX->result_array();
        }
        else
        {
            return  false;
        }
        
        $challNo = $res;*/
        $data2 = array(
            'app_no'=>$app_no,
            'rno'=>$info['rno'],
            'class'=>$info['myclass'],
            'iyear'=>2016,
            'sess'=>1,
            'name'=>$info['name'],
            'fname'=>$info['fname'],
            'fnic'=>$info['fnic'],
            'Migrated_From'=>$info['migfrom'],
            'Migrated_to'=>$info['migto'],
            'ekpo'=>$info['migfrom'],
            'sex'=>$info['sex'],
            'isother'=>0,

        );  
        $res =  $this->db->insert(TBLMIGRATIONTESTING3, $data2);
        return $res;
    }
    public function getrelease9thstd($inst)
    {
       // DebugBreak();
        $q2         = $this->db->get_where(TBLMIGRATIONTESTING3,array('isother'=>0,'ekpo'=>$inst,'Rno'=>null));
        $result = $q2->result_array();
        return $result;
    }
     public function getrelease9thstd_byRollNo($inst)
    {
       // DebugBreak();
        $q2         = $this->db->get_where(TBLMIGRATIONTESTING3,array('isother'=>0,'ekpo'=>$inst,'Formno'=>null));
        $result = $q2->result_array();
        return $result;
    }
    public function getinfoAll($AppNo)
    {
    
    //DebugBreak();
        $query = $this->db->query("Registration..sp_get_reg_Print_Form_Migration $AppNo");
        $result = $query->result_array();
        return $result;
    
    }
    public function getinfoAll_byRollNo($AppNo)
    {
    
//    DebugBreak();
        $query = $this->db->query("Registration..sp_get_reg_Print_Form_Migration_byRollNo $AppNo");
        $result = $query->result_array();
        return $result;
    
    }
     public function getappbyid($id)
    {
        $q2         = $this->db->get_where(TBLMIGRATIONTESTING3,array('isother'=>0,'app_No'=>$id));
        $result = $q2->result_array();
        return $result;
    }
    
     public function std11thclass($inst_cd)
    {

        $query = $this->db->query("Registration..[sp_get_regmigration] $inst_cd,11,2016,1");    
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
     public function std11thclass_byRollNo($inst_cd)
    {

        $where = ' (spl_cd =  17 OR  spl_cd = 70 OR status=4 OR status=2)';
        $this->db->where('coll_cd', $inst_cd);
        //   $query = $this->db->get_where(RE_ADMISSION_TBL,  array('rno' => $RollNo));
        $query = $this->db->where($where);
        $query = $this->db->get(RE_ADMISSION_TBL11);
        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {

            $result_1 = $query->result_array();

            return  $result_1;
        }
        else
        {
            return  false;
        }
    }
    
}
?>
