<?php

namespace App\Models\Traits;

trait Importable
{
    public function getImportableWithOptions($key = null)
    {
        if (is_null($key)) {
            return $this->importable;
        } else {
            return isset($this->importable[$key]) ? $this->importable[$key] : null;
        }
    }

    public function getImportable()
    {
        return collect($this->importable)->map(function ($item, $key) {
            return is_array($item) ? $key : $item;
        })->values();
    }
}