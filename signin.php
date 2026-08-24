<?php
require "config.php";
if(isset($_POST['register']) && $_SERVER['REQUEST_METHOD'] == "POST"){
    try{
    $course = strtoupper(htmlspecialchars(trim($_POST['course'])));
    $fname = htmlspecialchars(trim($_POST['fname']));
    $lname = htmlspecialchars(trim($_POST['lname']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
    $dob = $_POST['DOB'];
    $gender = $_POST['gender'] ?? '';

    $sql1 = $pdo->prepare("SELECT * FROM course WHERE CourseName = :course");
    $sql2 = $pdo->prepare("INSERT INTO registration(paid) values (0.00)");
    $sql3 = $pdo->prepare("SELECT * FROM registration ORDER BY registeredOn DESC limit 1");

    $sql1->execute([':course'=>$course]);
    $sql2->execute();
    $sql3->execute();

    $result1 = $sql1->fetch();
    $result3 = $sql3->fetch();

    if($result1 && $result3){
        $courseId = $result1['CourseId'];
        $deptId = $result1['DeptId'];
        $regId = $result3['RegId'];
        $adno = random_int(20000000000,27000000000);
        $NHIF = random_int(2000000000,3000000000);

        try{
            $sql2 = $pdo->prepare("INSERT INTO student VALUES (:adno,:fname,:lname,:email,:DOB,:gender,:NHIF,:courseId,:deptId,:regId,:passwor)");
            $sql2->execute([
                ':adno' => $adno,
                ':fname' => $fname,
                ':lname' => $lname,
                ':email' => $email,
                ':DOB' => $dob,
                ':gender' => $gender,
                ':NHIF' => $NHIF,
                ':courseId' => $courseId,
                ':deptId' => $deptId,
                ':regId' => $regId,
                ':passwor' => $password
            ]);
            $message = "Registration complete successfull <br>Your Admission number is:<kbd> $adno </kbd> <br> <a href='login.php'>log in here</a>";

        }catch(PDOException $e){
            $error = "Error occured ".$e->getMessage();
        }
    }else{
        $error = "Invalid / Unknown course name";
    }
}catch(PDOException $e){
    $error = "Error during registration".$e->getMessage();
}
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ATC-SMS REGISTRATION</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5 mb-5">

        <div class="row justify-content-center">
            <div class="col-9 col-md-10">
                <div class="card p-5" style="background-color:rgba(250,253,254,0.9);">
                <header class="m-4 text-center">
                    <h1>ATC - SMS</h1>
                    <div class="row justify-content-center">
                        <img src="pictures/atc logo.png" alt="ATC-LOGO" class="card-img-top w-50">
                    </div>
                    <small>Register now to create sms account</small>
                </header>
                <form method="post">

                    <div class="mb-4">
                        <label for="course" class="form-label">Course</label>
                        <input type="text" name="course" id="course" list="courselist" required placeholder="Enter your course name" class="form-control">
                        <datalist id="courselist">
                            <option value="IT">Information Technology</option>
                            <option value="CS">Computer Science</option>
                            <option value="CIVIL">Civil Engineering</option>
                            <option value="LABARATORY SCIENCE">Laboratory Science</option>
                            <option value="MECHATRONICS">Mechatronics</option>
                            <option value="TOURISM">Tour Guide</option>
                            <option value="HOTEL">Hotel management</option>
                        </datalist>
                    </div>

                    <div class="mb-4">
                        <label for="fname" class="form-label">First Name</label>
                        <input type="text" class="form-control" name="fname" id="fname" required placeholder="Enter your first name">
                    </div>

                    <div class="mb-4">
                        <label for="lname" class="form-label">Last Name</label>
                        <input type="text" name="lname" id="lname" class="form-control" required placeholder="Enter last name ...">
                    </div>

                    <div class="mb-4">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="fill your email .... ">
                    </div>

                    <div class="mb-4">
                        <label for="DOB" class="form-label">Date Of Birth</label>
                        <input type="date" name="DOB" id="DOB" class="form-control">
                    </div>

                    <div class="mb-4 form-check">
                        <label for="gender" class="form-radio-label">GENDER</label> <br>
                        <input type="radio" name="gender" id="gender" class="form-radio-input" value="male">MALE
                        <input type="radio" name="gender" id="gender" class="form-radio-input" value="female">FEMALE
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label">PASSWORD</label>
                        <input type="password" name="password" id="password" class="form-control" required placeholder="Set Your SMS Password ... ">
                    </div>

                    <p>Already Registerd <a href="login.php">log in</a></p>
                    <div class="mb-5">
                        <button type="submit" class="btn btn-success fw-bold w-100 btn-expand-lg" name="register">REGISTER</button>
                    </div>
                </form>
                <div class="card-foot">
                    <?php include "status_box.php"; ?>
                </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>