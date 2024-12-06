<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase_history extends Model
{
    use HasFactory;
    protected $fillable= ['idUser','idChapter','iprice'];
    // public $timestamps = false;
    const CREATED_AT = 'dCreateDay';
    const UPDATED_AT = 'dUpdateDay';
    protected $primaryKey = 'id';
    protected $table = 'tblpurchase_history';
}
