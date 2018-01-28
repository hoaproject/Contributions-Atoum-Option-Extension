<?php

/**
 * Hoa
 *
 *
 * @license
 *
 * New BSD License
 *
 * Copyright © 2007-2018, Hoa community. All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *     * Redistributions of source code must retain the above copyright
 *       notice, this list of conditions and the following disclaimer.
 *     * Redistributions in binary form must reproduce the above copyright
 *       notice, this list of conditions and the following disclaimer in the
 *       documentation and/or other materials provided with the distribution.
 *     * Neither the name of the Hoa nor the names of its contributors may be
 *       used to endorse or promote products derived from this software without
 *       specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDERS AND CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 */

namespace Hoa\atoum\Option;

use Hoa\atoum\Option\Asserters\HoaOptionAsserter;
use mageekguy\atoum;
use mageekguy\atoum\observable;
use mageekguy\atoum\runner;
use mageekguy\atoum\test;

class Extension implements atoum\extension
{
	public function __construct(atoum\configurator $configurator = null)
	{
		if ($configurator)
		{
			$parser = $configurator->getScript()->getArgumentsParser();

			$handler = function($script, $argument, $values) {
				$script->getRunner()->addTestsFromDirectory(dirname(__DIR__) . '/tests/units');
			};

			$parser
				->addHandler($handler, array('--test-ext'))
				->addHandler($handler, array('--test-it'))
			;
		}
	}

	public function addToRunner(runner $runner)
	{
		$runner->addExtension($this);

		return $this;
	}

	public function setRunner(runner $runner)
	{
		return $this;
	}

	public function setTest(test $test)
	{
		$asserter = null;

		$test->getAssertionManager()
			->setHandler(
				'hoaOption',
				function($option) use ($test, & $asserter)
				{
					if ($asserter === null)
					{
						$asserter = new HoaOptionAsserter($test->getAsserterGenerator());
					}

					$asserter->setWithTest($test);
					return $asserter->setWith($option);
				}
			)
		;

		return $this;
	}

	public function handleEvent($event, observable $observable) {}
}
