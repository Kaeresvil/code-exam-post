<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Post extends Model
{
   use SoftDeletes;
    protected $table = 'posts';

    protected $fillable  = [
        'title',
        'body',
        'user_id'
    ];

       public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeFilter($query, $filters)
    {
        $search = request('search') ?? false;
        $query->when(
            request('search')  ?? false,
            function ($query) use ($search) {
                $search = '%' . $search . '%';
                $query->when($search, function ($query) use ($search) {
                    $search = '%' . $search . '%';
                    $fillableFields = $this->fillable;
                    $query->where(function ($query) use ($fillableFields, $search) {
                        foreach ($fillableFields as $field) {
                            $query->orWhere($field, 'like', $search);
                        }
                    });
                });
            }
        );
     
    }
}
