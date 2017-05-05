<?php
namespace Beltrao\WeqtApi\v1\routers;

/**
 * Created by Rudda Beltrao
 * Date: 25/04/2017
 * Time: 01:10
 * Lab312 developer android  & php backend
 * www.lab312-icetufam.com.br
 * beltrao.rudah@gmail.com
 */


    use Beltrao\WeqtApi\v1\application\API;
    use Slim\Http\Request;
    use Slim\Http\Response;

    $app->get('/discrepancias', function (Request $request, Response $response, $args){


    });
    $app->post('/discrepancias', function(Request $request, Response $response, $args){

        $json = $request->getParam('discrepancias_json');
        $tarefaID = $request->getParam('tarefa_id');
        $uID = $request->getParam('u_id');
        $avaliacaoID = $request->getParam('avaliacao_id');

        $api = new API();
        $resposta = $api->addDiscrepancia(json_decode($json), $uID, $avaliacaoID, $tarefaID);
        
        $response->write($resposta);
        
    });
    
    $app->put('/discrepancia', function(Request $request, Response $response, $args){
    
    
    
    });
    
