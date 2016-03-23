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
use IteratorAggregate;
use UnexpectedValueException;

/**
 * The violation exception encapsulates a collector and thus constraint violation messages and causes the were
 * encountered during the validation process of domain logic. This exception should not be used while validating user
 * input that is expected to contain errors, however, it can be used in the (named) constructors of value objects to
 * enable the collection of multiple violations and subsequently the transformation of such messages back to user
 * notifications.
 *
 * > **NOTE**
 * >
 * > It is **highly** recommended to extend this exception and create a more meaningful one that is of an equivalent
 * > abstraction than the code that is going to throw it.
 */
class ViolationException extends UnexpectedValueException implements Countable, IteratorAggregate {

	/** @var ViolationCollector */
	protected $violations;

	/** @inheritDoc */
	public function __construct(ViolationCollector $violations) {
		$this->violations = $violations;
		parent::__construct("Encountered {$violations->count()} constraint violations.");
	}

	/** @inheritDoc */
	public function count() {
		return $this->violations->count();
	}

	/**
	 * @see ViolationCollector::getCauses()
	 * @return Generator|Exception[]
	 */
	public function getCauses(): Generator {
		return $this->violations->getCauses();
	}

	/** @inheritDoc */
	public function getIterator() {
		return $this->violations;
	}

	/**
	 * @see ViolationCollector::getMessages()
	 * @return Generator|string[]
	 */
	public function getMessages(): Generator {
		return $this->violations->getMessages();
	}

}
