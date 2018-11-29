<?php

namespace User\Controller;

use Exception;
use User\Form\NewPassword;
use User\Form\UserForm;
use User\Model\CidadeTable;
use User\Model\UserTable;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;

class IndexController extends AbstractActionController
{
    private $userForm;
    private $userTable;
    private $cidadeTable;

    public function __construct(UserForm $userForm, UserTable $userTable, CidadeTable $cidadeTable)
    {
        $this->userForm = $userForm;
        $this->userTable = $userTable;
        $this->cidadeTable = $cidadeTable;
    }

    public function registerAction()
    {
        $this->layout()->setTemplate('user/layout/layout');

        if ($this->getRequest()->isPost()) {
            $this->userForm->setData($this->getRequest()->getPost());
            if ($this->userForm->isValid()) {
                $data = $this->userForm->getData();

                try {
                    $user = $this->userTable->save($data);

                    $this->getEventManager()->trigger(
                        __FUNCTION__ . '.post',
                        $this,
                        ['data' => $user]
                    );
                    return $this->redirect()->toRoute('auth.login');

                } catch (Exception $exception) {
                    $this->flashMessenger()->addErrorMessage($exception->getMessage());
                }

                return $this->redirect()->refresh();
            }
        }

        return new ViewModel([
            'form' => $this->userForm->prepare()
        ]);
    }

    public function filterAction()
    {
        $request = $this->getRequest();
        if ($request->isXmlHttpRequest()) {
            // Ajax request
            $estado_id = $this->params()->fromRoute('id', -1);
            $data = $this->cidadeTable->findAll([
                'cidade_codigo_estado' => $estado_id]);
            $array_result = [];
            foreach ($data as $item) {
                array_push($array_result,$item);
            }
            $jsonData = $array_result;
            $view = new JsonModel($jsonData);
            $view->setTerminal(true);

        } else {
            $this->flashMessenger()->addErrorMessage("Ooops! Somente AJAX");
            return new ViewModel();
        }
        return $view;
    }

}