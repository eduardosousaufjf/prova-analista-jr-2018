<?php

namespace Auth\Authentication;

use User\Model\UserTable;
use Zend\Authentication\Adapter\AdapterInterface;
use Zend\Authentication\Result;
use Zend\Crypt\Password\Bcrypt;

;

class Adapter implements AdapterInterface
{
    protected $email;
    protected $password;
    private $userTable;

    public function __construct(UserTable $userTable)
    {
        $this->userTable = $userTable;
    }

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function authenticate()
    {

        /**
         * @var $user \User\Model\User
         */
        if ($user = $this->userTable->getUserByEmail($this->email)) {
            if (md5($this->password) == $user->usuario_senha) {
                return new Result(Result::SUCCESS, $user);
            }
        }

        return new Result(Result::FAILURE_CREDENTIAL_INVALID, null, [
            'Login ou senha inválido!'
        ]);
    }
}