<?php

namespace Tests\Unit;

use App\Parser\JsonItemParser;
use PHPUnit\Framework\TestCase;
use App\Parser\ItemParserInterface;

/**
 * Class JsonItemParserTest
 * @package Tests\Unit
 */
class JsonItemParserTest extends TestCase
{
    /**
     * @var ItemParserInterface
     */
    private ItemParserInterface $parser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->parser = new JsonItemParser();
    }

    public function testOutputCollectionCorrect(): void
    {
        $collectionParsed = $this->parser->handle(\json_encode([
            'data' => [
                [
                    'provider' => 'foo',
                    'brand_label' => 'bar',
                    'location' => 'baz',
                    'cpu' => 'que',
                    'drive_label' => 'quue',
                    'price' => 100
                ]
            ]
        ]));

        $this->assertFalse($collectionParsed->isEmpty());
    }

    public function testOutputCollectionEmpty(): void
    {
        $collectionParsed = $this->parser->handle(\json_encode([
            'data' => [
                [
                    'provider' => 'foo',
                    'location' => 'baz',
                    'cpu' => 'que',
                    'drive_label' => 'quue',
                    'price' => 100
                ]
            ]
        ]));

        $this->assertTrue($collectionParsed->isEmpty());
    }
}
