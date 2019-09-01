<?php

namespace App\Models\Settings;

use App\Models\Setting\Users\SystemUser;
use App\Models\Setting\Users\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;
use App\Models\Settings\Program;


/**
 * App\Models\Settings\SystemCategory
 *
 * @property int $id
 * @property int $system_id
 * @property string $name_en
 * @property string $name_ar
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Settings\Program[] $programs
 * @property-read \App\Models\Settings\RankingSystem $system
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\SystemCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\SystemCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\SystemCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\SystemCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\SystemCategory whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\SystemCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\SystemCategory whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\SystemCategory whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\SystemCategory whereSystemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\SystemCategory whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Settings\SystemCategory onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Settings\SystemCategory withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Settings\SystemCategory withoutTrashed()
 */
class SystemCategory extends Model
{
    use SoftDeletes;

    protected $fillable = ['system_id','name_en', 'name_ar'];

    protected $table = 'system_categories';

    public function system(){
        return $this->belongsTo(RankingSystem::class, 'system_id', 'id');
    }

    public function programs()
    {
        return $this->belongsToMany(Program::class,'program_categories','category_id','program_id');
    }

    public function getNameAttribute()
    {
        return App::getLocale() == 'ar' ? $this->name_ar : $this->name_en;
    }
}
