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

    $app->post('/discrepancias', function(Request $request, Response $response, $args){

        $json = $request->getParam('discrepancias_json');
        $tarefaID = $request->getParam('tarefa_id');
        $uID = $request->getParam('u_id');
        $avaliacaoID = $request->getParam('avaliacao_id');


        $api = new API();

        //$response->write(  json_decode( stripslashes($json) )  );

        try{
            $j = json_decode(stripslashes($json));
            $response->write(
                $api->addDiscrepancia($j, $tarefaID, $uID, $avaliacaoID));

        }catch (\Exception $x){

            $data[] = array("log"=>"sucess", "status"=>2);
            $response->write(json_encode($data));
        }

    });
    
    $app->get('/discrepancias', function(Request $request, Response $response, $args){

        
        $id = $request->getParam("id");
        $a = new API();
        echo $a->getDiscrepancias($id);


    });
    
