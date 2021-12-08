<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event_Join extends Model
{
    use HasFactory;
    protected $fillable = ["role"];
    public $table = "event__joins";
}
