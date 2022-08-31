<?php

namespace App\Models;

use App\Filters\WikiPagesFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Wikipage extends Model
{
    use SoftDeletes;

    use HasFactory;

    protected $table = 'wikipages';

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

    // Только родители
    public function scopeParents($query)
    {
        return $query
            ->select('p.id', 'p.title', DB::raw("count({$this->table}.id) as count"))
            ->join('wikipages as p', 'p.id', '=', "{$this->table}.parent_id")
            ->whereNull("{$this->table}.deleted_at")
            ->groupBy('p.id', 'p.title')
            ->having(DB::raw("count({$this->table}.parent_id)"), '>', 0);
    }

    public function parent()
    {
        return $this->belongsTo(Wikipage::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Wikipage::class, 'parent_id', 'id');
    }

    public function getTreeAttribute()
    {
        return ($this->prepareTree()) ? array_reverse($this->prepareTree()) : [];
    }

    public function prepareTree($tree = [])
    {
        if (!$this->parent) {
            return $tree;
        }
        if (!array_key_exists($this->id, $tree)) {
            $tree[] = $this->parent;
        }else{
            return $tree;
        }

        return $this->parent->prepareTree($tree);
    }

    public function getPageThumbAttribute()
    {
        return (!empty($this->thumb)) ? $this->thumb : config('app.noimage');
    }
}
