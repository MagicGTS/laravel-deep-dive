<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsSubscription extends Model
{
    use HasFactory;
    protected $fillable = ['email','last_verify_request_at','token'];
}
