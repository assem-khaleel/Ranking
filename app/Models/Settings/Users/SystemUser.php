<?php

namespace App\Models\Setting\Users;

use App\model\RankingResult;
use App\Models\Setting\Users\User;
use App\Models\Settings\SystemCategory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\systemUser
 *
 * @property int $id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting\Users\SystemUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting\Users\SystemUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting\Users\SystemUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting\Users\SystemUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting\Users\systemUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting\Users\systemUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting\Users\systemUser whereUserId($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Setting\Users\User  $users
 * @property-read \App\Models\Setting\Users\User $user
 * @property-read \App\Models\Settings\SystemCategory $systemCategory
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\model\RankingResult[] $results
 */
class SystemUser extends Model
{
    protected $table = 'system_users';

    protected $fillable = ['user_id'];

    public function user()
    {
       return $this->belongsTo(User::class);
    }

    public function systemCategory()
    {
        return $this->belongsTo(SystemCategory::class);
    }

    public function results()
    {
        return $this->hasMany(RankingResult::class, 'system_id','id');
    }

}
