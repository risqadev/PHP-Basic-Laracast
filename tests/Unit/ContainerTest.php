<?php

use Core\Container;

test('it can reolve something out of the container', function () {
  // arranje
  $container = new Container();

  $container->bind('foo', fn () => 'bar');

  // act
  $result = $container->resolve('foo');

  // assert/expect
  expect($result)->toEqual('bar');
});
