<html>
<head>
    <title>Tic Tac Toe Game</title>
    <?php echo link_tag('assets/css/bootstrap.css', 'stylesheet') ?>
    <?php
        $src = base_url("assets/js/bootstrap.js");
        echo '<script type="text/javascript" src="' . $src . '"></script>'
    ?>

    <?php echo link_tag('assets/css/style.css', 'stylesheet') ?>

    <?php echo link_tag('assets/css/font-awesome.css', 'stylesheet') ?>

    <?php
        $src = base_url("assets/js/ttt.js");
        echo '<script type="text/javascript" src="' . $src . '"></script>'
    ?>
</head>
<body>
