<?php
namespace braga\tools\tools;
/**
 *
 * @package common
 * @author Tomasz.Gajewski
 * Created on 2009-04-21 08:19:23
 * klasa umożliwiająca wysłanie emaila poprzez SMTP
 * klasa wysyła oddzielne maile do każdego nadawcy
 * żaden nadawca nie wie do kogo jeszcze poszła wiadomość
 * możliwe jest określenie jednego adresu DW (do wiadomości)
 * takiego samego dla wszystkich wiadomości
 */
class Poczta
{
	protected $from;
	protected $subject = null;
	protected $message = null;
	/**
	 *
	 * @var array EmailAddress
	 */
	protected $adresaci = array();
	protected $priority = self::NORMAL;
	protected $cc = array();
	protected $bcc = array();
	protected $realMode = true;
	// -------------------------------------------------------------------------
	const HIGH = "X-Priority: 1 (High)";
	const NORMAL = "X-Priority: 3 (Normal)";
	const LOW = "X-Priority: 5 (Low)";
	// -------------------------------------------------------------------------
	protected function realSendMail(EmailAddress $to)
	{
		$headers = "From: " . $this->from->getFormatedAddress() . "\n";
		// $headers .= "To: " . $to->getFormatedAddress() . "\n";
		foreach($this->cc as $cc) /* @var $cc EmailAddress */
		{
			$headers .= "CC: " . $cc->getFormatedAddress() . "\n";
		}
		foreach($this->bcc as $bcc)/* @var $bcc EmailAddress */
		{
			$headers .= "BCC: " . $bcc->getFormatedAddress() . "\n";
		}
		$headers .= "MIME-Version: 1.0\n";
		$headers .= $this->priority . "\n";
		$headers .= "Content-Type: text/html; charset=UTF-8; \n";
		$headers .= "Content-Transfer-Encoding: 8bit; \n";

		$body = "<!DOCTYPE html PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>\n";
		$body .= "<html>";
		$body .= "<head>";
		$body .= "<meta http-equiv='Content-Type' content='text/html;charset=utf-8'>";
		$body .= $this->getStyle();
		$body .= "</head>";
		$body .= "<body>";
		$body .= $this->message;
		$body .= "</body>";
		$body .= "</html>";
		if($this->realMode)
		{
			return @mail($to->getFormatedAddress(), $this->getSubject(), $body, $headers);
		}
	}
	// -------------------------------------------------------------------------
	protected function getStyle()
	{
		$retval = "<style>body{font-size:12px;font-family:Arial;}</style>";
		return $retval;
	}
	// -------------------------------------------------------------------------
	public function setDoWiadomosci(EmailAddress $adresat)
	{
		$this->cc[] = $adresat;
	}
	// -------------------------------------------------------------------------
	public function setUkrytyDoWiadomosci(EmailAddress $adresat)
	{
		$this->bcc[] = $adresat;
	}
	// -------------------------------------------------------------------------
	public function setFrom(EmailAddress $from)
	{
		$this->from = $from;
	}
	// -------------------------------------------------------------------------
	public function setPriority($priority)
	{
		if($priority == self::HIGH || $priority == self::NORMAL || $priority == self::LOW)
		{
			$this->priority = $priority;
		}
		else
		{
			$this->priority = self::NORMAL;
		}
	}
	// -------------------------------------------------------------------------
	public function setSubject($subject)
	{
		$this->subject = $subject;
	}
	// -------------------------------------------------------------------------
	protected function getSubject()
	{
		return "=?utf-8?B?" . base64_encode($this->subject) . "?=";
	}
	// -------------------------------------------------------------------------
	public function setMessage($message)
	{
		$this->message = html_entity_decode($message);
	}
	// -------------------------------------------------------------------------
	/**
	 * dodaje kolejnego odbiorcę emaila
	 * ograniczeniem ilości odbiorców jest dostępna pamięć
	 */
	public function addTo(EmailAddress $adresat)
	{
		if(!isset($this->adresaci[$adresat->getEmail()]))
		{
			$this->adresaci[$adresat->getEmail()] = $adresat;
		}
	}
	// -------------------------------------------------------------------------
	/**
	 * wysyła maila
	 * do każdego odbiory wysyłany jest email indywidualnie
	 */
	public function sendMails()
	{
		foreach($this->adresaci as $adresat)
		{
			$this->realSendMail($adresat);
		}
		return true;
	}
	// -------------------------------------------------------------------------
}
?>