<?php
    function generatepath($rno,$class,$year,$sess)
    {
        $basepath = DIRPATHMIG2;
        $clsvr = '';
        $picyear= substr($year, -2);
        $folderno = '';
        if($class == 10  OR $class == 9)
        {
            $clsvr = 'MA'; 

        }
        else if($class == 12  OR $class == 11)
        {
            $clsvr = 'IA';
        }

        if($rno>=100001 && $rno<=150000)
        {
            $folderno = '1st';
        }
        else if($rno>=150001 && $rno<=200000)
        {
            $folderno = '2nd';
        }
        else if($rno>=200001 && $rno<=250000)
        {
            $folderno = '3rd';
        }
        else if($rno>=250001 && $rno<=300000)
        {
            $folderno = '4th';
        }
        else if($rno>=300001 && $rno<=350000)
        {
            if($class ==  10 OR $class ==  9)
            $folderno = '5th';
            else if($class ==  12 OR $class ==  11)
            $folderno = '6th';
        }
        else if($rno>=350001 && $rno<400000)
        {
             if($class ==  10 OR $class ==  9)
            $folderno = '6th';
            else if($class ==  12 OR $class ==  11)
            $folderno = '7th';
        }
        else if($rno>=400001 && $rno<=450000)
        {
            if($class ==  10 OR $class ==  9)
            $folderno = '7th';
            else if($class ==  12 OR $class ==  11)
            $folderno = '8th';
           
        }
        else if($rno>=450001 && $rno<=500000)
        {
             if($class ==  10 OR $class ==  9)
            $folderno = '8th';
            else if($class ==  12 OR $class ==  11)
            $folderno = '9th';
        }
        else if($rno>=500001 && $rno<550000)
        {
            $folderno = '9th';
        }
        else if($rno>=550001 && $rno<600000)
        {
            $folderno = '10th';
        }
         else if($rno>=600001 && $rno<650000)
        {
            $folderno = '11th';
        }


        $pic = 'Pic'.$picyear.'-'.$clsvr ;

        $foldername =   $clsvr.  $folderno .$picyear;
        $basepath =  $basepath.'\\'.$pic.'\\'. $foldername.'\\';
        return  $basepath.$rno.".jpg";
    }

?>


<div class="dashboard-wrapper class wysihtml5-supported">
    <div class="left-sidebar">

        <div class="row-fluid">
            <div class="span12">
                <div class="widget no-margin">
                    <div class="widget-header">
                        <div class="title">
                            Release 11th Registration Students By Roll No.<a data-original-title="" id="notifications"></a>
                        </div>
                        
                    </div>
                    <div class="widget-body">
                        <h4>
                            View All Submited Forms:
                        </h4>
                        <hr>
                        <div id="dt_example" class="example_alt_pagination">
                            <table class="table table-condensed table-striped table-hover table-bordered pull-left" id="data-table">
                                <thead>
                                    <tr>
                                        <th style="width: 1%;">
                                            Sr.No.
                                        </th>
                                         <th style="width:5%">
                                            App.No.
                                        </th>
                                        <th style="width:5%">
                                            Roll No.
                                        </th>
                                        <th style="width:20%">
                                            Name
                                        </th>
                                        <th style="width:20%">
                                            Father's Name
                                        </th>
                                       
                                         <th style="width:4%" class="hidden-phone">
                                            Picture
                                        </th>
                                        <th style="width:18%" class="hidden-phone" >
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                   // DebugBreak();
                                    if($data != false)
                                    {
                                    $n=0;  
                                    $grp_name='';                             
                                    foreach($data as $key=>$vals):
                                    $n++;
                                    $formno = !empty($vals["Rno"])?$vals["Rno"]:"N/A";
                                   $path = generatepath($vals["Rno"],11,2016,1);
                                        $type = pathinfo($path, PATHINFO_EXTENSION);
                                        $data = file_get_contents($path);
                                        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                                    echo '<tr  >
                                    <td>'.$n.'</td>
                                  
                                    <td>'.$vals["app_No"].'</td>
                                      <td>'.$formno.'</td>
                                    <td>'.$vals["name"].'</td>
                                    <td>'.$vals["fname"].'</td>
                                     <td><img id="previewImg" style="width:40px; height: 40px;" src="'.$base64.'" alt="Candidate Image"></td>';
                                    echo'<td>
                                    <button type="button" class="btn btn-info" value="'.$vals["app_No"].'" onclick="downloadchallan('.$vals["app_No"].',1)">Download Challan</button>
                                    <button type="button" class="btn btn-info" value="'.$vals["app_No"].'" onclick="downloadchallan('.$vals["app_No"].',2)">Download Migration Form</button>
                                    </td>
                                    </tr>';
                                    endforeach;
                                    }
                                    ?>
 </tbody>
                            </table>
                            <div class="clearfix"></div>
                        </div>
                        <div class="control-group">
                            <div class="controls controls-row">
                                <label class="label label-important" style="font-size: large;">
                                    Note: Please write "No Image" in the above search to check if any image of candidate is missing or not.
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div> 
</div>
<script type="">
function downloadchallan(app_id,ischallan)
{
    if(ischallan == 2)
    {
     window.location.href = '<?=base_url()?>Migration/Print_migration_Form_Final11th_byRollNo/'+app_id;   
    }
    else if(ischallan == 1)
    {
      window.location.href = '<?=base_url()?>Migration/Print_migration_Form_Final11th_byRollNo/'+app_id;      
    }
     
}
</script>

