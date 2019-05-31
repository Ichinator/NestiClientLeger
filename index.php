

<!DOCTYPE html>
<html>
    <?php


    require_once __dir__."/Template/Head.tpl";
    ?>
    <body>

        <?php

        require_once __DIR__.'/Template/navbar.tpl';

        // https://www.pelock.com/products/hash-calculator
        //echo 'Hash en php : '.hash('sha512', 'password');
        //echo '<br> Hash en java : B109F3BBBC244EB82441917ED06D618B9008DD09B3BEFD1B5E07394C706A8BB980B1D7785E5976EC049B46DF5F1326AF5A2EA6D103FD07C95385FFAB0CACBC86';
        ?>
        <div class="container-fluid">
            <?php
            $request = $_SERVER['REQUEST_URI'];

            switch ($request) {
                case '/' :
                    require_once 'Views/index.php';
                    break;
                case '' :
                    require_once 'Views/index.php';
                    break;
                case '/about' :
                    require_once 'Views/about.php';
                    break;
                case '/connect':
                    require_once 'Views/connect.php';
                    break;
                default:
                    require_once 'Views/404.php';
                    break;
            }
            ?>
        </div>
    </body>

        <?php
        require_once __DIR__."/Template/Javascripts.tpl";
        switch ($request){
            case '/connect':
                require_once __DIR__."/Template/ConnectJS.tpl";
                break;
        }
        ?>
</html>