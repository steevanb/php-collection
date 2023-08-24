<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ObjectCollection;

use Steevanb\PhpCollection\ScalarCollection\StringCollection;

enum FooEnum {}

/** @extends AbstractObjectCollection<\DateTime> */
class DateTimeCollection extends AbstractObjectCollection
{
}

$collection = new DateTimeCollection([new \DateTime()]);
$collection->add(new \stdClass());
$data1 = $collection->get('foo');
$useless = $data1->getTimestamp();
$data1->sdfonsdfoinsdfionsdf();
$data1->foo();

$collection->add('foo');
$collection->merge(new StringCollection());

foreach ($collection->toArray() as $dataTime) {
    $useless2 = $dataTime->foo();
}
