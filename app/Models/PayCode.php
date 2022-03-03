<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayCode extends Model
{
    use HasFactory;

    protected $table = 'pay_codes';
    public $primaryKey = 'pc_id';
}
