<html>
<head>
    <title>Tic Tac Toe Game</title>
    <?php echo link_tag('assets/css/bootstrap.css', 'stylesheet') ?>
    <?php
        $src = base_url("assets/js/bootstrap.js");
        echo '<script type="text/javascript" src="' . $src . '"></script>'
    ?>


    <?php echo link_tag('assets/css/font-awesome.css', 'stylesheet') ?>
</head>
<body>

<h1><?php echo $title; ?></h1>