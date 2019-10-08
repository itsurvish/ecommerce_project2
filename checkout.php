<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Simple HTML Form</title>
    <link rel='stylesheet' href='css/style.css' type='text/css' media='all' />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


    <style type="text/css">
        label {
            font-weight: bold;
            color: #300ACC;
        }

    </style>
    

</head>

<body>
     <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
        <a class="navbar-brand" href="home.php">Mobile Hub</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Product<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cart.php">Cart</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="checkout.php">Checkout</a>
                </li>
            </ul>
        </div>
    </nav>

    <form method="post">

        <fieldset>
            <legend>Checkout</legend>

            <p><label>First Name: <input type="text" name="firstname" size="20" maxlength="40"></label></p>

            <p><label>Last Name: <input type="text" name="lastname" size="20" maxlength="40"></label></p>


            <p><label for="">Payment method: </label><input type="radio" name="payment" value="debit"> Debit <input type="radio" name="payment" value="credit"> Credit</p>

        </fieldset>


        <input type="submit" name="submit" class="btn btn-success" value="Submit ">


    </form>
    <?php 
       if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
        if(!empty($_POST['firstname'])){
            $firstname = $_POST['firstname'];
        }
    else
    {
        $firstname = NULL;
        echo '<p class ="error"> Please enter your first name</p>';
    }
    
     if(!empty($_REQUEST['lastname'])){
            $lastname = $_REQUEST['lastname'];
        }
    else
    {
        $lastname = NULL;
        echo '<p class ="error"> Please enter your last name</p>';
    }
    
     
    
    if(isset($_REQUEST['payment']))
    {
        $payment = $_REQUEST['payment'];
        
        if ($payment == 'debit')
    {
        $message = '<p><strong> Debit</strong></p>';
    } elseif($payment == 'credit')
        {
        $message = '<p><strong> Credit</strong></p>';
    }
    else{
        $payment = NULL;
        echo '<p class = "error">Please Select debit or credit</p>';
    }
    }else 
    {
        $payment = null;
        echo '<p class = "error">Please select payment method</p>';
    }
    
    
    
    if($firstname && $lastname && $payment)
    {


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO user (firstname, lastname, payment)
VALUES ('".$_POST["firstname"]."','".$_POST["lastname"]."','".$_POST["payment"]."')";

        //shows alert msg if submits successfully, and redirects to inventory automatically after 3 seconds
if ($conn->query($sql) === TRUE) {
echo "<script type= 'text/javascript'>alert('Thank you for shopping with us...');</script>
";
    echo "<meta http-equiv = 'refresh' content = '3; url =index.php' />";
} else {
echo "<script type= 'text/javascript'>alert('Error: " . $sql . "<br>" . $conn->error."');</script>";
}
        
    

$conn->close();
		
		
		
    }else {
		
        echo '<p class = "error"> <strong>Please enter your details.</strong></p>';
    }
    
       }

?>
    <button type='index' class="btn btn-primary" onClick="location.href='index.php'">Inventory</button>

</body>

</html>
