<?php

namespace App\Models\Settings;

use App\model\File;
use Eloquent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;

/**
 * App\Models\Settings\RankingSystem
 *
 * @property int $id
 * @property string $name_en
 * @property string $name_ar
 * @property string $url
 * @property string|null $description_en
 * @property string|null $description_ar
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|RankingSystem[] $RankingCriteria
 * @property-read mixed $name
 * @method static \Illuminate\Database\Eloquent\Builder|RankingSystem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RankingSystem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RankingSystem query()
 * @method static \Illuminate\Database\Eloquent\Builder|RankingSystem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RankingSystem whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RankingSystem whereDescriptionAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RankingSystem whereDescriptionEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RankingSystem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RankingSystem whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RankingSystem whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RankingSystem whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RankingSystem whereUrl($value)
 * @mixin Eloquent
 * @property-read Collection|RankingCriteria[] $criteria
 * @property-read mixed $description
 * @property-read Collection|SystemCategory[] $categories
 * @method static bool|null forceDelete()
 * @method static Builder|RankingSystem onlyTrashed()
 * @method static bool|null restore()
 * @method static Builder|RankingSystem withTrashed()
 * @method static Builder|RankingSystem withoutTrashed()
 * @property-read File $logo
 * @property-read Collection|Program[] $programs
 */
class RankingSystem extends Model
{
    use SoftDeletes;

    protected $fillable = ['name_en', 'name_ar','abbreviation', 'url', 'description_en', 'description_ar'];
    protected $table = 'ranking_systems';
    static $LOGO = 'Ranking System Logo';

    public function criteria()
    {
        return $this->hasMany(RankingCriteria::class, 'system_id', 'id');
    }

    public function categories()
    {
        return $this->hasMany(SystemCategory::class,'system_id','id');
    }

    public function programs()
    {

        return $this->hasManyThrough(Program::class, SystemCategory::class,'system_id','id');
    }

    public function getNameAttribute()
    {
        return App::getLocale() == 'ar' ? $this->name_ar : $this->name_en;
    }

    public function  getDescriptionAttribute()
    {
        return App::getLocale() == 'ar' ? $this->description_ar : $this->description_en;
    }

    function logo()
    {
        return $this->morphOne(File::class,'fileable');
    }

}
