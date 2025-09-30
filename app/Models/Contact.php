<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use CrudTrait;

    protected $fillable = [
        'name',
        'email',
        'image',
    ];


      public function setImageAttribute($value)
    {
        if ($value) {
            $this->attributes['image'] = $value->store('contacts', 'public');
        }
    }


    public function getImageAttribute($value)
    {
        return $value ? asset('storage/' . $value) : null;
    }
}
