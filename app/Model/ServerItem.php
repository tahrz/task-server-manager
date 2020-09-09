<?php

declare(strict_types=1);

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ServerItem
 * @package App\Model
 */
class ServerItem extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'provider',
        'brand',
        'location',
        'cpu',
        'drive',
        'price'
    ];

    /**
     * @param ServerItem $importItem
     * @return $this
     */
    public function updateAttributes(self $importItem): self
    {
        $this->provider = $importItem->provider;
        $this->brand = $importItem->brand;
        $this->location = $importItem->location;
        $this->cpu = $importItem->cpu;
        $this->drive = $importItem->drive;
        $this->price = $importItem->price;

        return $this;
    }
}
