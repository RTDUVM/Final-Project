<?php
include ('top.php');
//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^
//
print PHP_EOL . '<!-- SECTION: 1 Initialize variables -->' . PHP_EOL;
//These variables are used in both sections 2 and 3, otherwise we would
//declare them in the section we needed them
print PHP_EOL . '<!-- SECTION: 1a. debugging setup -->' . PHP_EOL;
//We print out the post array so that we can see our form is working.
//Normally I wrap this in a debug statement but for now I want to always
//display it. When you first come to the form it is empty. When you submit the
//form it displays the contents of the post array.
//if($debug)
    print'<p>Post Array:</p><pre>';
    print_r($_POST);
    print'</pre>';
    //}
    
    //%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
    //
    print PHP_EOL . '<!-- SECTION: 1b form variables -->' . PHP_EOL;
    //
    //Initialize variables one for each form element
    //In the order they appear on the form
    //
    //REGISTRATION
    $firstName = "";
    $lastName = "";
    $birthDate = "";
    $grade = "";
    $room = "";
    $teacher = "";
    $address = "";
    $zip = "";
    $homePhone = "";
    $email ="roxann.downing@uvm.edu";
    $parent1 = "";
    $cellphone1 = "";
    $parent2 = "";
    $cellphone2 = "";
    $emergency = "";
    $emergencyCell = "";
    $authorize1 = "";
    $authorize1Relationship = "";
    $authorize2 = "";
    $authorize2Relationship = "";
    
    //HEALTH History
    $gender = "Female";
    
    $comments = "";
    $comments2 = "";
    $comments3 = "";
    
    $accept = true; //checked
    $accept2 = true;
    $accept3 = true;
    //%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
    //
    print PHP_EOL . '<!-- SECTION: 1c form error flags -->' . PHP_EOL;
    //
    //Initialize Error Flags one for each form element we validate
    //in the order they appear on the form
    $firstNameERROR = false;
    $lastNameERROR = false;
    $birthDateERROR = false;
    $gradeERROR = false;
    $roomERROR = false;
    $teacherERROR = false;
    $addressERROR = false;
    $zipERROR = false;
    $homePhoneERROR = false;
    $emailERROR = false;
    $parent1ERROR = false;
    $cellphone1ERROR = false;
    $parent2ERROR = false;
    $cellphone2ERROR = false;
    $emergencyERROR = false;
    $emergencyCellERROR = false;
    $authorize1ERROR = false;
    $authorize1RelationshipERROR = false;
    $authorize2ERROR = false;
    $authorize2RelationshipERROR = false;
        
    
    $genderERROR = false;
   
    $commentsERROR = false;
    $comments2ERROR = false;
    $comments3ERROR = false;
    
    $acceptERROR = false;
    $accept2ERROR = false;
    $accept3ERROR = false;
    $totalChecked = 0;
    $totalChecked2 = 0;
    $totalChecked3 = 0;
    ////%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
    //
    print PHP_EOL . '<!-- SECTION: 1d misc variables -->' .PHP_EOL;
    //
    //create array to hold error messages filled (if any) in 2d displayed in 3c.
    $errorMsg = array();
    
    //have we mailed the information to the user, flag variable?
    $mailed = false;
    
    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    //
    print PHP_EOL . '<!-- SECTION: 2 Process for when the form is submitted -->' . PHP_EOL;
    //
    if (isset($_POST["btnSubmit"])){
    
    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    //
    print PHP_EOL . '<!-- SECTION: 2a Security -->' .PHP_EOL;
    
    //the url for this form
    $thisURL = $domain . $phpSelf;
    
    if(!securityCheck($thisURL)){
        $msg = '<p>Sorry you cannot access this page.</p>';
        $msg.= '<p>Security breach detected and reported</p>'; 
        die($msg);
    }
    
    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@2
    //
    print PHP_EOL . '<!-- SECTION: 2b Sanitize (clean) data -->' .PHP_EOL;
    //remove any potential JavaScript or html code from users input on the 
    //form. Note it is best to follow the same order as declared in section 1c.
   $firstName = htmlentities($_POST["txtFirstName"], ENT_QUOTES, "UTF_8"); 
   $lastName = htmlentities($_POST["txtLastName"], ENT_QUOTES, "UTF_8"); 
   $birthDate = htmlentities($_POST["txtBirthDate"], ENT_QUOTES, "UTF_8"); 
   $grade = htmlentities($_POST["txtGrade"], ENT_QUOTES, "UTF_8"); 
   $room = htmlentities($_POST["txtRoom"], ENT_QUOTES, "UTF_8"); 
   $teacher = htmlentities($_POST["txtTeacher"], ENT_QUOTES, "UTF_8"); 
   $address = htmlentities($_POST["txtAddress"], ENT_QUOTES, "UTF_8"); 
   $zip = htmlentities($_POST["txtZip"], ENT_QUOTES, "UTF_8"); 
   $homePhone = htmlentities($_POST["txtHomePhone"], ENT_QUOTES, "UTF_8"); 
  
   $email = filter_var($_POST["txtEmail"], FILTER_SANITIZE_EMAIL);
   $parent1 = htmlentities($_POST["txtParent1"], ENT_QUOTES, "UTF_8"); 
   $cellphone1 = htmlentities($_POST["txtCellPhone1"], ENT_QUOTES, "UTF_8"); 
   $parent2 =htmlentities($_POST["txtParent2"], ENT_QUOTES, "UTF_8"); 
   $cellphone2 = htmlentities($_POST["txtCellPhone2"], ENT_QUOTES, "UTF_8"); 
   $emergency = htmlentities($_POST["txtEmergency"], ENT_QUOTES, "UTF_8"); 
   $emergencyCell = htmlentities($_POST["txtEmergencyCell"], ENT_QUOTES, "UTF_8"); 
   $authorize1 = htmlentities($_POST["txtAuthorize1"], ENT_QUOTES, "UTF_8"); 
   $authorize1Relationship = htmlentities($_POST["txtAuthorize1Relationship"], ENT_QUOTES, "UTF_8"); 
   $authorize2 = htmlentities($_POST["txtAuthorize2"], ENT_QUOTES, "UTF_8"); 
   $authorize2Relationship = htmlentities($_POST["txtAuthorize2Relationship"], ENT_QUOTES, "UTF_8"); 
   
   $gender = htmlentities($_POST["radGender"], ENT_QUOTES, "UTF_8"); 
    
    $comments = htmlentities($_POST["txtComments"], ENT_QUOTES, UTF_8);
    $comments2 = htmlentities($_POST["txtComments"], ENT_QUOTES, UTF_8);
    $comments3 = htmlentities($_POST["txtComments"], ENT_QUOTES, UTF_8);
    
    //NOTE if a check box is not checked it is not sent in the post array
    if(isset($_POST["chkAccept"])){
        $accept = true;
        $totalChecked++;
    } else {
        $accept = false;
    }
    if(isset($_POST["chkAccept2"])){
        $accept2 = true;
        $totalChecked2++;
    } else {
        $accept2 = false;
    }
    if(isset($_POST["chkAccept3"])){
        $accept3 = true;
        $totalChecked3++;
    } else {
        $accept = false;
    }
    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    //
    print PHP_EOL . '<!-- SECTION: 2c Validation -->' .PHP_EOL;
    //
    //Validation section. CHeck each value for possible errors, empty or
    //not what we expect. You will need an IF block for each element you will
    //check (see above section 1c and 1d). The if blocks should also be in the
    //order that the elements appear on your form so that the error messages
    //will be in the order they appear. errorMsg will be displayed on the form
    // see section 3b. The error flag ($emailERROR) will be used in section 3c.
    if($firstName == ""){
        $errorMsg[] = "Please enter your child's first name";
        $firstNameERROR = true;
    } elseif(!verifyAlphaNum($firstName)){
        $errorMsg[] = "Your child's first name appears to have an extra character.";
        $firstNameERROR = true;
    }
    
    if($lastName == ""){
        $errorMsg[] = "Please enter your child's last name";
        $lastNameERROR = true;
    } elseif(!verifyAlphaNum($lastName)){
        $errorMsg[] = "Your child's last name appears to have an extra character.";
        $lastNameERROR = true;
    }
    if($birthDate == ""){
        $errorMsg[] = "Please enter your child's birth date";
        $birthDateERROR = true;
    } elseif(!verifyAlphaNum($birthDate)){
        $errorMsg[] = "Your child's birth date appears to have an extra character.";
        $birthDateERROR = true;
    }
    if($grade == ""){
        $errorMsg[] = "Please enter your child's grade in school";
        $gradeERROR = true;
    } elseif(!verifyAlphaNum($grade)){
        $errorMsg[] = "Your child's grade appears to have an extra character.";
        $gradeERROR = true;
    }
    if($room == ""){
        $errorMsg[] = "Please enter your child's room number";
        $roomERROR = true;
    } elseif(!verifyAlphaNum($room)){
        $errorMsg[] = "Your child's room number appears to have an extra character.";
        $roomERROR = true;
    }
    if($teacher == ""){
        $errorMsg[] = "Please enter the name of your child's teacher";
        $teacherERROR = true;
    } elseif(!verifyAlphaNum($teacher)){
        $errorMsg[] = "This name appears to have an extra character.";
        $teacherERROR = true;
    }
    if($address == ""){
        $errorMsg[] = "Please enter your address";
        $addressERROR = true;
    } elseif(!verifyAlphaNum($address)){
        $errorMsg[] = "Your address appears to have an extra character.";
        $addressERROR = true;
    }
    if($zip == ""){
        $errorMsg[] = "Please enter your zip code";
        $zipERROR = true;
    } elseif(!verifyAlphaNum($zip)){
        $errorMsg[] = "Your zip appears to have an extra character.";
        $zipERROR = true;
    }
    if($homePhone == ""){
        $errorMsg[] = "Please enter your home phone number";
        $homePhoneERROR = true;
    } elseif(!verifyAlphaNum($homePhone)){
        $errorMsg[] = "Your phone number appears to have an extra character.";
        $homePhoneERROR = true;
    }
    
    if ($email == ""){
        $errorMsg[] = 'Please enter your email address';
        $emailERROR = true;
    } elseif (!verifyEmail($email)){
        $errorMsg[] = 'Your email address appears to be incorrect.';
        $emailERROR = true;
    }
    if($parent1 == ""){
        $errorMsg[] = "Please enter the child's Parent/Guardian name";
        $parent1ERROR = true;
    } elseif(!verifyAlphaNum($parent1)){
        $errorMsg[] = "This name appears to have an extra character.";
        $parent1ERROR = true;
    }
    if($cellphone1 == ""){
        $errorMsg[] = "Please enter a number for the child's Parent/Gaurdian";
        $cellphone1ERROR = true;
    } elseif(!verifyAlphaNum($cellphone1)){
        $errorMsg[] = "This number appears to have an extra character.";
        $cellphone1ERROR = true;
    }
    if(!verifyAlphaNum($parent2)){
        $errorMsg[] = "This number appears to have an extra character.";
        $parent2ERROR = true;
    }
    if(!verifyAlphaNum($cellphone2)){
        $errorMsg[] = "This number appears to have an extra character.";
        $cellphone2ERROR = true;
    }    
    if($emergency == ""){
        $errorMsg[] = "Please enter an alternate emergency contact";
        $emergencyERROR = true;
    } elseif(!verifyAlphaNum($emergency)){
        $errorMsg[] = "Your emergency contact appears to have an extra character.";
        $emergencyERROR = true;
    } elseif($emergency == $parent1){
        $errorMsg[] = "The alternate emergency contact can not be a parent or guardian";
        $emergencyERROR = true;
    }
    
    if($emergencyCell == ""){
        $errorMsg[] = "Please enter a number for your child's emergency contact";
        $emergencyCellERROR = true;
    } elseif(!verifyAlphaNum($emergencyCell)){
        $errorMsg[] = "Your emergency contact number appears to have an extra character.";
        $emergencyCellERROR = true;
    }
    
    if(!verifyAlphaNum($authorize1)){
        $errorMsg[] = "This number appears to have an extra character.";
        $authorize1ERROR = true;
    }
     if(!verifyAlphaNum($authorize1Relationship)){
        $errorMsg[] = "This number appears to have an extra character.";
        $authorize1RelationshipERROR = true;
     }
     if(!verifyAlphaNum($authorize2)){
        $errorMsg[] = "This number appears to have an extra character.";
        $authorize2ERROR = true;
     }
     if(!verifyAlphaNum($authorize2Relationship)){
        $errorMsg[] = "This number appears to have an extra character.";
        $authorize2RelationshipERROR = true;
     }
     
    if ($gender != "Female" AND $gender != "Male" AND $gender != "Prefer"){
        $errorMsg[] = "Please choose a gender";
        $genderERROR = true;
    }
   
    if ($comments != ''){
        if(!verifyAlphaNum($comments)){
        $errorMsg[] = "Your comments appear to have extra characters that are not allowed";
        $commentsERROR = true;
    }
    }
    if ($comments2 != ''){
        if(!verifyAlphaNum($comments2)){
        $errorMsg[] = "Your comments appear to have extra characters that are not allowed";
        $comments2ERROR = true;
    }
    }
   if ($comments3 != ''){
        if(!verifyAlphaNum($comments3)){
        $errorMsg[] = "Your comments appear to have extra characters that are not allowed";
        $comments3ERROR = true;
    }
    } 
    if($totalChecked < 1){
        $errorMsg[] = "The authorization for medical treatment must be checked";
        $acceptERROR = true;
    }
    if($totalChecked2 < 1){
        $errorMsg[] = "The physical appointment must be checked";
        $accept2ERROR = true;
    }
     if($totalChecked3 < 1){
        $errorMsg[] = "The physical appointment must be checked";
        $accept3ERROR = true;
    }
    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    //
    print PHP_EOL . '<!-- SECTION: 2d Process Form - Passed Validation -->' .PHP_EOL;
    //
    //Process for when the form passes validation (the errorMsg is empty)
    //
    if(!$errorMsg){
        if($debug)
             print '<p>Form is valid</p>';
    
    
    //@@@@@@@@@@@@@@@@@@@@@@@@@
    //
    print PHP_EOL . '<!-- SECTION: 2e Save Data -->' . PHP_EOL;
    //
    //This block saves the data to a CSV file.
    
    //array used to hold form values that will be saved to a CSV file
    $dataRecord = array();
    
    //assign values to the dataRecord array
    $dataRecord[] = $firstName;
    $dataRecord[] = $lastName;
    $dataRecord[] = $birthDate;
    $dataRecord[] = $grade;
    $dataRecord[] = $room;
    $dataRecord[] = $teacher;
    $dataRecord[] = $address;
    $dataRecord[] = $zip;
    $dataRecord[] = $homePhone;
    $dataRecord[] = $email;
    $dataRecord[] = $parent1;
    $dataRecord[] = $cellphone1;
    $dataRecord[] = $parent2;
    $dataRecord[] = $cellphone2;
    $dataRecord[] = $emergency;
    $dataRecord[] = $emergencyCell;
    $dataRecord[] = $authorize1;
    $dataRecord[] = $authorize1Relationship;
    $dataRecord[] = $authorize2;
    $dataRecord[] = $authorize2Relationship;
    
    
    $dataRecord[] = $gender;
    
    $dataRecord[] = $comments;
    $dataRecord[] = $comments2;
    $dataRecord[] = $comments3;
    
    $dataRecord[] = $accept;
    $dataRecord[] = $accept2;
    $dataRecord[] = $accept3;
    //setup csv file
    $myFolder = 'data/';
    $myFileName = 'registration';
    $fileExt = '.csv';
    $filename = $myFolder . $myFileName . $fileExt;
    
    if($debug) print PHP_EOL . '<p>filename is ' . $filename;
    
    // now we just open the file for append
    $file = fopen($filename, 'a');
    
    //write the forms informations
    fputcsv($file, $dataRecord);
    
    //CLose the file
    fclose($file);
    
    
    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    //
    print PHP_EOL . '<!-- SECTION: 2f Create message -->' .PHP_EOL;
    //
    //build a message to display on the screen in section 3a and to mail
    // to the person filling out the form (section 2g).
    
    $message = '<h2>Your Information.</h2>';
    
    foreach($_POST as $htmlName => $value) {
    if($htmlName != 'btnSubmit'){
        $message .= '<p>';
        //breaks up the form name into words. For example,
        //txtfirst name becomes first name
        $camelCase = preg_split('/(?=[A-Z])/', substr($htmlName, 3));
    
        foreach($camelCase as $oneWord){
            $message .= $oneWord . '';
        }
    
        $message .= ' = ' . htmlentities($value, ENT_QUOTES, "UTF-8") . '</p>';
    
    }
    }
    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    //
    print PHP_EOL . '<!-- SECTION: 2g Mail to user -->' . PHP_EOL;
    //
    //Process for mailing a message which contains the forms data
    //the message was built in section 2f.
    $to = $email; // the person who filled out the form
    $cc = '';
    $bcc = '';
    
    $from = 'Customer Service <rtdownin@uvm.edu>';
    
    // subject of mail should make sense to your form
    $subject = 'Information on your carbon fooprint: ';
    
    $mailed = sendMail($to, $cc, $bcc, $from, $subject, $message);
    
        } //ends form is valid
    
    }//ends if form was submitted. 
    
    
    
    //##########################################################################
    //
    print PHP_EOL . '<!-- SECTION 3 Display Form -->' .PHP_EOL;
    //
    ?>
