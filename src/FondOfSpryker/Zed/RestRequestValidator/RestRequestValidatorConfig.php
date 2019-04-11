<?php

namespace FondOfSpryker\Zed\RestRequestValidator;

use FondOfSpryker\Shared\RestRequestValidator\RestRequestValidatorConstants;
use Spryker\Zed\RestRequestValidator\RestRequestValidatorConfig as SprykerRestRequestValidatorConfig;

class RestRequestValidatorConfig extends SprykerRestRequestValidatorConfig
{
    protected const PATH_PATTERN_CORE_VALIDATION = '/spryker*/*/*/*/Glue/*/Validation';

    /**
     * @return string[]
     */
    public function getValidationSchemaPathPattern(): array
    {
        $validationSchemaPathPattern = parent::getValidationSchemaPathPattern();

        $corePathPattern = array_shift($validationSchemaPathPattern);
        $validationSchemaPathPattern = array_merge($this->getThirdPartyPathPatterns(), $validationSchemaPathPattern);
        array_unshift($validationSchemaPathPattern, $corePathPattern);

        return $validationSchemaPathPattern;
    }

    /**
     * @return string[]
     */
    public function getThirdPartyPathPatterns(): array
    {
        $thirdPartyPathPatterns = $this->get(RestRequestValidatorConstants::THIRD_PARTY_VALIDATION_PATH_PATTERNS, []);

        return array_reverse($thirdPartyPathPatterns);
    }
}
