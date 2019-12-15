<?php

namespace App\Services;

use App\Imports\ImportInstances;
use Exception;
use Illuminate\Support\Collection;

class ImportService
{
    private $collectionFromImportedFile;

    public function getCollectionFromImportedFile($file, string $className) : ImportService
    {

        if (!in_array($file->getClientOriginalExtension(), ['xlsx', 'xls'])) {
            abort(409, __("Unsupported file type"));
        }

        try {
            $this->collectionFromImportedFile = app(ImportInstances::class, ['model' => $className])->toCollection($file)->first();
        } catch (Exception $e) {
            dd($e->getMessage());
            abort(409, __("Unsupported file type"));
        }

        return $this;
    }

    public function getPreview($limit = 5) : Collection
    {
        return $this->collectionFromImportedFile->take($limit);
    }
}