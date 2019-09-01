<div class="form-body">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group row">
                <label for="name_en" class="control-label col-md-2">{{ trans('criterias.rankingSystem') }}</label>
                <div class="col-md-10">
                    <select class="select2 form-control custom-select" style="width: 100%; height:36px;" id="system_id"
                            type="text"
                            class="form-control {{ $errors->has('system_id') ? 'is-invalid' : '' }}" name="system_id" data-placeholder="{{trans('criterias.selectRankingSystem')}}">
                        <option value="">{{trans('criterias.selectRankingSystem')}}</option>
                        @foreach($systems as $system)
                            <option value="{{ $system->id }}" {{old('system_id') == $system->id || isset($criteria->system_id) && $criteria->system_id == $system->id ? 'selected' : '' }}>{{ $system->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('system_id'))
                        <small class="form-control-feedback text-danger"> {{ $errors->first('system_id') }} </small>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group row">
                <label for="name_en" class="control-label col-md-2">{{ trans('criterias.nameEn') }}</label>
                <div class="col-md-10">
                    <input id="name_en" name="name_en" type="text"
                           class="form-control {{ $errors->has('name_en') ? 'is-invalid' : '' }}"
                           placeholder="{{trans('criterias.nameEnglish')}}"
                           value="{{ old('name_en', ($criteria->name_en ?? '')) }}">
                    @if ($errors->has('name_en'))
                        <small class="form-control-feedback text-danger"> {{ $errors->first('name_en') }} </small>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group row">
                <label for="name_ar" class="control-label col-md-2">{{trans('criterias.nameAr') }}</label>
                <div class="col-md-10">
                    <input id="name_ar" name="name_ar" type="text"
                           class="form-control {{ $errors->has('name_ar') ? 'is-invalid' : '' }}"
                           placeholder="{{trans('criterias.nameArabic')}}"
                           value="{{ old('name_ar', ($criteria->name_ar ?? '')) }}">
                    @if ($errors->has('name_ar'))
                        <small class="form-control-feedback text-danger">{{ $errors->first('name_ar') }}</small>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group row">
                <label for="url" class="control-label col-md-2">{{trans('criterias.percentage')}}</label>
                <div class="col-md-10">
                    <input id="percentage" name="percentage" type="text"
                           class="form-control {{ $errors->has('percentage') ? 'is-invalid' : '' }}"
                           placeholder="{{trans('criterias.percentage')}}"
                           value="{{ old('percentage', ($criteria->percentage ?? '')) }}">
                    @if ($errors->has('percentage'))
                        <small class="form-control-feedback text-danger">{{ $errors->first('percentage') }}</small>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group row">
                <label for="description_en" class="control-label col-md-2">{{ trans('criterias.descriptionEn')}}</label>
                <div class="col-md-10">
                    <textarea id="description_en" name="description_en"
                              class="form-control {{ $errors->has('description_en') ? 'is-invalid' : '' }}"
                              placeholder="{{trans('criterias.descriptionEnglish')}}">{{ old('description_en', ($criteria->description_en ?? '')) }}</textarea>
                    @if ($errors->has('description_en'))
                        <small class="form-control-feedback text-danger">{{ $errors->first('description_en') }}</small>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group row">
                <label for="description_ar" class="control-label col-md-2">{{ trans('criterias.descriptionAr')}}</label>
                <div class="col-md-10">
                    <textarea id="description_ar" name="description_ar"
                              class="form-control {{ $errors->has('description_ar') ? 'is-invalid' : '' }}"
                              placeholder="{{trans('criterias.descriptionArabic')}}">{{ old('description_ar', ($criteria->description_ar ?? '')) }}</textarea>
                    @if ($errors->has('description_ar'))
                        <small class="form-control-feedback text-danger">{{ $errors->first('description_ar') }}</small>
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
                            class="btn btn-linkedin">{{empty($ranking->id) ? trans('common.save') : trans('common.update')}}</button>
                    <a href="{{route('ranking-criteria.index')}}"
                       class="btn btn-danger"> {{trans('common.cancel')}}</a>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- End PAge Content -->
    <!-- ============================================================== -->

</div>

@push('script')
    <script type="text/javascript">
        jQuery(document).ready(function () {
            // For select 2
            $(".select2").select2();
        });
    </script>
@endpush