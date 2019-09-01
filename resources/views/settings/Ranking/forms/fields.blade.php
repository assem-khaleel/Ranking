<div class="form-body">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group row">
                <label for="name_en" class="control-label col-md-2">{{ trans('ranking.nameEn') }}</label>
                <div class="col-md-10">
                    <input id="name_en" name="name_en" type="text"
                           class="form-control {{ $errors->has('name_en') ? 'is-invalid' : '' }}"
                           placeholder="{{trans('ranking.nameEn')}}" value="{{ old('name_en', ($ranking->name_en ?? '')) }}">
                    @if ($errors->has('name_en'))
                        <small class="form-control-feedback text-danger"> {{ $errors->first('name_en') }} </small>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group row">
                <label for="name_ar" class="control-label col-md-2">{{ trans('ranking.nameAr') }}</label>
                <div class="col-md-10">
                    <input id="name_ar" name="name_ar" type="text"
                           class="form-control {{ $errors->has('name_ar') ? 'is-invalid' : '' }}"
                           placeholder="{{ trans('ranking.nameAr') }}" value="{{ old('name_ar', ($ranking->name_ar ?? '')) }}">
                    @if ($errors->has('name_ar'))
                        <small class="form-control-feedback text-danger">{{ $errors->first('name_ar') }}</small>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group row">
                <label for="abbreviation" class="control-label col-md-2">{{ trans('ranking.abbr') }}</label>
                <div class="col-md-10">
                    <input id="abbreviation" name="abbreviation" type="text"
                           class="form-control {{ $errors->has('abbr') ? 'is-invalid' : '' }}"
                           placeholder="{{ trans('ranking.abbr') }}" value="{{ old('abbreviation', ($ranking->abbreviation ?? '')) }}">
                    @if ($errors->has('abbreviation'))
                        <small class="form-control-feedback text-danger">{{ $errors->first('abbreviation') }}</small>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group row">
                <label for="url" class="control-label col-md-2">{{ trans('ranking.url') }}</label>
                <div class="col-md-10">
                    <input id="url" name="url" type="url"
                           class="form-control {{ $errors->has('url') ? 'is-invalid' : '' }}" placeholder="{{ trans('ranking.url') }}"
                           value="{{ old('url', ($ranking->url ?? '')) }}">
                    @if ($errors->has('url'))
                        <small class="form-control-feedback text-danger">{{ $errors->first('url') }}</small>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group row">
                <label class="control-label col-md-2">{{trans('ranking.logoUpload')}}</label>
                <div class="col-md-10 fileinput fileinput-new input-group"
                     data-provides="fileinput">
                    <div class="form-control" data-trigger="fileinput"><i
                                class="glyphicon glyphicon-file fileinput-exists"></i> <span
                                class="fileinput-filename"></span></div>
                    <span class="input-group-addon btn btn-default btn-file"> <span
                                class="fileinput-new">{{trans('users.selectImage')}}</span> <span
                                class="fileinput-exists">{{trans('users.change')}}</span>
                                            <input type="file" name="logo"> </span>
                    <a href="#" class="input-group-addon btn btn-default fileinput-exists"
                       data-dismiss="fileinput">{{trans('users.remove')}}</a>
                </div>
                @if ($errors->has('logo'))
                    <small class="form-control-feedback text-danger">{{trans($errors->first('logo'))}}</small>
                @endif
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group row">
                <label for="description_en" class="control-label col-md-2">{{ trans('ranking.descEn') }}</label>
                <div class="col-md-10">
                    <textarea id="description_en" name="description_en"
                              class="form-control {{ $errors->has('description_en') ? 'is-invalid' : '' }}"
                              placeholder="{{ trans('ranking.descEn') }}">{{ old('description_en', ($ranking->description_en ?? '')) }}</textarea>
                    @if ($errors->has('description_en'))
                        <small class="form-control-feedback text-danger">{{ $errors->first('description_en') }}</small>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group row">
                <label for="description_ar" class="control-label col-md-2">{{ trans('ranking.descAr') }}</label>
                <div class="col-md-10">
                    <textarea id="description_ar" name="description_ar"
                              class="form-control {{ $errors->has('description_ar') ? 'is-invalid' : '' }}"
                              placeholder="{{ trans('ranking.descAr') }}">{{ old('description_ar', ($ranking->description_ar ?? '')) }}</textarea>
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
                    <a href="{{route('ranking-system.index')}}"
                       class="btn btn-danger"> {{trans('common.cancel')}}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script src="{{asset('js/jasny-bootstrap.js')}}"></script>
@endpush