<?php $t->section('page', function() { ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $this['title'] ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

    <style>
        html, body { height: 100%; margin: 0; }
        body {
            font-family: Arial;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #oops {
            text-align: center;
            padding: 20px;
            color: #666;
            border: 1px solid #ccc;
            border-radius: 10px;
            -webkit-box-shadow: 0px 0px 20px 0px rgba(0,0,0,0.5);
            -moz-box-shadow: 0px 0px 20px 0px rgba(0,0,0,0.5);
            box-shadow: 0px 0px 20px 0px rgba(0,0,0,0.5);
            background-color: #fafafa;
            max-width: 75%;
            width: 400px;
        }

        a {
            text-decoration: none;
            color: #00f;
        }
    </style>
</head>
<body>
    <?php echo $this->show('main') ?>
</body>
</html>
<?php }) ?>