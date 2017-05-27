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
use Beltrao\WeqtApi\v1\model\Evaluation;
use Slim\Http\Request;
use Slim\Http\Response;

$app->get('/evaluation', function (Request $request, Response $response, $args) {


    $request_code = $request->getParam('request_code');
    $id = $request->getParam('id');

    switch ($request_code) {

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

$app->post('/evaluation', function (Request $request, Response $response, $args) {


    switch ($request->getParam("action")) {

        case 1:

            $avaliacao_id = $request->getParam('avaliacao_id');
            $user_id = $request->getParam('usuario_id');
            $status = $request->getParam('status');


            $api = new API();
            $response->write($api->UpdateInvites($user_id, $avaliacao_id, $status));


            break;
        case 2:

            $api = new API();
            $evaluation = new Evaluation();
            //salvar o tcle
            
            if( !empty($_FILES['tcle']) ){

                $tcleName = 'tcle-'.time().".pdf";
                $docName = 'doc-'.time().".pdf";
                $path ="http://www.lab312-icetufam.com.br/projetos/weqt/docs/";
                $absolutePath = __DIR__.'/../../../docs/';



                    if(move_uploaded_file($_FILES['doc']['tmp_name'],$absolutePath.$docName) && move_uploaded_file($_FILES['tcle']['tmp_name'],$absolutePath.$tcleName)){

                        $evaluation->titulo = $request->getParam('nome');
                        $evaluation->moderador = $request->getParam('moderador');
                        $evaluation->descricao = $request->getParam('descricao');
                        $evaluation->setTarefas(json_decode($request->getParams('tarefas')));
                        $evaluation->tcle = $path.$tcleName;

                        if ($api->addEvaluation($evaluation)) {

                            $data[] = array("log" => 'sucess'+$evaluation->descricao, 'status' => 200);
                            $response->write("oi");


                        // die;
                        }
                    }
            }else{


                $data[] = array("log" => 'fail','status' => 100);
                $response->write("erro");


            }


            break;

             default:
              break;

    }


});