<main>
    <article>
    <?php
        //#######################################
        //
        print PHP_EOL . '<!-- SECTION 3a -->' . PHP_EOL;
        //
        // If its the first time coming to the form or there are errors we are going
        //to display the form.
     
     if (isset($_POST["btnSubmit"]) AND empty($errorMsg)){//closing of if marked with: end body submit
         print '<h2>Thank you for providing your information.</h2>';
     
         print'<p>For your records a copy of this data has ';
         if(!$mailed){
             print "not ";
         }
     
         print 'been sent:</p>';
         print '<p>To: ' . $email . '</p>';
     
         print $message;
     } else {  
    print '<h2>Register With Us Today!</h2>';
    print '<p class="form-heading">Your information will help us change the world!</p>';
 
        //########################
        //
        print PHP_EOL . '<!-- SECTION 3b Error Messages -->' .PHP_EOL;
        //
        //display any error messages before we print out the form
     
    if($errorMsg) { 
        print '<div id ="errors">' . PHP_EOL;
        print '<h2>Your form has the following mistakes that need to be fixed.</h2>' .PHP_EOL;
        print '<ol>' . PHP_EOL;
    
        foreach ($errorMsg as $err) {
            print '<li>' . $err . '</li>' . PHP_EOL;
        }
        
        print '</ol>' . PHP_EOL;
        print '</div>' . PHP_EOL;
    }
        
        //##################################
        //
        print PHP_EOL . '<!-- SECTION 3c html Form -->' .PHP_EOL;
        //
        /*Display the html form. Note that the action is to this same page. $phpSelf
            is defined in top.php
            NOTE the line:
            value="<?php print $email; ?>
            this makes the form sticky by displaying either the initial default value (line??)
            or the value they typed in (line ??)
            NOTE this line:
            <?php if($emailERROR) print 'class="mistake"'; ?>
            this prints out a CSS class so that we can highlight the background etc. to
            make it stand out that a mistake happened here.
         */
?>
        
        
        
        <form action ="<?php print $phpSelf; ?>"
              id ="frmRegister"
              method="post">
        
                    <fieldset class =" contact">
                        <legend>Contact Information</legend>
                        <p> 
                            <label class ="required" for="txtFirstName">First Name</label>
                            <input autofocus
                                   <?php if ($firstNameERROR) print 'class="mistake"'; ?>
                                   id ="txtFirstName"
                                   maxlength ="45"
                                   name="txtFirstName"
                                   onfocus="this.select()"
                                   placeholder="Enter your child's first name"
                                   tabindex="100"
                                   type="text"
                                   value="<?php print $firstName; ?>"
                                >
                        </p>
                        
                        <p>
                            <label class="required" for="txtLastName">Last Name</label>
                            <input
                                   <?php if ($lastNameERROR) print 'class="mistake"'; ?>
                                   id="txtLastName"
                                   maxlength="45"
                                   name="txtLastName"
                                   onfocus="this.select()"
                                   placeholder="Enter your child's last name"
                                   tabindex="100"
                                   type="text"
                                   value="<?php print $lastName; ?>"
                                >
                        </p>
        
                        <p>
                            <label class="required" for="txtBirthDate">Birth Date (MM-DD-YYYY)</label>
                            <input
                                   <?php if ($birthDateERROR) print 'class="mistake"'; ?>
                                   id="txtBirthDate"
                                   maxlength="45"
                                   name="txtBirthDate"
                                   onfocus="this.select()"
                                   placeholder="Enter your child's birth date"
                                   tabindex="102"
                                   type="text"
                                   value="<?php print $birthDate; ?>"
                                >
                        </p>
                        
                        <p>
                            <label class="required" for="txtGrade">Grade Level</label>
                            <input
                                   <?php if ($gradeERROR) print 'class="mistake"'; ?>
                                   id="txtGrade"
                                   maxlength="45"
                                   name="txtGrade"
                                   onfocus="this.select()"
                                   placeholder="Enter your child's grade"
                                   tabindex="103"
                                   type="text"
                                   value="<?php print $grade; ?>"
                                >
                        </p>
                        
                        
                        <p>
                            <label class="required" for="txtRoom">Room Number</label>
                            <input
                                   <?php if ($roomERROR) print 'class="mistake"'; ?>
                                   id="txtRoom"
                                   maxlength="45"
                                   name="txtRoom"
                                   onfocus="this.select()"
                                   placeholder="Enter your child's room number"
                                   tabindex="102"
                                   type="text"
                                   value="<?php print $room; ?>"
                                >
                        </p>
                        
                        <p>
                            <label class="required" for="txtTeacher">Teacher Name</label>
                            <input
                                   <?php if ($teacherERROR) print 'class="mistake"'; ?>
                                   id="txtTeacher"
                                   maxlength="45"
                                   name="txtTeacher"
                                   onfocus="this.select()"
                                   placeholder="Enter the name of your child's teacher"
                                   tabindex="103"
                                   type="text"
                                   value="<?php print $teacher; ?>"
                                >
                        </p>
                        
                        <p>
                            <label class="required" for="txtAddress">Address</label>
                            <input
                                   <?php if ($addressERROR) print 'class="mistake"'; ?>
                                   id="txtAddress"
                                   maxlength="45"
                                   name="txtAddress"
                                   onfocus="this.select()"
                                   placeholder="Enter your address"
                                   tabindex="103"
                                   type="text"
                                   value="<?php print $address; ?>"
                                >
                        </p>
                        
                        <p>
                            <label class="required" for="txtZip">Zip Code</label>
                            <input
                                   <?php if ($zipERROR) print 'class="mistake"'; ?>
                                   id="txtZip"
                                   maxlength="45"
                                   name="txtZip"
                                   onfocus="this.select()"
                                   placeholder="Enter your Zip Code"
                                   tabindex="102"
                                   type="text"
                                   value="<?php print $zip; ?>"
                                >
                        </p>
                        
                        <p>
                            <label class="required" for="txtHomePhone">Home Phone Number XXX-XXX-XXXX</label>
                            <input
                                   <?php if ($homePhoneERROR) print 'class="mistake"'; ?>
                                   id="txtHomePhone"
                                   maxlength="45"
                                   name="txtHomePhone"
                                   onfocus="this.select()"
                                   placeholder="Enter your home phone"
                                   tabindex="103"
                                   type="text"
                                   value="<?php print $homePhone; ?>"
                                >
                        </p>
                        
                        <p>
                            <label class="required" for ="txtEmail">Email</label>
                            <input
                                <?php if ($emailERROR) print 'class="mistake"'; ?>
                                id ="txtEmail"
                                maxlength ="45"
                                name ="txtEmail"
                                onfocus="this.select()"
                                placeholder="Enter your email address"
                                tabindex ="120"
                                type="text"
                                value ="<?php print $email; ?>"
                                >                                    
                        </p>  
                        
                        <p>
                            <label class="required" for="txtParent1">Parent/Guardian #1</label>
                            <input
                                   <?php if ($parent1ERROR) print 'class="mistake"'; ?>
                                   id="txtParent1"
                                   maxlength="45"
                                   name="txtParent1"
                                   onfocus="this.select()"
                                   placeholder="Parent/Guardian Name"
                                   tabindex="104"
                                   type="text"
                                   value="<?php print $parent1; ?>"
                                >
                        </p>
                        
                        <p>
                            <label class="required" for="txtCellPhone1">Telephone Number XXX-XXX-XXXX</label>
                            <input
                                   <?php if ($cellphone1ERROR) print 'class="mistake"'; ?>
                                   id="txtCellPhone1"
                                   maxlength="45"
                                   name="txtCellPhone1"
                                   onfocus="this.select()"
                                   placeholder="Enter their telephone number"
                                   tabindex="105"
                                   type="text"
                                   value="<?php print $cellphone1; ?>"
                                >
                        </p>
                        <p>
                            <label class="required" for="txtParent2">Parent/Guardian #2</label>
                            <input
                                   <?php if ($parent2ERROR) print 'class="mistake"'; ?>
                                   id="txtParent2"
                                   maxlength="45"
                                   name="txtParent2"
                                   onfocus="this.select()"
                                   placeholder="Parent/Guardian name"
                                   tabindex="105"
                                   type="text"
                                   value="<?php print $parent2; ?>"
                                >
                        </p>
                        <p>
                            <label class="required" for="txtCellPhone2">Telephone Number XXX-XXX-XXXX</label>
                            <input
                                   <?php if ($cellphone2ERROR) print 'class="mistake"'; ?>
                                   id="txtCellPhone2"
                                   maxlength="45"
                                   name="txtCellPhone2"
                                   onfocus="this.select()"
                                   placeholder="Enter their telephone number"
                                   tabindex="107"
                                   type="text"
                                   value="<?php print $cellphone2; ?>"
                                >
                        </p>
                        
                        <p>
                            <label class="required" for="txtEmergency">Emergency Contact</label>
                            <input
                                   <?php if ($emergencyERROR) print 'class="mistake"'; ?>
                                   id="txtEmergency"
                                   maxlength="45"
                                   name="txtEmergency"
                                   onfocus="this.select()"
                                   placeholder="Enter contact name"
                                   tabindex="107"
                                   type="text"
                                   value="<?php print $emergency; ?>"
                                >
                        </p>
                        <p>
                            <label class="required" for="txtEmergencyCell">Telephone Number XXX-XXX-XXXX</label>
                            <input
                                   <?php if ($emergencyCellERROR) print 'class="mistake"'; ?>
                                   id="txtEmergencyCell"
                                   maxlength="45"
                                   name="txtEmergencyCell"
                                   onfocus="this.select()"
                                   placeholder="Enter contact's telephone number"
                                   tabindex="108"
                                   type="text"
                                   value="<?php print $emergencyCell; ?>"
                                >
                        </p>
                        <p>
                            <label class="required" for="txtAuthorize1">Authorized to Pick Up #1</label>
                            <input
                                   <?php if ($authorize1ERROR) print 'class="mistake"'; ?>
                                   id="txtAuthorize1"
                                   maxlength="45"
                                   name="txtAuthorize1"
                                   onfocus="this.select()"
                                   placeholder="Enter authorized person's name"
                                   tabindex="108"
                                   type="text"
                                   value="<?php print $authorize1; ?>"
                                >
                        </p>
                        <p>
                            <label class="required" for="txtAuthorize1Relationship">Relationship to Child</label>
                            <input
                                   <?php if ($authorize1RelationshipERROR) print 'class="mistake"'; ?>
                                   id="txtAuthorize1Relationship"
                                   maxlength="45"
                                   name="txtAuthorize1Relationship"
                                   onfocus="this.select()"
                                   placeholder="Enter relationship"
                                   tabindex="109"
                                   type="text"
                                   value="<?php print $authorize1Relationship; ?>"
                                >
                        </p>
                        <p>
                            <label class="required" for="txtAuthorize2">Authorized to Pick Up #2</label>
                            <input
                                   <?php if ($authorize2ERROR) print 'class="mistake"'; ?>
                                   id="txtAuthorize2"
                                   maxlength="45"
                                   name="txtAuthorize2"
                                   onfocus="this.select()"
                                   placeholder="Enter authorized person's name"
                                   tabindex="109"
                                   type="text"
                                   value="<?php print $authorize2; ?>"
                                >
                        </p>
                         <p>
                            <label class="required" for="txtAuthorize2Relationship">Relationship to Child</label>
                            <input
                                   <?php if ($authorize2RelationshipERROR) print 'class="mistake"'; ?>
                                   id="txtAuthorize2Relationship"
                                   maxlength="45"
                                   name="txtAuthorize2Relationship"
                                   onfocus="this.select()"
                                   placeholder="Enter relationship"
                                   tabindex="110"
                                   type="text"
                                   value="<?php print $authorize2Relationship; ?>"
                                >
                        </p>
                    </fieldset> <!-- ends contact -->
        
                    
                    
                    <!-- gender of child -->
                    <fieldset class ="radio <?php if ($genderERROR) print 'mistake'; ?>">
                              <legend>What is your child's gender?</legend>
                        <p>
                            <label class='radio-field'><input type="radio" id="radGenderFemale" name="radGender" value="Female" tabindex="572"
                         <?php if ($gender == "Female") echo ' checked="checked" '; ?>>
                                Female</label>
                        </p>
                        <p>
                            <label class="radio-field"><input type="radio" id="radGenderMale" name='radGender' value="Male" tabindex="574"
                        <?php if ($gender == "Male") echo ' checked="checked" ';?>>
                                Male</label>
                    </p>
                    
                    <p>
                        <label class="radio-field"><input type="radio" id="radGenderPrefer" name="radGender" value="Prefer" tabindex="576"
                      <?php if ($gender == "Prefer") echo ' checked="checked" ';?>>
                            Prefer not to answer</label>
                    </p>
                    </fieldset>
                    
                    
                    
                    <fieldset class="textarea">
                        <legend> HEALTH HISTORY </legend>
                        <p> 
                            <label class="required" for="txtComments">Please list any food, environmental or other allergies, which are severe,
                                life threatening or require emergency medication.</label>
                            <textarea <?php if ($commentsERROR) print 'class="mistake"'; ?>
                                id="txtComments"
                                name="txtComments"
                                onfocus="this.select()"
                                tabindex="560"><?php print $comments; ?></textarea>
                        </p>
                        
                        <p>
                            <label class="required" for="txtComments2">Please list any SPECIAL CONSIDERATIONS/NEEDS relevant
                                to your child, such as existing illnesses, previous serious illnesses, injuries or hospitalizations
                                within the past 12 months, any medications prescribed for long-term continuous use, behavioral/emotional
                                issues, etc. that we should be aware of.</label>
                            <textarea <?php if ($comments2ERROR) print 'class="mistake"'; ?>
                                id="txtComments2"
                                name="txtComments2"
                                onfocus="this.select()"
                                tabindex="560"><?php print $comments2; ?></textarea>
                        </p>
                        <p>
                            <label class="required" for="txtComments3">Please list any prescription medications like EPI pens,
                                inhalers, etc. which require administration for emergency purposes during program hours</label>
                            <textarea <?php if ($comments3ERROR) print 'class="mistake"'; ?>
                                id="txtComments3"
                                name="txtComments3"
                                onfocus="this.select()"
                                tabindex="560"><?php print $comments3; ?></textarea>
                        </p>
                    </fieldset>
                              
                    <fieldset class="checkbox <?php if($acceptERROR) print ' mistake'; ?>">
                        <legend> In the event that I cannot be reached to make arrangements for medical treatment, I authorize PS75 ASP, 
                            LLC AFTERSCHOOL PROGRAM staff to administer first aid/ or transport to the nearest hospital or emergency care 
                            facility.</legend>
                        
                        <p>
                            <label class="check-field">
                                <input <?php if ($accept) print " checked";?>
                                    id="chkAccept"
                                    name="chkAccept"
                                    tabindex="420"
                                    type="checkbox"
                                    value="Accept">By clicking on this box, I state that I agree with the above statement</label>
                        </p>
                       
                    </fieldset>
                    
                    <fieldset class="checkbox <?php if($accept2ERROR) print ' mistake'; ?>">
                        <legend> I certify that my child has been examined by a licensed physician in the past 12 months,
                            is able to participate in the PS75 ASP, LLC AFTERSCHOOL PROGRAM. The health history is correct as
                            far as I know, and the person herein described has permission to engage in all prescribed activities
                            and fieldtrips, except as noted by the examining physician and I.</legend>
                        <p>
                            <label class="check-field">
                                <input <?php if ($accept2) print " checked";?>
                                    id="chkAccept2"
                                    name="chkAccept2"
                                    tabindex="420"
                                    type="checkbox"
                                    value="Accept">By clicking on this box, I state that I agree with the above statement</label>
                        </p>
                    </fieldset>
                    
                    <fieldset class="checkbox <?php if($accept3ERROR) print ' mistake'; ?>">
                        <legend>I certify that all the above knowledge is accurate and complete. By checking
                        this box I acknowledge that I am providing my electronic signature on this document. </legend>
                        <p>
                            <label class="check-field">
                                <input <?php if ($accept3) print " checked";?>
                                    id="chkAccept3"
                                    name="chkAccept3"
                                    tabindex="420"
                                    type="checkbox"
                                    value="Accept">By clicking on this box, I state that I agree with the above statement</label>
                        </p>
                    </fieldset>
                    <fieldset class ="buttons">
                        <legend></legend> 
                        <input class="button" id="btnSubmit" name="btnSubmit" tabindex="900" type ="submit" value ="Register">
                    </fieldset> <!-- ends buttons -->
        </form>
        <?php
         } //ends body submit
      ?>  
    </article>
</main>

<?php include 'footer.php'; ?>

</body>
</html>
