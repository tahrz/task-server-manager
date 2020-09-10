<?php

namespace Tests\Unit;

use App\Model\ServerItem;
use PHPUnit\Framework\TestCase;
use App\Model\ServerItemFactory;

/**
 * Class ServerItemFactoryTest
 * @package Tests\Unit
 */
class ServerItemFactoryTest extends TestCase
{
    public function testSuccessfulReturnedInstanceOfServerItem(): void
    {
        $faked = [
            'provider' => 'foo',
            'brand_label' => 'bar',
            'location' => 'baz',
            'cpu' => 'que',
            'drive_label' => 'quue',
            'price' => 10
        ];

        $item = (new ServerItemFactory())($faked);

        $this->assertInstanceOf(ServerItem::class, $item);
    }
}
