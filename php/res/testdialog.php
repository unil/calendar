<html>
    <head>
        <!-- Begin JQuery -->
        <link type="text/css" rel="StyleSheet" href="https://wwwfbm.unil.ch/html/css/jquery-ui-1.8.4.custom.css" />
        <script type="text/javascript" src="https://wwwfbm.unil.ch/html/js/jquery.js"></script>
        <script type="text/javascript" src="https://wwwfbm.unil.ch/html/js/jquery.ui.core.js"></script>
        <script type="text/javascript" src="https://wwwfbm.unil.ch/html/js/jquery.validate.js"></script>


        <!-- End JQuery -->
        <script type="text/javascript" src="html/js/plugins.js"></script>
        <script type="text/javascript" src="html/js/application.js"></script>
        <script type="text/javascript">
            <!--
            function sessionTimeout(){
                window.location = "http://wwwfbm.unil.ch/calendar"
            }
            //-->
        </script>
    </head>
    <body>
        <?php
        $error = array();

        $error["success"] = true;
        $error["test2"] = true;
        $error["test3"] = true;

        $variable = json_encode($error);
        ?>

        <script type="text/javascript">
            /*var errors = eval(<?php echo $variable; ?>);


            for (name in errors) {
                document.writeln(errors[name]);
            }*/



            $.each(<?php echo $variable; ?>, function(key, val) {
                document.writeln('key:' + key + ' val:' + val + '<br />');
            });


        </script>
    </body>
</html>

