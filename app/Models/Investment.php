<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'amount',
        'date',
        'user_id',
        'file_path'
    ];

    public function user()
    {
       return $this->belongsTo(User::class);
    }

}
