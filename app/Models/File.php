<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

/**
 * App\model\File
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string $type
 * @property string $path
 * @property int $size
 * @property string $fileable_type
 * @property int $fileable_id
 * @property int $user_id
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $fileable
 * @method static \Illuminate\Database\Eloquent\Builder|\App\model\File newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\model\File newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\model\File query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\model\File whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\model\File whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\model\File whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\model\File whereFileableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\model\File whereFileableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\model\File whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\model\File whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\model\File wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\model\File whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\model\File whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\model\File whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\model\File whereUserId($value)
 * @mixin \Eloquent
 */
class File extends Model
{
    protected $fillable = ['name', 'description', 'type', 'path', 'size', 'fileable_id', 'fileable_type', 'user_id'];

    public function fileable()
    {
        return $this->morphTo();
    }

    /**
     * @param array $attributes
     */
    public function createFile($attributes = [])
    {
        /** @var UploadedFile $file */
        $file = $attributes['file'];
        $attributes['name'] = $file->getClientOriginalName();
        $attributes['size'] = $file->getSize();
        $attributes['type'] = $file->getClientMimeType();
        $attributes['user_id'] = \Auth::user()->id;

        $attributes['path'] = Storage::disk('public')->put($attributes['local_path'], $file);

        $this->create($attributes);
    }

    /**
     * @param array $attributes
     */
    public function updateFile($attributes = [])
    {
        /** @var UploadedFile $file */
        $file = $attributes['file'];
        $attributes['name'] = $file->getClientOriginalName();
        $attributes['size'] = $file->getSize();
        $attributes['type'] = $file->getClientMimeType();
        $attributes['user_id'] = \Auth::user()->id;

        $attributes['path'] = Storage::disk('public')->put($attributes['local_path'], $file);

        if ($attributes['old_file']) {
            Storage::disk('public')->delete($attributes['old_file']);
        }
        unset($attributes['local_path']);
        unset($attributes['file']);
        unset($attributes['old_file']);


        $this->update($attributes);
    }
}
