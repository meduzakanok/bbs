<?php
$name = getenv('NAME', true) ?: 'World';
echo sprintf('Hello meduza %s!', $name);
?>
