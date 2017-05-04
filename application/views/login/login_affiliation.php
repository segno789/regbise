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

        <link href="<?php  echo base_url(); ?>assets/css/icomoon/styleprivateslip.css" rel="stylesheet">
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
                        <a href="" title="BISE Gujranwala" rel="home"><img style="margin-top: 9px;text-align:left;width:150px;float: left;margin-left: 14px;" src="<?php  echo base_url(); ?>assets/img/icon.png" alt="Logo BISE GRW"></a>
                        <!--Intimation-->
                        <p style="color: wheat;text-align: center;font-size: 23px;margin-left: 28px;float: left;  margin-top:35px;">Board of Intermediate & Secondary Education, Gujranwala </br></br> <?= TITLE_Affiliation?> </p>
                    </div>
                </div> 
                <div class="row-fluid" >

                    <div class="span12" id="div_login">
                        <div class="sign-in-container">
                            <form action="<?php echo base_url();?>Login_affiliation" id="loginForm" class="login-wrapper" method="post">
                                <div class="header">
                                    <div class="row-fluid">
                                       <!-- <div class="span12 text-center">
                                            <span class="span5"> Please Select</span>
                                            <label class="  span4 radio-inline">
                                                <input type="radio" name="radio_affiliated" value="1" checked="checked">Not Affiliated
                                            </label>

                                            <label class=" label-primary span3 radio-inline">
                                                <input type="radio" name="radio_affiliated" value="2" >Affiliated
                                            </label>

                                        </div>    -->
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
                                                
                                            <select name="ddlAffiliated" id="ddlAffiliated">
                                             <option value="1">Not Affiliated</option>
                                             <option value="2">Affiliated</option>
                                            </select>
                                           
                                            </div>
                                            <input class="input span12 email" id="username" name="username" placeholder="Institute Code" required="required"  type="text">
                                        </div>
                                    </div>
                                    <div class="row-fluid">
                                        <div class="span12">
                                            <input class="input span12 password" id="password" name="password" placeholder="Password" required="required" type="password">
                                        </div>
                                    </div>
                                </div>
                                <div class="actions">
                                    <a id="new_acc" class="btn-primary btn btn" style="float:left;"  ><u>Create New Account</u></a>
                                    <input  class="btn-large pull-right btn-primary" name="btnLogin" type="submit"  value="Login" style="height: 50px; width: 100px;" >
                                    <!-- <a class="link" href="#">Forgot Password?</a>-->
                                    <div class="clearfix"></div>
                                </div>
                          <!--  </form>    -->
                        </div>
                    </div>
                          <!--<form name="new_reg" id="new_reg" action="<?php //echo base_url(); ?>Affiliation_New/NewUserReg_Insert/">  -->
                          </form>
                      <form action="<?php echo base_url();?>Affiliation_New/NewUserReg_Insert" id="myform" class="login-wrapper" method="post">     
                    <div id="new_user" class="form-horizontal ">

                        <div >
                            <div class="span12">
                                <div class="sign-in-container">

                                    <div class="control-group hero-unit">
                                        <h4>
                                            Please fill out this form.
                                        </h4>

                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="inputFirstName">
                                            User Name 
                                        </label>
                                        <div class="controls">
                                            <input type="text" value="testno2" class="span6" id="inputFirstName" name="inputFirstName" placeholder="First Name" required>

                                        </div>


                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="inputEmail">
                                            Email
                                        </label>
                                        <div class="controls">
                                            <input type="email" value="testno2@gmail.com" class="span6" id="inputEmail" name="inputEmail" placeholder="Email" required>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="txt_pwd">
                                            Password
                                        </label>
                                        <div class="controls">
                                            <input type="password" value="Bc090402770" class="span6" id="txt_pwd" name="txt_pwd" placeholder="Password" required>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="txt_repwd">
                                            Retype Password
                                        </label>
                                        <div class="controls">
                                            <input type="password" value="Bc090402770" class="span6" id="txt_repwd" name="txt_repwd" placeholder="Re Type Password" required>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="inputCNIC">
                                            CNIC
                                        </label>
                                        <div class="controls">
                                            <input type="text" value="34101-7928302-5" class="span6" id="inputCNIC" name="inputCNIC" placeholder="Your CNIC" required>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label"  id="error">
                                        </label> 
                                        <div class="controls">
                                            <input  class="btn-large  btn-primary span4" name="btnNewUserReg" id="btnNewUserReg" type="submit"  value="Register"  > 
                                            <input  class="btn-large btn-primary span2" name="link_login" id="link_login" type="button" value="Login"  >  
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="inputFirstName" id="error">
                                        </label> 
                                        <div class="controls">

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                    
                    
                            <div id="new_user" class="form-horizontal " style="display: block;">

                        <div >
                            <div class="span12">
                                <div class="sign-in-container">

                                    <div class="control-group hero-unit">
                                        <h4>
                                            This User Name already Registered.If its your's UserName then Login or If you forget then Please enter Your email Address. We will send you Password on your Email.
                                        </h4>

                                    </div>
                                    
                                    <div class="control-group">
                                        <label class="control-label" for="inputEmail">
                                            Email
                                        </label>
                                        <div class="controls">
                                            <input type="email" value="testno2@gmail.com" class="span6" id="inputEmail" name="inputEmail" placeholder="Email" required>
                                        </div>
                                    </div>
                                    
                                    <div class="control-group">
                                        <label class="control-label"  id="error">
                                        </label> 
                                        <div class="controls">
                                            <input  class="btn-large  btn-primary span4" name="btnEmailSend" id="btnEmailSend" type="submit"  value="Send Email to me"  > 
                                            <input  class="btn-large btn-primary span2" name="link_login" id="link_login" type="button" value="Login"  >  
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="inputFirstName" id="error">
                                        </label> 
                                        <div class="controls">

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                      </form>


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
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/alertify.core.css">
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/alertify.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.mask.js"></script>
            <script type="text/javascript">

            $("#new_acc").click(function(){
                $("#div_login").hide();
                $("#new_user").show();
            })
            $("#link_login").click(function(){
                $("#div_login").show();
                $("#new_user").hide();
            })
            $("#inputCNIC").mask("99999-9999999-9",{placeholder:"_"});
            function valid()
            {

               // debugger;
                var first_name = $("#inputFirstName").val();
                var inputEmail = $("#inputEmail").val();
                var txt_pwd = $("#txt_pwd").val();
                var txt_repwd = $("#txt_repwd").val();
                var inputCNIC = $("#inputCNIC").val();

                if(first_name == "")
                {
                    //$("#error").text("Please Provide Your Name First.");
                    alertify.error("Please Provide Your Name First.")
                    $("#inputFirstName").focus();
                    return false;
                }
                else if(inputEmail == "")
                {  
                    alertify.error("Please Provide Your Email First.");
                    $("#inputEmail").focus();
                    return false;
                }
                else if(txt_pwd == "")
                {  
                    alertify.error("Please Provide Your Password First.");
                    $("#txt_pwd").focus();
                    return false;
                }
                else if(txt_repwd == "" || txt_pwd != txt_repwd  )
                {  
                    alertify.error("Please Provide Your Re-Password First.");
                    $("#txt_repwd").val("");
                    $("#txt_repwd").focus();
                    return false;
                }
                else if(inputCNIC == "")
                {  
                    alertify.error("Please Provide Your CNIC First.");
                    $("#inputCNIC").focus();
                    return false;
                }
                else if(txt_pwd != "")
                {  
                   // debugger;
                    if(txt_pwd.length < 8)
                    {
                        alertify.error("Please Provide Password which has 8 or more length.");

                        $("#txt_pwd").focus();
                        $("#txt_pwd").val("");
                        $("#txt_repwd").val("");
                        return false;
                    }
                    else if(!/\d/.test(txt_pwd))
                    {
                        alertify.error("Please Provide Password which contain at least one digit");//, one upper case letter, one lower case latter and more than 8 characters length.");
                        $("#txt_pwd").focus();
                        $("#txt_pwd").val("");
                        $("#txt_repwd").val("");
                        return false;
                    }
                    else if(!/[a-z]/.test(txt_pwd))
                    {
                        alertify.error("Please Provide Password which contain at least one lower case alphabet");//, one upper case letter, one lower case latter and more than 8 characters length.");
                        $("#txt_pwd").focus();
                        $("#txt_pwd").val("");
                        $("#txt_repwd").val("");
                        return false;
                    }
                    else if(!/[A-Z]/.test(txt_pwd))
                    {
                        alertify.error("Please Provide Password which contain at least one UPPER case alphabet");//, one upper case letter, one lower case latter and more than 8 characters length.");
                        $("#txt_pwd").focus();
                        $("#txt_pwd").val("");
                        $("#txt_repwd").val("");
                        return false;
                    }
                    else if(/[^0-9a-zA-Z]/.test(txt_pwd))
                    {
                        alertify.error("Please Provide Password which contain at least one UPPER case alphabet, one lower case alphabet, one digit and password length more than 8 characters.");
                        $("#txt_pwd").focus();
                        $("#txt_pwd").val("");
                        $("#txt_repwd").val("");
                        return false;
                    }

                    /*jQuery.ajax({

                        type: "POST",
                        url: "<?php //echo base_url(); ?>Affiliation_New/NewUserReg_Insert/",
                        dataType: 'json',
                        data: $("#myform").serialize(),
                        beforeSend: function() {  $('.mPageloader').show(); },
                        complete: function() { $('.mPageloader').hide();},
                        success: function(json) {
                            var listitems='';
                            //$('#instruction').empty();
                            $.each(json.center, function (key, data) {

                                console.log(data);
                                alert(data);
                                // listitems +='<label style="text-align: left; margin-top: -23px;">'+data.CENT_CD + '-' + data.CENT_NAME+'</label><br>';
                            })
                            //$('#instruction').html('<h1 style="    margin-bottom: 28px;">Selected Zone Centre List </h1>'+listitems); 
                            //$.fancybox("#instruction");
                        },
                        error: function(request, status, error){
                            alert(request.responseText);
                        }
                    });

                    //window.location.href =  '/index.php/Affiliation_New/NewUserReg_Insert/';
                    return true;

                }  */

                }
            }
            $('a').tooltip('hide');
            $('.popover-pop').popover('hide');
            //Collapse
            $('#myCollapsible').collapse({
                toggle: false
            })
            $("[name='ddlAffiliated']").click(function (){
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
                    alertify.error.text("Please type same as above password");
                    $("#txt_repwd").val("");
                    $("#txt_repwd").focus();
                    $(this).css("background-color", "#FFFFFF");
                    return;
                }
            }
            
            /*$("#btnNewUserReg").click(function(){
                   debugger;
                     var status  =  valid(); 

        if(status == 0)
        {

            return false;    
        }
        else
        {
            $.ajax({
                type: "POST",
                url: "<?php// echo base_url(); ?>Affiliation_New/NewUserReg_Insert/",
                dataType: 'html',
                data: $( '#new_reg' ).serialize(),
                beforeSend: function() {$('.mPageloader').show();},
                complete: function() { $('.mPageloader').hide();},
                success: function(data) 
                {
                    
                     /*var obj = JSON.parse(data) ;
                     if(obj.error ==  1)
                     {
                       // window.location.href ='<?php //echo base_url(); ?>Affiliation_New/formdownloaded/'+obj.formno; 
                     }
                     else
                     {
                         $('.mPageloader').hide();
                        alertify.error(obj.error);
                          return false; 
                     }*/

               /* },
                error: function(request, status, error){
                    alertify.error(request.responseText);
                }
            });


            return false;
        } 
            })      */
          
        function login()
        {
        var uid = $("#username").val();
        var pwd = $("#password").val();
        if(uid == "" || pwd == "")
        {
        alert("Please enter User ID/Email");
        }
        else
        {
        window.location.href ='<?php echo base_url(); ?>Login_affiliation/'; 
        }
        
        }
           
        </script>
    </body>
</html>