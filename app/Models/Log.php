<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public const SOURCE_API = 'api';
    public const SOURCE_REDIS = 'redis';

    public static function getDataByIds(array $ids): Collection
    {
        return Log
            ::whereNotNull('data')
            ->whereIn('id', $ids)
            ->orderBy('data->name')
            ->get('data');
    }
}
