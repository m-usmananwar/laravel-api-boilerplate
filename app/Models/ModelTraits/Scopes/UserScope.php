<?php

namespace App\Models\ModelTraits\Scopes;

trait UserScope
{
    public function scopeFilters($query, $data = [])
    {
        return $query;
    }
}
