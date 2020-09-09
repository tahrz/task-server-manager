<?php

declare(strict_types=1);

namespace App\Model;

/**
 * Class ServerItemFactory
 * @package App\Model
 */
class ServerItemFactory
{
    /**
     * @param array $data
     * @return ServerItem
     */
    public function __invoke(array $data): ServerItem
    {
        return new ServerItem([
            'provider' => $data['provider'],
            'brand' => $data['brand_label'],
            'location' => $data['location'],
            'cpu' => $data['cpu'],
            'drive' => $data['drive_label'],
            'price' => $data['price']
        ]);
    }
}
