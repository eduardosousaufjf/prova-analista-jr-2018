<?php

namespace User\Model;

use Core\Model\CoreModelTrait;

class Estado
{
    use CoreModelTrait;

    public $estado_id;
    public $estado_sigla;
    public $estado_nome;
}