<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Project extends Model
{

    use HasFactory, Filterable;
    protected $fillable = [
        'name',
        'description',
        'status',
        'qr_code',
        'user_id',
    ];

    /**
     * Get filterable attributes for this model
     */
    public function getFilterableAttributes(): array
    {
        return [
            'name' => [
                'type' => 'text',
                'label' => __('projects.name'),
                'placeholder' => __('app.filters.filter_by', ['field' => __('projects.name')]),
            ],
            'status' => [
                'type' => 'select',
                'label' => __('projects.status'),
                'placeholder' => __('app.filters.select_option'),
                'options' => [
                    'active' => __('app.active'),
                    'inactive' => __('app.inactive'),
                    'completed' => __('projects.completed'),
                    'on_hold' => __('projects.on_hold')
                ]
            ],
            'user_id' => [
                'type' => 'select',
                'label' => __('projects.user'),
                'placeholder' => __('app.filters.select_option'),
                'relationship' => 'user',
                'display_field' => 'name',
                'value_field' => 'id'
            ],
            'created_at' => [
                'type' => 'date',
                'label' => __('app.created_at'),
                'placeholder' => __('app.filters.filter_by', ['field' => __('app.created_at')]),
            ]
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
