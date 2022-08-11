<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Cuestionario
 * 
 * @property int $idCuestionario
 * @property string $codigo
 * @property string $titulo
 * @property string $descripcion
 * @property Carbon $fechaCreacion
 * @property int $disponible
 * @property int $autor
 * @property string|null $antecedentesPersonales
 * @property string|null $antecedentesFamiliares
 * @property string|null $motivoConsulta
 * @property string|null $revision
 * @property int $edad
 * @property string $imagen
 * @property int|null $genero
 * @property string|null $trabajo
 * @property int|null $hijos
 * @property string|null $imagenSeccion
 * @property int|null $seccion
 * 
 * @property Usuario $usuario
 * @property Collection|Pregunta[] $preguntas
 * @property Collection|Puntaje[] $puntajes
 *
 * @package App\Models
 */
class Cuestionario extends Model
{
	protected $table = 'cuestionarios';
	protected $primaryKey = 'idCuestionario';
	public $timestamps = false;

	protected $casts = [
		'disponible' => 'int',
		'autor' => 'int',
		'edad' => 'int',
		'genero' => 'int',
		'hijos' => 'int',
		'seccion' => 'int'
	];

	protected $dates = [
		'fechaCreacion'
	];

	protected $fillable = [
		'codigo',
		'titulo',
		'descripcion',
		'fechaCreacion',
		'disponible',
		'autor',
		'antecedentesPersonales',
		'antecedentesFamiliares',
		'motivoConsulta',
		'revision',
		'edad',
		'imagen',
		'genero',
		'trabajo',
		'hijos',
		'imagenSeccion',
		'seccion'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'autor');
	}

	public function preguntas()
	{
		return $this->hasMany(Pregunta::class, 'idCuestionario');
	}

	public function puntajes()
	{
		return $this->hasMany(Puntaje::class, 'idCuestionario');
	}
}
