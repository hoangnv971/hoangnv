<?php 
namespace Core\Exceptions;

use Exception;

class InvalidOrderException extends Exception
{
    private $_messages;

    public function __construct($message, 
                                $code = 0, 
                                Exception $previous = null
                                ) 
    {
    	if(is_array($message)){
    		$this->_messages = $message;
    		$message = 'Errors!';
    	}
        parent::__construct($message, $code, $previous);
    }

     public function getMessages() { 
     	return $this->_messages; 
     }

}
