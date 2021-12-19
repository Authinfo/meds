<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const PRODUCTS_NAME_RADIO = [
        'Tes Rapid Antigen'         => 'Tes Rapid Antigen',
        'Tes RT-PCR'                => 'Tes RT-PCR',
        'Imune Booster'             => 'Imune Booster',
        'Vaksin'                    => 'Vaksin',
        'Lab Darah'                 => 'Lab Darah',
        'Gold'                      => 'Gold',
        'Basic'                     => 'Basic',
        'Tindakan Medis Minor'      => 'Tindakan Medis Minor',
        'Perawatan Pasien Diabetes' => 'Perawatan Pasien Diabetes',
        'Fisioterapi'               => 'Fisioterapi',
    ];

    public $table = 'products';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'price',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function categories()
    {
        return $this->belongsToMany(ProductCategory::class);
    }

    public function tags()
    {
        return $this->belongsToMany(ProductTag::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
