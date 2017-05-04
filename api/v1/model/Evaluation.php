<?php
namespace Beltrao\WeqtApi\v1\model;;
/**
 * Created by Rudda Beltrao
 * Date: 25/04/2017
 * Time: 01:37
 * Lab312 developer android  & php backend
 * www.lab312-icetufam.com.br
 * beltrao.rudah@gmail.com
 */
use Beltrao\WeqtApi\v1\model\Discrepancia;
use Beltrao\WeqtApi\v1\model\Defeito;
use Usuario;
require __DIR__.'/../../../vendor/autoload.php';
class Evaluation
{
    public $titulo;
    public $data_criacao;
    public $moderador;
    public $id;
    public $tcle;
    public $info;
    public $descricao;

    private $discrepancias;
    private $defeitos;
    private $colaboradores;
    

    public function __construct()
    {
        $this->data_criacao  = '';
        $this->nome          = '';
        $this->moderador     = '';
        $this->id            = '';
        $this->tcle          = '';
        $this->info          = '';
        
        $this->discrepancias = array();
        $this->colaboradores = array();
        $this->defeitos = array();
        
    }

    
    public function addDiscrepancias(Discrepancia $d)
    {
    
        array_push($this->discrepancias, $d);
    
    }
    
    public function addColaborador(Usuario $u){
        
        array_push($this->colaboradores, $u);
    }
    
    public function addDefeitos(Defeito $defeito){
        
        array_push($this->defeitos, $defeito);
        
    }

    /*getters and setters*/

    /**
     * @param array $discrepancias
     */
    public function setDiscrepancias($discrepancias)
    {
        $this->discrepancias = $discrepancias;
    }

    /**
     * @param array $defeitos
     */
    public function setDefeitos($defeitos)
    {
        $this->defeitos = $defeitos;
    }

    /**
     * @param array $colaboradores
     */
    public function setColaboradores($colaboradores)
    {
        $this->colaboradores = $colaboradores;
    }

     
    /**
     * @return array
     */
    public function getDiscrepancias()
    {
        return $this->discrepancias;
    }

    /**
     * @return array
     */
    public function getDefeitos()
    {
        return $this->defeitos;
    }

    /**
     * @return array
     */
    public function getColaboradores()
    {
        return $this->colaboradores;
    }
    
    
    
    
    
    
}

