<?php

namespace App\Http\Controllers\Traits;


use App\Http\Requests\Admin\Import\ImportInstancesPreviewRequest;
use App\Http\Requests\Admin\Import\ImportInstancesRequest;
use App\Imports\ImportInstances;
use App\Services\ImportService;
use App\Shop\Products\Product;

trait ImportInstanceControllerTrait
{
    private function importInstances(ImportInstancesRequest $request, string $className) : void
    {
        $mappedHeader = $request->get('mappedHeader');

        $selected = collect(json_decode($mappedHeader))->map->selected->toArray();

        $import = app(ImportInstances::class, ['model' => $className])->appendMappedHeader($selected);

        $import->import($request->file('fileImport'));
    }

    public function loadInstancesImportPreview(ImportInstancesPreviewRequest $request, string $className) : array
    {
        return [
            'data' => app(ImportService::class)
                ->getCollectionFromImportedFile($request->file('fileImport'), $className)
                ->getPreview(),
            'importable' => app($className)->getImportable()
        ];
    }

}