<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Puntaje
 * 
 * @property int $idPuntaje
 * @property Carbon $fechaCreacion
 * @property int $puntajeCorrecto
 * @property int $puntajeIncorrecto
 * @property int $idCuestionario
 * 
 * @property Cuestionario $cuestionario
 *
 * @package App\Models
 */
class Puntaje extends Model
{
	protected $table = 'puntajes';
	protected $primaryKey = 'idPuntaje';
	public $timestamps = false;

	protected $casts = [
		'puntajeCorrecto' => 'int',
		'puntajeIncorrecto' => 'int',
		'idCuestionario' => 'int'
	];

	protected $dates = [
		'fechaCreacion'
	];

	protected $fillable = [
		'fechaCreacion',
		'puntajeCorrecto',
		'puntajeIncorrecto',
		'idCuestionario'
	];

	public function cuestionario()
	{
		return $this->belongsTo(Cuestionario::class, 'idCuestionario');
	}
}
