<div class="box">
    <form action="{{ route('admin.customers.store') }}" method="post" class="form" @submit.prevent="onSubmit">
        <div class="box-body">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="name">Name <span class="text-danger">*</span></label>
                <input v-model="form.name" type="text" name="name" id="name" placeholder="Name" class="form-control" value="{{ old('name') }}">
            </div>
            <div class="form-group">
                <label for="email">Email <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-addon">@</span>
                    <input type="text" v-model="form.email" name="email" id="email" placeholder="Email" class="form-control" value="{{ old('email') }}">
                </div>
            </div>
            <div class="form-group">
                <label for="password">Password <span class="text-danger">*</span></label>
                <input type="password" v-model="form.password" name="password" id="password" placeholder="xxxxx" class="form-control">
            </div>
            <div class="form-group">
                <label class="typo__label">Select customer group</label>
                <multiselect v-model="form.groups" :options="groups" :multiple="true" placeholder="Select one" label="title" track-by="id">

                </multiselect>
            </div>
            <div class="form-group">
                <label for="status">Status </label>
                <select name="status" v-model="form.status" id="status" class="form-control">
                    <option value="0">Disable</option>
                    <option value="1">Enable</option>
                </select>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <div class="btn-group">
                <a href="{{ route('admin.products.index') }}" class="btn btn-default">Back</a>
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </div>
    </form>
</div>