<?php

$result = '';

if(isset($_POST['word'])) {

    // send API request to http://api.mac/index.php?word=schaap
    $word = $_POST['word'];
    $url = 'api.mac/?word='.$word;

    // let cUrl handle sending the request and getting a response
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($curl);

    /* expected result
        {
            "status": true,
            "message": {
                "status": true,
                "results": {
                    "nl-NL": [
                        "resultaat 1",
                        "resultaat 2"
                    ],
                    "en-UK": [
                        "result 1",
                        "result 2"
                    ]
                }
            }
        }
    */

    // TODO: error handling; result can be "false" or 404 (not found)
    $items = json_decode($result);

    $vertalingen = $items->message->results;

    curl_close($curl);
}
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/fontawesome.js"
            integrity="sha384-7ox8Q2yzO/uWircfojVuCQOZl+ZZBg2D2J5nkpLqzH1HY0C1dHlTKIbpRz/LG23c" crossorigin="anonymous"></script>

    <title>Starter Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>

<nav class="navbar navbar-expand-sm navbar-dark bg-primary mb-3">
    <div class="container">
        <a class="navbar-brand" href="/">Front</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>
            </ul>

        </div>
    </div>
</nav>

<main role="main" class="container">

    <div class="container">
        <h1>Zoek</h1>
        <p class="lead">

            <form action="" method="POST">
                <input name="word" id="word">
                <input type="submit" value="Zoeken">
            </form>

        </p>
        <ul>
            <?php
                foreach($vertalingen as $land=>$betekenissen) {
                    echo "<li>";
                    echo $land;
                        echo "<ul>";
                        foreach($betekenissen as $betekenis) {
                            echo "<li>" . $betekenis . "</li>";
                        }
                        echo "</ul>";
                    echo "</li>";
                }
            ?>
        </ul>
    </div>

</main><!-- /.container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="js/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
