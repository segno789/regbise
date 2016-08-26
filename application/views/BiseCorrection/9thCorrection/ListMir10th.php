<div class="dashboard-wrapper class wysihtml5-supported" style="background: white;">
<div class="left-sidebar">
    <div class="row-fluid">
        <div class="span12">
            <div class="widget">
                <div class="widget-header">
                    <div class="title">
                        List of 10th Migration <a id="redgForm" data-original-title=""></a>
                    </div>
                </div>
           
                <div class="widget-body">
                        <h4>
                            All 10th Migrated Forms:
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
                                            Roll No.
                                        </th>
                                        <th style="width:10%">
                                            Name
                                        </th>
                                        <th style="width:10%">
                                            Father's Name
                                        </th>
                                       
                                      
                                        <th style="width:8%" class="hidden-phone" >
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    if($migration != false)
                                    {
                                        $n=0;  
                                        $grp_name='';                             
                                        foreach($migration as $key=>$vals):
                                        $n++;
                                        $formno = !empty($vals["rno"])?$vals["rno"]:"N/A";
                                      
                                        echo '<tr  >
                                        <td>'.$n.'</td>
                                        <td>'.$formno.'</td>
                                        <td>'.$vals["name"].'</td>
                                        <td>'.$vals["fname"].'</td>';

                                        echo'<td>
                                        <button type="button" class="btn btn-info" value="'.$formno.'" onclick="migrateto('.$formno.','.$vals['Migrated_to'].')">Restore</button>
                                        </td>
                                        </tr>';
                                        endforeach;
                                    }
                                    ?>
 </tbody>
                            </table>
                            <div class="clearfix"></div>
                        </div>
                     
                    </div>
                
                
            </div>  

        </div>
    </div>
</div>
<script type="text/javascript">



    function CancelAlert()
    {
        var msg = "Are You Sure You want to Cancel this Form ?"
        alertify.confirm(msg, function (e) {
            if (e) {
                // user clicked "ok"
                window.location.href ="<?php echo base_url(); ?>index.php/Registration/index/7";
            } else {
                // user clicked "cancel"

            }
        });
    }
    function migrateto(formno,inst_cd,oldinst)
    {
        window.location.href ="<?php echo base_url(); ?>bisecorrection/restoreMigration/10/"+formno+"/"+inst_cd; 
    }
</script>