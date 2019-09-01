<?php

namespace App\Models\Settings;

use App\model\RankingResult;
use App\Models\Setting\Users\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * App\Models\Settings\Program
 *
 * @property int $id
 * @property string $name_ar
 * @property string $name_en
 * @property int|null $responsible_id
 * @property int $department_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Settings\SystemCategory[] $categories
 * @property-read \App\Models\Settings\Department $department
 * @property-read mixed $name
 * @property-read \App\Models\Setting\Users\User|null $users
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\Program newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\Program newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Settings\Program onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\Program query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\Program whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\Program whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\Program whereDepartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\Program whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\Program whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\Program whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\Program whereResponsibleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\Program whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Settings\Program withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Settings\Program withoutTrashed()
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Settings\RankingSystem[] $systems
 */
class Program extends Model
{
    use SoftDeletes;

    protected $fillable = array('id','name_ar','name_en','department_id','responsible_id');

    public function department()
    {
        return $this->belongsTo(Department::class,'department_id','id');
    }

    public function users()
    {
        return $this->belongsTo(User::class,'responsible_id','id');
    }

    public function categories()
    {
        return $this->belongsToMany(SystemCategory::class,'program_categories','program_id','category_id');
    }

    public function getSystemsAttribute()
    {
        return RankingSystem::join('system_categories', 'ranking_systems.id', '=', 'system_categories.system_id')
            ->join('program_categories', 'system_categories.id', '=', 'program_categories.category_id')
            ->join($this->table, 'program_categories.program_id', '=', 'programs.id')
            ->select('ranking_systems.*')
            ->where('programs.id', $this->id)->get();
    }

    public function getNameAttribute()
    {
        return \App::getLocale() == 'ar' ? $this->name_ar : $this->name_en;
    }

    public function results() {
        return $this->morphMany(RankingResult::class, 'rankable');
    }
}
