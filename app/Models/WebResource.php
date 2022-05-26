<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebResource extends Model
{
    const TERM = 'term';
    const PRIVACY = 'privacy';
    use HasFactory;
}
