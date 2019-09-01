<div class="form-body">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group row">
                <label for="department_id" class="control-label col-md-2">{{ trans('department.departments') }}</label>
                <div class="col-md-10">
                    <select class="select2 form-control custom-select {{$errors->has('department_id') ? 'is-invalid' : ''}}"
                            style="width: 100%; height:36px;" name="department_id"
                            data-placeholder="{{ trans('program.department') }}" data-placeholder="{{ trans('program.SelectUser') }}">
                        <option value="">{{ trans('program.department') }}</option>
                    @foreach($colleges as $college)
                            <optgroup label="{{ $college->name }}">
                                @foreach($college->departments as $department)

                                    <option value="{{ $department->id }}" {{old('department_id') == $department->id || isset($program->department_id) && $program->department_id == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>

                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                    @if ($errors->has('department_id'))
                        <small class="form-control-feedback text-danger"> {{ $errors->first('department_id') }}</small>
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
                           value="{{ old('name_en', ($program->name_en ?? '')) }}">
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
                           value="{{ old('name_ar', ($program->name_ar ?? '')) }}">
                    @if ($errors->has('name_ar'))
                        <small class="form-control-feedback text-danger">{{ $errors->first('name_ar') }}</small>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <hr>
    <h3 class="card-title">{{trans('program.systemToRanking')}}</h3>
    <div class="row">
        @foreach($rankingSystem as $rank)
        <div class="col-md-12">
            <div class="form-group row">

           <label for="category_id" class="control-label col-md-2" data-toggle="tooltip" title="{{$rank->name}}">{{$rank->abbreviation}}</label><br>
                <div  class="col-md-10">
                    <select id="category_id" class="category form-control {{ $errors->has('category_id') ? 'is-invalid' : '' }}" name="categories[{{ $rank->id }}]">
                        <option value="">{{ trans('program.category') }}</option>
                          @if(isset($rank->categories))
                        @foreach($rank->categories as $category)
                                    <option value="{{ $category->id }}" {{old('categories.'.$rank->id ) == $category->id || isset($program) && in_array($category->id, $program->categories->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                              @endif
                    </select>
                    @if ($errors->has('category_id'))
                        <small class="form-control-feedback text-danger"> {{ $errors->first('category_id') }}</small>
                    @endif
                </div>
            </div>
        </div>
            @endforeach
    </div>
    <hr>
    <h3 class="card-title">{{trans('program.ResponsuibleId')}}</h3>
    <div class="col-md-12">
        <div class="form-group row">
            <label for="responsible_id" class="control-label col-md-2">{{ trans('program.user') }}</label>
            <div class="col-md-10">
                <select class="user form-control custom-select {{ $errors->has('responsible_id') ? 'is-invalid' : '' }}"
                        style="width: 100%; height:36px;" name="responsible_id">
                    <option value="">{{ trans('program.SelectUser') }}</option>
                            @foreach($users as $user)
                                <option value="{{ $user->user->id }}" {{ isset($program->responsible_id) && $program->responsible_id == $user->user->id ? 'selected' : '' }}>{{ $user->user->name }}</option>
                            @endforeach
                </select>
                @if ($errors->has('responsible_id'))
                    <small class="form-control-feedback text-danger"> {{ $errors->first('responsible_id') }}</small>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="form-actions">
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-offset-3 col-md-9">
                    <input type="hidden" name="is_orgchart" value="{{ request('is_orgchart',false)  }}">
                    <button type="submit"
                            class="btn btn-linkedin">{{empty($program->id) ? trans('common.save') : trans('common.update')}}</button>
                    <a href="{{route('program.index')}}"
                       class="btn btn-danger"> {{trans('common.cancel')}}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script type="text/javascript">
        jQuery(document).ready(function () {
            // For select 2
            $(".select2").select2();
            $(".user").select2();
            $(".category").select2();
        });
    </script>
@endpush