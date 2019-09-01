<?php

namespace App\Models\Setting;

use App\model\RankingResult;
use App\Models\Setting\Users\User;
use App\Models\Settings\College;
use Illuminate\Database\Eloquent\Model;
use App\Models\Setting\Users\InstitutionUser;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Setting\Institution
 *
 * @property int $id
 * @property string $name_en
 * @property string $name_ar
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting\Institution newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting\Institution newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting\Institution query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting\Institution whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting\Institution whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting\Institution whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting\Institution whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting\Institution whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting\Institution whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Setting\Users\InstitutionUser $institutionUser
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Settings\College[] $colleges
 * @property-read mixed $name
 * @property-read \App\model\RankingResult $result
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Setting\Users\User[] $users
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Setting\Institution onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Setting\Institution withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Setting\Institution withoutTrashed()
 */
class Institution extends Model
{
    use SoftDeletes;

    protected $fillable = array('name_en','name_ar');

    public function institutionUser()
    {
        return$this->hasOne(InstitutionUser::class);
    }

    public function name()
    {
        return \App::getLocale() == 'ar' ? $this->name_ar : $this->name_en;
    }

    function result()
    {
        return $this->morphMany(RankingResult::class,'rankable');

    }

    public function getNameAttribute() {
        return \App::getLocale() == 'ar' ? $this->name_ar : $this->name_en;
    }

    public function colleges()
    {
        return $this->hasMany(College::class);
    }

    public function users()
    {
        return $this->hasManyThrough(User::class, InstitutionUser::class, 'id', 'institution_id','user_id', 'id');
    }
}
