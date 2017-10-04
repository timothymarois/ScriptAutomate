<?php namespace App\Emails;

interface InterfaceEmail
{
    public function send();
    public function addTo($arg);
    public function addCc($arg);
    public function addBcc($arg);
    public function addReplyTo($arg);
    public function from($arg);
    public function subject($arg);
    public function message($arg1,$arg2);
}
