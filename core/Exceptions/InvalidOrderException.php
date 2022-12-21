<?php 
namespace Core\Exceptions;

use Exception;

class InvalidOrderException extends Exception
{
    private $messages;

    public function __construct($message, $code = 0, Exception $previous = null) 
    {
    	if(!is_array($message)) {
    		$this->messages = [[$message]];
    	}else{
    		$this->messages = $message;
    	}
    	$message = 'errors';
        parent::__construct($message, $code, $previous);
    }

	public function getMessages()
	{
		return $this->messages;
	}

}
