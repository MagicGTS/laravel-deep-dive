<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsExternal extends Model
{
    protected $fillable = ['title','description','link','category','guid','pubDate'];
    use HasFactory;
    public function topic()
    {
        return $this->belongsTo(NewsTopicExternal::class,'news_topic_external_id');
    }
}
