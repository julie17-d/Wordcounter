<?php
    //connect to database
    $project = mysqli_connect("localhost", "root", "password", "wordcounter");

    //check connection
    if (!$project) {
        die("Connection failed: " . mysqli_connect_error());
    }

    //get current page's project's name
    $projectName = $_GET["ProjectName"];

    //get data for current page's project
    $table = mysqli_query($project, "SELECT * FROM wordcounter.test WHERE ProjectName = '$projectName'");
    $data = mysqli_fetch_array($table);
?>

<div class="page">
            <div class="welcomeHeader">
                <h2 class="welcomeText"><?php echo $projectName ?></h2>
            </div>
            <div class="pageContent">
                <h3 class="newProjectText">stats</h3>
</div>
<div class="stats">
    <?php
        //start of calculations to get how many words you should write today
        $startDate = new DateTime($data["StartDate"]);
        $endDate = new DateTime($data["EndDate"]);
        $today = new DateTime(date("Y-m-d"));
        $dateDiff = $today->diff($endDate);
        $daysLeft = $dateDiff->format("%a");
        $wordsLeft = $data["WordGoal"] - $data["CurrentWordcount"];

        if (isset($_POST['submit'])) {
            //update database with today's submitted words
            $todaysWordcount = $_POST['todaysWordcount'];
            $currentWordcount = $data["CurrentWordcount"] + $todaysWordcount;
            $sql = "UPDATE wordcounter.test SET CurrentWordcount = '$currentWordcount' WHERE ProjectName = '$projectName'";


            if ($project->query($sql) === TRUE) {
                //updated daily word goal
                echo "Records added successfully <br>";
                echo "You need to write " . round(($data["WordGoal"] - $currentWordcount) / $daysLeft, 0) . " words each day to reach your goal.";
            } else {
                //check for error updating database
                echo "Error updating record: " . $project->error;
            }
        } else {
            //non updated daily word goal
            echo "You need to write " . round($wordsLeft / $daysLeft, 0) . " words each day to reach your goal.";
        }

        //start of form
        echo "<form action='projectPage.php?ProjectName=$projectName' method='POST' class=''>";
    ?>

<ul>
    <div>
        <label for="todaysWordcount">Words Written Today</label>
        <input name="todaysWordcount">
    </div>
    <button type="submit" value="Submit" name="submit">submit</button>
</ul>
</form>

<?php

?>