<?php
namespace Beltrao\WeqtApi\v1\authentication;
/**
 * Created by Rudda Beltrao
 * Date: 02/04/2017
 * Time: 01:52
 * Lab312 developer android  & php backend
 * www.lab312-icetufam.com.br
 * beltrao.rudah@gmail.com
 */
use Beltrao\api\v1\database\conexao;
use PDO;
require (__DIR__."/../../../vendor/autoload.php");
class Auth
{

    
    
    public function authenticationToken ($app_name, $app_pass){
        
        $conn = conexao::connect();
        
        if($conn){

            $smt = $conn->prepare('SELECT * FROM `base-authentication` WHERE `app_name` = :nome');
            $smt->bindParam(':nome', $app_name);
            $smt->execute();

            if($result = $smt->fetch(PDO::FETCH_ASSOC)){

                if(password_verify($app_name.$app_pass, $result['app_token'])){

                    $rehash = password_needs_rehash($result['app_token'],
                        PASSWORD_DEFAULT, array('cost'=>15)
                        );

                    if($rehash === true){

                        password_hash($result['app_token'], PASSWORD_DEFAULT, ['cost'=>15]);
                        $this->updateToken($app_name, $result['app_token']);

                    }
                    return true;
                }


            }


        }


        return false;

    }


    /*
     * addToken
     * @param string $name
     * @param string $pass
     *
     * @return string
     * */
    public function addToken($name, $pass){

        $token = $name.$pass;
        $token = password_hash($token, PASSWORD_DEFAULT, ['cost'=>12]);

        $db = conexao::connect();

        if($db!= false && $db!= null){

            $sql = 'INSERT INTO `base-authentication`(`app_name`, `app_token`) VALUES(:n,:tk)';

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':n', $name);
            $stmt->bindParam(':tk', $token);

            if($stmt->execute()){

                return true;
            }


        }

        return false;


    }

    /*
     * updateToken
     *
     * @param string $app_name
     * @param string $token
     *
     * @return boolean
     * */

    private function updateToken($app_name, $token){

        $sql = 'UPDATE `base-authentication` SET `app_token` = :token where `app_name` = :nome ';

        $db = conexao::connect();
        $stmt= $db->prepare($sql);
        $stmt->bindParam(':token', $token);
        $stmt->bindParam(':nome', $app_name);

        if($stmt->execute()){

            return true;
        }

        return  false;



    }


}

