<?php

namespace App\Models\Setting\Users;

use App\Models\Setting\Users\InstitutionUser;
use App\Models\Setting\Users\SystemUser;
use App\Models\Settings\Program;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\model\File;


/**
 * App\Models\Setting\Users\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property int $status 1 indicate active, 0 is disabled
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\model\File $image
 * @property-read \App\Models\Setting\Users\InstitutionUser $institutionUser
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Settings\Program[] $programs
 * @property-read \App\Models\Setting\Users\SystemUser $systemUser
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting\Users\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting\Users\User newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Setting\Users\User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting\Users\User query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting\Users\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting\Users\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting\Users\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting\Users\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting\Users\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting\Users\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting\Users\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting\Users\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting\Users\User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting\Users\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Setting\Users\User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Setting\Users\User withoutTrashed()
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Notifiable , SoftDeletes;

    static $ACTIVE  = 1;
    static $INACTIVE  = 0;

    static $PROFILE_IMAGE = 'Profile Image';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function systemUser()
    {
        return $this->hasOne(SystemUser::class);
    }

    public function institutionUser()
    {
        return $this->hasOne(InstitutionUser::class);
    }

    public function programs()
    {
        return $this->hasMany(Program::class, 'responsible_id', 'id');
    }

    function image()
    {
        return $this->morphOne(File::class,'fileable')
            ->where('description','=',User::$PROFILE_IMAGE);
    }

}
