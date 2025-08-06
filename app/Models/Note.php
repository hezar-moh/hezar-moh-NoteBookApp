<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    // protected $fillable=['title', 'content']; //for to enable mass asssigning of values
    protected $guarded = []; 

//  protected $guarded = [];// This means no attributes are guarded, so all attributes can be mass assigned. It’s like saying “I trust all fields.”

// protected $fillable = ['title', 'content'];
// This means only the attributes title and content are mass assignable. All others are protected.


}
