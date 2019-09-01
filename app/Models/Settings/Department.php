<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



/**
 * App\Models\Settings\Department
 *
 * @property int $id
 * @property string $name_ar
 * @property string $name_en
 * @property int $college_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Settings\College $college
 * @property-read mixed $name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Settings\Program[] $programs
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\Department newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\Department newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Settings\Department onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\Department query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\Department whereCollegeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\Department whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\Department whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\Department whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\Department whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\Department whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\Department whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Settings\Department withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Settings\Department withoutTrashed()
 * @mixin \Eloquent
 */
class Department extends Model
{
    use SoftDeletes;

    protected $fillable = array('id','name_ar','name_en','college_id');

    public function college()
    {
        return $this->belongsTo(College::class,'college_id','id');
    }

    public function programs()
    {
        return $this->hasMany(Program::class);
    }

    public function getNameAttribute() {
        return \App::getLocale() == 'ar' ? $this->name_ar : $this->name_en;
    }
}
