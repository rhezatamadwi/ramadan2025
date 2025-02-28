<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    private const ROLE_ADMIN = 1;
    private const ROLE_USER = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'gender',
        'last_login_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Memeriksa apakah pengguna memiliki peran sebagai admin.
     * 
     * Metode ini memeriksa apakah ID role pengguna saat ini sama dengan konstanta ROLE_ADMIN.
     * 
     * @return bool True jika pengguna adalah admin, false jika bukan.
     */
    public function isAdmin(): bool {
        return $this->id_role === self::ROLE_ADMIN;
    }

    /**
     * Memeriksa apakah pengguna berjenis kelamin wanita.
     *
     * Fungsi ini mengecek nilai properti gender pengguna untuk menentukan
     * apakah pengguna tersebut berjenis kelamin wanita.
     *
     * @return bool Mengembalikan true jika pengguna berjenis kelamin wanita (gender='P'),
     *              false jika bukan
     */
    public function isWanita(): bool {
        return $this->gender === 'P';
    }
}
