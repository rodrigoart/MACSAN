<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insumo extends Model
{
    use HasFactory;

    protected $fillable = [
        'hoja_monitoreo_id',
        'nombre',
        'user_id',
        'in_stock',
        'saldo_kardex',
        'entrada',
        'fecha_vencimiento',
        'lote',
        'med',
        'activo',
        'no_kardex',
        'DR',
        'existencia_real',
        'observaciones',
    ];

    public function updatedAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => date("h:ia d/m/Y", strtotime($value)),
        );
    }


    //relations
    public function HojaMonitoreo(){
        return $this->belongsTo(HojaMonitoreo::class);
    }

    public function User(){
        return $this->belongsTo(User::class);
    }
}

            // $table->unsignedBigInteger('hoja_monitoreo_id');
            // $table->string('nombre');
            // $table->string('in_stock');
            // $table->unsignedInteger('saldo_kardex');
            // $table->string('entrada');
            // $table->string('fecha_vencimiento');
            // $table->unsignedInteger('lote');
            // $table->string('med')->nullable();
            // $table->unsignedBigInteger('no_kardex');
            // $table->string('DR')->nullable();
            // $table->unsignedBigInteger('existencia_real')->nullable();
            // $table->text('observaciones')->nullable();
