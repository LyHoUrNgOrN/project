<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'dateStart',
        'dateEnd',
        'country',
        'city',
        'description',
        'category_id',
        'picture',
    ];

    public function users(){
        return $this->belongsToMany(User::class,'event_joins','event_id','user_id');
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }


    public $table = "events";
}
