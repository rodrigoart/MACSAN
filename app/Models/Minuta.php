<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Minuta extends Model
{
    use HasFactory;

    protected $fillable = [
        'distrito',
        'user_id',
        'actualizado_por',
        'responsable',
        'supervisor',
        'participantes',
        'fecha_analisis',
        'fecha_inicio',
        'fecha_final',
        'observaciones',
    ];

    public function updatedAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => date("h:ia d/m/Y", strtotime($value)),
        );
    }
    //relations
    public function problemas(){
        return $this->hasMany(Problema::class);
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function actualizado(){
        return $this->belongsTo(User::class, 'actualizado_por');
    }
}
