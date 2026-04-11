<?php

namespace App\Models;

use App\Models\common\role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    protected $table = 'users';

    protected $primaryKey = 'user_id';

    protected $fillable = [
        'user_name',
        'email',
        'password',
        'role_id',
        'active_flag',
        'admin_flag',
        'owner_flag',
        'email_verified',
        'password_reset_code',
        'password_reset_expires',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified' => 'boolean',
        'active_flag' => 'boolean',
        'admin_flag' => 'boolean',
        'owner_flag' => 'boolean',
        'password_reset_expires' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(role::class, 'role_id', 'role_id');
    }
}
