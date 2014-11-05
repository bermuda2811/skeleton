<html>
    <head>
        <title> Tr Framework</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


        <!-- Bootstrap -->
        <link href="<?php echo BOOTSTRAP_URL;?>dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="<?php echo PUBLIC_HTML_URL.'css/'?>dashboard.css" rel="stylesheet">
        <link href="<?php echo PUBLIC_HTML_URL.'css/'?>condition.css" rel="stylesheet">

        <!-- set Js from controller -->
        <?php if(isset($js) && !empty($js)) {
            foreach($js as $js_temp) {
                ?>
                <script type="text/javascript" src="<?php echo PUBLIC_HTML_URL.'js/'.$js_temp?>"></script>
                <?php
            }
        }?>
    </head>
    <body>

    <?php View::loadView('include/header');?>

    <div class="container-fluid">
        <div class="row">

            <?php

            View::loadView('include/sidebar',
                array('left_category'=>isset($left_category)?$left_category:array()));
            ?>
            <?php echo isset($main_content)?$main_content:'Empty content !';?>
        </div>
        <div class="row">
            <?php View::loadView('include/footer');?>
        </div>
    </div>



    </body>
</html>