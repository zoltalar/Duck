<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'address',
        'address_2',
        'city',
        'state_id',
        'postal_code',
        'latitude',
        'longitude',
        'photo',
        'active',
        'user_id'
    ];

    /**
     * Handle 'photo' attribute.
     *
     * @param   string $value
     * @return  void
     */
    public function setPhotoAttribute($value)
    {
        $attribute = 'photo';

        // If a base64 was sent, store it in the db
        if (starts_with($value, 'data:image')) {
            // 0. Make the image
            $image = \Image::make($value);

            // 1. Generate a filename.
            $file = md5($value . time()) . '.jpg';

            // 2. Store the image on disk.
            \Storage::disk('public')->put($file, $image->stream());

            // 3. Save the path to the database
            $this->attributes[$attribute] = $file;
        }
    }
}
