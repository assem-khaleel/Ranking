@php

 $dir = $currentLanguage->locale == 'en' ? 'ltr' : 'rtl';

@endphp
@extends('layouts.app')

@section('wrapper')

<div class="col-xl-12 col-lg-12 mb-3">
    <div class="card">
        <div style="overflow-x: scroll;" id="chart"></div>
    </div>
</div>
<ul id="org-chart" class="d-none">
    <li>
        <div class='item 1'>
            <button class="btn btn-link text-white" data-toggle="modal">{{ Auth()->user()->institutionUser->institution->name }}</button>
        </div>
        <ul>
            @if (count(Auth()->user()->institutionUser->institution->colleges))
                @foreach(Auth()->user()->institutionUser->institution->colleges as $college)
                    <li>
                        <div class='item class-1'>
                            <button class='create-department add btn btn-link p-0 ' data-college-id="{{ $college->id }}" ><i class='fa fa-plus-square'></i></button>
                            <button class='delete delete-college btn btn-link p-0' href="javascript:void(0)" data-college-id="{{ $college->id }}"><i class="fa fa-times"></i></button>
                            <form method="POST" action="{{ route('college.destroy', $college->id) }}" id="college-{{ $college->id }}" accept-charset="UTF-8" data-college-id="{{ $college->id }}">
                                <input type="hidden" name="is_orgchart" value="1">
                                <input name="_method" type="hidden" value="DELETE">{{ csrf_field() }}
                            </form>
                            <button class='edit-college btn btn-link p-0 text-white ' data-college-id="{{ $college->id }}" ><i class='fa fa-edit-square'></i>&nbsp;{{ $college->name }}</button>
                        </div>

                        <ul>
                            @foreach($college->departments as $department)
                                <li>

                                    <div class='item class-2 '>
                                        <a href="{{route('program.create',['is_orgchart'=>true])}}" class="create-program add btn btn-link p-0 " data-department-id="{{ $department->id }}"><i class='fa fa-plus-square'></i></a>
                                        <input type="hidden" name="is_orgchart" value="1">
                                        <button class='delete delete-department btn btn-link p-0' href="javascript:void(0)" data-department-id="{{ $department->id }}"><i class="fa fa-times"></i></button>
                                        <form method="POST" action="{{ route('department.destroy', $department->id) }}" accept-charset="UTF-8" data-department-id="{{ $department->id }}" id="department-{{ $department->id }}">
                                            <input type="hidden" name="is_orgchart" value="1">
                                            <input name="_method" type="hidden" value="DELETE">{{ csrf_field() }}
                                        </form>
                                        <button class='edit-department  btn btn-link p-0 text-white ' data-department-id="{{ $department->id }}" ><i class='fa fa-edit-square'></i>&nbsp;{{ $department->name }}</button>
                                    </div>
                                    <ul>
                                        @foreach($department->programs as $program)
                                            @php $results = $program->results @endphp
                                            <li>
                                                <div class='item class-3'>
                                                    <button class='delete delete-program btn btn-link p-0' href="javascript:void(0)" data-program-id="{{ $program->id }}"><i class="fa fa-times"></i></button>
                                                    <form method="POST" action="{{ route('program.destroy', $program->id) }}" accept-charset="UTF-8" data-program-id="{{ $program->id }}" id="program-{{ $program->id }}">
                                                        <input type="hidden" name="is_orgchart" value="1">
                                                        <input name="_method" type="hidden" value="DELETE">{{ csrf_field() }}
                                                    </form>

                                                   <a href="{{route('program.edit',[$program->id,'is_orgchart'=>true])}}" class='edit-program  btn btn-link p-0 text-white' data-program-id="{{ $program->id }}" ><i class='fa fa-edit-square'></i>&nbsp;{{ $program->name }}</a> <br>


                                                    @foreach($program->systems as $system)
                                                        <i class="fa fa-dot-circle-o {{ $results->where('system_id', $system->id)->where('year', date('Y'))->where('month', date('n'))->isEmpty() ? 'text-danger' : 'active-month' }}" aria-hidden="true"></i>
                                                    @endforeach


                                                    <button class="btn btn-info btn-sm waves-effect waves-light ranking-progress mt-2" data-program-id="{{ $program->id }}" type="button"><span class="btn-label"><i class="fa fa-pie-chart"></i></span>{{trans('programModal.progress')}}</button>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            @endif
        </ul>
    </li>
</ul>
@include('dashboard.modals.create-department')

@include('dashboard.modals.edit-college-modal')

@include('dashboard.modals.create-program')

@include('dashboard.modals.ranking-progress')


