<?php



namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Note
 *
 * @property int $id
 * @property int $etudiant_id
 * @property int $module_id
 * @property string $controle_1
 * @property string $controle_2
 * @property float $exam
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Etudiant $etudiant
 *
 * @package App\Models
 */
class Note extends Model
{
    use HasFactory;

	protected $table = 'notes';

	protected $casts = [
		'etudiant_id' => 'int',
		'module_id' => 'int',
		'score' => 'float'
	];

	protected $fillable = [
		'etudiant_id',
		'module_id',
		'controle_1',
		'controle_2',
		'exam'
	];

	public function etudiant()
	{
		return $this->belongsTo(Etudiant::class);
	}
    
}
