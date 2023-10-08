<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "student_registration";

$connection = new mysqli($servername, $username, $password, $database);

$name = "";
$email = "";
$phone = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD']=='POST'){
        $name = $_POST["name"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        

        do{
            if ( empty($name) || empty($email) || empty($phone) ){
                $errorMessage = "All the fields are required";
                break;
            }
            // add new student registration to db
            $sql = "INSERT INTO student (name, email, phone)" . 
                "VALUES ('$name','$email','$phone')";
            $result = $connection->query($sql);

            if(!$result){
                $errorMessage = "Invalid query : ". $connection->error;
                break;
            }

            $name = "";
            $email = "";
            $phone = "";

            $successMessage = "Student registration successful";

            header("location: /lab4/index.php");
            exit;

        }while(false);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Register</title>
    <link rel = "stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container my-5">
        <h2> New Registration </h2>

        <?php
        if (!empty($errorMessage)){
            echo "
            <div class = 'alert alert-warning alert-dismissible fade show' role ='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";

        }
        ?>
        <form method="post"> 
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Phone</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="phone" value="<?php echo $phone; ?>">
                </div>
            </div>

            <?php
            if(!empty($successMessage)){
                echo "
                <div class = 'row mb-3'>
                    <div class = 'offset-sm-3 col-sm-6'>
                        <div class = 'alert alert-success alert-dismissible fade show' role ='alert'>
                            <strong>$successMessage</strong>
                            <button type = 'button' class = 'btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                    </div>
                </div>

            ";
            }
            ?>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit </button>
                </div>
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-outline-primary" href = "/lab4/index.php">Cancel </button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>