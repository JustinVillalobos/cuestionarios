<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Pregunta
 * 
 * @property int $idPregunta
 * @property string $respuesta1
 * @property string $respuesta2
 * @property string|null $respuesta3
 * @property string|null $respuesta4
 * @property int $solucion
 * @property string $tituloDetalles
 * @property string $detalles
 * @property string|null $tituloAyuda
 * @property string|null $ayuda
 * @property int $idCuestionario
 * 
 * @property Cuestionario $cuestionario
 *
 * @package App\Models
 */
class Pregunta extends Model
{
	protected $table = 'preguntas';
	protected $primaryKey = 'idPregunta';
	public $timestamps = false;

	protected $casts = [
		'solucion' => 'int',
		'idCuestionario' => 'int'
	];

	protected $fillable = [
		'respuesta1',
		'respuesta2',
		'respuesta3',
		'respuesta4',
		'solucion',
		'tituloDetalles',
		'detalles',
		'tituloAyuda',
		'ayuda',
		'idCuestionario'
	];

	public function cuestionario()
	{
		return $this->belongsTo(Cuestionario::class, 'idCuestionario');
	}
}
