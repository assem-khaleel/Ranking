<div class="modal fade" id="program-progress-modal" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel1">{{$systems->name}} : {{$systems->year}}
                    / {{trans('months.'.DateTime::createFromFormat('!m', $systems->month)->format('F'))}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="progress">
                    <div class="progress-bar progress-bar-success progress-bar-striped"
                         role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"
                         style="width:{{$systems->progress}}%">
                        @if ($systems->progress == 0 )
                            <span class="text-dark">{{trans('program.progress')}} : {{$systems->progress}}</span>
                        @else
                            {{trans('program.progress')}} : {{$systems->progress}}
                        @endif
                    </div>
                </div>
                <br>
                <div class="table-responsive">
                    <table class="table color-bordered-table info-bordered-table table-striped m-b-0">
                        <thead>
                        <tr>
                            <th class="col-md-3">{{trans('criterias.criterion')}}</th>
                            @if($systems->indicatorsCount != 0)
                                <th class="col-md-3">{{trans('indicators.indicator')}}</th>
                            @endif
                            <th class="col-md-3">{{trans('result.value')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $currentCriteria = 0 @endphp

                        @foreach($systems->criterias as $criteria)
                            @if ($criteria->indicator->isNotEmpty())

                                @foreach($criteria->indicator as $indicator)
                                    <tr>
                                        @if ($currentCriteria != $criteria->id)
                                            @php $currentCriteria = $criteria->id @endphp
                                            <td class="col-md-3"
                                                rowspan="{{ $criteria->indicator->count() }}"> {{$criteria->name}}</td>
                                        @endif
                                        <td class="col-md-3">{{$indicator->name}}</td>
                                        <td class="class col-md-3">{{ $systems->results->where('indicator_id', $indicator->id)->first()->value ?? trans('program.notSet')}}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    @if ($currentCriteria != $criteria->id)
                                        @php $currentCriteria = $criteria->id @endphp
                                        <td class="col-md-3"> {{$criteria->name}}</td>
                                    @endif
                                    <td class="class col-md-3">{{ $systems->results->where('criteria_id', $criteria->id)->first()->value ?? trans('program.notSet')}}</td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">{{trans('common.close')}}
                </button>
            </div>
        </div>
    </div>
</div>