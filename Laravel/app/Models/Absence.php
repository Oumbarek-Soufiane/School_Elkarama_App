<?php



namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Absence
 *
 * @property int $id
 * @property int $etudiant_id
 * @property int $module_id
 * @property boolean $seance1
 * @property boolean $seance2
 * @property boolean $seance3
 * @property boolean $seance4
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Etudiant $etudiant
 * @property Module $module
 *
 * @package App\Models
 */
class Absence extends Model
{
    use HasFactory;

	protected $table = 'absences';

	protected $casts = [
		'etudiant_id' => 'int',
		'module_id' => 'int',
		'seance1' => 'boolean',
		'seance2' => 'boolean',
		'seance3' => 'boolean',
		'seance4' => 'boolean',
		'created_at' => 'datetime',
		'updated_at' => 'datetime',
	];

	protected $fillable = [
		'etudiant_id',
		'module_id',
		'seance1',
		'seance2',
		'seance3',
		'seance4',
		'created_at',
		'updated_at'
	];
	public function etudiant()
	{
		return $this->belongsTo(Etudiant::class);
	}

	public function module()
	{
		return $this->belongsTo(Module::class);
	}
}
