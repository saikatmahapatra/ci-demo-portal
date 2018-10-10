<?php
date_default_timezone_set('Asia/Kolkata');
$enable_maintainence_mode = true;
$down_time_upto = date('2018-10-10 23:50:59'); // 24h format
$current_time = date('Y-m-d H:i:s');
$time_diff = strtotime($down_time_upto) - strtotime($current_time);
if(($enable_maintainence_mode===true) && (strtotime($current_time)<=strtotime($down_time_upto))){
	?>
	<!doctype html>
    <html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <title>Under Maintainence</title>
        <style>
            body {
                margin-top: 5rem;
                margin-bottom: 5rem;
            }
        </style>
    </head>

    <body>
        <main class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-12 col-md-12 text-center">                    
                    <h1 class="text-info mt-3 mb-3">Critical maintenance is in progress...</h1>
					<h4>It is expected to up after <?php echo date('d/m/Y H:i:s T',strtotime($down_time_upto));?></h4>
                </div>
            </div>
        </main>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        
    </body>
    </html>
	<?php
	die();
}
?>
