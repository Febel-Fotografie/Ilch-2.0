<?php
/**
 * @copyright Ilch 2
 * @package ilch
 */

namespace Modules\Training\Controllers\Admin;

use Modules\Training\Mappers\Training as TrainingMapper;
use Modules\Training\Models\Training as TrainingModel;
use Modules\Training\Mappers\Entrants as EntrantsMapper;
use Modules\User\Mappers\User as UserMapper;
use Modules\User\Mappers\Group as GroupMapper;

class Index extends \Ilch\Controller\Admin
{
    public function init()
    {
        $items = [
            [
                'name' => 'manage',
                'active' => false,
                'icon' => 'fa fa-th-list',
                'url' => $this->getLayout()->getUrl(['controller' => 'index', 'action' => 'index']),
                [
                    'name' => 'add',
                    'active' => false,
                    'icon' => 'fa fa-plus-circle',
                    'url' => $this->getLayout()->getUrl(['controller' => 'index', 'action' => 'treat'])
                ]
            ],
            [
                'name' => 'menuSettings',
                'active' => false,
                'icon' => 'fa fa-th-list',
                'url' => $this->getLayout()->getUrl(['controller' => 'settings', 'action' => 'index'])
            ]
        ];

        if ($this->getRequest()->getActionName() === 'treat') {
            $items[0][0]['active'] = true;
        } else {
            $items[0]['active'] = true;
        }

        $this->getLayout()->addMenu
        (
            'menuTraining',
            $items
        );
    }

    public function indexAction()
    {
        $trainingMapper = new TrainingMapper();

        $this->getLayout()->getAdminHmenu()
                ->add($this->getTranslator()->trans('menuTraining'), ['action' => 'index']);

        if ($this->getRequest()->getPost('check_training') && $this->getRequest()->getPost('action') === 'delete') {
            foreach ($this->getRequest()->getPost('check_training') as $trainingId) {
                $trainingMapper->delete($trainingId);
            }
        }

        $this->getView()->set('training', $trainingMapper->getTraining());
    }

    public function treatAction() 
    {
        $trainingMapper = new TrainingMapper();
        $userMapper = new UserMapper();
        $groupMapper = new GroupMapper();

        if ($this->getRequest()->getParam('id')) {
            $this->getLayout()->getAdminHmenu()
                    ->add($this->getTranslator()->trans('menuTraining'), ['action' => 'index'])
                    ->add($this->getTranslator()->trans('edit'), ['action' => 'treat']);

            $this->getView()->set('training', $trainingMapper->getTrainingById($this->getRequest()->getParam('id')));
        } else {
            $this->getLayout()->getAdminHmenu()
                    ->add($this->getTranslator()->trans('menuTraining'), ['action' => 'index'])
                    ->add($this->getTranslator()->trans('add'), ['action' => 'treat']);
        }

        if ($this->getRequest()->isPost()) {
            $model = new TrainingModel();

            if ($this->getRequest()->getParam('id')) {
                $model->setId($this->getRequest()->getParam('id'));
            }

            $title = trim($this->getRequest()->getPost('title'));

            if (empty($title)) {
                $this->addMessage('missingTitle', 'danger');
            } else {
                $groups = '';
                if (!empty($this->getRequest()->getPost('groups'))) {
                    $groups = implode(',', $this->getRequest()->getPost('groups'));
                }

                $model->setTitle($title);
                $model->setDate(new \Ilch\Date(trim($this->getRequest()->getPost('date'))));
                $model->setTime($this->getRequest()->getPost('time'));
                $model->setPlace($this->getRequest()->getPost('place'));
                $model->setContact($this->getRequest()->getPost('contact'));
                $model->setVoiceServer($this->getRequest()->getPost('voiceServer'));
                $model->setVoiceServerIP($this->getRequest()->getPost('voiceServerIP'));
                $model->setVoiceServerPW($this->getRequest()->getPost('voiceServerPW'));
                $model->setGameServer($this->getRequest()->getPost('gameServer'));
                $model->setGameServerIP($this->getRequest()->getPost('gameServerIP'));
                $model->setGameServerPW($this->getRequest()->getPost('gameServerPW'));
                $model->setText($this->getRequest()->getPost('text'));
                $model->setShow($this->getRequest()->getPost('calendarShow'));
                $model->setReadAccess($groups);
                $trainingMapper->save($model);

                $this->addMessage('saveSuccess');

                $this->redirect(['action' => 'index']);
            }
        }

        if ($trainingMapper->existsTable('calendar')) {
            $this->getView()->set('calendarShow', 1);
        }

        if ($this->getRequest()->getParam('id')) {
            $groups = explode(',', $trainingMapper->getTrainingById($this->getRequest()->getParam('id'))->getReadAccess());
        } else {
            $groups = [2,3];
        }

        $this->getView()->set('users', $userMapper->getUserList(['confirmed' => 1]))
                        ->set('userGroupList', $groupMapper->getGroupList())
                        ->set('groups', $groups);
    }

    public function delAction()
    {
        if ($this->getRequest()->isSecure()) {
            $trainingMapper = new TrainingMapper();
            $entrantsMapper = new EntrantsMapper();

            $trainingMapper->delete($this->getRequest()->getParam('id'));
            $entrantsMapper->deleteAllUser($this->getRequest()->getParam('id'));

            $this->addMessage('deleteSuccess');
        }

        $this->redirect(['action' => 'index']);
    }
}
