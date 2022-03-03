<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayCodeEntry extends Model
{
    use HasFactory;
    protected $table = 'paycodeentry';
    public $primaryKey = 'paycode_entry_id';
}