@push('head')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.orgchart-'.$dir.'.css') }}">
@endpush
@push('script')
    <script type="text/javascript" src="{{ asset('js/jquery.orgchart.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $("#org-chart").orgChart({
                container: $("#chart"),
                stack    : true,
                depth    : 3
            });

            $('.active-month').css({
                'background-color': '#56e63c',
            });


            $(".create-department").click(function (e) {
                e.preventDefault();

                var $model = $('#department-modal');
                var college_id = $(this).data('college-id');

                $model.find('#department_name_en').val('');
                $model.find('#department_name_ar').val('');
                $model.find('#department_id').val('');
                $model.find('#college-id').val(college_id);

                $model.find('form').attr('action', '/settings/department');
                $model.find('input[name="_method"]').remove();

                $model.find('.is-invalid').removeClass('is-invalid');
                $model.find('span.invalid-feedback').remove();

                $model.modal().show();
            });
            $(".ranking-progress").click(function (e) {
                e.preventDefault();

                var $modal = $('#ranking-progress');

                var programId = $(this).data('program-id');

                $modal.find('.charts-row').empty();
                $.ajax({
                    url: '/settings/program/progress/' + programId,
                    dataType:'json',
                    success: function (e) {
                        //console.log(e.length);
                        if(e.length===0){
                            $modal.find('.charts-row').append('<div class="col-lg-12 text-center h1">There is no criteria</div>');
                        }
                        else {
                            $.each(e, function (i, elem) {
                                $modal.find('.charts-row').append(
                                    ( e.length===1
                                        ?
                                        "<div class='col-lg-12'>" :
                                        (e.length===2
                                            ?
                                            "<div class='col-lg-6'>" :
                                            (e.length===3
                                                ?
                                                "<div class='col-lg-4'>" :
                                                (e.length===4
                                                    ?
                                                    "<div class='col-lg-3'>" :
                                                    "<div class='col-lg-3'>")))) +
                                    "<div class='card'>" +
                                    "<div class='card-body'>" +
                                    "<h4 class='card-title'>" + elem.name_en + "</h4>" +
                                    "<div class='row'>" +
                                    "<div class='col-lg-12 col-md-6 m-b-30'>" +
                                    "<div class='chart program-progress-chart d-block mx-auto' data-percent='" + elem.progress + "'> <span class='percent'>" + parseInt(elem.progress) +
                                    "</div>" +
                                    "</div>" +
                                    "</div>" +
                                    "</div>" +
                                    "</div>" +
                                "</div>");
                            });
                        }

                        $program_chart_details=$modal.find('#program-chart-details');
                        $program_chart_details.attr('href', $program_chart_details.data('ohref').replace('__id__', programId));

                        $modal.modal().show();

                        $modal.find('.program-progress-chart').easyPieChart({
                            easing: 'easeOutBounce',
                            barColor : '#13dafe',
                            lineWidth: 10,
                            animate: 1000,
                            trackColor: '#e5e5e5'
                        });
                    },
                    error: function (e) {
                        console.log(e);
                    }
                });
            });

            $('#department-form').submit(function(e){
                var departForm = $(this);
                e.preventDefault();

                departForm.find('.is-invalid').removeClass('is-invalid');
                departForm.find('span.invalid-feedback').remove();

                $.post($(this).attr('action'), $(this).serialize())
                    .done(function (d) {
                        history.go(0);
                    })
                    .fail(function(d){
                        for(var i in d.responseJSON.errors){

                            console.log(d.responseJSON.errors);

                            $errorContainer  = $('<span class="invalid-feedback" role="alert">');

                            for(var j=0; j<d.responseJSON.errors[i].length; j++){
                                $errorContainer.append('<strong>'+d.responseJSON.errors[i][j]+'</strong>');
                            }

                            departForm.find('[name="'+i+'"]').addClass('is-invalid').after($errorContainer);
                        }
                    });
            });

            $(".edit-department").click(function (e) {
                e.preventDefault();
                var department_id = $(this).data('department-id');
                $.ajax({
                    url: '/settings/department/' + department_id,

                    success: function (e) {
                        $('#department_name_en').val(e.name_en);
                        $('#department_name_ar').val(e.name_ar);
                        $('#college-id').val(e.college_id);

                        $('#department-form').attr('action', '/settings/department/' + department_id);
                        $('#department-form').append('<input type="hidden" name="_method" value="PUT">');

                        $('#department-form').find('.is-invalid').removeClass('is-invalid');
                        $('#department-form').find('span.invalid-feedback').remove();

                        $('#department-modal').modal().show();
                    },
                    error: function (e) {
                        console.log(e);
                    }
                });
            });

            $(".edit-college").click(function (e) {
                e.preventDefault();
                var college_id = $(this).data('college-id');
                $.ajax({
                    url: '/settings/college/' + college_id,
                    success: function (e) {
                        $('#college_name_en').val(e.name_en);
                        $('#college_name_ar').val(e.name_ar);

                        $('#college-edit-form').attr('action', '/settings/college/' + college_id);
                        $('#college-edit-form').append('<input type="hidden" name="_method" value="PUT">');

                        $('#college-edit-form').find('.is-invalid').removeClass('is-invalid');
                        $('#college-edit-form').find('span.invalid-feedback').remove();
                        $('#edit-college-modal').modal().show();
                    },
                    error: function (e) {
                        console.log(e);
                    }
                });
            });
            $('#college-edit-form').submit(function(e){
                var collForm = $(this);
                e.preventDefault();

                collForm.find('.is-invalid').removeClass('is-invalid');
                collForm.find('span.invalid-feedback').remove();

                $.post($(this).attr('action'), $(this).serialize())
                    .done(function (d) {
                        history.go(0);
                    })
                    .fail(function(d){
                        for(var i in d.responseJSON.errors){

                            console.log(d.responseJSON.errors);

                            $errorContainer  = $('<span class="invalid-feedback" role="alert">');

                            for(var j=0; j<d.responseJSON.errors[i].length; j++){
                                $errorContainer.append('<strong>'+d.responseJSON.errors[i][j]+'</strong>');
                            }

                            collForm.find('[name="'+i+'"]').addClass('is-invalid').after($errorContainer);
                        }
                    });
            });

            $(".delete-college").click(function (e) {
                e.preventDefault();
                var college_id = $(this).data('college-id');
                $('#college-' + college_id).submit();
            });
            $(".delete-department").click(function (e) {
                e.preventDefault();
                var department_id = $(this).data('department-id');
                $('#department-' + department_id).submit();
            });
            $(".delete-program").click(function (e) {
                e.preventDefault();
                var program_id = $(this).data('program-id');
                $('#program-' + program_id).submit();
            });

        });
    </script>
@endpush

@endsection
