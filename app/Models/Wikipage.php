<?php

namespace App\Models;

use App\Filters\WikiPagesFilter;
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
        return $this->belongsTo(Wikipage::class, 'parent_id');
    }

    public function getParentList(){
        $sql = "SELECT t.parent_id, p.title  FROM `wikipages` as t
join wikipages as p on p.id = t.parent_id
WHERE 1 group by t.parent_id having count(t.parent_id) > 0;";
    }
}
