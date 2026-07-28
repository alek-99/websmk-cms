<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    protected $table = 'messages';

    protected $fillable = [
        'nama',
        'email',
        'no_wa',
        'pesan',

       
    ];
}
