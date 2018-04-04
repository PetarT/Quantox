<?php
/**
 * Created by PhpStorm.
 * User: petar
 * Date: 4.4.18.
 * Time: 11.17
 */

namespace Quantox\Domain\Exceptions;

/**
 * Class BaseException
 * @package Quantox\Domain\Exceptions
 */
class BaseException extends \Exception
{
	/**
	 * @var string $message - Exception's error message.
	 */
	protected $message = "General Exception message.";

	/**
	 * @var integer $code - Exception's error code.
	 */
	protected $code = 500;


	/**
	 * Initializes the Exception.
	 *
	 * @param  string|NULL    $message  - Exception's text message.
	 * @param  int|NULL       $code     - Exception's code number.
	 * @param \Exception|NULL $previous - Previous Exception in the stack, for Exception's nesting.
	 *
	 * @since  1.0.0
	 * @return void
	 */
	public function __construct(string $message = null, int $code = null, \Exception $previous = null)
	{
		/*
		 * Validates provided parameters.
		 *
		 * If no message nor code were supplied, then we'll use whatever values were already
		 * set in the class.
		 */
		if ($message === null)
		{
			$message = $this->message;
		}

		if ($code === null)
		{
			$code = $this->code;
		}

		// Calls parent construct().
		parent::__construct($message, $code, $previous);
	}
}
