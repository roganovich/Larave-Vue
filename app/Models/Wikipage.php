<?php

namespace App\Models;

use App\Filters\wikipages\WikiPagesFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wikipage extends Model
{
    use SoftDeletes;

    use HasFactory;

    protected $fillable = ['title', 'description', 'parent_id', 'updated_at'];

    // Поиск по полям
    public function scopeFilter(Builder $builder, $request)
    {
        return (new WikiPagesFilter($request))->filter($builder);
    }
    // Сортировка по полям
    public function scopeSort(Builder $builder, $request)
    {
        return (new WikiPagesFilter($request))->sortable($builder);
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\Wikipage', 'parent_id');
    }
}
