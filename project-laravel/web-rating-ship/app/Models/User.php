<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    protected $appends = ['status_text'];
    protected $table = 'users';
    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'phone',
        'status'
    ];
    const STATUS = [
        'ACTIVE' => 1,
        'DE_ACTIVE' => 0
    ];
    const PASSWORD_DEFAULT = '123456';

    const STATUS_UNLOCKED = 1;
    const STATUS_LOCKED = 0;

    protected $statusArr = [
        self::STATUS_UNLOCKED => 'Tài khoản đang hoạt động',
        self::STATUS_LOCKED => 'Tài khoản bị khoá',
    ];

    public function getStatusTextAttribute()
    {
        if($this->status == self::STATUS_UNLOCKED){
            $name = 'Tài khoản đang hoạt động';
        } else{
            $name = 'Tài khoản bị khoá';
        }
        return $name;
    }
    
}
