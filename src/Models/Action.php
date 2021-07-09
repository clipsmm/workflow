<?php

namespace Clipsmm\Workflow\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Action extends Model {

    protected $table = 'm_actions';

    protected $guarded = [];

    public function stage(): BelongsTo
    {
        return $this->belongsTo(Stage::class);
    }

    public function next_stage(): BelongsTo
    {
        return $this->belongsTo(Stage::class, 'next_stage_id');
    }
}
