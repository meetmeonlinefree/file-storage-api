<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientStorage extends Model
{
    use HasFactory;

    protected $table = 'client_storage';

    protected $fillable = [
        'client_code',
        'size_bytes',
    ];
}
