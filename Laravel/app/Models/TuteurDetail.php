<?php



namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TuteurDetail
 *
 * @property int $id
 * @property int $etudiant_id
 * @property int $tuteur_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Etudiant $etudiant
 * @property Tuteur $tuteur
 *
 * @package App\Models
 */
class TuteurDetail extends Model
{
    use HasFactory;

    protected $table = 'tuteur_details';

    protected $casts = [
        'etudiant_id' => 'int',
        'tuteur_id' => 'int'
    ];

    protected $fillable = [
        'etudiant_id',
        'tuteur_id'
    ];

    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class);
    }

    public function tuteur()
    {
        return $this->belongsTo(Tuteur::class);
    }
}
