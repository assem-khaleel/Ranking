@php
    /**
     * Created by PhpStorm.
     * User: dura
     * Date: 3/14/19
     * Time: 11:11 AM
     */
@endphp
<div class="form-body">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group row">
                <label class="control-label col-md-2">{{trans('indicators.nameEn')}}</label>
                <div class="col-md-10">
                    <input type="text" id="name_en" name="name_en"
                           class="form-control {{ $errors->has('name_en') ? 'is-invalid' : '' }}"
                           placeholder="{{ trans('indicators.nameEnglish') }}"
                           value="{{ old('name_en', ($rankingIndicator->name_en ?? '')) }}">
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
                <label class="control-label col-md-2">{{trans('indicators.nameAr')}}</label>
                <div class="col-md-10">
                    <input type="text" id="name_ar" name="name_ar"
                           class="form-control {{ $errors->has('name_ar') ? 'is-invalid' : '' }}"
                           placeholder="{{ trans('indicators.nameArabic') }}"
                           value="{{ old('name_ar', ($rankingIndicator->name_ar ?? '')) }}">
                    @if ($errors->has('name_ar'))
                        <small class="form-control-feedback text-danger">{{ $errors->first('name_ar') }}</small>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group row">
                <label class="control-label col-md-2">{{trans('indicators.criteria')}}</label>
                <div class="col-md-10">
                    <select class="select2 form-control custom-select" style="width: 100%; height:36px;" name="criterion_id"
                            data-placeholder="{{trans('indicators.selectCriteria')}}">
                        <option value="">{{trans('indicators.selectCriteria')}}</option>
                        @foreach($rankingCriterias as $rankingCriteria)
                            <option value="{{$rankingCriteria->id}}"
                                    {{old('criterion_id') == $rankingCriteria->id || !empty($rankingIndicator->criterion_id) && ($rankingCriteria->id == $rankingIndicator->criterion_id) ? 'selected' : '' }}>
                                {{$rankingCriteria->name}}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('criterion_id'))
                        <small class="form-control-feedback text-danger">{{ $errors->first('criterion_id') }}</small>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group row">
                <label for="description_en" class="control-label col-md-2">{{trans('indicators.descriptionEn')}}</label>
                <div class="col-md-10">
                    <textarea id="description_en" name="description_en"
                              class="form-control {{$errors->has('description_en') ? 'is-invalid' : '' }}"
                              placeholder="{{trans('indicators.descriptionEnglish')}}">{{ old('description_en', ($rankingIndicator->description_en ?? '')) }}</textarea>
                    @if ($errors->has('description_en'))
                        <small class="form-control-feedback text-danger">{{ $errors->first('description_en') }}</small>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group row">
                <label for="description_en" class="control-label col-md-2">{{trans('indicators.descriptionAr')}}</label>
                <div class="col-md-10">
                    <textarea id="description_ar" name="description_ar"
                              class="form-control {{ $errors->has('description_ar') ? 'is-invalid' : '' }}"
                              placeholder="{{trans('indicators.descriptionArabic')}}">{{ old('description_ar', ($rankingIndicator->description_ar ?? '')) }}</textarea>
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
                            class="btn btn-linkedin">{{empty($rankingIndicator->id) ? trans('indicators.save') : trans('indicators.update')}}</button>
                    <a href="{{route('ranking-indicator.index')}}"
                       class="btn btn-danger"> {{trans('indicators.cancel')}}</a>
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
