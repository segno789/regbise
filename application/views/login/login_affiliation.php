<html lang="en"><!--
    <![endif]--><head>
        <meta charset="utf-8">
        <title>
            BISE GRW - BOARD OF INTERMEDIATE AND SECONDARY EDUCATION GUJRANWALA
        </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <!-- bootstrap css -->

        <link href="<?php echo base_url(); ?>assets/css/icomoon/styleprivateslip.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/icomoon/style.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/main.css" rel="stylesheet"> <!-- Important. For Theming change primary-color variable in main.css  -->
        <!--[if lte IE 7]>
        <script src="css/icomoon-font/lte-ie7.js">
        </script>
        <![endif]-->

    </head>
    <body style="background-color: white !important;">


        <div class="container-fluid">


            <div class="left-sidebar">
                <div id="header">
                    <div class="inHeaderLogin">
                        <a href="" title="BISE Gujranwala" rel="home"><img style="margin-top: 9px;text-align:left;width:150px;float: left;margin-left: 14px;" src="<?php echo base_url(); ?>assets/img/icon.png" alt="Logo BISE GRW"></a>
                        <!--Intimation-->
                        <p style="color: wheat;text-align: center;font-size: 23px;margin-left: 28px;float: left;  margin-top:35px;">Board of Intermediate & Secondary Education, Gujranwala </br></br> <?= TITLE_Affiliation?> Session <?php echo CURRENT_SESS;?></p>
                    </div>
                </div> 
                <div class="row-fluid" >

                    <div class="span12" style="display: none;">
                        <div class="sign-in-container">
                            <form action="#" class="login-wrapper" method="post">
                                <div class="header">
                                    <div class="row-fluid">
                                    <div class="span12 text-center">
                                       <span class="span5"> Please Select</span>
                                      <label class="  span4 radio-inline">
                                                    <input type="radio" name="radio_affiliated" value="1" checked="checked">Not Affiliated
                                                </label>
                                                
                                                <label class=" label-primary span3 radio-inline">
                                                    <input type="radio" name="radio_affiliated" value="2" >Affiliated
                                            </label>
                                            
                                    </div>
                                        <div class="span12">
                                            <h3>Login</h3>
                                           
                                        </div>
                                        <div class="span12">
                                            <p>Fill out the form below to login.</p>
                                            <?php 

                                            if($user_status == 1)
                                            {
                                                echo "<b style='color: #f63131;    font-size: 15px;'>Your UserId/Password is not correct.Please use correct information</b>";
                                            }
                                            else if($user_status == 2)
                                            {
                                                echo "<b style='color: #f63131;    font-size: 15px;'>Only Schools are allowed to downlaod slips.</b>";
                                            }
                                            else if($user_status == 3)
                                            {
                                                echo "<b style='color: #f63131;    font-size: 15px;'>Currently your account is inActive.</b>";
                                            }
                                            else if($user_status == 4)
                                            {
                                                echo "<b style='color: #f63131;    font-size: 13px;'> Your Registration Returns (2014-2016) not submitted. Please contact to Online Registration Branch B.I.S.E. Gujranwala.</b>";
                                            }
                                            else if($user_status == 5)
                                            {
                                                echo "<b style='color: #f63131;    font-size: 13px;'> Plaese wait some maintaince.</b>";
                                            }
                                            else if($user_status == 6)
                                            {
                                                echo "<b style='color: #f63131;    font-size: 13px;'>  Your Institution Students are not Enrolled in Matric Annual 2016.</b>";
                                            }
                                            else if($user_status == 7)
                                            {
                                                echo "<b style='color: #f63131;    font-size: 13px;'>  Your subject Groups are not filled.Please Contact to Affiliations Branch at B.I.S.E Gujranwala.</b>";
                                            }

                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="content">
                                    <div class="row-fluid">
                                  
                                        <div class="span12">
                                          <div>
                                          <h4 id="lbl_inst_email" style="color: green;">Please Provide Institute Email</h4>
                                         
                                          </div>
                                          <input class="input span12 email" id="" name="username" placeholder="Institute Code" required="required" maxlength="6" type="text">
                                        </div>
                                    </div>
                                    <div class="row-fluid">
                                        <div class="span12">
                                            <input class="input span12 password" id="" name="password" placeholder="Password" required="required" type="password">
                                        </div>
                                    </div>
                                </div>
                                <div class="actions">
                               <a onclick="new_reg();" style="color:blue; cursor:pointer ;"><u>Create New Account</u></a>
                                    <input  class="btn-large pull-right btn-info" name="btnLogin" type="submit" value="Login" style="height: 50px; width: 100px;" >
                                    <!-- <a class="link" href="#">Forgot Password?</a>-->
                                    <div class="clearfix"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    <div id="new_user" class="form-horizontal ">
                    <div >
                     <div class="span12">
                        <div class="sign-in-container">
                            <form action="#" class="login-wrapper" method="post">
                             <div class="control-group">
                            <label class="control-label" for="inputFirstName">
                            Please fill out this form
                            </label>
                            
                          </div>
                          <div class="control-group">
                            <label class="control-label" for="inputFirstName">
                              User Name
                            </label>
                            <div class="controls">
                              <input type="text" id="inputFirstName" placeholder="First Name" required>
                            </div>
                          </div>
                          <div class="control-group">
                            <label class="control-label" for="inputFirstName">
                              Email
                            </label>
                            <div class="controls">
                              <input type="email" id="inputFirstName" placeholder="Email" required>
                            </div>
                          </div>
                           <div class="control-group">
                            <label class="control-label" for="inputFirstName">
                              Password
                            </label>
                            <div class="controls">
                              <input type="password" id="txt_pwd" placeholder="Password" required>
                            </div>
                          </div>
                           <div class="control-group">
                            <label class="control-label" for="inputFirstName">
                              Retype Password
                            </label>
                            <div class="controls">
                              <input type="password" id="txt_repwd" placeholder="Re Type Password" required>
                            </div>
                          </div>
                            <div class="control-group">
                            <label class="control-label" for="inputFirstName">
                              CNIC
                            </label>
                            <div class="controls">
                              <input type="text" id="inputFirstName" placeholder="Your CNIC" required>
                            </div>
                          </div>
                            <div class="control-group">
                                <label class="control-label" for="inputFirstName" id="error">
                              </label> 
                            <div class="controls">
                                   <input  class="btn-large  btn-info" name="btnLogin" type="submit" value="Register"  >
                            </div>
                          </div>
                          </form>
                          </div>
                          </div>
                     </div>
                          
                    </div>



                </div>
                
                <div id="header" style=" position: fixed;left: 50%;bottom: -30px;transform: translate(-50%, -50%);margin: 0 auto;">
                    <div class="inFooterLogin">
                        <div id="copyright" style="    color: wheat;font-size: 16px;padding-top: 20px;text-align: center;">
                            © 2016 <a href="http://www.bisegrw.com" style="color: wheat;">www.bisegrw.com</a> | Powered by Bisegrw  Development Team 
                        </div>
                    </div>
                </div> 
            </div>
            <!--/.fluid-container-->
        </div>
        <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
        <script type="text/javascript">
            $('a').tooltip('hide');
            $('.popover-pop').popover('hide');
            //Collapse
            $('#myCollapsible').collapse({
                toggle: false
            })
            $("[name='radio_affiliated']").click(function (){
            //alert(this.value);
            if(this.value == 1 )
            {
              $("#lbl_inst_email").text("Please Provide Institute Email").css('color','green').effect( "highlight", {color:"#669966"}, 3000 );
            }
            else 
            {
              $("#lbl_inst_email").text("Please Provide Institute Code").css('color','darkblue');
            }
             
              // $("#lbl_inst_code").show();
            });
            
            $("#txt_repwd").focusout(function(){
                     confirm_pwd();
                    
            });
            function confirm_pwd()
            {
               var pwd = $("#txt_pwd").val();
               var repwd = $("#txt_repwd").val();
               if(pwd != repwd)
               {
               $("#error").text("Please type same as above password");
               $("#txt_repwd").focus();
               $(this).css("background-color", "#FFFFFF");
               return;
               }
            }
            function new_reg()
            {
            
            }
        </script>
        <script type="text/javascript" async="async" defer="defer" data-cfasync="false" src="https://mylivechat.com/chatinline.aspx?hccid=93646887"></script>
    </body></html>