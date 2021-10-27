<?php

declare(strict_types=1);

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Builder;

use Ivory\GoogleMap\Helper\Builder\AbstractJavascriptHelperBuilder;
use Ivory\GoogleMap\Helper\Builder\PlaceAutocompleteHelperBuilder;
use Ivory\GoogleMap\Helper\PlaceAutocompleteHelper;
use PHPUnit\Framework\TestCase;

class PlaceAutocompleteHelperBuilderTest extends TestCase
{
    /** @var PlaceAutocompleteHelperBuilder */
    private $placeAutocompleteHelperBuilder;

    /** {@inheritdoc} */
    protected function setUp(): void
    {
        $this->placeAutocompleteHelperBuilder = PlaceAutocompleteHelperBuilder::create($_SERVER['API_KEY'] ?? null);
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractJavascriptHelperBuilder::class, $this->placeAutocompleteHelperBuilder);
    }

    public function testBuild()
    {
        $this->assertInstanceOf(PlaceAutocompleteHelper::class, $this->placeAutocompleteHelperBuilder->build());
    }
}
