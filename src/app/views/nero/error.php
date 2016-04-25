<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title>Nero error</title>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>

        <style>
         * {
             margin: 0;
             padding: 0;
             font-family: 'Open Sans Condensed', sans-serif;
             font-size: 1.1em;
         }
         
         h1 {
             text-align: center;
             margin-top: 100px;
             color: black;
             font-size: 3em;
         }

         .container {
             width: 80%;
             margin: 100px auto;
             border-radius: 5px;
             background: #222;
             padding: 20px;
             color: white;
         }

         .container p, .container h3 {
             text-align: center;
         }

         .container h3 {
             color: red;
             font-size: 2em;
         }

         .container ul {
             list-style: none;
         }
         

        </style>
    </head>
    <body>
        <h1>Nero exception diagnosis</h1>
        
        <div class="container">
            <p>There was an exception error</p>
            <h3><?= $exception->getMessage() ?></h3>


            <?php
            $traceString = $exception->getTraceAsString();
            $explodedTrace = explode('#', $traceString);
            unset($explodedTrace[0]);
            ?>

            <ul>
                <p>Stack trace: </p>
                <?php foreach($explodedTrace as $line): ?>
                    <li><?= $line; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>

    </body>
</html>
