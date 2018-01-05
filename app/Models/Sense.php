<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sense extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'senses';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['entry_id', 'name'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Relationship: one Sense belong to Entry
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function entry()
    {
        return $this->belongsTo(Entry::class, 'entry_id');
    }

    /**
     * Relationship: one Sense has many Definition
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function definitions()
    {
        return $this->hasMany(Definition::class, 'sense_id');
    }

    /**
     * Relationship: one Sense has many Example
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function examples()
    {
        return $this->hasMany(Example::class, 'sense_id');
    }
}
