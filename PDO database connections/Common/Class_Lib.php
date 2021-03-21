<?php


class Class_Lib
{
}

class Student

{
    private $id;
    private $name;
    private $phone;
    private $password;


    public function __construct($id, $name, $phone, $password)
    {
        $this->id = $id;
        $this->name = $name;
        $this->phone = $phone;
        $this->password = $password;
    }

    //region: Getters and Setters
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = trim($id);
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = trim($name);
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = trim($phone);
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = trim($password);
    }
    //endregion

}

class Course
{
    private $courseCode;
    private $title;
    private $weeklyHours;

    public function __construct($courseCode, $title, $weeklyHours)
    {
        $this->courseCode = $courseCode;
        $this->title = $title;
        $this->weeklyHours = $weeklyHours;
    }

    //region Getters and Setters
    /**
     * @return mixed
     */
    public function getCourseCode()
    {
        return $this->courseCode;
    }

    /**
     * @param mixed $courseCode
     */
    public function setCourseCode($courseCode)
    {
        $this->courseCode = $courseCode;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getWeeklyHours()
    {
        return $this->weeklyHours;
    }

    /**
     * @param mixed $weeklyHours
     */
    public function setWeeklyHours($weeklyHours)
    {
        $this->weeklyHours = $weeklyHours;
    }
    //endregion


}

class Semester
{
    private $semesterCode;
    private $year;
    private $term;

    /**
     * Semester constructor.
     * @param $semesterCode
     * @param $year
     * @param $term
     */
    public function __construct($semesterCode, $year, $term)
    {
        $this->semesterCode = $semesterCode;
        $this->year = $year;
        $this->term = $term;
    }

    //region Getters and Setters
    /**
     * @return mixed
     */
    public function getSemesterCode()
    {
        return $this->semesterCode;
    }

    /**
     * @param mixed $semesterCode
     */
    public function setSemesterCode($semesterCode)
    {
        $this->semesterCode = $semesterCode;
    }

    /**
     * @return mixed
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param mixed $year
     */
    public function setYear($year)
    {
        $this->year = $year;
    }

    /**
     * @return mixed
     */
    public function getTerm()
    {
        return $this->term;
    }

    /**
     * @param mixed $term
     */
    public function setTerm($term)
    {
        $this->term = $term;
    }
    //endregion



}

class Registration
{
    private $studentId;
    private $courseCode;
    private $semesterCode;

    /**
     * Registration constructor.
     * @param $studentId
     * @param $courseCode
     */
    public function __construct($studentId, $courseCode, $semesterCode)
    {
        $this->studentId = $studentId;
        $this->courseCode = $courseCode;
        $this->semesterCode = $semesterCode;
    }



    //region Getters and Setters

    /**
     * @return mixed
     */
    public function getStudentId()
    {
        return $this->studentId;
    }

    /**
     * @param mixed $studentId
     */
    public function setStudentId($studentId)
    {
        $this->studentId = $studentId;
    }

    /**
     * @return mixed
     */
    public function getCourseCode()
    {
        return $this->courseCode;
    }

    /**
     * @param mixed $courseCode
     */
    public function setCourseCode($courseCode)
    {
        $this->courseCode = $courseCode;
    }

    /**
     * @return mixed
     */
    public function getSemesterCode()
    {
        return $this->semesterCode;
    }

    /**
     * @param mixed $semesterCode
     */
    public function setSemesterCode($semesterCode)
    {
        $this->semesterCode = $semesterCode;
    }


    //endregion

}

class Course_Offer
{
    private $courseCode;
    private $semesterCode;

    /**
     * Course_Offer constructor.
     * @param $courseCode
     * @param $semesterCode
     */
    public function __construct($courseCode, $semesterCode)
    {
        $this->courseCode = $courseCode;
        $this->semesterCode = $semesterCode;
    }

    //region Getters and Setters
    /**
     * @return mixed
     */
    public function getCourseCode()
    {
        return $this->courseCode;
    }

    /**
     * @param mixed $courseCode
     */
    public function setCourseCode($courseCode)
    {
        $this->courseCode = $courseCode;
    }

    /**
     * @return mixed
     */
    public function getSemesterCode()
    {
        return $this->semesterCode;
    }

    /**
     * @param mixed $semesterCode
     */
    public function setSemesterCode($semesterCode)
    {
        $this->semesterCode = $semesterCode;
    }
    //endregion


}

class Complete_Registration
{
    private $semesterCode;
    private $year;
    private $term;
    private $courseCode;
    private $courseTitle;
    private $hours;

    /**
     * Complete_Registration constructor.
     * @param $year
     * @param $term
     * @param $courseCode
     * @param $courseTitle
     * @param $hours
     */
    public function __construct($semesterCode, $year, $term, $courseCode, $courseTitle, $hours)
    {
        $this->semesterCode = $semesterCode;
        $this->year = $year;
        $this->term = $term;
        $this->courseCode = $courseCode;
        $this->courseTitle = $courseTitle;
        $this->hours = $hours;
    }



    //region Getters and Setters
    /**
     * @return mixed
     */
    public function getSemesterCode()
    {
        return $this->semesterCode;
    }

    /**
     * @param mixed $semesterCode
     */
    public function setSemesterCode($semesterCode)
    {
        $this->semesterCode = $semesterCode;
    }
    /**
     * @return mixed
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param mixed $year
     */
    public function setYear($year)
    {
        $this->year = $year;
    }

    /**
     * @return mixed
     */
    public function getTerm()
    {
        return $this->term;
    }

    /**
     * @param mixed $term
     */
    public function setTerm($term)
    {
        $this->term = $term;
    }

    /**
     * @return mixed
     */
    public function getCourseCode()
    {
        return $this->courseCode;
    }

    /**
     * @param mixed $courseCode
     */
    public function setCourseCode($courseCode)
    {
        $this->courseCode = $courseCode;
    }

    /**
     * @return mixed
     */
    public function getCourseTitle()
    {
        return $this->courseTitle;
    }

    /**
     * @param mixed $courseTitle
     */
    public function setCourseTitle($courseTitle)
    {
        $this->courseTitle = $courseTitle;
    }

    /**
     * @return mixed
     */
    public function getHours()
    {
        return $this->hours;
    }

    /**
     * @param mixed $hours
     */
    public function setHours($hours)
    {
        $this->hours = $hours;
    }
    //endregion


}

