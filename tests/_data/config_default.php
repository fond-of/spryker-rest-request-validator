<?php

use FondOfSpryker\Shared\RestRequestValidator\RestRequestValidatorConstants;
use Spryker\Shared\Kernel\KernelConstants;

$CURRENT_STORE = 'UNIT';

$config[KernelConstants::PROJECT_NAMESPACES] = [
    'Pyz',
];

$config[KernelConstants::CORE_NAMESPACES] = [
    'FondOfSpryker',
    'SprykerShop',
    'SprykerEco',
    'Spryker',
];

$config[RestRequestValidatorConstants::THIRD_PARTY_VALIDATION_PATH_PATTERNS] = [
    'fond-of-spryker/*/*/*/Glue/*/Validation',
];
