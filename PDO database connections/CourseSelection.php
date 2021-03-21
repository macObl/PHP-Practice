<?php
//NOTE: include class definition BEFORE session start!
include ("Common/Class_Lib.php");

session_start(); 	// start PHP session!

include("./Common/Functions.php");
include("./Common/Header.php");

//redirect and protect page
if(!isset($_SESSION["StudentObject"]))
{
        $_SESSION["GoTo"] = "CourseSelection.php";
        header("Location: Login.php");
        exit();
}


$Student = $_SESSION["StudentObject"];
$dbConnection =  $_SESSION["dbconnection"];

$id = $Student->getId();
$name = $Student->getName();
$phone = $Student ->getPhone();
$password = $Student->getPassword();

$semesterCode = $term = $year = $currentSemester = $totalHours ="";

$ErrorCheckboxMessage = " ";

//region TESTING
//printf($validCheckbox);


//print_r($dbConnection);
//print_r($semesters);
//print_r($testing);
//endregion

//Hand Hours display
if (isset ($_POST['semester']))
{
    $selectedSemester = ($_POST['semester']);
    $totalHours = getRegisteredHours($id, $selectedSemester);

    $remainingHours = 16-$totalHours;
}


if (isset($_POST["btnSubmit"]))
{
    //get list of checked courses
    $selectedCoursesList = $_POST['selectedCourse'];

    //check if array of checkboxes is empty
    if (empty($selectedCoursesList)) {
        $ErrorCheckboxMessage = "You must select as least 1 course";
    } else {

        $newHours = 0;
        foreach ($selectedCoursesList as $cID)
        {
            $weeklyHours = getCourseHoursByCourseID($cID);
            $newHours += $weeklyHours;
        }
        $potentialHours = $newHours + $totalHours;
        if($potentialHours > 16)
        {
            $ErrorCheckboxMessage = "Your selection exceeds the maximum amount of hours";
        }
        else
        {
            $ErrorCheckboxMessage = "";

            //Call function to insert into DB Registrations
            writeCoursesToRegistrationDB($selectedCoursesList, $id, $selectedSemester);

            header("Location: CurrentRegistration.php");
            exit();
        }

    }

}



?>

<div class="container">
    <h1 align="center">Course Selection Page!</h1>
    <hr>
    <p>Welcome <b><?php echo $name ?></b>! (not you? Change user <a href="Login.php">here</a>) </p>
   <?php

   if (isset($selectedSemester))
   {
       ?>
       <p>You have registered for <b><?php echo $totalHours ?></b> hours for the selected semester</p>
       <p>You can register for <b><?php echo $remainingHours?></b> more hours of courses this semester</p>

       <?php
   }
   else
   {
       echo "<p>Please choose a semester in order to display weekly hours</p>";
       echo "<p>Please choose a semester in order to display remaining available hours</p>";

   }
   ?>
<!--    <p>You have registered for <b>--><?php //echo $totalHours?><!--</b> hours for the selected semester</p>-->

    <p>(Please note that the courses you have registered for will not be displayed in the list)</p>

    <br>

    <form id="courseSelectionForm" name="courseSelectionForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">


        <p id="selectedSemester"></p>


        <div class="dropown" align="right">

            <select name="semester" id="semester" class="dropdown" style="float: right" onchange="document.courseSelectionForm.submit();">
                <option value="">Select a Semester</option>
                <?php

                $semesterSQL = "SELECT * FROM Semester";
                $stmt = $myPdo->prepare($semesterSQL);
                $stmt->execute();
                foreach($stmt as $row) {
                    $semester = array($row['SemesterCode'], $row['Term'], $row['Year']);
                    $semesters[] = $semester;
                }

                //following code written by Amanda Desa/////////////////////////////
                foreach ($semesters as $semValue)
                {
                    echo "<option value='$semValue[0]'";
                    if($semValue[0] == $_POST['semester']){
                        echo "selected='selected'";
                    }
                    echo ">".$semValue[2]." " .$semValue[1]."</option>";     //printing the semester year and term
                }
                ////////////////////////////////////////////////////////////////////
                ?>
            </select>
            <br>


        </div>
        <br>
        <div align="right">
        <span  class="text-danger"><?php echo $ErrorCheckboxMessage; ?></span>
        </div>

        <table class='table' border="1">
            <tr>
                <th>Code</th>
                <th>Course Title</th>
                <th>Hours</th>
                <th>Select</th>

            </tr>
            <?php

            //get list of courses for student from registration table
            $alreadyRegistered = getCourseIDByStudentID($id);

            //list of course objects to display
            $courses = getCourseBySemester($selectedSemester, $id);



            $i = 0;
            foreach ($courses as $c)
            {
                $code = $c->getCourseCode();
                $title = $c->getTitle();
                $weeklyHours = $c->getWeeklyHours();

                echo "<tr>";
                echo "<td>$code</td><td>$title</td><td>$weeklyHours</td><td><input type='checkbox' name='selectedCourse[]' value='$code' size='2'/>&nbsp;</td>";
                echo "</tr>";
                $i++;
            }
            ?>
        </table>

        <br/>
        <div class="container" align="right">
            <div class="form-group row">
                <input class="btn btn-primary" type="submit" name="btnSubmit" value="Submit"/>
                <span style="padding-left:3em"></span>
                <input class="btn btn-primary"
                       type="submit"
                       name="clear"
                       onclick="$('input:checkbox').removeAttr('checked');" value="Clear">
                <span style="padding-right: 2em"></span>
            </div>
        </div>
    </form>




</div>

<br><br><br><br><br>


<?php include("./Common/Footer.php");?>
