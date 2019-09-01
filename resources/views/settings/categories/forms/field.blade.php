<div class="form-body">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group row">
                <label for="college_id" class="control-label col-md-2">{{trans('category.ranking')}}</label>
                <div class="col-md-10">
                        <select id="system_id" class="select2 form-control custom-select {{ $errors->has('system_id') ? 'is-invalid' : '' }}" style="width: 100%; height:36px;" name="system_id"
                                 data-placeholder="{{trans('category.selectRanking')}}">
                        @foreach($data as $data1)
                            <option value="{{ $data1->id }}" {{old('system_id') == $data1->id || isset($systemCategory->system_id) && $systemCategory->system_id == $data1->id ? 'selected' : '' }}>{{ $data1->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('system_id'))
                        <small class="form-control-feedback text-danger"> {{ $errors->first('system_id') }}</small>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group row">
                <label class="control-label col-md-2">{{trans('common.nameEn')}}</label>
                <div class="col-md-10">
                    <input type="text" id="name_en" name="name_en"
                           class="form-control {{ $errors->has('name_en') ? 'is-invalid' : '' }}"
                           placeholder="{{ trans('common.nameEnLabel') }}"
                           value="{{ old('name_en', ($systemCategory->name_en ?? '')) }}">
                    @if ($errors->has('name_en'))
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $errors->first('name_en')}}</strong>
                       </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group row">
                <label class="control-label col-md-2">{{trans('common.nameAr')}}</label>
                <div class="col-md-10">
                    <input type="text" id="name_ar" name="name_ar"
                           class="form-control {{ $errors->has('name_ar') ? 'is-invalid' : '' }}"
                           placeholder="{{ trans('common.nameArLabel') }}"
                           value="{{ old('name_ar', ($systemCategory->name_ar ?? '')) }}">
                    @if ($errors->has('name_ar'))
                        <small class="form-control-feedback text-danger">{{ $errors->first('name_ar') }}</small>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="form-actions">
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-offset-3 col-md-9">
                    <button type="submit"
                            class="btn btn-linkedin">{{empty($systemCategory->id) ? trans('common.save') : trans('common.update')}}</button>
                    <a href="{{route('category.index')}}"
                       class="btn btn-danger"> {{trans('common.cancel')}}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script type="text/javascript">
        jQuery(document).ready(function() {
            // For select 2
            $(".select2").select2();
        });
    </script>
@endpush
