<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Traits\ImportInstanceControllerTrait;
use App\Http\Requests\Admin\Import\ImportInstancesPreviewRequest;
use App\Http\Requests\Admin\Import\ImportInstancesRequest;
use App\Http\Controllers\Controller;
use App\Shop\Products\Product;

class ImportController extends Controller
{
    use ImportInstanceControllerTrait;

    public function preview(ImportInstancesPreviewRequest $request) : array
    {
        return $this->loadInstancesImportPreview($request, Product::class);
    }

    public function import(ImportInstancesRequest $request) : void
    {
        $this->importInstances($request, Product::class);
    }
}
