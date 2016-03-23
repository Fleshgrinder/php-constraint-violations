<?php
/**
 * @author Richard Fussenegger <fleshgrinder@users.noreply.github.com>
 * @copyright 2016 Richard Fussenegger
 * @license MIT
 */

namespace Fleshgrinder\Constraints;

use Exception;

/**
 * The violation value object encapsulates a message and a possible cause that resulted in the violation.
 *
 * Implementers who choose to extend this class to provide additional functionality should ensure that the resulting
 * objects are immutable.
 */
class Violation {

	/** @var Exception */
	private $cause;

	/** @var string */
	private $message;

	public function __construct(string $message, Exception $cause) {
		assert('$message !== ""', '`message` cannot be empty');
		$this->cause = $cause;
		$this->message = $message;
	}

	/** @inheritDoc */
	public function __toString(): string {
		return $this->message;
	}

	/** Get this violation’s cause, if any. */
	public function getCause(): Exception {
		return $this->cause;
	}

	/** Get this violation’s message. */
	public function getMessage(): string {
		return $this->message;
	}

	//@formatter:off
	//@codeCoverageIgnoreStart
	//@codingStandardsIgnoreStart
	private function __clone(){}
	private function __sleep(){}
	private function __wakeup(){}
	//@codingStandardsIgnoreEnd
	//@codeCoverageIgnoreEnd
	//@formatter:on

}
