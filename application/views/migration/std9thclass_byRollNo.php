<div class="dashboard-wrapper class wysihtml5-supported">
    <div class="left-sidebar">

        <div class="row-fluid">
            <div class="span12">
                <div class="widget no-margin">
                    <div class="widget-header">
                        <div class="title">
                            9th By Roll Number<a data-original-title="" id="notifications">s</a>
                        </div>

                    </div>
                    <div class="widget-body">

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
                                        <th style="width:20%">
                                            Name
                                        </th>
                                        <th style="width:20%">
                                            Father's Name
                                        </th>
                                        <th style="width:5%" class="hidden-phone">
                                            DOB
                                        </th>
                                        <th style="width:20%" class="hidden-phone">
                                            Subject Group
                                        </th>
                                        <th style="width:11%" class="hidden-phone">
                                            Selected Subjects
                                        </th>
                                        <!--<th style="width:4%" class="hidden-phone">
                                            Picture
                                        </th> -->
                                        <th style="width:18%" class="hidden-phone" >
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
    function generatepath($rno,$class,$year,$sess)
    {
      $basepath = 'F:\xampp\htdocs\Share Images\OldPics';
      $clsvr = '';
      $picyear= substr($year, -2);
      $folderno = '';
      if($class == 10  OR $class == 09)
      {
         $clsvr = 'MA'; 
        
      }
      else if($class == 12  OR $class == 11)
      {
          $clsvr = 'IA';
      }

      if($rno>100001 && $rno<=150000)
      {
          $folderno = '1st';
      }
      else if($rno>150001 && $rno<=200000)
      {
          $folderno = '2nd';
      }
      else if($rno>200001 && $rno<=250000)
      {
          $folderno = '3rd';
      }
      else if($rno>250001 && $rno<=300000)
      {
          $folderno = '4th';
      }
      else if($rno>300001 && $rno<=350000)
      {
          $folderno = '5th';
      }
      else if($rno>350001 && $rno<400000)
      {
          $folderno = '6th';
      }
      else if($rno>400001 && $rno<=450000)
      {
          $folderno = '7th';
      }
      else if($rno>450001 && $rno<=450000)
      {
          $folderno = '8th';
      }
      else if($rno>450001 && $rno<500000)
      {
          $folderno = '9th';
      }
      else if($rno>500001 && $rno<550000)
      {
          $folderno = '10th';
      }
      else if($rno>550001 && $rno<600000)
      {
          $folderno = '11th';
      }
      
      
      $pic = 'Pic'.$clsvr.'-'.$picyear ;
      
      $foldername =   $clsvr.  $folderno .$picyear;
      $basepath =  $basepath.'\\'.$pic.'\\'. $foldername;
         
    }
                                    //select '"'+SUB_ABR+'" =>"'+convert(varchar(20), SUB_CD) +'",',* from matric..tblSubject_NewSchm
                                    $subarray = array(

                                        "U" =>"1",
                                        "E" =>"2",
                                        "ISL" =>"3",
                                        "PS" =>"4",
                                        "M" =>"5",
                                        "PHY" =>"6",
                                        "CH" =>"7",
                                        "BIO" =>"8",
                                        "GSC" =>"9",
                                        "FED" =>"10",
                                        "GEO(PAK)" =>"11",
                                        "HA&RP" =>"12",
                                        "EHE" =>"13",
                                        "P&H" =>"14",
                                        "GTD" =>"15",
                                        "GEOL" =>"16",
                                        "A&SS" =>"17",
                                        "ART&MD" =>"18",
                                        "IST" =>"19",
                                        "IH" =>"20",
                                        "HP" =>"21",
                                        "AR" =>"22",
                                        "PR" =>"23",
                                        "GEO" =>"24",
                                        "ECO" =>"25",
                                        "CIV" =>"26",
                                        "F&N" =>"27",
                                        "AHE" =>"28",
                                        "MBH" =>"29",
                                        "C&T" =>"30",
                                        "CD&FL" =>"31",
                                        "MSC" =>"32",
                                        "CG" =>"33",
                                        "U/LIT" =>"34",
                                        "E/LIT" =>"35",
                                        "PUN" =>"36",
                                        "EDU" =>"37",
                                        "EN&FA" =>"38",
                                        "PHO" =>"39",
                                        "HPD" =>"40",
                                        "CALI" =>"41",
                                        "L(C)" =>"42",
                                        "EW" =>"43",
                                        "RE" =>"44",
                                        "COM" =>"45",
                                        "AGR" =>"46",
                                        "BKA" =>"47",
                                        "WW(FM)" =>"48",
                                        "GAGRI" =>"49",
                                        "F/ECO" =>"50",
                                        "ETH" =>"51",
                                        "LSF" =>"52",
                                        "AP" =>"53",
                                        "PI&FC" =>"54",
                                        "HORT" =>"55",
                                        "PHE" =>"56",
                                        "RA" =>"57",
                                        "H&ME" =>"58",
                                        "D&GM" =>"59",
                                        "HM&NC" =>"60",
                                        "ST&DM" =>"61",
                                        "C&B" =>"62",
                                        "PFV&F" =>"63",
                                        "C&GC" =>"64",
                                        "FHHM" =>"65",
                                        "ARTH" =>"66",
                                        "BAKE" =>"67",
                                        "CM" =>"68",
                                        "DRAW" =>"69",
                                        "EMB" =>"70",
                                        "HIS" =>"71",
                                        "TAIL" =>"72",
                                        "TYPE" =>"73",
                                        "WEAV" =>"74",
                                        "SRP" =>"75",
                                        "CM" =>"76",
                                        "SPC" =>"77",
                                        "CSC" =>"78",
                                        "WW(BM)" =>"79",
                                        "P/AR" =>"80",
                                        "SERT" =>"81",
                                        "QUR" =>"82",
                                        "POUL" =>"83",
                                        "ART/M" =>"84",
                                        "B-Std" =>"85",
                                        "H&F" =>"86",
                                        "E/ST" =>"87",
                                        "R/AC" =>"88",
                                        "F/FRM" =>"89",
                                        "CHW" =>"90",
                                        "BEAT" =>"91",
                                        "GMath" =>"92",
                                        "CSC/D" =>"93",
                                        "HPD/D" =>"94",

                                    );
                                   // $result =  array_search($data[0]['sub4'],$subarray);
                                    // DebugBreak();
                                    if($data != false)
                                    {
                                        $n=0;  
                                        $grp_name='';                             
                                        foreach($data as $key=>$vals):
                                        $vals['picPath'] = "";//generatepath($vals["rno"],$vals["class"],$vals["Iyear"],$vals["sess"]);
                                        $n++;
                                        $formno = !empty($vals["rno"])?$vals["rno"]:"N/A";
                                        $grp_name = $vals["grp_cd"];
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

                                        echo '<tr  >
                                        <td>'.$n.'</td>
                                        <td>'.$formno.'</td>
                                        <td>'.$vals["name"].'</td>
                                        <td>'.$vals["Fname"].'</td>
                                        <td>'.date("d-m-Y", strtotime($vals["Dob"])).'</td>
                                        <td>'.$grp_name.'</td>
                                        <td>'.array_search($vals['sub1'],$subarray).','.array_search($vals['sub2'],$subarray).','.array_search($vals['sub3'],$subarray).','.array_search($vals['sub4'],$subarray).','.array_search($vals['sub5'],$subarray).','.array_search($vals['sub6'],$subarray).','.array_search($vals['sub7'],$subarray).','.array_search($vals['sub8'],$subarray).'</td>
                                       ';
                                       // <td><img id="previewImg" style="width:40px; height: 40px;" src="'.base_url().IMAGE_PATH.$Inst_Id.'/'.$vals['picPath'].'" alt="Candidate Image"></td>
                                        echo'<td>
                                        <button type="button" class="btn btn-info" value="'.$formno.'" onclick="releasemForm_byRollNo('.$vals['formNo'].')">Release</button>
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

