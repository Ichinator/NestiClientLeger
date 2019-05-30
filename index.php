

<!DOCTYPE html>
<?php


require __dir__."/Template/Head.tpl";
?>
<body>

<?php

require __DIR__.'/Template/navbar.tpl';

// https://www.pelock.com/products/hash-calculator
//echo 'Hash en php : '.hash('sha512', 'password');
//echo '<br> Hash en java : B109F3BBBC244EB82441917ED06D618B9008DD09B3BEFD1B5E07394C706A8BB980B1D7785E5976EC049B46DF5F1326AF5A2EA6D103FD07C95385FFAB0CACBC86';

$request = $_SERVER['REQUEST_URI'];

switch ($request) {
    case '/' :
        require 'Views/index.php';
        break;
    case '' :
        require 'Views/index.php';
        break;
    case '/about' :
        require 'Views/about.php';
        break;
    case '/connect':
        require 'Views/connect.php';
        break;
    default:
        require 'Views/404.php';
        break;
}
?>

</body>

<?php
require __DIR__."/Template/Javascripts.tpl";
switch ($request){
    case '/connect':
        require __DIR__."/Template/ConnectJS.tpl";
        break;
}
?>
</html>