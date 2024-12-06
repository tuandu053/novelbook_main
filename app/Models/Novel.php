<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Novel extends Model
{
    use HasFactory;
    protected $fillable= ['sCover','sNovel','sDes','sProgress','iStatus','idUser','iLicense_Status','sLicense'];
    // public $timestamps = false;
    const CREATED_AT = 'dCreateDay';
    const UPDATED_AT = 'dUpdateDay';
    protected $primaryKey = 'id';
    protected $table = 'tblnovel';

    public function readingHistories()
    {
        return $this->hasManyThrough(Reading_history::class, Chapter::class, 'idNovel', 'idChapter', 'id', 'id');
    }
}
