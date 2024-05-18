<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Eventos extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title', 'content', 'color', 'start', 'end', 'url'
    ];

    /**
     * Retorna a data  formatada.
     *
     * @param  string  $value
     * @return string
     */
    // Defina os accessors para os campos start e end
    public function getStartAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y H:i');
    }

    public function getEndAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y H:i');
    }


}
