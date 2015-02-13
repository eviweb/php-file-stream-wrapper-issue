<?php

Tracker::getInstance()->reset();
FileStreamWrapper::wrap();

require 'file:///'.__DIR__.'/required-fixture.php';

echo '<p>';
echo 'Expected file stream wrapper constructor call: 1<br>';
echo 'Actual file stream wrapper constructor call: '.Tracker::getInstance()->getCounter().'<br>';
echo '</p>';
