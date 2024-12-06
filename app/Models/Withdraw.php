<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    use HasFactory;
    protected $fillable= ['iCoint','idUser','sBank','sBankAccountNumber'];
    // public $timestamps = false;
    const CREATED_AT = 'dCreateDay';
    const UPDATED_AT = 'dUpdateDay';
    protected $primaryKey = 'id';
    protected $table = 'tblwithdraw';
}
