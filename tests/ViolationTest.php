<?php
/**
 * @author Richard Fussenegger <fleshgrinder@users.noreply.github.com>
 * @copyright 2016 Richard Fussenegger
 * @license MIT
 */

namespace Fleshgrinder\Constraints;

final class Stringable {

	public function __toString() {
		return 'message';
	}

}

final class ViolationTest extends \PHPUnit_Framework_TestCase {

	public function testStringable() {
		$cut = new Violation(new Stringable, new \Exception);
		$this->assertSame('message', (string) $cut);
	}

	public function testCount() {
		$c = new ViolationCollector;
		$c->addViolation('v1');
		$e = new ViolationException($c);
		$c->addViolation('v2');
		$this->assertSame(2, count($e));
	}

	public function testIterator() {
		$cut = new ViolationCollector;
		$x = new Violation('x', new \Exception('x'));
		$cut->add($x);
		$y = new Violation('y', new \Exception('y'));
		$cut->add($y);
		$cut = new ViolationException($cut);
		$this->assertSame([ $x, $y ], iterator_to_array($cut));
	}

	public function testGetMessages() {
		$cut = new ViolationCollector;
		$cut->addViolation('message');
		$cut = new ViolationException($cut);
		$this->assertSame('message', implode('', iterator_to_array($cut->getMessages())));
	}

	public function testGetMessagesEmpty() {
		$cut = new ViolationException(new ViolationCollector);
		$this->assertSame([], iterator_to_array($cut->getMessages()));
	}

	public function testGetCauses() {
		$cut = new ViolationCollector;
		$expected = new \Exception;
		$cut->addViolation('message', $expected);
		$cut = new ViolationException($cut);
		$this->assertSame([ $expected ], iterator_to_array($cut->getCauses()));
	}

	public function testGetCausesEmpty() {
		$cut = new ViolationException(new ViolationCollector);
		$this->assertSame([], iterator_to_array($cut->getCauses()));
	}

	public function testHasViolations() {
		$cut = new ViolationCollector;
		$this->assertFalse($cut->hasViolations());
		$cut->addViolation('1');
		$this->assertTrue($cut->hasViolations());
	}

}
