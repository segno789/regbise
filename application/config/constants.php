<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');
define('GET_PRIVATE_IMAGE_PATH_COPY','');
define('IMAGE_PATH_OTHER_BOARD_10TH', 'uploads/2017/other/');
define('IMAGE_PATH_OTHER_BOARD_11TH', 'uploads/2017/other/colleges/other/');

define('IMAGE_PATH', 'uploads/2016/');
define('IMAGE_PATH2', 'uploads/2016_backup/');
define('BARCODE_PATH', 'uploads/assets/pdfs/');
define('SINGLE_LAST_DATE', '2017-01-30');
define('DOUBLE_LAST_DATE', '2016-09-30');
define('RE_ADMISSION_TBL', 'matric_new..vw9th16');
define('RE_ADMISSION_TBL11', 'matric_new..vwIA1P16');
define('ISREADMISSION', '1');
////9th registration correction
define('regyear','2017');

//===========================================================
define('IMAGE_PATH11', 'uplaods/2017/reg/');
define('IMAGE_PATH211', 'uploads/2016_backup/');
define('BARCODE_PATH11', 'uploads/assets/pdfs/');
define('SINGLE_LAST_DATE11', '2017-11-08');
define('DOUBLE_LAST_DATE11', '2017-11-08');

//================ Ninth Correction variables ========================
define('Correction_Last_Date','2017-10-31');
define('Corr_ApplicationNo','30000');
define('Corr_ApplicationNo11','10000');
define('CORR_IMAGE_PATH', 'uploads/correction/');
define('CORR_IMAGE_PATH11', 'uplaods/2017/correction//');

define('session_year','2017-2019');
define('corr_bank_chall_class','9TH');
define('return_pdf_isPicture','1');
define('CURRENT_SESS','2017-2019'); 
define('Reg_Cards_9th_Heading','SECONDARY SCHOOL'); 
define('Reg_Cards_11th_Heading','HIGHER SECONDARY SCHOOL'); 
define('TITLE','Online 11th/9th Registration'); 
define('TITLE_Affiliation','Online Affiliation for SSC and HSSC'); 
define('YEAR',2017);
   
//===============11th challan varaible
define('corr_bank_chall_class1','11th');
define('CURRENT_SESS1','2017-2019'); 

//================ Migration variables ========================

define('NOC_APP_NO','80000'); 
define('MIGRATIONSESS','2017-19'); 
define('MIGRATIONSESS2','2016-18'); 
define('TBLMIGRATION','Registration..tblreg9th'); 
define('TBLMIGRATION_11th','Registration..tblreg11th'); 
define('TBLMIGRATION1','matric_new..tblAdmMig'); 
define('TBLMIGRATION2','matric_new..tblRegMig');
define('TBLMIGRATION3','Registration..tblMig');  
define('TBLMIGRATIONTESTING3','Registration..tblMig');  
define('DIRPATH','C:\inetpub\vhosts\bisegrw.com\ssc.bisegrw.com\oldPics'); 
define('DIRPATHMIG','C:\inetpub\vhosts\bisegrw.com\registration.bisegrw.com\uploads\2016\\'); 
define('DIRPATHCOR','C:\inetpub\vhosts\bisegrw.com\registration.bisegrw.com\uploads\correction\\'); 
define('TBLMIGRATION4','matric_new..vw9th17'); 








/* End of file constants.php */
/* Location: ./application/config/constants.php */