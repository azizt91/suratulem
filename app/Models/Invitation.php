<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'data_mempelai' => 'array',
            'data_acara' => 'array',
            'data_galeri' => 'array',
            'data_fitur_tambahan' => 'array',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function template()
    {
        return $this->belongsTo(Template::class);
    }

    public function music()
    {
        return $this->belongsTo(Music::class);
    }

    public function guestbooks()
    {
        return $this->hasMany(Guestbook::class);
    }
}
