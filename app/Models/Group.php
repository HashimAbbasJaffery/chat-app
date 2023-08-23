<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $guarded = [ "id", "created_at", "updated_at" ];
    use HasFactory;

    public function users() {
        return $this->belongsToMany(User::class, "group_members");
    }
}
