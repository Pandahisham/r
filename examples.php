<?php

require_once __DIR__ . '/R.php';

// Full string match
//
// /^Paradise Lost$/
//
echo R::expression()
	->startOfString()
	->text('Paradise Lost')
	->endOfString() . "\n";

// Alternate texts
//
// /The (dog|cat)?basket fell off the roof/
//
echo R::expression()
	->text('The ')
	->group(
		R::group()->optional()->oneOfThese()->text('dog')->text('cat')
	)
	->text('basket fell off the roof') . "\n";

// Assertions
//
// /\bkettle\b/
//
echo R::expression()
	->wordBoundary()
	->text('kettle')
	->wordBoundary() . "\n";

// Quantifiers: Dutch postal code
//
// /[\d]{4}[a-z]{2}/
//
echo R::expression()
	->char(R::chars()->digit()->times(4))
	->char(R::chars()->letter()->times(2)) . "\n";

// Named blocks
// Automatically adjusting delimiters (#)
//
// #(?P<protocol>http[s]?)://(?P<url>.*)#
//
echo R::expression()
	->group(
		R::group('protocol')
			->text('http')
			->char(R::chars('s')->optional())
	)
	->text('://')
	->group(
		R::group('url')
			->char(R::anyChar()->zeroOrMore())
	) . "\n";

// Multiline expressions
//
// /^start\s+(^the)\s+show$/m
//
echo R::multiLineExpression()
	->startOfStringOrLine()
	->text('start')
	->whitespace()
	->group(
		R::group()->startOfLine()->text('the')
	)
	->whitespace()
	->text('show')
	->endOfStringOrLine() . "\n";