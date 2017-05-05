<?php
namespace Beltrao\WeqtApi\v1\application;
use Beltrao\WeqtApi\v1\model\Evaluation;
use Beltrao\WeqtApi\v1\database\Connection;
use Beltrao\WeqtApi\v1\database\Queries;
use Beltrao\WeqtApi\v1\model\Usuario;
use PDO;
require __DIR__."/../../../vendor/autoload.php";
/**
 * Created by Rudda Beltrao
 * Date: 25/04/2017
 * Time: 06:56
 * Lab312 developer android  & php backend
 * www.lab312-icetufam.com.br
 * beltrao.rudah@gmail.com
 */
class API
{

    public function addEvaluation(Evaluation $evaluation){
         
        $db = Connection::connect();
        $query = Queries::$PUT_EVALUATION;
        
        if($db != null && $db!= false){
            
            $stmt = $db->prepare($query);
            
            $stmt->bindValue(":titulo", $evaluation->titulo);
            $stmt->bindValue(":tcle", $evaluation->tcle);
            $stmt->bindValue(":moderador", $evaluation->moderador);
            $stmt->bindValue(":doc", $evaluation->info);

            return $stmt->execute();
            
        }

        return false;

    }

    public function addUser(Usuario $u){
        $query = Queries::$PUT_USER;

        $db = Connection::connect();

        if($db && $db!= null){

            $stmt= $db->prepare($query);
            $stmt->bindValue(":nome", $u->nome);
            $stmt->bindValue(":email", $u->email);
            $stmt->bindValue(":profile", $u->foto);


            if($stmt->execute()){

                $stmt->closeCursor();

                $db =Connection::connect();
                $query = 'select * from usuario where name = :name and email = :email';
                $query = str_replace(':name', "'".$u->nome."'", $query);
                $query = str_replace(':email', "'".$u->email."'", $query);

                
                $result = $db->query($query);

                if($u = $result->fetch(PDO::FETCH_ASSOC)){

                   $data[] = $u;
                    return json_encode($data);
                }else{
                    
                    return 0;
                }


                
            }


        }

        return false;

    }

    public function login(Usuario $u){

        $query = Queries::$GET_USER;
        $db = Connection::connect();

        if($db && $db!=null) {


            $query = str_replace(":nome", $u->nome, $query);
            $query = str_replace(":email", $u->email,$query);

            $stmt = $db->query($query);



            if($stmt->rowCount()==1){

                $u = $stmt->fetch(PDO::FETCH_ASSOC);
                $data[] = $u;

                return json_encode($data);

            }else{

                $u->id = 90;
                $data[] = $u;
                return json_encode($data);

            }

            
        }

        return false;
    }

    public function getInvites($user_id){
        $query = Queries::$GET_INVITES;
        $query = str_replace(':id',$user_id, $query);
        
        $db = Connection::connect();
        
        if($db && $db!= null){
            
            $stmt = $db->query($query);
            

            while($dados = $stmt->fetch(PDO::FETCH_ASSOC)){

                $data[]  = $dados;

            }


            return json_encode($data);

        }else{

            $data[] = array("LOG", "sucess", "status", 0);
            return json_encode($data);

        }
        
        
    }
    public function UpdateInvites($userId, $evaluationId, $status){

        $query = Queries::$POST_INVITE;
        $query = str_replace(':status', $status, $query);
        $query = str_replace(':id_avaliacao', $evaluationId, $query);
        $query = str_replace(':usuario_id', $userId, $query);

        $db = Connection::connect();

        $stmt= $db->query($query);

        if($stmt->execute()){

            $data[] = array("log"=>'sucess', 'status'=>1);
            return json_encode($data);

        }else{

            $data[] = array("log"=>'erro', 'status'=>2);
            return json_encode($data);
        }


    }

    public function getEvaluationOpened($userID){
        $query = Queries::$GET_EVALUATION_OPENED;
        $query = str_replace(':id', $userID, $query);

        $db = Connection::connect();
        if($db && $db!= null){

            $stmt = $db->query($query);

            if($stmt->rowCount()>0){

                while($result = $stmt->fetch(PDO::FETCH_ASSOC)){


                    $tarefas = $this->getTarefa($result['idOfEvaluation']);
                    $aux = $result;

                    if($tarefas!= null){

                        $aux['tarefas'] = $tarefas;

                    }

                    $data[] = $aux;


                }


                return json_encode($data);

            }else{

                $data[] = array("log"=>"0 fill", "status"=>0);

            }

        }

    }

