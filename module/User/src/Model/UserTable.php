<?php

namespace User\Model;

use Core\Model\AbstractCoreModelTable;

class UserTable extends AbstractCoreModelTable
{
    public function save(array $data)
    {

        if (isset($data['usuario_senha'])) {
            $data['usuario_senha'] = md5($data['usuario_senha']);
        }

        return parent::save($data);
    }

    public function getUserByEmail($email)
    {
        return $this->getBy(['usuario_email' => $email]);
    }
}