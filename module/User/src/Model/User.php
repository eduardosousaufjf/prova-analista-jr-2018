<?php

namespace User\Model;

use Core\Model\CoreModelTrait;

class User
{
    use CoreModelTrait;

    public $usuario_email;
    public $usuario_senha;
    public $usuario_nome;
    public $usuario_telefone;
    public $usuario_logradouro;
    public $usuario_numero;
    public $usuario_complementto;
    public $usuario_bairro;
    public $usuario_cidade_id;
    public $usuario_cep;
}