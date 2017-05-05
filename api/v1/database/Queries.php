<?php
/**
 * Created by Rudda Beltrao
 * Date: 25/04/2017
 * Time: 01:22
 * Lab312 developer android  & php backend
 * www.lab312-icetufam.com.br
 * beltrao.rudah@gmail.com
 */

namespace Beltrao\WeqtApi\v1\database;


class Queries
{
    //:id
    public static $GET_DISCREPANCIAS_GROUP_BY_ASK = 'select (select titulo from pergunta where id = a.pergunta_id) as pergunta,  count( a.id_alternativa)  as qtde,(select valor from alternativas where id = a.id_alternativa) as valor from usuario_has_pergunta as a  WHERE avaliacao_idavaliacao = :id group by a.pergunta_id, a.id_alternativa ';

    public static $PUT_EVALUATION = "INSERT INTO avaliacao (titulo, tcle, doc, moderador) values (:titulo, :tcle, :doc, :moderador)";

    public static $PUT_USER = "INSERT INTO usuario(name, email, profile) values (:nome, :email, :profile)";
    public static $GET_USER = "SELECT * FROM usuario where email = :email and name = :nome";


    public static $GET_INVITES = 'SELECT b.titulo as title, b.descricao, (select profile from usuario where usuario.id = a.usuario_id) as fromProfile,(select email from usuario where usuario.id = a.usuario_id) as fromEmail, b.tcle, b.doc, b.idavaliacao as idOfEvaluation, b.data_criacao as criacao  FROM cx_entrada as a inner join avaliacao  as b where a.usuario_id = :id and a.status_avaliacao = 0 and b.idavaliacao = a.avaliacao_idavaliacao';
    public static $POST_INVITE = 'UPDATE cx_entrada SET status_avaliacao= :status WHERE avaliacao_idavaliacao = :id_avaliacao and usuario_id= :usuario_id';

    
    public static $GET_EVALUATION_OPENED = 'SELECT b.titulo as title, b.descricao, (select profile from usuario where usuario.id = a.usuario_id) as fromProfile, b.idavaliacao as idOfEvaluation, b.data_criacao as criacao  FROM cx_entrada as a inner join avaliacao  as b where a.usuario_id = :id and a.status_avaliacao = 1 and b.idavaliacao = a.avaliacao_idavaliacao';
    public static $GET_EVALUATION_CLOSED = "SELECT * FROM cx_entrada where usuario_id = :id and status = 2";
    
    public static $GET_TAREFAS = 'select id, nome as title,  desc_tarefa as descricao, avaliacao_idavaliacao as avaliacaoID from tarefas where avaliacao_idavaliacao = :id';
    public static $GET_PERGUNTAS = "select titulo, descricao, sim, nao, prox, id FROM pergunta";
    public static $GET_SUBPERGUNTAS = "select id, valor, descricao from alternativas where pergunta_id = :id";
    
    public static $PUT_DISCREPANCIA= "INSERT INTO `discrepancias`(`usuario_id`, `pergunta_id`, `id_alternativa`, `id_tarefa`, `avaliacao_idavaliacao`, `comentario`) VALUES (:uid, :perguntaid, :alternativaid, :tarefaid, :avaliacaoid, :comentarios )";
    

}