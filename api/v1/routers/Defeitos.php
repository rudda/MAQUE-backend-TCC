<?php

/**
 * Created by Rudda Beltrao
 * Date: 25/04/2017
 * Time: 01:13
 * Lab312 developer android  & php backend
 * www.lab312-icetufam.com.br
 * beltrao.rudah@gmail.com
 */

use Beltrao\WeqtApi\v1\application\API;
use Slim\Http\Request;
use Slim\Http\Response;
    
    $app->get('/defeitos', function (Request $request, Response $response, $args){
    
        $id = $request->getParam('id');
        if($id>0){
            
            $api = new API();
            $response->write($api->getDefeitos($id));


        }

    
    });
    


