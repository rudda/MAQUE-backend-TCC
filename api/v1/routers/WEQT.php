<?php
namespace Beltrao\WeqtApi\v1\routers;
/**
 * Created by Rudda Beltrao
 * Date: 29/04/2017
 * Time: 07:20
 * Lab312 developer android  & php backend
 * www.lab312-icetufam.com.br
 * beltrao.rudah@gmail.com
 */

$app->get('/weqt', function (\Slim\Http\Request $request, \Slim\Http\Response $response, $args){

    $api = new \Beltrao\WeqtApi\v1\application\API();
    $response->write($api->getWEQT());

});