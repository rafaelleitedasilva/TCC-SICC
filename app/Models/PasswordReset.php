<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $primaryKey = 'ID';
    protected $table = 'password_resets';
}
