<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'address',
        'email',
        'phone',
        'web',
        'logo',
        // 'created_at',
        // 'updated_at',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        
    ];



    /**
     * The id.
     */
    protected $primaryKey = 'id';

    //👉 - https://stackoverflow.com/questions/40891205/undefined-table-7-error-relation-expenses-does-not-exist
    protected $table = 'company';
}
