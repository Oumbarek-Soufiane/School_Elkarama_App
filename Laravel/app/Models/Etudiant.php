<?php



namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Etudiant
 *
 * @property int $id
 * @property int $user_id
 * @property int $groupe_id
 * @property string|null $couvertureMedicale
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Groupe $groupe
 * @property User $user
 * @property Collection|Absence[] $absences
 * @property Collection|Devoir[] $devoirs
 * @property Collection|Note[] $notes
 * @property Collection|TuteurDetail[] $tuteur_details
 *
 * @package App\Models
 */
class Etudiant extends Model
{
	use HasFactory;

	protected $table = 'etudiants';

	protected $casts = [
		'user_id' => 'int',
		'groupe_id' => 'int',
		'dateNaissance' => 'date',
	];

	protected $fillable = [
		'user_id',
		'groupe_id',
		'couvertureMedicale'
	];

	public function groupe()
	{
		return $this->belongsTo(Groupe::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function absences()
	{
		return $this->hasMany(Absence::class);
	}

	public function devoirs()
	{
		return $this->hasMany(Devoir::class);
	}

	public function notes()
	{
		return $this->hasMany(Note::class);
	}

	public function tuteur_details()
	{
		return $this->hasMany(TuteurDetail::class);
	}
}
