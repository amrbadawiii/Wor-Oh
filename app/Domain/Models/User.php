<?php

namespace App\Domain\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected static function newFactory()
    {
        return UserFactory::new();
    }
    protected $fillable = [
        'name',
        'email',
        'warehouse_id',
        'user_type',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
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
            'password' => 'hashed',
        ];
    }
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
    public function quotations()
    {
        return $this->hasMany(Quotation::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function inbounds()
    {
        return $this->hasMany(Inbound::class);
    }
}
