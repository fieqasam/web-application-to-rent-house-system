<?php
session_start(); 
include('header.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>RENT HOUSE</title>
    <style>
    .news{
    border-radius: 10px;
    width: calc(100% );
    height: 250px;
    margin: 10px;
    }
    .NewsGrid{
        margin: 20px;
        border: 1px ;
        padding: 15px;
    }
    .container-fluid{
        width: 90%;
    }
    </style>
</head>
<body>
<!-- banner -->
<div class="inside-banner">
  <div class="container"> 
    <span class="pull-right"><a href="index.php">Home</a> /News</span>
    <h2> News</h2>
</div>
</div>
<!-- banner --> 
<div class="container">
    <div class="spacer agents">
        <?php 
        $url = 'https://newsapi.org/v2/top-headlines?country=my&apiKey=1afc2b0c00364e06bd3da81a9c54bab0';
        $response = file_get_contents($url);
        $NewsData = json_decode($response);

        ?>
        <div class="container-fluid">
            <?php
            foreach ($NewsData->articles as $News) {
                
            ?>
            <div class="row NewsGrid">
                <div class="col-md-3">
                    <img src="<?php echo $News->urlToImage ?>" alt="news thumbnail" class="news">
                </div>
                <div class="col-md-9">
                    <a href="<?php echo $News->url ?>"><h4>Title:<?php echo $News->title ?></h4></a><br>
                    <h5><?php echo $News->description ?></h5><br>
                    <p><?php echo $News->content ?></p>
                    <h6>Author: <?php echo $News->author ?></h6>
                    <h6>Published at: <?php echo $News->publishedAt ?></h6>
                </div>

            </div>
            <?php 
        } ?>
        </div>

    </div>
</div>
</body>
</html>
<?php include'footer.php';?>