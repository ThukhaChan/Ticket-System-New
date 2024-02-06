<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    public function priority()
    {
        return $this->belongsTo(Priority::class);
    }
    public function label()
    {
        return $this->belongsTo(Label::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
