<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'balance',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getId()
    {
        return $this->attributes['id'];
    }

    public function setId($id)
    {
        $this->attributes['id'] = $id;
    }

    public function getName()
    {
        return $this->attributes['name'];
    }

    public function setName($name)
    {
        $this->attributes['name'] = $name;
    }

    public function getEmail()
    {
        return $this->attributes['email'];
    }

    public function setEmail($email)
    {
        $this->attributes['email'] = $email;
    }

    public function getRole()
    {
        return $this->attributes['role'];
    }

    public function setRole($role)
    {
        $this->attributes['role'] = $role;
    }

    public function getBalance()
    {
        return $this->attributes['balance'];
    }

    public function setBalance($balance)
    {
        $this->attributes['balance'] = $balance;
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function getOrders()
    {
        return $this->orders;
    }

    public function setOrders($orders)
    {
        $this->orders = $orders;
    }
}
