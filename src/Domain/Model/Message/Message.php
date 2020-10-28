<?php


namespace App\Domain\Model\Message;


use App\Domain\Model\Contact\Contact;

class Message
{

    /**
     * @var string
     */
    protected $from;

    /**
     * @var string
     */
    protected $to;

    /**
     * @var string
     */
    protected $message;

    /**
     * @var string
     */
    protected $cc;

    /**
     * @var string
     */
    protected $bcc;
    /**
     * @var string
     */
    protected $subject;

    /**
     * Message constructor.
     * @param string $from
     * @param string $to
     * @param string $message
     * @param string $cc
     * @param string $bcc
     * @param string $subject
     */
    public function __construct(string $from = '', string $message = '', string $to = '', string $cc = '', string $bcc = '', string $subject = '')
    {
        $this->from = $from;
        $this->to = $to;
        $this->message = $message;
        $this->cc = $cc;
        $this->bcc = $bcc;
        $this->subject = $subject;
    }

    /**
     * @return string
     */
    public function getFrom(): string
    {
        return $this->from;
    }

    /**
     * @param string $from
     * @return Message
     */
    public function setFrom(string $from): Message
    {
        $this->from = $from;
        return $this;
    }

    /**
     * @return string
     */
    public function getTo(): string
    {
        return $this->to;
    }

    /**
     * @param string $to
     * @return Message
     */
    public function setTo(string $to): Message
    {
        $this->to = $to;
        return $this;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     * @return Message
     */
    public function setMessage(string $message): Message
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return string
     */
    public function getCc(): string
    {
        return $this->cc;
    }

    /**
     * @param string $cc
     * @return Message
     */
    public function setCc(string $cc): Message
    {
        $this->cc = $cc;
        return $this;
    }

    /**
     * @return string
     */
    public function getBcc(): string
    {
        return $this->bcc;
    }

    /**
     * @param string $bcc
     * @return Message
     */
    public function setBcc(string $bcc): Message
    {
        $this->bcc = $bcc;
        return $this;
    }

    /**
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     * @return Message
     */
    public function setSubject(string $subject): Message
    {
        $this->subject = $subject;
        return $this;
    }


    /**
     * @param array $data
     * @return static
     */
    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['name']
        );
    }

    /**
     * @param Contact $contact
     * @return static
     */
    public static function fromContact(Contact $contact): self
    {
        return new self(
            $contact->getEmail(),
            $contact->getMessage()
        );
    }

}