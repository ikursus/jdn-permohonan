<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Helpdesk extends Model
{
    // Daftarkan maklumat nama table yang model ini perlu berhubung
    protected $table = 'helpdesks';

    // Daftarkan maklumat nama field yang boleh diisi
    protected $fillable = [
        'user_id',
        'ticket_id',
        'subject',
        'category',
        'description',
        'status',
        'priority'
    ];

    // protected $guarded = [
    //     'id'
    // ];

    protected $attributes = [
        'category' => 'General',
        'status' => 'Open',
        'priority' => 'Low'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    const STATUS_TYPES = [
        'Open',
        'In Progress', 
        'Closed',
        'On Hold'
    ];

    const PRIORITY_LEVELS = [
        'Low',
        'Medium',
        'High',
        'Urgent'
    ];
}
