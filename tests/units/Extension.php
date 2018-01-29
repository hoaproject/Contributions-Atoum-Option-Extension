<?php

namespace tests\units\Hoa\atoum\Option;

use mageekguy\atoum;

class Extension extends atoum\test
{
	public function testClass()
	{
		$this
			->testedClass
				->hasInterface('mageekguy\atoum\extension')
		;
	}

	public function test__construct()
	{
		$this
			->if($script = new atoum\scripts\runner(uniqid()))
				->and($script->setArgumentsParser($parser = new \mock\mageekguy\atoum\script\arguments\parser()))
				->and($configurator = new \mock\mageekguy\atoum\configurator($script))
			->then
				->object($this->newTestedInstance)
					->if($this->resetMock($parser))
					->if($this->newTestedInstance($configurator))
						->then
							->mock($parser)
								->call('addHandler')
									->twice()
		;
	}

	public function testSetRunner()
	{
		$this
			->if($this->newTestedInstance)
			->and($runner = new atoum\runner())
			->then
				->object($this->testedInstance->setRunner($runner))
					->isTestedInstance
		;
	}

	public function testSetTest()
	{
		$this
			->given(
				$manager = new \mock\mageekguy\atoum\test\assertion\manager(),
				$test = new \mock\mageekguy\atoum\test(),
				$test->setAssertionManager($manager)
			)
			->if($this->newTestedInstance)
				->then
					->object($this->testedInstance->setTest($test))
						->isTestedInstance
					->mock($manager)
						->call('setHandler')
							->withArguments('option')
								->once()
		;
	}
}
