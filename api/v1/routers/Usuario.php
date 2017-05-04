<?php
namespace Beltrao\WeqtApi\v1\routers;

/**
 * Created by Rudda Beltrao
 * Date: 25/04/2017
 * Time: 07:24
 * Lab312 developer android  & php backend
 * www.lab312-icetufam.com.br
 * beltrao.rudah@gmail.com
 */

    use Beltrao\WeqtApi\v1\application\API;
    use Beltrao\WeqtApi\v1\model\Usuario;
    use Slim\Http\Request;
    use Slim\Http\Response;



    $app->post('/usuario', function (Request $request, Response $response, $args){

        $usuario = new Usuario();
        $usuario->nome = $request->getParam("u_name");
        $usuario->foto = $request->getParam("u_foto");
        $usuario->email = $request->getParam("u_email");

        $api = new API();
        if($api->addUser($usuario)!= 0){

            $response->write($api->addUser($usuario));

        }else{
            $usuario->id = 0;
            $resposta[] = $usuario;

            $response->write(json_encode($resposta));

        }


        

    });
    
    $app->get('/usuario', function (Request $request, Response $response, $args){
       
        $u = new Usuario();
        $u->nome = $request->getParam('u_name');
        $u->email = $request->getParam('u_email');

         
        $api = new API();
        $response->write($api->login($u));


        
    });

