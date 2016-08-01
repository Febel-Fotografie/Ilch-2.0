<?php
/**
 * @copyright Ilch 2.0
 * @package ilch
 */

namespace Modules\Contact\Controllers;

use Modules\Contact\Mappers\Receiver as ReceiverMapper;

class Index extends \Ilch\Controller\Frontend
{
    public function indexAction()
    {
        $receiverMapper = new ReceiverMapper();

        $this->getLayout()->getHmenu()->add($this->getTranslator()->trans('menuContact'), ['action' => 'index']);

        if ($this->getRequest()->getPost('saveContact')) {
            $receiver = $receiverMapper->getReceiverById($this->getRequest()->getPost('contact_receiver'));
            $name = $this->getRequest()->getPost('contact_name');
            $contactEmail = $this->getRequest()->getPost('contact_email');
            $subject = $this->getTranslator()->trans('contactWebsite').$this->getConfig()->get('page_title').':<'.$name.'>('.$contactEmail.')';
            $captcha = trim(strtolower($this->getRequest()->getPost('captcha')));
            $message = $this->getRequest()->getPost('contact_message');

            if (empty($name)) {
                $this->addMessage('missingName', 'danger');
            } elseif (empty($contactEmail)) {
                $this->addMessage('missingEmail', 'danger');
            } elseif (!filter_var($contactEmail, FILTER_VALIDATE_EMAIL)) {
                $this->addMessage('invalidEmail', 'danger');
            } elseif (empty($message)) {
                $this->addMessage('missingText', 'danger');
            } elseif (empty($_SESSION['captcha']) || $captcha != $_SESSION['captcha']) {
                $this->addMessage('invalidCaptcha', 'danger');
            } else {
                /*
                * @todo create a general sender.
                */
                $mail = new \Ilch\Mail();
                $mail->setTo($receiver->getEmail(),$receiver->getName())
                        ->setSubject($subject)
                        ->setFrom($this->getConfig()->get('standardMail'), $this->getConfig()->get('page_title'))
                        ->setMessage($message)
                        ->addGeneralHeader('Content-Type', 'text/plain; charset="utf-8"');
                $mail->setAdditionalParameters('-f '.$this->getConfig()->get('standardMail'));
                $mail->send();

                $this->addMessage('sendSuccess');
            }
        }

        $this->getView()->set('receivers', $receiverMapper->getReceivers());
    }
}
