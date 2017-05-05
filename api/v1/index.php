<?php
namespace Beltrao\WeqtApi\v1;

use Slim\App;


/**
 * Created by Rudda Beltrao
 * Date: 25/04/2017
 * Time: 00:57
 * Lab312 developer android  & php backend
 * www.lab312-icetufam.com.br
 * beltrao.rudah@gmail.com
 */

    require __DIR__.'/../../vendor/autoload.php';
    $app = new App();
    include 'routers/Evaluations.php';
    include 'routers/Discrepancia.php';
    include 'routers/Defeitos.php';
    include 'routers/WEQT.php';
    include "routers/Usuario.php";

    $app->run();  
    