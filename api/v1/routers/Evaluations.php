<?php
namespace Beltrao\WeqtApi\v1\routers;

/**
 * Created by Rudda Beltrao
 * Date: 25/04/2017
 * Time: 01:06
 * Lab312 developer android  & php backend
 * www.lab312-icetufam.com.br
 * beltrao.rudah@gmail.com
 */

    
    use Beltrao\WeqtApi\v1\application\API;
    use Slim\Http\Request;
    use Slim\Http\Response;

    $app->get('/evaluation', function (Request $request, Response $response, $args){



        $request_code = $request->getParam('request_code');
        $id = $request->getParam('id');

        switch ($request_code){

            //caixa entrada - convites
            case 1:

                $api = new API();
                $response->write($api->getInvites($id));

                break;

            //inspecoes abertas - com tarefas a serem feitas
            //tarefas
            case 2:
                $api = new API();
                $response->write($api->getEvaluationOpened($id));
                break;

            //Minhas Inspeções  - com dados a serem mostrados
            case 3:

                break;
            default:
                break;
            
            
        }
        
    });

    $app->post('/evaluation', function(Request $request, Response $response, $args){
    
        $avaliacao_id = $request->getParam('avaliacao_id');
        $user_id = $request->getParam('usuario_id');
        $status = $request->getParam('status');


        $api = new API();
        $response->write($api->UpdateInvites($user_id, $avaliacao_id, $status));
        
        
    });

    $app->put('/evaluation', function(Request $request, Response $response, $args){

               //add uma nova inspeção

    });


