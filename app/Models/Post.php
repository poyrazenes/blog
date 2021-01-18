<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Base
{
    use HasFactory;

    protected $fillable = ['user_id', 'category_id', 'title', 'content', 'status'];

    protected static function boot()
    {
        parent::boot();

        $user = auth()->user();
        $content_type = Log::ContentType_Post;

        static::created(function ($model) use ($user, $content_type) {
            $model->createLog($user, $model, $content_type, Log::Action_Create);
        });

        static::updated(function ($model) use ($user, $content_type) {
            $model->createLog($user, $model, $content_type, Log::Action_Update);
        });

        static::deleted(function ($model) use ($user, $content_type) {
            $model->createLog($user, $model, $content_type, Log::Action_Delete);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
