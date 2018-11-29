<?php

namespace User\Model;

use Core\Model\CoreModelTrait;

class Cidade
{
    use CoreModelTrait;

    public $cidade_id;
    public $cidade_codigo_estado;
    public $cidade_nome;
}