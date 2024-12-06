<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;
    protected $fillable= ['sChapter','iChapterNumber','sContent','iPublishingStatus','iStatus','idNovel','icharges'];
    // public $timestamps = false;
    const CREATED_AT = 'dCreateDay';
    const UPDATED_AT = 'dUpdateDay';
    protected $primaryKey = 'id';
    protected $table = 'tblchapter';
}
