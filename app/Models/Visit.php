<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Visit extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'visit';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'id_user',
        'time_visit',
        'date_visit',
        'location',
        'image',
        'information'
    ];
    public $timestamps = false;


    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }


}
