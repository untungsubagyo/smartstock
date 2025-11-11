<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchDetail extends Model
{
    use HasFactory;

    protected $table = 'update_branchess';

    protected $fillable = [
        'code', 'name', 'address', 'city', 'province',
        'phone', 'email', 'logo_path', 'is_main', 'is_active',
    ];
}
