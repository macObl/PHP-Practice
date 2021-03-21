<?php

//FUNCTIONS//////////////////////////////////////////////////////////////

//ACCESS THE DATABASE//////////////////////////////////////////////////////////////
$dbConnection = parse_ini_file("Common/db_connection.ini");
extract($dbConnection);
$myPdo = new PDO($dsn, $user, $password);


//NEW USER=====================================================================================================
//================================================================================================================

function ValidateID($studentID) {
    $studentID = trim($studentID);

    $dbConnection = parse_ini_file("Common/db_connection.ini");
    extract($dbConnection);
    $myPdo = new PDO($dsn, $user, $password);

    $stmt = $myPdo->prepare("SELECT * FROM Student WHERE StudentId=:studentID LIMIT 1");
    $stmt->bindValue(':studentID', $studentID, PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ( strlen($studentID) == 0)
    {
        return "Student ID field can not be blank.";
    }
    elseif ($row) {
        return "A student with this ID has already signed up!";
    }
    else
    {
        return "";
    }
}

function ValidateName($name) {
    $name = trim($name);

    if ( strlen($name) == 0)
    {
        return "Name field can not be blank.";
    }
    else
    {
        return "";
    }
}

function ValidatePhone($phone) {
    $phone = trim($phone);

    $phoneRegex = "/^([1]-)?[2-9]{1}[0-9]{2}-[0-9]{3}-[0-9]{4}$/i";
    if (preg_match($phoneRegex, $phone, $matches))
    {
        return "";
    }
    else
    {
        return "Phone Number has been entered incorrectly!";
    }
}

function ValidatePassword($studentPassword) {
    $password = trim($studentPassword);

    $passwordRegex = "/^.*(?=.{6,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/";
    if (preg_match($passwordRegex, $studentPassword, $matches))
    {
        return "";
    }
    else
    {
        return "Password must be at least 6 characters long, contain at least one upper case letter, one lowercase letter, and one digit!";
    }
}

function ValidateRepeatPass($repeatedPass, $studentPassword) {
    $repeatedPass = trim($repeatedPass);
    $password = trim($studentPassword);


    if ($repeatedPass == $studentPassword)
    {
        return "";
    }
    else
    {
        return "Passwords do not match!";
    }
}

function ValidateUserCreation($validID, $validName, $validPhone, $validPassword, $validRepeatPass)
{
    if ($validID == "" && $validName == "" && $validPhone == "" && $validPassword == "" && $validRepeatPass == "")
    {

        return true;
    }
    else
    {
        return false;
    }
}


//LOGIN=====================================================================================================
//================================================================================================================

function ValidateLoginID($studentID) {
    $studentID = trim($studentID);

    if ( strlen($studentID) == 0)
    {
        return "Student ID cannot be blank.";
    }
    else
    {
        return "";
    }
}

function ValidateLoginPassword($studentPassword) {
    $studentPassword = trim($studentPassword);

    if ( strlen($studentPassword) == 0)
    {
        return "Password cannot be blank.";
    }
    else
    {
        return "";
    }
}

function ValidateLogin($validID, $validPassword) {
    if ($validID == "" && $validPassword == "")
    {
        return true;
    }
    else
    {
        return false;
    }

}

//COURSE SELECTION=====================================================================================================
//================================================================================================================


function getCourseBySemester($semester, $studentID)
{

    //initiate PDO
    $dbConnection = parse_ini_file("Common/db_connection.ini");
    extract($dbConnection);
    $myPdo = new PDO($dsn, $user, $password);

    $courses = array();

    $sql="SELECT Course.CourseCode Code, Title, WeeklyHours "
        ."FROM Course INNER JOIN CourseOffer ON Course.CourseCode = CourseOffer.CourseCode "
        ."WHERE CourseOffer.SemesterCode=:semesterCode "

        //removing registered courses from query
        ."AND Course.CourseCode "
        . "NOT IN (SELECT CourseCode FROM Registration "
        . "WHERE Registration.StudentId = :studentID AND Registration.SemesterCode = :semesterCode)";

        $pStmt = $myPdo->prepare($sql);
        $pStmt->execute(['studentID' => $studentID, 'semesterCode' => $semester]);


    foreach($pStmt as $row)
    {
        $course = new Course($row['Code'],$row['Title'],$row['WeeklyHours']);
        $courses[] = $course;
    }

    return $courses;
}

function writeCoursesToRegistrationDB($selectedCourses, $studentID, $semesterCode)
{
    //initiate PDO
    $dbConnection = parse_ini_file("Common/db_connection.ini");
    extract($dbConnection);
    $myPdo = new PDO($dsn, $user, $password);

    foreach ($selectedCourses as $course)
    {
        $sql = "INSERT INTO Registration (StudentId, CourseCode, SemesterCode) VALUES (?,?,?)";
        $stmt= $myPdo->prepare($sql);
        $stmt->execute([$studentID, $course, $semesterCode]);
    }
}

//This function partially written by Randy Wu//
function getRegisteredHours($id, $semesterCode) {

    $dbConnection = parse_ini_file("Common/db_connection.ini");
    extract($dbConnection);
    $myPdo = new PDO($dsn, $user, $password);


    $sql = "SELECT Registration.CourseCode,Course.WeeklyHours, Registration.SemesterCode 
            FROM Registration 
            INNER JOIN Course ON Registration.CourseCode = Course.CourseCode 
            WHERE StudentId =:studentID AND Registration.SemesterCode =:semesterCode";
    $pStmt = $myPdo -> prepare($sql);
    $pStmt -> execute(['studentID' => $id, 'semesterCode'=> $semesterCode]);
    $results = $pStmt->fetchAll(PDO::FETCH_ASSOC);
//    print_r( $results);

    $totalHours = 0;
    foreach ($results as $row) {
        $totalHours += $row['WeeklyHours'];
    }
    return $totalHours;
}

function getCourseHoursByCourseID($courseCode)
{
    $dbConnection = parse_ini_file("Common/db_connection.ini");
    extract($dbConnection);
    $myPdo = new PDO($dsn, $user, $password);

    $sql = "SELECT Course.CourseCode, Course.WeeklyHours Hours
            FROM Course
            WHERE CourseCode=:code";

    $pStmt = $myPdo -> prepare($sql);
    $pStmt -> execute(['code'=> $courseCode]);

    $totalHours = 0;
    foreach ($pStmt as $row) {
        $totalHours += $row['Hours'];
    }
    return $totalHours;
}



//CURRENT REGISTRATION=====================================================================================================
//================================================================================================================
 function getRegistrationsByStudenID($student)
 {
     $dbConnection = parse_ini_file("Common/db_connection.ini");
     extract($dbConnection);
     $myPdo = new PDO($dsn, $user, $password);

     $registrations = array();

     $sql="SELECT Registration.CourseCode Code, Registration.StudentId StudentID, Registration.SemesterCode SemesterID "
         ."FROM Registration "
         ."WHERE StudentID=:studentID";

     $pStmt=$myPdo->prepare($sql);
     $pStmt->execute(['studentID'=>$student]);

     foreach($pStmt as $row)
     {
         $registration = new Registration($row['StudentID'],$row['Code'],$row['SemesterID']);

         $registrations[] = $registration;
     }
     return $registrations;
 }



function getCourseIDByStudentID($student)
 {
     $dbConnection = parse_ini_file("Common/db_connection.ini");
     extract($dbConnection);
     $myPdo = new PDO($dsn, $user, $password);

     $courseCodes = array();


     $sql="SELECT Registration.CourseCode Code, Registration.StudentId StudentID, Registration.SemesterCode SemesterCode "
         ."FROM Registration "
         ."WHERE StudentID=:studentID";

     $pStmt=$myPdo->prepare($sql);
     $pStmt->execute(['studentID'=>$student]);

     foreach($pStmt as $row)
     {
        $courseID = $row['Code'];

         $courseCodes[] = $courseID;
     }
     return $courseCodes;
 }

 function getCourseByCourseCode($courseCode)
 {
     $dbConnection = parse_ini_file("Common/db_connection.ini");
     extract($dbConnection);
     $myPdo = new PDO($dsn, $user, $password);


     $sql="SELECT Course.CourseCode CourseCode, Title, WeeklyHours "
         ."FROM Course "
         ."WHERE CourseCode=:courseID";

     $pStmt=$myPdo->prepare($sql);
     $pStmt->execute(['courseID'=>$courseCode]);

     foreach($pStmt as $row)
     {
         $course = new Course($row['CourseCode'],$row['Title'],$row['WeeklyHours']);
     }

     return $course;
 }

 function getSemesterBySemesterCode($semesterCode)
 {
     $dbConnection = parse_ini_file("Common/db_connection.ini");
     extract($dbConnection);
     $myPdo = new PDO($dsn, $user, $password);

     $sql = "SELECT Semester.SemesterCode SemesterCode, Semester.Year Year, Semester.Term Term
         FROM Semester INNER JOIN Registration ON Semester.SemesterCode = Registration.SemesterCode 
         WHERE Semester.SemesterCode=:semesterCode";

     $pStmt=$myPdo->prepare($sql);
     $pStmt->execute(['semesterCode'=>$semesterCode]);

     foreach($pStmt as $row)
     {
         $semester = new Semester($row['SemesterCode'],$row['Year'],$row['Term']);
     }
     return $semester;
 }

 function getListOfSemesterCodes()
 {
     $dbConnection = parse_ini_file("Common/db_connection.ini");
     extract($dbConnection);
     $myPdo = new PDO($dsn, $user, $password);

     $sql = "SELECT Semester.SemesterCode SemesterCode FROM Semester";

     $pStmt=$myPdo->prepare($sql);
     $pStmt->execute();


     $semesterCodes = array();

     foreach($pStmt as $row)
     {
         $semesterCode = $row['SemesterCode'];
         $semesterCodes[] = $semesterCode;
     }
     return $semesterCodes;
 }

 function deleteSelectedCourses($studentID, $courseID)
 {
     $dbConnection = parse_ini_file("Common/db_connection.ini");
     extract($dbConnection);
     $myPdo = new PDO($dsn, $user, $password);

     $sql = "DELETE FROM Registration 
             WHERE StudentId=:studentId AND CourseCode=:courseID";

     $pStmt=$myPdo->prepare($sql);
     $pStmt->execute(['studentId'=>$studentID , 'courseID'=>$courseID]);

 }


