<?php

namespace FondOfSpryker\Zed\RestRequestValidator;

use Codeception\Test\Unit;
use FondOfSpryker\Shared\RestRequestValidator\RestRequestValidatorConstants;

class RestRequestValidatorConfigTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\RestRequestValidator\RestRequestValidatorConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restRequestValidatorConfig;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->restRequestValidatorConfig = $this->getMockBuilder(RestRequestValidatorConfig::class)
            ->setMethods(['get'])
            ->getMock();
    }

    /**
     * @return void
     */
    public function testGetValidationSchemaPathPatternWithEmptyThirdPartyPathPatterns(): void
    {
        $this->restRequestValidatorConfig->expects($this->atLeastOnce())
            ->method('get')
            ->with(RestRequestValidatorConstants::THIRD_PARTY_VALIDATION_PATH_PATTERNS, [])
            ->willReturn([]);

        $validationSchemaPathPattern = $this->restRequestValidatorConfig->getValidationSchemaPathPattern();

        $this->assertCount(3, $validationSchemaPathPattern);
        $this->assertEquals($this->restRequestValidatorConfig->getCorePathPattern(), $validationSchemaPathPattern[0]);
        $this->assertEquals($this->restRequestValidatorConfig->getProjectPathPattern(), $validationSchemaPathPattern[1]);
        $this->assertEquals($this->restRequestValidatorConfig->getStorePathPattern(), $validationSchemaPathPattern[2]);
    }

    /**
     * @return void
     */
    public function testGetValidationSchemaPathPattern(): void
    {
        $this->restRequestValidatorConfig->expects($this->atLeastOnce())
            ->method('get')
            ->with(RestRequestValidatorConstants::THIRD_PARTY_VALIDATION_PATH_PATTERNS, [])
            ->willReturn([
                'fond-of-spryker/*/*/*/Glue/*/Validation',
            ]);

        $validationSchemaPathPattern = $this->restRequestValidatorConfig->getValidationSchemaPathPattern();

        $this->assertCount(4, $validationSchemaPathPattern);
        $this->assertEquals($this->restRequestValidatorConfig->getCorePathPattern(), $validationSchemaPathPattern[0]);
        $this->assertEquals($this->restRequestValidatorConfig->getThirdPartyPathPatterns()[0], $validationSchemaPathPattern[1]);
        $this->assertEquals($this->restRequestValidatorConfig->getProjectPathPattern(), $validationSchemaPathPattern[2]);
        $this->assertEquals($this->restRequestValidatorConfig->getStorePathPattern(), $validationSchemaPathPattern[3]);
    }
}
