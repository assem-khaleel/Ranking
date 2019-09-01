<?php

namespace App\Models\Setting\Users;

use App\Models\Setting\Users\User;
use App\Models\Setting\Institution;
use App\Models\Settings\College;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Setting\Users\InstitutionUser
 *
 * @property int $id
 * @property int $user_id
 * @property int $institution_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Setting\Users\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting\Users\InstitutionUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting\Users\InstitutionUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting\Users\InstitutionUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting\Users\InstitutionUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting\Users\InstitutionUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting\Users\InstitutionUser whereInstitutionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting\Users\InstitutionUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting\Users\InstitutionUser whereUserId($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Setting\Institution $institution
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Settings\College[] $colleges
 */
class InstitutionUser extends Model
{
    protected $table = 'institution_users';

    protected $fillable = ['user_id', 'institution_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    public function colleges()
    {
        return $this->hasMany(College::class, 'institution_id', 'institution_id');
    }
}
