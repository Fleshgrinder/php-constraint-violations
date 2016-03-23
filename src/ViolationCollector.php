<?php
/**
 * @author Richard Fussenegger <fleshgrinder@users.noreply.github.com>
 * @copyright 2016 Richard Fussenegger
 * @license MIT
 */

namespace Fleshgrinder\Constraints;

use Countable;
use Exception;
use Generator;
use Iterator;
use UnexpectedValueException;

/**
 * The constraint violation collector can be used to collect messages and their possible causes during validation. This
 * class may be extended to provide additional functionality or simply to construct different objects in the
 * {@see Violations::addMessage()} method.
 *
 * Note that this class does not clone the violation instances that are added to it. The generic {@see Violation}
 * implementation is immutable and extending classes should be too.
 */
class ViolationCollector implements Countable, Iterator {

	/** @var Violation[] */
	private $violations = [];

	/**
	 * Add a child instance of {@see Violation} to the collector. This method should not be used to add {@see Violation}
	 * instances to the collector use {@see ViolationCollector::addViolation()} instead. The using code is cleaner
	 * without any `new Violation` code.
	 *
	 * @see ViolationCollector::addViolation()
	 * @param $violation
	 */
	public function add(Violation $violation) {
		$this->violations[] = $violation;
	}

	/**
	 * Add a {@see Violation} to the collector.
	 *
	 * @param $message
	 *     that explains the violation in user language.
	 * @param $cause
	 *     that explains the violation in developer language. An {@see \UnexpectedValueException} with
	 *     <var>$message</var> is created if `NULL` (default) is passed.
	 */
	public function addViolation(string $message, Exception $cause = null) {
		$cause = $cause ?? new UnexpectedValueException($message);
		$this->violations[] = new Violation($message, $cause);
	}

	/** @inheritDoc */
	public function count() {
		return count($this->violations);
	}

	/**
	 * {@inheritDoc}
	 * @return Violation
	 */
	public function current() {
		return current($this->violations);
	}

	/**
	 * Get all collected constraint violation causes, if any.
	 *
	 * @return Generator|Exception[]
	 */
	public function getCauses(): Generator {
		foreach ($this->violations as $violation) {
			yield $violation->getCause();
		}
	}

	/**
	 * Get all collected constraint violation messages, if any.
	 *
	 * @return Generator|string[]
	 */
	public function getMessages(): Generator {
		foreach ($this->violations as $violation) {
			yield $violation->getMessage();
		}
	}

	/**
	 * Check if any constraint violations were collected.
	 */
	public function hasViolations(): bool {
		return !empty($this->violations);
	}

	/** @inheritDoc */
	public function next() {
		next($this->violations);
	}

	/** @inheritDoc */
	public function key() {
		return key($this->violations);
	}

	/** @inheritDoc */
	public function valid() {
		return current($this->violations) !== false;
	}

	/** @inheritDoc */
	public function rewind() {
		reset($this->violations);
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
