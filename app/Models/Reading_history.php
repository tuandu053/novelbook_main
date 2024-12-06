<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reading_history extends Model
{
    use HasFactory;
    protected $fillable= ['idUser','idChapter'];
    // public $timestamps = false;
    const CREATED_AT = 'dCreateDay';
    const UPDATED_AT = 'dUpdateDay';
    protected $primaryKey = 'id';
    protected $table = 'tblreading_history';
}
