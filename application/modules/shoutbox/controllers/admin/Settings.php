<?php
/**
 * @copyright Ilch 2.0
 * @package ilch
 */

namespace Modules\Shoutbox\Controllers\Admin;

class Settings extends \Ilch\Controller\Admin
{
    public function init()
    {
        $this->getLayout()->addMenu
        (
            'menuShoutbox',
            [
                [
                    'name' => 'manage',
                    'active' => false,
                    'icon' => 'fa fa-th-list',
                    'url' => $this->getLayout()->getUrl(['controller' => 'index', 'action' => 'index'])
                ],
                [
                    'name' => 'settings',
                    'active' => true,
                    'icon' => 'fa fa-cogs',
                    'url' => $this->getLayout()->getUrl(['controller' => 'settings', 'action' => 'index'])
                ]
            ]
        );
    }
    
    public function indexAction() 
    {
        $this->getLayout()->getAdminHmenu()
                ->add($this->getTranslator()->trans('menuShoutbox'), ['controller' => 'index', 'action' => 'index'])
                ->add($this->getTranslator()->trans('settings'), ['action' => 'index']);

        if ($this->getRequest()->isPost()) {
            $this->getConfig()->set('shoutbox_limit', $this->getRequest()->getPost('limit'));
            $this->getConfig()->set('shoutbox_maxwordlength', $this->getRequest()->getPost('maxwordlength'));
            $this->getConfig()->set('shoutbox_maxtextlength', $this->getRequest()->getPost('maxtextlength'));
            $this->addMessage('saveSuccess');
        }

        $this->getView()->set('limit', $this->getConfig()->get('shoutbox_limit'));
        $this->getView()->set('maxwordlength', $this->getConfig()->get('shoutbox_maxwordlength'));
        $this->getView()->set('maxtextlength', $this->getConfig()->get('shoutbox_maxtextlength'));
    }
}
