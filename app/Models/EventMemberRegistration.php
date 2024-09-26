<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventMemberRegistration extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class,'member_category_id');
    }
    public function organizer()
    {
        return $this->belongsTo(Organization::class,'organizer_id');
    }
}
