<?php

namespace App\Models;

class Log extends Base
{
    const ContentType_User = 1;
    const ContentType_Category = 2;
    const ContentType_Post = 3;

    const Action_Create = 'create';
    const Action_Update = 'edit';
    const Action_Delete = 'delete';
    const Action_Login = 'login';
    const Action_Logout = 'logout';
    const Action_InvalidLogin = 'invalid_login';
    const Action_Approve = 'approve';

    protected $table = 'logs';

    protected $fillable = ['user_id', 'content_id', 'content_type', 'action', 'content'];

    protected $dates = ['created_at'];

    public static $content_types = [
        1 => 'Kullanıcı',
        2 => 'Kategori',
        3 => 'Post',
    ];

    public static $actions = [
        'create' => 'Oluşturma',
        'edit' => 'Güncelleme',
        'delete' => 'Silme',
        'login' => 'Oturum Açma',
        'logout' => 'Oturum Kapatma',
        'invalid_login' => 'Hatalı Giriş'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function insert(
        $user_id = null,
        $content_id = 0,
        $content_type = 0,
        $action = 0,
        $content = ''
    )
    {
        $log = new Log();
        $log->user_id = $user_id;
        $log->content_id = $content_id;
        $log->content_type = $content_type;
        $log->action = $action;
        $log->content = json_encode($content);
        $log->save();
    }
}
