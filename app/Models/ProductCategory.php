<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategory extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const PRODUCT_CATEGORIES_RADIO = [
        'Perawatan Cegah Dini Covid-19' => 'Perawatan Cegah Dini Covid-19',
        'Perawatan Isoman Covid-19'     => 'Perawatan Isoman Covid-19',
        'Rawat Jalan'                   => 'Rawat Jalan'
    ];

    public $table = 'product_categories';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
