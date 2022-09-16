<?php
    include "./top.php";
    include "./welcomePageContent.html";
?>

<div class="stats">

<?php
    //connect to database
    $mysqli2 = mysqli_connect("localhost", "root", "password", "wordcounter");

    //check connection
    if (!$mysqli2) {
        die("Connection failed: " . mysqli_connect_error());
    }

    //get data
    if (isset($_POST['submit'])) {
        $project = $_POST['project'];
        $goal = $_POST['goal'];
        $current = $_POST['current'];
        $startDate = $_POST['startDate'];
        $endDate = $_POST['endDate'];

        //create new project and insert it into database
        $insert = mysqli_query($mysqli2, "INSERT INTO `test`(`ProjectName`, `WordGoal`, `CurrentWordcount`, `StartDate`, `EndDate`) VALUES ('$project', '$goal', '$current', '$startDate', '$endDate')");
        
        //check for errors
        if (!$insert) {
            echo mysqli_error();
        } else {
            //link to project page
            echo "<div class='newProjectLink'><a href='./projectPage.php?ProjectName=$project'>Project added succesfully. Access your project page by clicking here.</a></div>";
        }
    }

    mysqli_close($mysqli2);
?>

</div>

<?php
    include "./bottom.html";
?>