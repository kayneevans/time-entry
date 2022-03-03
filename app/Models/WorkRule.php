<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkRule extends Model
{
    use HasFactory;

    protected $table = 'work_rules';
    public $primaryKey = 'wr_id';
}
