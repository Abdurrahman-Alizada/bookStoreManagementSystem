<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    use HasFactory;

    protected $fillable = [
        'title' ,'price' , 'author' , 'ISBN' , 'category', 'tatalPages' , 'publish_date' ,'publisher_id', 
    ];

    

}
