<html>
<head>
    <title>Tic Tac Toe Game</title>
    <?php echo link_tag('assets/css/bootstrap.css', 'stylesheet') ?>
    <?php
        $src = base_url("assets/js/bootstrap.js");
        echo '<script type="text/javascript" src="' . $src . '"></script>'
    ?>

    <?php
        foreach ($css_files as $css)
        {
            echo link_tag('assets/css/' . $css . '.css', 'stylesheet');
        }
    ?>

    <?php
        $src = base_url("assets/js/ttt.js");
        echo '<script type="text/javascript" src="' . $src . '"></script>'
    ?>
</head>
<body>
