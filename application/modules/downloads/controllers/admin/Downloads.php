<?php
/**
 * @copyright Ilch 2.0
 * @package ilch
 */

namespace Modules\Downloads\Controllers\Admin;

use Modules\Downloads\Mappers\File as FileMapper;
use Modules\Downloads\Mappers\Downloads as DownloadsMapper;
use Modules\Downloads\Controllers\Admin\Base as BaseController;

defined('ACCESS') or die('no direct access');

class Downloads extends BaseController 
{
    public function init()
    {
        parent::init();
        $this->getLayout()->addMenuAction
        (
            array
            (
                'name' => 'menuActionDownloadsInsertImage',
                'icon' => 'fa fa-plus-circle',
                'url'  => 'javascript:media();'
            )
        );
    }

    public function indexAction() 
    {
        
    }

    public function treatDownloadsAction() 
    {
        $fileMapper = new FileMapper();
        $pagination = new \Ilch\Pagination();
        $downloadsMapper = new DownloadsMapper();
        $id = $this->getRequest()->getParam('id');
        $downloadsTitle = $downloadsMapper->getDownloadsById($id);

        if ($this->getRequest()->getPost('action') == 'delete') {
                foreach($this->getRequest()->getPost('check_gallery') as $imageId) {
                    $imageMapper->deleteById($imageId);
                }
                $this->addMessage('deleteSuccess');
                $this->redirect(array('action' => 'treatgallery','id' => $id));
        }

        if ($this->getRequest()->getPost()) {
            foreach($this->getRequest()->getPost('check_image') as $imageId ) {
                $catId = $this->getRequest()->getParam('id');
                $model = new \Modules\Downloads\Models\File();
                $model->setFileId($imageId);
                $model->setCat($catId);
                $fileMapper->save($model);
            }
        }

        $pagination->setPage($this->getRequest()->getParam('page'));
        $this->getView()->set('image', $fileMapper->getFileByDownloadsId($id, $pagination));
        $this->getView()->set('pagination', $pagination);
        $this->getView()->set('galleryTitle', $downloadsTitle->getTitle());
    }

    public function treatImageAction() 
    {
        $imageMapper = new ImageMapper();
        $id = $this->getRequest()->getParam('id');

        if ($this->getRequest()->getPost()) {
            $imageTitle = $this->getRequest()->getPost('imageTitle');
            $imageDesc = $this->getRequest()->getPost('imageDesc');
            $model = new \Modules\Gallery\Models\Image();
            $model->setId($id);
            $model->setImageTitle($imageTitle);
            $model->setImageDesc($imageDesc);
            $imageMapper->saveImageTreat($model);

            $this->addMessage('Success');
        }

        $this->getView()->set('image', $imageMapper->getImageById($id));
    }

    public function delAction()
    {
        if($this->getRequest()->isSecure()) {
            $imageMapper = new ImageMapper();
            $id = $this->getRequest()->getParam('id');

            $imageMapper->deleteById($id);

            $this->addMessage('deleteSuccess');
            $this->redirect(array('action' => 'treatgallery', 'id' => $this->getRequest()->getParam('gallery')));
        }
    }
}