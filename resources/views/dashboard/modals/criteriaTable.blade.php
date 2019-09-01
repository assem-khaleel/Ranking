<div class="container-fluid" id="table">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <!-- row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title m-b-40">{{trans('common.reportInstitution')}}</h4>
                    @if(!empty($criterias))

                        <div class="table-responsive">
                            <table class="table color-bordered-table info-bordered-table table-striped m-b-0"
                                   style="table-layout: fixed">
                                <thead>
                                <tr>
                                    <th width="15%">{{trans('criterias.criteriaName')}}</th>

                                    @if(!empty($system->indicatorsCount) && $system->indicatorsCount != 0)
                                        <th width="25%">{{trans('indicators.nameIndicator')}}</th>
                                    @endif
                                    @if(empty($month))
                                        @for ($i = 1; $i <= 12; $i++)
                                            <th width="5%">{{$i}}</th>
                                        @endfor
                                    @else
                                        <th width="5%">{{trans('result.value')}}</th>
                                    @endif

                                </tr>
                                </thead>
                                <tbody>
                                @php $currentCriteria = 0 @endphp
                                @foreach($criterias as $criteria)
                                    @if ($criteria->indicator->isNotEmpty())

                                        @foreach($criteria->indicator as $indicator)
                                            <tr>
                                                @if ($currentCriteria != $criteria->id)
                                                    @php $currentCriteria = $criteria->id @endphp
                                                    <td class="" width="15%"
                                                        rowspan="{{ $criteria->indicator->count() }}"> {{$criteria->name}}</td>
                                                @endif
                                                <td class="" width="25%">{{$indicator->name}}</td>
                                                @if(empty($month))
                                                    @for ($i = 1; $i <= 12; $i++)
                                                        <td class="class"
                                                            width="5%">{!! $system->results->where('indicator_id', $indicator->id)->where('month', $i)->first()->value ?? '<i class="fa fa-window-close text-danger" aria-hidden="true"></i>'!!}</td>
                                                    @endfor
                                                @else
                                                    <td class="class"
                                                        width="5%">{!! $system->results->where('indicator_id', $indicator->id)->first()->value ?? '<i class="fa fa-window-close text-danger" aria-hidden="true"></i>'!!}</td>

                                                @endif

                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            @if ($currentCriteria != $criteria->id)
                                                @php $currentCriteria = $criteria->id @endphp
                                                <td class="" width="90%"> {{$criteria->name}}</td>
                                            @endif
                                            @if(empty($month))
                                                @for ($i = 1; $i <= 12; $i++)
                                                    <td class="class"
                                                        width="5%">{!!$system->results->where('criteria_id', $criteria->id)->where('month', $i)->first()->value ?? '<i class="fa fa-window-close text-danger" aria-hidden="true"></i>'!!} </td>
                                                @endfor
                                            @else
                                                <td class="class"
                                                    width="5%">{!!$system->results->where('criteria_id', $criteria->id)->first()->value ?? '<i class="fa fa-window-close text-danger" aria-hidden="true"></i>'!!} </td>
                                            @endif
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- End PAge Content -->
    <!-- ============================================================== -->

</div>