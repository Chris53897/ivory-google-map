<?php

declare(strict_types=1);

namespace Ivory\Tests\GoogleMap\Helper\JsonBuilder;

use Ivory\GoogleMap\Helper\JsonBuilder\JsonBuilder;
use PHPUnit\Framework\TestCase;

class JsonBuilderTest extends TestCase
{
    /**
     * @var JsonBuilder
     */
    private $jsonBuilder;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        $this->jsonBuilder = new JsonBuilder();
    }

    public function testDefaultState(): void
    {
        $this->assertDefaultState();
    }

    public function testValues(): void
    {
        $this->jsonBuilder->setValues(['foo' => 'bar']);

        $this->assertTrue($this->jsonBuilder->hasValues());
        $this->assertSame(['[foo]' => 'bar'], $this->jsonBuilder->getValues());
    }

    public function testValueWithEscape(): void
    {
        $this->jsonBuilder->setValue('[foo]', 'bar');

        $this->assertTrue($this->jsonBuilder->hasValues());
        $this->assertSame(['[foo]' => 'bar'], $this->jsonBuilder->getValues());
    }

    public function testValueWithoutEscape(): void
    {
        $this->jsonBuilder->setValue('[foo]', 'bar', false);

        $values = $this->jsonBuilder->getValues();

        $this->assertTrue($this->jsonBuilder->hasValues());
        $this->assertArrayHasKey('[foo]', $values);
        $this->assertNotSame('bar', $values['[foo]']);
    }

    public function testRemoveValue(): void
    {
        $this->jsonBuilder
            ->setValue('[foo]', 'bar')
            ->removeValue('[foo]');

        $this->assertFalse($this->jsonBuilder->hasValues());
    }

    public function testReset(): void
    {
        $this->jsonBuilder
            ->setValues(['foo' => 'bar'])
            ->reset();

        $this->assertDefaultState();
    }

    public function testBuildWithoutValues(): void
    {
        $this->assertSame('[]', $this->jsonBuilder->build());
    }

    public function testBuildWithJsonEncodeOptions(): void
    {
        $this->jsonBuilder->setJsonEncodeOptions(JSON_FORCE_OBJECT);

        $this->assertSame(JSON_FORCE_OBJECT, $this->jsonBuilder->getJsonEncodeOptions());
        $this->assertSame('{}', $this->jsonBuilder->build());
    }

    /**
     * @param string $expected
     * @param array  $values
     *
     * @dataProvider valuesProvider
     */
    public function testBuildWithValues($expected, array $values): void
    {
        $this->assertSame($expected, $this->jsonBuilder->setValues($values)->build());
    }

    /**
     * @param string $expected
     * @param array  $values
     *
     * @dataProvider valueProvider
     */
    public function testBuildWithValue($expected, array $values): void
    {
        foreach ($values as $path => $value) {
            $this->jsonBuilder->setValue($path, $value['value'], $value['escape']);
        }

        $this->assertSame($expected, $this->jsonBuilder->build());
    }

    public function valuesProvider(): array
    {
        return [
            // Arrays
            ['["foo"]', ['foo']],
            ['["foo","bar","baz"]', ['foo', 'bar', 'baz']],
            ['[["foo","bar"],[["baz"]],"bat"]', [['foo', 'bar'], [['baz']], 'bat']],

            // Objects
            ['{"foo":"bar"}', ['foo' => 'bar']],
            ['{"foo":"bar","baz":"bat","ban":"boo"}', ['foo' => 'bar', 'baz' => 'bat', 'ban' => 'boo']],
            ['{"foo":"bar","baz":{"bat":"ban"}}', ['foo' => 'bar', 'baz' => ['bat' => 'ban']]],

            // Mixed
            ['["foo",{"bar":"baz"},"bat","ban"]', ['foo', ['bar' => 'baz'], 'bat', 'ban']],
            ['{"foo":"bar","baz":["bat","ban"]}', ['foo' => 'bar', 'baz' => ['bat', 'ban']]],
        ];
    }

    public function valueProvider(): array
    {
        return [
            // Arrays
            ['[foo]', ['[0]' => ['value' => 'foo', 'escape' => false]]],
            ['[foo,"bar",baz]', [
                '[0]' => ['value' => 'foo', 'escape' => false],
                '[1]' => ['value' => 'bar', 'escape' => true],
                '[2]' => ['value' => 'baz', 'escape' => false],
            ]],
            ['[[foo,"bar"],[baz],bat]', [
                '[0][0]' => ['value' => 'foo', 'escape' => false],
                '[0][1]' => ['value' => 'bar', 'escape' => true],
                '[1][0]' => ['value' => 'baz', 'escape' => false],
                '[2]'    => ['value' => 'bat', 'escape' => false],
            ]],

            // Objects
            ['{"foo":bar}', ['[foo]' => ['value' => 'bar', 'escape' => false]]],
            ['{"foo":bar,"baz":"bat","ban":boo}', [
                '[foo]' => ['value' => 'bar', 'escape' => false],
                '[baz]' => ['value' => 'bat', 'escape' => true],
                '[ban]' => ['value' => 'boo', 'escape' => false],
            ]],
            ['{"foo":"bar","baz":{"bat":ban}}', [
                '[foo]'      => ['value' => 'bar', 'escape' => true],
                '[baz][bat]' => ['value' => 'ban', 'escape' => false],
            ]],

            // Mixed
            ['["foo",{"bar":baz},bat,"ban"]', [
                '[0]'      => ['value' => 'foo', 'escape' => true],
                '[1][bar]' => ['value' => 'baz', 'escape' => false],
                '[2]'      => ['value' => 'bat', 'escape' => false],
                '[3]'      => ['value' => 'ban', 'escape' => true],
            ]],
            ['{"foo":bar,"baz":[bat,"ban"]}', [
                '[foo]'    => ['value' => 'bar', 'escape' => false],
                '[baz][0]' => ['value' => 'bat', 'escape' => false],
                '[baz][1]' => ['value' => 'ban', 'escape' => true],
            ]],
        ];
    }

    private function assertDefaultState(): void
    {
        $this->assertSame(0, $this->jsonBuilder->getJsonEncodeOptions());
        $this->assertFalse($this->jsonBuilder->hasValues());
        $this->assertEmpty($this->jsonBuilder->getValues());
    }
}
