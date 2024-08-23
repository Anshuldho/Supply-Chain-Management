<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Enable timestamps
    public $timestamps = true;

    // Fillable attributes
    protected $fillable = ['name', 'location'];
}