    public function getTarefa($idOfEvaluation){

        $db = Connection::connect();
        $query = Queries::$GET_TAREFAS;
        $query = str_replace(":id", $idOfEvaluation,$query);

        if($db && $db!=null){

            $stmt = $db->query($query);
            while ($result = $stmt->fetch(PDO::FETCH_ASSOC)){

                $data[]= $result;

            }

            return $data;
        }

        return null;


    }

    public function getWEQT(){
        
        $query = Queries::$GET_PERGUNTAS;
        $db = Connection::connect();
        
        if($db && $db!= null){
            
            $stmt = $db->query($query);
            
            while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
                
                $result['alternativas'] = $this->getSubPerguntas($result['id']);
                $pergunta[] = $result;
            
            }
            //    echo json_encode($pergunta);
            

            return json_encode($pergunta);
            
        }
        
    }

    public function getSubPerguntas($id){

        $query = Queries::$GET_SUBPERGUNTAS;
        $query= str_replace(':id', $id, $query);
        $db = Connection::connect();


        if($db && $db!= null){

            $stmt = $db->query($query);
            if($stmt->rowCount()>0){

                while($result = $stmt->fetch(PDO::FETCH_ASSOC)){

                    $data[] = $result;

                }

                return $data;
            }else{
                $data= array();
                return $data;
            }

        }
        
    }

    public function addDiscrepancia($json, $tarefaID, $usuarioID, $avaliacaoID){

        $pdo = Connection::connect();
        $query = Queries::$PUT_DISCREPANCIA;
        $p1 = true;
        $p2 = true;
        
       for($i=0; $i< count($json); $i++){

           $value = $json[$i];
           $stmt = $pdo->prepare($query);
           $stmt->bindValue(':uid', $value->usuarioID + $i);
           $stmt->bindValue(':alternativaid', $value->alternativaID + $i);
           $stmt->bindValue(':tarefaid', $value->tarefaID+ $i);
           $stmt->bindValue(':comentarios', $value->comentarios .$i);
           $stmt->bindValue(':avaliacaoid', $value->avaliacaoID + $i);
           $stmt->bindValue(':perguntaid', $value->perguntaID + $i);

           $p1= $stmt->execute();


       }

        //concluir dizendo que a tarefa foi realizada
        $stmt->closeCursor();
        $pdo = Connection::connect();
        $p2 = $pdo->exec("INSERT INTO log_tarefas(tarefa_id, usuario_id, avaliacao_id, status ) values ($tarefaID, $usuarioID, $avaliacaoID, 1)");

        if($p1 && $p2){
            
            $data[] = array("log"=>"sucess", "status"=>1);
        }else{

            $data[] = array("log"=>"sucess", "status"=>2);
            
        }

        
        return json_encode($data);
        
    }

}


    /*$json = array();

    for($i=0; $i<10; $i++){

        $json[] = array("alternativaID"=>"999",
            "avaliacaoID"=>"999",
            "comentarios"=>"helo teste",
            "perguntaID"=>"999",
            "tarefaID"=>"999",
            "usuarioID"=>"999"
        );


    }




    $a = new API();
    echo $a->addDiscrepancia(json_decode(json_encode($json)), 999,999,999);
*/

    /*$u = new Usuario();
    $u->foto = "http://www.google.com/rudda.jpg";
    $u->nome = "fulano silva beltrao brito2";
    $u->email = "b.rudah@gmail.com";
    $a = new API();
    $v = $a->addUser($u);
    echo $v;*/

/*  $a = new API();
  $ev = new Evaluation();
  $ev->titulo = "teste api";
  $ev->info = "http://asdasd.asdas/asdas/asdasd/p.pdf";
  $ev->tcle = "http://asdasd.asdas/asdas/asdasd/h.pdf";
  $ev->moderador = 1;
  echo   $a->addEvaluation($ev);*/
