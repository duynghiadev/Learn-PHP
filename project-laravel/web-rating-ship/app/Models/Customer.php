<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    protected $table = 'customers';

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'gender',
        'status'
    ];

    const PASSWORD_DEFAULT = '123456';

    protected $appends = ['status_text','gender_text'];

    const GENDER_MALE = 1;
    const GENDER_FEMALE = 0;

    const STATUS = [
        'ACTIVE' => 1,
        'DE_ACTIVE' => 0,
    ];
    const STATUS_UNLOCKED = 1;
    const STATUS_LOCKED = 0;

    static $genderArr = [
        self::GENDER_MALE => '1',
        self::GENDER_FEMALE => '0'
    ];
    public $genderTextArr = [
        self::GENDER_MALE => 'Nam',
        self::GENDER_FEMALE => 'Nữ'
    ];
    protected $statusArr = [
        self::STATUS_UNLOCKED => 'Tài khoản đang hoạt động',
        self::STATUS_LOCKED => 'Tài khoản bị khoá',
    ];

    public function getGenderTextAttribute(){
        return $this->genderTextArr [$this->gender];
    }

    public function getStatusTextAttribute()
    {
        return $this->statusArr [$this->status];
    }
}
