<?php

namespace User\Form;

use User\Form\Filter\UserFilter;
use User\Model\CidadeTable;
use User\Model\EstadoTable;
use User\Model\UserTable;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Form\Element\Csrf;
use Zend\Form\Element\Number;
use Zend\Form\Element\Select;
use Zend\Form\Form;
use Zend\Form\Element\Text;
use Zend\Form\Element\Email;
use Zend\Db\Adapter\Adapter;
use Zend\Form\Element\Password;

class UserForm extends Form
{
    /**
     * @var AbstractTableGateway
     */
    private $usuarioTb;
    /**
     * @var CidadeTable
     */
    private $cidadeTb;

    public function __construct(UserTable $usuarioTb, CidadeTable $cidadeTb, EstadoTable $estadoTb)
    {
        parent::__construct('user', []);

        $this->usuarioTb = $usuarioTb;
        $this->cidadeTb = $cidadeTb;
        $this->estadoTb = $estadoTb;

        $this->setAttributes(['method' => 'POST']);

        $name = new Text('usuario_nome');
        $name->setAttributes([
            'placeholder' => 'Nome',
            'class' => 'form-control',
            'required' => true,
            'maxlength' => 255
        ]);
        $this->add($name);

        $email = new Email('usuario_email');
        $email->setAttributes([
            'placeholder' => 'Email',
            'class' => 'form-control',
            'required' => true,
            'maxlength' => 255
        ]);
        $this->add($email);

        $password = new Password('usuario_senha');
        $password->setAttributes([
            'placeholder' => 'Senha',
            'class' => 'form-control',
            'required' => true,
            'maxlength' => 255
        ]);
        $this->add($password);

        $telefone = new Text('usuario_telefone');
        $telefone->setAttributes([
            'placeholder' => 'Telefone (XX) XXXXX-XXXX',
            'class' => 'form-control',
            'id' => 'txttelefone',
            'required' => true,
            'maxlength' => 20,
            'pattern' => "\([0-9]{2}\)[\s][0-9]{4}-[0-9]{4,5}"
        ]);
        $this->add($telefone);

        $logradouro = new Text('usuario_logradouro');
        $logradouro->setAttributes([
            'placeholder' => 'Logradouro',
            'class' => 'form-control',
            'required' => true,
            'maxlength' => 255
        ]);
        $this->add($logradouro);

        $numero = new Number('usuario_numero');
        $numero->setAttributes([
            'placeholder' => 'Número',
            'class' => 'form-control',
            'required' => true,
        ]);
        $this->add($numero);

        $complemento = new Text('usuario_complemento');
        $complemento->setAttributes([
            'placeholder' => 'Complemento',
            'class' => 'form-control',
            'required' => false,
            'maxlength' => 255
        ]);
        $this->add($complemento);

        $bairro = new Text('usuario_bairro');
        $bairro->setAttributes([
            'placeholder' => 'Bairro',
            'required' => true,
            'class' => 'form-control',
            'maxlength' => 255
        ]);
        $this->add($bairro);

        $cep = new Text('usuario_cep');
        $cep->setAttributes([
            'placeholder' => 'CEP',
            'class' => 'form-control',
            'required' => true,
            'maxlength' => 9

        ]);
        $this->add($cep);

        $cidade_id = new Select('usuario_cidade_id');
        $cidade_id->disableInArrayValidator(true);
        $cidade_id->setAttributes([
            'class' => 'form-control',
            'required' => true,
            'id' => 'cidade_id'
        ]);
        $cidade_id->setEmptyOption("Escolha uma cidade");
        $cidade_id->setValueOptions($this->cidadeTb->getComboCidade());
        $this->add($cidade_id);

        $estado_id = new Select('usuario_estado_id');
        $estado_id->disableInArrayValidator(true);
        $estado_id->setAttributes([
            'class' => 'form-control',
            'required' => true,
            'id' => 'estado_id'
        ]);
        $estado_id->setEmptyOption("Escolha um estado");
        $estado_id->setValueOptions($this->estadoTb->getComboEstado());
        $this->add($estado_id);


        $csrf = new Csrf('csrf');
        $csrf->setOptions([
            'csrf_options' => [
                'timeout' => 600
            ]

        ]);
        $this->add($csrf);

    }
}