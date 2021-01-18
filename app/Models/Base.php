<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;


class Base extends Model
{
    protected $perPage = 30;

    public function scopeFilter(Builder $query, Request $request, $fields)
    {
        $has_filter = (boolean)$request->input('filter', false);

        if (!$has_filter) {
            return $query;
        }

        foreach ($fields as $field => $type) {
            if ($request->filled($field)) {
                $values = $request->input($field, '');

                if ($type == 'whereIn') {
                    $query->whereIn($field, $values);
                } elseif ($type == 'whereNot') {
                    $query->where($field, '!=', $values);
                } elseif ($type == 'whereLike') {
                    $query->where($field, 'like', "%$values%");
                } else {
                    $query->where($field, $values);
                }
            }
        }

        return $query;
    }

    public static function createLog($user, $model, $content_type, $action)
    {
        $user_id = $user ? $user->id : null;

        $content = $action != 'delete' ? $model->attributes : '';

        $log = new Log();
        $log->user_id = $user_id;
        $log->content_id = $model->id;
        $log->content_type = $content_type;
        $log->action = $action;
        $log->content = json_encode($content);
        $log->created_at = Carbon::now();
        $log->save();
    }
}
