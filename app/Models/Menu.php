<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Restaurant;
use App\Models\User;

class Menu extends Model
{
    use HasFactory;
    protected $fillable = ['weekday', 'foodtitle', 'fooddesc', 'foodadditives', 'allergens', 'price'];

    protected $casts = [
        'foodadditives' => 'array',
        'allergens' => 'array',
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
