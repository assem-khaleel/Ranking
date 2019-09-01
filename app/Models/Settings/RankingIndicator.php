<?php
/**
 * Created by PhpStorm.
 * User: plus
 * Date: 10/03/19
 * Time: 01:16 م
 */

namespace App\Models\Settings;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Settings\RankingIndicators
 *
 * @property int $id
 * @property int $criterion_id
 * @property string $name_en
 * @property string $name_ar
 * @property string|null $description_en
 * @property string|null $description_ar
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Settings\RankingCriteria $criteria
 * @property-read mixed $description
 * @property-read mixed $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\RankingIndicator newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\RankingIndicator newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\RankingIndicator query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\RankingIndicator whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\RankingIndicator whereCriterionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\RankingIndicator whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\RankingIndicator whereDescriptionAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\RankingIndicator whereDescriptionEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\RankingIndicator whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\RankingIndicator whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\RankingIndicator whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\RankingIndicator whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $enabled
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\RankingIndicator whereEnabled($value)
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Settings\RankingIndicator onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Settings\RankingIndicator withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Settings\RankingIndicator withoutTrashed()
 */
class RankingIndicator extends Model
{
    use SoftDeletes;

    protected $fillable = ['criterion_id','name_en','name_ar','description_en','description_ar'];

    protected $table = 'ranking_indicators';

    public function criteria()
    {
        return $this->belongsTo(RankingCriteria::class, 'criterion_id','id');
    }

    public function getNameAttribute()
    {
        return App::getLocale() == 'ar' ? $this->name_ar : $this->name_en;
    }

    public function getDescriptionAttribute()
    {
        return App::getLocale() == 'ar' ? $this->description_ar : $this->description_en;
    }

}