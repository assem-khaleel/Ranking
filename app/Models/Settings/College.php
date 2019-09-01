<?php

namespace App\Models\Settings;

use App\Models\Setting\Institution;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Settings\College
 *
 * @property int $id
 * @property string $name_ar
 * @property string $name_en
 * @property int $institution_id
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Settings\Department[] $departments
 * @property-read mixed $name
 * @property-read \App\Models\Setting\Institution $institutionCollege
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\College newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\College newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\College query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\College whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\College whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\College whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\College whereInstitutionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\College whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\College whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\College whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Setting\Institution $institution
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Settings\College onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Settings\College withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Settings\College withoutTrashed()
 */
class College extends Model
{

    use SoftDeletes;
    protected $fillable = array('id','name_ar','name_en','institution_id');

    public function departments ()
    {
        return $this->hasMany(Department::class);
    }

    public function getNameAttribute() {
        return \App::getLocale() == 'ar' ? $this->name_ar : $this->name_en;
    }

    public function institution()
    {
        return $this->belongsTo(Institution::class, 'institution_id', 'institution_id');
    }
}
