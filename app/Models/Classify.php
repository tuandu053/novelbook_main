<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classify extends Model
{
    use HasFactory;

    protected $fillable= ['idCategories','idNovel'];
    // public $timestamps = false;
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $table = 'tblclassify';
}
