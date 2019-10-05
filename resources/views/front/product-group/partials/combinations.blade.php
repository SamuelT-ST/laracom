<template v-if="item.attributes.length">
        <div class="mb-2">
                <small>{{ __('Vyberte si kombináciu') }}</small>
        </div>
        <div class="form-group mx-4">
                <select class="form-control attribute-select" @change="chooseAttribute($event, item.id)">
                <template v-for="attribute in item.attributes">
                        <template v-for="attributeValue in attribute.attributes_values">
                        <option :value="attribute.id">@{{ attributeValue.attribute.name}}: @{{ attributeValue.value }}</option>
                        @{{ attributeValue.attribute.name}}: @{{ attributeValue.value }}
                        </template>
                </template>
                </select>
        </div>
</template>