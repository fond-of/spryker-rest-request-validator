<?php

namespace FondOfSpryker\Zed\RestRequestValidator;

use Codeception\Test\Unit;
use org\bovigo\vfs\vfsStream;

class RestRequestValidatorConfigTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\RestRequestValidator\RestRequestValidatorConfig
     */
    protected $restRequestValidatorConfig;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->vfsStreamDirectory = vfsStream::setup('root', null, [
            'config' => [
                'Shared' => [
                    'stores.php' => file_get_contents(codecept_data_dir('stores.php')),
                    'config_default.php' => file_get_contents(codecept_data_dir('empty_config_default.php')),
                ],
            ],
        ]);

        $this->restRequestValidatorConfig = new RestRequestValidatorConfig();
    }

    /**
     * @return void
     */
    public function testGetValidationSchemaPathPatternWithEmptyThirdPartyPathPatterns(): void
    {
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
        $validationSchemaPathPattern = $this->restRequestValidatorConfig->getValidationSchemaPathPattern();

        $this->assertCount(4, $validationSchemaPathPattern);
        $this->assertEquals($this->restRequestValidatorConfig->getCorePathPattern(), $validationSchemaPathPattern[0]);
        $this->assertEquals($this->restRequestValidatorConfig->getThirdPartyPathPatterns()[0], $validationSchemaPathPattern[1]);
        $this->assertEquals($this->restRequestValidatorConfig->getProjectPathPattern(), $validationSchemaPathPattern[2]);
        $this->assertEquals($this->restRequestValidatorConfig->getStorePathPattern(), $validationSchemaPathPattern[3]);
    }
}
