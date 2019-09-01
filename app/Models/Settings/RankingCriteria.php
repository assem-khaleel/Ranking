<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;

/**
 * App\Models\Settings\RankingCriteria
 *
 * @property $name
 * @property int $id
 * @property int $system_id
 * @property string $name_en
 * @property string $name_ar
 * @property float $percentage
 * @property string|null $description_en
 * @property string|null $description_ar
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $description
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Settings\RankingIndicator[] $indicator
 * @property-read \App\Models\Settings\RankingSystem $system
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\RankingCriteria newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\RankingCriteria newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\RankingCriteria query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\RankingCriteria whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\RankingCriteria whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\RankingCriteria whereDescriptionAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\RankingCriteria whereDescriptionEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\RankingCriteria whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\RankingCriteria whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\RankingCriteria whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\RankingCriteria wherePercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\RankingCriteria whereSystemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\RankingCriteria whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $enabled
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\RankingCriteria whereEnabled($value)
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Settings\RankingCriteria onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Settings\RankingCriteria withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Settings\RankingCriteria withoutTrashed()
 */
class RankingCriteria extends Model
{
    use SoftDeletes;

    protected $fillable = ['system_id','name_en','name_ar','percentage','description_en','description_ar'];

    protected $table = 'ranking_criteria';

    public function system(){
        return $this->belongsTo(RankingSystem::class, 'system_id', 'id');
    }

    public function getNameAttribute() {
        return App::getLocale() == 'ar' ? $this->name_ar : $this->name_en;
    }

    public function getDescriptionAttribute() {
        return App::getLocale() == 'ar' ? $this->description_ar : $this->description_en;
    }

    public function indicator()
    {
        return $this->hasMany(RankingIndicator::class,'criterion_id','id');
    }
}
