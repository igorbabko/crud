<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $guarded = [];

    protected $with = ['users'];

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function syncUsers($userIds = [])
    {
        $this->users()->sync($userIds);

        return $this;
    }
}
