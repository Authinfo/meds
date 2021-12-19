<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const STATUS_BOOKING_RADIO = [
        '0' => 'Belum Terbayar',
        '1' => 'Sudah Terbayar',
    ];

    public const JENIS_BOOKING_RADIO = [
        'Saya Sendiri' => 'Saya Sendiri',
        'Orang Lain' => 'Orang Lain'
    ];
    public $table = 'bookings';

    protected $dates = [
        'tanggal_permintaan',
        'dob_orang_lain',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'nomor_order',
        'tanggal_permintaan',
        'status_booking',
        'jenis_booking',
        'nama_orang_lain',
        'email_orang_lain',
        'nomor_identitas_orang_lain',
        'dob_orang_lain',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getTanggalPermintaanAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setTanggalPermintaanAttribute($value)
    {
        $this->attributes['tanggal_permintaan'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function user_names()
    {
        return $this->belongsToMany(User::class);
    }

    public function incomes()
    {
        return $this->hasOne(\App\Models\Income::class);
    }

    public function categories()
    {
        return $this->belongsToMany(ProductCategory::class);
    }

    public function product_names()
    {
        return $this->belongsToMany(Product::class);
    }

    public function getDobOrangLainAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDobOrangLainAttribute($value)
    {
        $this->attributes['dob_orang_lain'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
