<?php
/**
 * Created by Rudda Beltrao
 * Date: 06/05/2017
 * Time: 17:44
 * Lab312 developer android  & php backend
 * www.lab312-icetufam.com.br
 * beltrao.rudah@gmail.com
 */

    use Beltrao\WeqtApi\v1\application\API;
    use Slim\Http\Request;
    use Slim\Http\Response;

    $app->post('/votar', function (Request $request, Response $response, $args){

        $user = $request->getParam('user');
        $avaliacao = $request->getParam('avaliacao');
        $tarefa = $request->getParam('tarefa');
        $pergunta = $request->getParam("pergunta");
        $alternativa = $request->getParam('alternativa');
        $prioridade = $request->getParam('prioridade');
        $voto = $request->getParam('voto');
        
        $api = new API();
        $response->write(
            $api->setDefeito($user, $avaliacao, $tarefa, $pergunta, $alternativa, $voto, $prioridade));
        
        


    });

