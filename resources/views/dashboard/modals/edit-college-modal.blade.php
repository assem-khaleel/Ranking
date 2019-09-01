<div class="modal fade" id="edit-college-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">{{trans('college.edit')}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">

                <form id="college-edit-form" action="{{route('college.update',$college->id)}}" class="form-horizontal" method="post">
                    @csrf
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="control-label col-md-2">{{trans('common.nameEn')}}</label>
                                    <div class="col-md-10">
                                        <input type="text" id="college_name_en" name="name_en"
                                               class="form-control {{ $errors->has('name_en') ? 'is-invalid' : '' }}"
                                               placeholder="{{ trans('common.nameEnLabel') }}"
                                              >
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
                                        <input type="text" id="college_name_ar" name="name_ar"
                                               class="form-control {{ $errors->has('name_ar') ? 'is-invalid' : '' }}"
                                               placeholder="{{ trans('common.nameArLabel') }}"
                                        >
                                        @if ($errors->has('name_ar'))
                                            <small class="form-control-feedback text-danger">{{ $errors->first('name_ar') }}</small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <input name="college_id" type="hidden" value="" id="college-id">
                            <input type="hidden" name="is_orgchart" value="1">
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn btn-linkedin">{{trans('common.save')}} </button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal" aria-hidden="true">{{trans('common.cancel')}}</button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>
