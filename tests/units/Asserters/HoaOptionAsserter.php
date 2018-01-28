<?php

namespace tests\units\Hoa\atoum\Option\Asserters;

use function Hoa\Option\None;
use function Hoa\Option\Some;
use mageekguy\atoum;

class HoaOptionAsserter extends atoum\test
{
	public function testClass()
	{
		$this
			->testedClass
				->isSubClassOf('mageekguy\atoum\asserters\variable')
		;
	}

	public function testSetWidth()
	{
		$this
			->if($asserter = $this->newTestedInstance)
			->and($value = None())
			->then
				->exception(function() use ($asserter)
				{
					$asserter->setWith(new \stdClass);
				})
				->isInstanceOf('mageekguy\atoum\asserter\exception')
					->hasMessage('object(stdClass) is not an Option instance')
				->object($this->testedInstance->setWith($value))
					->isTestedInstance
				->object($asserter->getValue())
					->isIdenticalTo($value)
		;
	}

	public function testIsNone()
	{
		$this
			->given($value = None())
			->if($asserter = $this->newTestedInstance)
			->then
				->assert('Check none value')
					->exception(function() use ($asserter)
					{
						$asserter
							->setWith(Some(42))
							->isNone();
					})
					->isInstanceOf('mageekguy\atoum\asserter\exception')
						->hasMessage('Option::some() "integer(42)" contains a value')
				->assert('Check none value with custom fail message')
					->exception(function() use ($asserter)
					{
						$asserter
							->setWith(Some(42))
							->isNone('yolo');
					})
					->isInstanceOf('mageekguy\atoum\asserter\exception')
						->hasMessage('yolo')
				->assert('Check assertion return the asserter to chain')
					->object($this->testedInstance->setWith($value)->isNone())
						->isTestedInstance()
		;
	}

	public function testIsSome()
	{
		$this
			->given($value = Some(42))
			->if($asserter = $this->newTestedInstance)
			->then
			->assert('Check some value')
				->exception(function() use ($asserter)
				{
					$asserter
						->setWith(None())
						->isSome();
				})
				->isInstanceOf('mageekguy\atoum\asserter\exception')
					->hasMessage('Option::none() doesn\'t contains a value')
			->assert('Check some value with custom fail message')
			->exception(function() use ($asserter)
				{
					$asserter
						->setWith(None())
						->isSome('yolo');
				})
				->isInstanceOf('mageekguy\atoum\asserter\exception')
					->hasMessage('yolo')
			->assert('Check assertion return the asserter to chain')
				->object($this->testedInstance->setWith($value)->isSome())
					->isTestedInstance()
		;
	}

	public function testSome()
	{
		$this
			->given($value = Some(42))
			->if($asserter = $this->newTestedInstance)
			->then
				->assert('Check some value')
				->exception(function() use ($asserter)
				{
					$asserter
						->setWith(None())
						->some();
				})
				->isInstanceOf('mageekguy\atoum\asserter\exception')
					->hasMessage('Option::none() doesn\'t contains a value')
			->assert('Check assertion return the asserter to chain with')
				->object($this->testedInstance->setWith($value)->some())
					->isTestedInstance()
			->assert('Check unwrapped value define the new value')
				->if($this->testedInstance->setWith($value)->some())
				->integer($this->testedInstance->getValue())
					->isIdenticalTo(42)
			->assert('Check unwrapped value type')
				->variable($this->testedInstance->setWith($value)->some()->integer)
			->assert('Check unwrapped value value')
				->variable($this->testedInstance->setWith($value)->some()->isEqualTo(42))
			->assert('Check unwrapped value full assertion')
				->if($this->testedInstance->setWith($value)->some())
					->variable($this->testedInstance->integer($this->testedInstance->getValue())->isEqualTo(42))
		;
	}

	public function testShortSyntax()
	{
		$this
			->given($value = Some(42), $none = None())
			->if($this->newTestedInstance)
			->then
				->assert('Check some short syntax value')
					->object($this->testedInstance->setWith($value)->some->isEqualTo(42))
						->isTestedInstance()
				->assert('Check isSome short syntax')
					->object($this->testedInstance->setWith($value)->isSome)
						->isTestedInstance()
				->assert('Check isNome short syntax')
					->object($this->testedInstance->setWith($none)->isNone)
						->isTestedInstance()
		;
	}
}
