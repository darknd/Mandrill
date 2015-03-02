<?php

use Mandrill;


class MailHandler {

    const CONTENT_TYPE_HTML = 'html';
    const CONTENT_TYPE_TEXT = 'text';

    private $apiKey = '';
    private $_contentText = null;
    private $_contentHtml = null;
    private $_subject = null;
    private $_from = null;
    private $_fromName = null;
    private $_to = array();

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function setContent($content, $type)
    {
        if ($type == self::CONTENT_TYPE_HTML)
        {
            $this->_contentHtml = $content;
        }

        if ($type == self::CONTENT_TYPE_TEXT)
        {
            $this->_contentText = $content;
        }
    }

    public function setSubject($subject)
    {
        $this->_subject = $subject;
    }

    public function setFrom($email, $name=null)
    {
        $this->_from = $email;
        if (!is_null($name))
        {
            $this->_fromName = $name;
        }
    }

    public function addCC($email, $name = null)
    {
        $this->_to[] = ['email' => $email, 'name'=> $name,'type' => 'cc'];
    }

    public function addBCC($email, $name = null)
    {
        $this->_to[] = ['email' => $email, 'name'=> $name,'type' => 'bcc'];
    }

    public function send(){
        $mandrill = new Mandrill($this->apiKey);

        $message = array(
            'subject' => $this->_subject,
            'from_email' => $this->_from,
            'from_name' => $this->_fromName,
            'to' => $this->_to);

        if (!is_null($this->_contentText))
        {
            $message['text'] = $this->_contentText;
        }

        if (!is_null($this->_contentHtml))
        {
            $message['html'] = $this->_contentHtml;
        }

        return print_r($mandrill->messages->send($message));
    }

}
