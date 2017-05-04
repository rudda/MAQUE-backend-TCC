<?php
namespace Beltrao\WeqtApi\v1\model;
/**
 * Created by Rudda Beltrao
 * Date: 25/04/2017
 * Time: 01:46
 * Lab312 developer android  & php backend
 * www.lab312-icetufam.com.br
 * beltrao.rudah@gmail.com
 */
use Usuario;
class Comentario
{
    public $usuario;
    public $comentario;
    
    function __construct(Usuario $u, $comentario)
    {
        $this->usuario = u;
        $this->comentario = $comentario;
                   
    }
    
    
    
}