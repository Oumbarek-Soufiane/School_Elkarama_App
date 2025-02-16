<?php



namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Module
 *
 * @property int $id
 * @property string $designation
 * @property int $nombreHeure
 * @property int $filiere_id
 * @property int $professeur_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Filiere $filiere
 * @property Professeur $professeur
 * @property Collection|Absence[] $absences
 * @property Collection|Tp[] $tps
 *
 * @package App\Models
 */
class Module extends Model
{
    use HasFactory;

	protected $table = 'modules';

	protected $casts = [
		'nombreHeure' => 'int',
		'filiere_id' => 'int',
		'professeur_id' => 'int'
	];

	protected $fillable = [
		'designation',
		'nombreHeure',
		'filiere_id',
		'professeur_id'
	];

	public function filiere()
	{
		return $this->belongsTo(Filiere::class);
	}

	public function professeur()
	{
		return $this->belongsTo(Professeur::class);
	}

	public function absences()
	{
		return $this->hasMany(Absence::class);
	}

	public function tps()
	{
		return $this->hasMany(Tp::class);
	}
}
