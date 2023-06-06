<!DOCTYPE html>
<html>
<head>
    <title>School Management System</title>
    <style>
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .row {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-gap: 20px;
            margin-bottom: 20px;
        }
        
        .box {
            background-color: #f2f2f2;
            padding: 20px;
            text-align: center;
            cursor: pointer;
        }
        
        h1 {
            text-align: center;
        }

.button-wrapper a {
    display: inline-block;
    padding: 10px 20px;
    background-color: #333;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    font-size: 16px;
    font-weight: bold;
}


    </style>
</head>
<body>
    <div class="container">
<div class="button-wrapper">
    <a href="login.PHP">Logout</a>
</div>
        <h1>School Management System</h1>

        <div class="row">
            <div class="box" onclick="window.location.href='add_student.php';">
                <h3>Add Student</h3>
            </div>
            
            <div class="box" onclick="window.location.href='add_parent.php';">
                <h3>Add Parent</h3>
            </div>
            
            <div class="box" onclick="window.location.href='add_teacher.php';">
                <h3>Add Teacher</h3>
            </div>
            
            <div class="box" onclick="window.location.href='add_course.php';">
                <h3>Add Course</h3>
            </div>
        </div>
        
        <div class="row">
            <div class="box" onclick="window.location.href='add_admin.php';">
                <h3>Add Admin</h3>
            </div>
            
            <div class="box" onclick="window.location.href='make_classroom.php';">
                <h3>Make Classroom</h3>
            </div>
            
            <div class="box" onclick="window.location.href='add_student_fee.php';">
                <h3>Add Student Fee</h3>
            </div>
            
            <div class="box" onclick="window.location.href='mark_student_attendance.php';">
                <h3>Mark Student Attendance</h3>
            </div>
        </div>
        
        <div class="row">
            <div class="box" onclick="window.location.href='add_student_grades.php';">
                <h3>Add Student Grades</h3>
            </div>


            
            <div class="box" onclick="window.location.href='view_attendance.php';">
                <h3>View Attendance</h3>
            </div>
            
            <div class="box" onclick="window.location.href='view_fee.php';">
                <h3>View Fee</h3>
            </div>
            
            <div class="box" onclick="window.location.href='view_teachers.php';">
                <h3>View Teachers</h3>
            </div>
        </div>
        
        <div class="row">
            <div class="box" onclick="window.location.href='view_students.php';">
                <h3>View Students</h3>
            </div>
            
            <div class="box" onclick="window.location.href='view_parents.php';">
                <h3>View Parents</h3>
            </div>
            
            <div class="box" onclick="window.location.href='view_student_grades.php';">
                <h3>View Student Grades</h3>
            </div>
<div class="box" onclick="window.location.href='disable_student.php';">
    <h3>Disable Student</h3>
</div>

<div class="box" onclick="window.location.href='disable_teacher.php';">
    <h3>Disable teacher</h3>
</div>

<div class="box" onclick="window.location.href='disable_parent.php';">
    <h3>Disable Parent</h3>
</div>
    
<div class="box" onclick="window.location.href='add_student_classroom.php';">
    <h3>Add Student To Classroom</h3>
</div>
<div class="box" onclick="window.location.href='view_student_in_classroom.php';">
    <h3>View Students in Classroom</h3>
</div>

</body>
</html>
