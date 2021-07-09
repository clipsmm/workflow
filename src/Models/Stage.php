<?php

namespace Clipsmm\Workflow\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Stage extends Model {

    protected $table = 'm_stages';

    protected $guarded = [];

    public function workflow(): BelongsTo
    {
        return $this->belongsTo(Workflow::class, 'workflow_id');
    }

    public function actions(): HasMany
    {
        return $this->hasMany(Action::class, 'stage_id');
    }

    public function expired_stage(): BelongsTo
    {
        return $this->belongsTo(self::class, 'expired_stage_id');
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
