<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProcurementRequest extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'requests';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'nama_barang',
        'jumlah',
        'estimasi_harga',
        'keterangan',
        'status',
    ];

    /**
     * Get the user that owns the procurement request.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
