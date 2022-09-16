<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="./wordcounter.css">
    <link href='https://fonts.googleapis.com/css?family=Alegreya SC' rel='stylesheet'>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wordcounter</title>
</head>
<body>
    <main>
        <div class="containerContainer">
        <div class="menuContainer">
            <div class="bookSpine">
                <h1 class="websiteTitle"><a href="./wordcounter.php">WORDCOUNTER</a></h1>
                <ul>
                    <li>
                        <?php
                            //connect to database
                            $mysqli = new mysqli("localhost", "root", "password", "wordcounter");

                            // Check connection
                            if ($mysqli->connect_errno) {
                                echo "Failed to connect to MySQL: " . $mysqli->connect_error;
                                exit();
                            }
                            //store results by end date
                            $result = mysqli_query($mysqli, "SELECT * FROM wordcounter.test ORDER BY EndDate ASC");

                            //make projects' names appear in the menu
                            echo "<table>";

                            while ($row = mysqli_fetch_array($result)) {
                                echo "<tr><td><a href=\"./projectPage.php?ProjectName=" . urlencode($row["ProjectName"]) . "\">" . $row["ProjectName"] . "</a></td></tr>";
                            }
                            echo "</table>";

                            mysqli_close($mysqli);
                        ?>
                    </li>
                </ul>
            </div>
        </div>