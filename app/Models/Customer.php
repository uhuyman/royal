<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'customer';
    protected $fillable = [
        'id',
        'id_user',
        'cust_name',
        'cust_hp',
        'species',
        'ras',
        'age',
        'lifestyle',
        'special_need',
        'brand_before',
        'know_brand_rc',
        'before_buy',
        'information',
        'buy',
        'product_buy',
        'qty_recomend',
        'quantity'
    ];

    protected $primaryKey = 'id';

    public $timestamps = false;


    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
