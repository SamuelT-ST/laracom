<div v-for="(featureValue, index) in form.featureValues">
    <div class="row mb-2">
        <div class="col-5">

        <multiselect
                v-model="featureValue.feature"
                :options="availableFeaturesNew"
                track-by="id"
                label="title"
                :taggable="true"
                :id="index"
                @tag="createFeature"
                @input="fillValues(featureValue.feature.id, index)"
                placeholder="{{ __('Vlastnosť') }}">
        </multiselect>

        </div>

        <div class="col-5">

        <multiselect
                v-if="featureValue.feature"
                v-model="featureValue.chosenValue"
                :id="featureValue.feature.id"
                :options="featureValue.availableValues"
                track-by="id"
                label="value"
                :taggable="true"
                @tag="createValue"
                placeholder="{{ __('Hodnota') }}">
        </multiselect>

        </div>

        <div class="col-1">
            <a style="color: red; position: relative; top: 10px; cursor: pointer" @click="deleteFeature(index)" title="{{ trans('brackets/admin-ui::admin.btn.delete') }}"><i class="fa fa-times"></i></a>
        </div>
    </div>
</div>

<div class="row text-right">
    <div class="col-11">
        <a class="btn btn-primary" href="#" @click.prevent="addNewFeature"><i class="fa fa-plus"></i>  {{ __('Nová vlastnosť') }}</a>
    </div>

</div>
