<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessSetting extends Model
{
    protected $fillable = [
        'business_name',
        'address', 
        'city',
        'phone',
        'logo_path',
        'footer_message'
    ];

    public static function getSettings()
    {
        return self::first() ?? self::create([
            'business_name' => 'Pojok Berlian Cafetaria',
            'address' => 'Jl. Berlian 14 No. 13',
            'city' => 'Bekasi, Jawa Barat',
            'phone' => '(+62) 851 5642 8744',
            'logo_path' => 'favicon.svg',
            'footer_message' => "Thank you for your purchase!\nPlease come again!"
        ]);
    }
}
