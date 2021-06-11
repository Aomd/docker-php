# docker-php
Docker PHP Client API

## Example

```php
<?php

namespace xxx;

use aomd\Docker\Docker;


require_once __DIR__ . '/../vendor/autoload.php';


$docker = new Docker();

$docker->setModule('Container');

print_r($docker -> list());

```