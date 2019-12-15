<?php

namespace App\Imports;

use App\Shop\Features\Feature;
use App\Shop\FeatureValues\FeatureValue;
use App\Shop\Products\Product;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ImportInstances implements ToCollection, ToModel, WithStartRow
{
    use Importable;

    private $model;
    private $mappedHeader;

    public function __construct(string $model)
    {
        $this->model = app($model);
    }

    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        //
    }

    public function appendMappedHeader(array $mappedHeader = []) : self
    {
        $this->mappedHeader = $mappedHeader;

        return $this;
    }

    /**
     * @param array $row
     *
     * @return Model|Model[]|null
     */
    public function model(array $row)
    {
        $rows = collect($this->mappedHeader)->mapWithKeys(function ($item, $index) use ($row) {
            if (strpos( $item, 'Feature' ) === 0){
                $item = substr($item, 9);
            }
            return $item ? [$item => $row[$index]] : [$item => null];
        });

        try {
            DB::transaction(function () use (&$model, $rows, $row) {
                $model = $this->model->create($rows->toArray());

                $rows->filter(function ($item, $index) use ($row, $model) {
                    return !is_null($model->getImportableWithOptions($index));
                })->each(function ($item, $index) use ($row, $model) {
                    $itemOptions = $model->getImportableWithOptions($index);
                    $methodName = isset($itemOptions['related']) ? $itemOptions['related'] : null;

                    if (method_exists($this->model, $methodName)
                        && ($model->$methodName() instanceof BelongsToMany || $model->$methodName() instanceof MorphToMany)) {
                        if ($itemOptions['type'] === 'name') {
                            $ids = collect(explode(',', $item))->map(function ($subItem) use ($itemOptions) {
                                $instance = app($itemOptions['class'])->where($itemOptions['column'], trim($subItem))->first();
                                return $instance ? $instance->id : null;
                            })->filter(function ($id) {
                                return $id !== null;
                            })->toArray();
                        } else {
                            $ids = collect(explode(',', $item))->map(function ($id) {
                                return trim($id);
                            })->toArray();
                        }

                        $model->$methodName()->sync($ids);
                    }

                    if ($itemOptions['type'] === 'image') {
                        $model->addMediaFromUrl($item)->toMediaCollection($itemOptions['collection'], 'media');
                    }

                    if ($itemOptions['type'] === 'feature'){
                        $this->createOrAssignFeatureValue($item, $itemOptions, $model);
                    }
                });
            });

            return $model;
        } catch (Exception $e) {
            Log::error('Import error: '.  $e->getMessage());
        }
    }

    private function createOrAssignFeatureValue($item, $itemOptions, Product $model){

        $feature = Feature::find($itemOptions['id']);

        $valueType = $feature->is_number ? 'value_integer' : 'value_string';

        $existingValue = FeatureValue::query()
            ->where('feature_id', $feature->id)
            ->where($valueType, $item)
            ->first();

        if (!$existingValue){
            $existingValue = FeatureValue::query()->insertGetId(['feature_id'=>$feature->id, $valueType => $item]);
            $model->featureValues()->attach($existingValue);
        } else {
            $model->featureValues()->attach($existingValue->id);
        }
    }

    /**
     * @return int
     */

    public function startRow(): int
    {
        if (!empty($this->mappedHeader)) {
            return 2;
        }
        return 1;
    }
}
