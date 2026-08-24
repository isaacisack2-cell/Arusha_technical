<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ATC - CONTACTS</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        body{
            background-color: rgba(200,199,210,0.8);
        }

        button a{
            text-decoration:none;
            font-weight: 700;
            font-size: 0.85rem;
            transition: all 0.2s ease;
        }

        button a:hover{
            color: white;
        }

        .logo{
            width: 100px;
            height: 100px;
            object-fit: cover;
            overflow: hidden;
        }

        .card{transition: all 0.2s ease;background-color: #acb8;}
        .card:hover{
            transform: translateY(-2px);
            scroll-behavior: smooth;
            border: 1px solid #0000ff;
            box-shadow: 0 4px 10px #302131;
        }

        .nav-brand{
            color: #0000ff;
            font-weight: bold;
            font-size: 1.5rem;
            text-decoration: none;
            transition: color 0.5s ease-in, transform 0.2s ease-in-out;
        }

        .nav-brand:hover{
            color: #FFFFFF;
            transform: translateY(-3px);
        }
    </style>
</head>
<body>

<!-- NAVIGATION BAR -->
<div class="navbar navbar-dark bg-dark navbar-expand-lg">
    <div class="container-fluid">
       <a href="index.php" class="nav-brand">HOME</a>
       <a href="about.php" class="nav-brand">ABOUT US</a>
        <a href="login.php" class="nav-brand">SIGNIN</a>
    </div>
</div>


    <div class="container mt-5">
        <h3 class="text-info text-center mb-5">CONTACT US <br>
            <span class="text-success">
                <span class="logo m-3"><img src="pictures/atc logo.png" alt="ATC LOGO" class="logo mr-5"></span>
                <h4>Arusha Technical College</h4>
            </span>
        </h3>
        <div class="row">
            <!-- SEND EMAIL -->
            <div class="col-6 col-md-4">
                <div class="card bg-light">
                    <div class="card-body">
                        <h5 class="card-title">Send Email</h5>
                        <p class="card-text">Enter your message</p>
                        <form method="post">
                            <textarea name="message" id="message" cols="30" rows="4" class="form-control" autocomplete="on" autocorrect="on"></textarea>
                        <button type="submit" class="btn btn-outline-primary mt-4 w-100">
                            <a href="mailto:isaacisack2@gmail.com?subject=User_contact&body=<?php if(isset($_POST['message'])){echo $_POST['message'];}else{echo "i need help on how to register online";} ?>" class="fw-200">
                                SEND EMAIL
                            </a>
                        </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- SEND SMS -->
            <div class="col-6 col-md-4">
                <div class="card bg-light">
                    <div class="card-body">
                        <h5 class="card-title">Send SMS</h5>
                        <p class="card-text">Enter your sms message to send</p>
                        <form method="post">
                            <textarea name="sms" id="sms" cols="30" rows="4" autocomplete="on" autocorrect="on" class="form-control"></textarea>
                            <button type="submit" class="btn btn-outline-primary mt-4 w-100">
                                <a href="sms:255619552706?body=<?php if(isset($_POST['sms'])){echo $_POST['sms'];}else{ echo "hello how can i register direct at ATC";} ?>">
                                    SEND SMS
                                </a>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- PHONE CALL -->
            <div class="col-12 col-md-4">
                <div class="card bg-light">
                    <div class="card-body">
                        <h5 class="card-title">MAKE A PHONE CALL</h5>
                        <p class="card-text text-primary fw-bold" style="font-family:Arial;">This will make a direct dial phone call to admisiion office. <br>If You have more requests you can just visit direct an admission office at atc</p>
                        <form method="post">
                            <button type="submit" class="btn btn-outline-primary mt-4 w-100">
                                <a href="tel:255619552706">
                                    CALL
                                </a>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>