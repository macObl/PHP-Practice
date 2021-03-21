<?php
include ("Common/Class_Lib.php");
session_start(); 	// start PHP session!

include("./Common/Header.php");
include("./Common/Functions.php");

if(!isset($_SESSION["StudentObject"]))
{
    $_SESSION["GoTo"] = "CurrentRegistration.php";
    header("Location: Login.php");
    exit();

}

$Student = $_SESSION["StudentObject"];

$id = $Student->getId();
$name = $Student->getName();
$phone = $Student ->getPhone();
$password = $Student->getPassword();

$allSemesterCodes = getListOfSemesterCodes();

if (isset($_POST["btnDelete"]))
{

    $selectedCoursesList = $_POST['selectedCourse'];

    //check if array of checkboxes is empty
    if (empty($selectedCoursesList)) {
        $ErrorCheckboxMessage = "You must select as least 1 course";
    } else {

        $ErrorCheckboxMessage = "";

        //Delete selected courses from DB
        echo "Deleting Courses!";

        foreach ($selectedCoursesList as $courseID)
        {

            deleteSelectedCourses($id, $courseID);
        }

        //reload page
        header("Location: CurrentRegistration.php");
        exit();
    }

}

?>


<div class="container" align="center">
    <h1 >Course Registration Page!</h1>
    <hr>
</div>
<div class="container">
    <p>Hello <b><?php echo $name ?></b>! (not you? Change user <a href="Login.php">here</a>).
        The following are your current registrations.</p>


    <p id="jsMessage"></p>
    <div align="right">
        <span  class="text-danger"><?php echo $ErrorCheckboxMessage; ?></span>
    </div>
    <form id="registrationDisplayForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <table class='table' border="1">
        <tr>
            <th>Year</th>
            <th>Term</th>
            <th>Course Code</th>
            <th>Course Title</th>
            <th>Hours</th>
            <th>Select</th>

        </tr>
        <?php

        //get registration object from student ID
        $registrationObjects = getRegistrationsByStudenID($id);


        $courseObjects = array();
        $semesterObjects = array();
        $completeRegistrationList = array();


        //get semesterID and courseID for each registration
        foreach ($registrationObjects as $r)
        {
            $semesterID = $r->getSemesterCode();
            $registeredSemesterIDs[] = $semesterID;
            $courseID = $r->getCourseCode();


            //get course and semester objects
            $courseObject = getCourseByCourseCode($courseID);
            $semesterObject = getSemesterBySemesterCode($semesterID);

            //add them to master class for all properties
            $year = $semesterObject->getYear();
            $term = $semesterObject->getTerm();

            $courseCode = $courseObject->getCourseCode();
            $title = $courseObject->getTitle();
            $hours = $courseObject->getWeeklyHours();

            //create Master Object to display
            $completeRegistrationList[] = new Complete_Registration($semesterID, $year, $term, $courseCode, $title, $hours);

        }

        $registrationsBySemester = array();


        //remove irrelevant semesterIDs from $allSemesterCodes
        $relevantSemesterCodes = array_intersect($allSemesterCodes, $registeredSemesterIDs);


        if(!empty($completeRegistrationList))
        {
            $i = 0;
            foreach ($relevantSemesterCodes as $oneSemester)
            {
                //create array for that semester
                $arrayForSpecificSemesterCode = array();


                foreach($completeRegistrationList as $crl)
                {
                    $semesterCode = $crl->getSemesterCode();
                    //the the semesterCode exists in the courseobject then add it to THAT semesters array
                    if ($semesterCode == $oneSemester)
                    {
                        $arrayForSpecificSemesterCode[] = $crl;
                    }

                }
                //add semester array to multidimensional array
                $registrationsBySemester[] = $arrayForSpecificSemesterCode;
            }

            //region TESTING
//            print_r($relevantSemesterCodes);

            //print_r($registrationObjects);
            //multidimensional Array
            //print_r($registrationsBySemester);
            //endregion

            foreach ($registrationsBySemester as $semester)
            {
                //reset weeklyHours total
                $weeklyTotal = 0;

                foreach($semester as $crl)
                {
                    $semesterCode = $crl->getSemesterCode();
                    $year = $crl->getYear();
                    $term = $crl->getTerm();
                    $code = $crl->getCourseCode();
                    $title = $crl->getCourseTitle();
                    $weeklyHours = $crl->getHours();

                    $weeklyTotal += $weeklyHours;


                    echo "<tr>";
                    echo "<td>$year</td><td>$term</td><td>$code</td><td>$title</td><td>$weeklyHours</td><td><input type='checkbox' name='selectedCourse[]' value='$code'/>&nbsp;</td>";
                    echo "</tr>";
                    $i++;
                }
                echo "<tr>";
                echo "<tr><th colspan='5' style='text-align: right'>Total Weekly Hours: <b>$weeklyTotal</b><td></td></th></tr>";
                echo "</tr>";

            }
        }

        ?>
    </table>
</div>


<br/>
    <div class="container" align="right">
        <div class="form-group row">
            <input class="btn btn-danger" type="submit" name="btnDelete" value="Delete Selected"
                   onclick="return confirm('Are you sure you want to delete the selected courses??')"/>


            <span style="padding-left:3em"></span>
            <input class="btn btn-primary"
                   type="submit"
                   name="clear"
                   onclick="$('input:checkbox').removeAttr('checked');" value="Clear">
            <span style="padding-right: 2em"></span>
        </div>
    </div>




<br><br><br><br><br>



<?php include("./Common/Footer.php");?>
