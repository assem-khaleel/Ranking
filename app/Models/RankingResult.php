<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * App\model\RankingResult
 *
 * @property int $id
 * @property int $rankable_id
 * @property string $rankable_type
 * @property int $system_id
 * @property int $criteria_id
 * @property int|null $indicator_id
 * @property int $month
 * @property int $year
 * @property int|null $value
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\model\RankingResult[] $rankable
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\model\RankingResult newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\model\RankingResult newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\model\RankingResult onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\model\RankingResult query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\model\RankingResult whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\model\RankingResult whereCriteriaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\model\RankingResult whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\model\RankingResult whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\model\RankingResult whereIndicatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\model\RankingResult whereMonth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\model\RankingResult whereRankableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\model\RankingResult whereRankableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\model\RankingResult whereSystemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\model\RankingResult whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\model\RankingResult whereValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\model\RankingResult whereYear($value)
 * @method static \Illuminate\Database\Query\Builder|\App\model\RankingResult withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\model\RankingResult withoutTrashed()
 * @mixin \Eloquent
 */
class RankingResult extends Model
{
    use SoftDeletes;

    protected $table = 'ranking_results';

    protected $fillable = ['rankable_id', 'rankable_type', 'system_id', 'criteria_id', 'indicator_id', 'month', 'year', 'value'];

    static $institution  = 1;
    static $program  = 2;
    /**
     * @return MorphTo
     */
    public function rankable()
    {
        return $this->morphTo();
    }

}
