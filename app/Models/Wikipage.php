<?php

namespace App\Models;

use App\Filters\WikiPagesFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class Wikipage extends Model
{
    use SoftDeletes;

    use HasFactory;

    protected $fillable = ['title', 'description', 'parent_id'];

    public function scopeFilter(Builder $builder, $request)
    {
        return (new WikiPagesFilter($request->search))->filter($builder);
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\Wikipage', 'parent_id');
    }
}
