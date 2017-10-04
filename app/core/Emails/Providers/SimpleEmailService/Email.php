<?php namespace App\Emails\Providers\SimpleEmailService;

/**
 * Email Class (must have the InterfaceEmail)
 * Loaded from the DashboardCMS Email Module \Emails
 */
class Email implements \App\Emails\InterfaceEmail
{

    /**
     * $service
     * SES Authentication
     */
    protected $service;

    /**
     * $message
     * Message class
     */
    protected $message;


    /**
     * __construct()
     */
    public function __construct($config)
    {
        $this->service = new Service($config['key'], $config['token']);
        $this->message = new Message();
    }


    //--------------------------------------------------------------------


    /**
     * send()
     *
     */
    public function send()
    {
        if (!$this->service) trigger_error("SimpleEmailService\Email::send(): Encountered an error: SES Access Key and Secret Key is missing.", E_USER_WARNING);
        return $this->service->sendEmail($this->message);
    }


    //--------------------------------------------------------------------


    /**
     * addTo()
     *
     */
    public function addTo($arg)
    {
        return $this->message->addTo($arg);
    }


    //--------------------------------------------------------------------


    /**
     * addCc()
     *
     */
    public function addCc($arg)
    {
        return $this->message->addCc($arg);
    }


    //--------------------------------------------------------------------


    /**
     * addBcc()
     *
     */
    public function addBcc($arg)
    {
        return $this->message->addBcc($arg);
    }


    //--------------------------------------------------------------------


    /**
     * addReplyTo()
     *
     */
    public function addReplyTo($arg)
    {
        return $this->message->addReplyTo($arg);
    }


    //--------------------------------------------------------------------


    /**
     * from()
     *
     */
    public function from($arg)
    {
        return $this->message->setFrom($arg);
    }


    //--------------------------------------------------------------------


    /**
     * subject()
     *
     */
    public function subject($arg)
    {
        return $this->message->setSubject($arg);
    }


    //--------------------------------------------------------------------


    /**
     * message()
     *
     */
    public function message($arg1,$arg2)
    {
        return $this->message->setMessageFromString($arg1,$arg2);
    }


    //--------------------------------------------------------------------


    /**
     * addAttachmentFromData()
     *
     */
    public function addAttachmentFromData($name, $data, $mimeType = 'application/octet-stream', $contentId = null, $attachmentType = 'attachment')
    {
        return $this->message->addAttachmentFromData($name, $data, $mimeType, $contentId, $attachmentType);
    }


    //--------------------------------------------------------------------


}
