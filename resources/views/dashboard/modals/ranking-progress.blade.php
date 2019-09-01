<div class="modal fade bs-example-modal-lg" id="ranking-progress" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">{{trans('programModal.rankingProgress')}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <!-- ============================================================== -->
                        <!-- Start Page Content -->
                        <!-- ============================================================== -->
                        <div class="row charts-row">

                        </div>
                </div>
            </div>

            <div class="modal-footer">

                <div class="col-md-offset-12 col-md-12">
                    <a href="#" data-ohref="{{route('home.program', "__id__" )}}" id="program-chart-details" type="submit" class="btn btn-linkedin">{{trans('settings.moreDetails')}} </a>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" aria-hidden="true">{{trans('settings.close')}}</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>

@push('head')
<link href="{{asset('plugins/morrisjs/morris.css')}}" rel="stylesheet">
<link href="{{asset('css/css-chart/css-chart.css')}}" rel="stylesheet">
@endpush

@push('script')
<!-- Chart JS -->
<script src="{{asset('plugins/echarts/echarts-all.js')}}"></script>
<!-- JavaScript -->
<script src="{{asset('plugins/raphael/raphael-min.js')}}"></script>
<script src="{{asset('plugins/morrisjs/morris.js')}}"></script>
<script src="{{asset('plugins/easy-pie-chart/dist/jquery.easypiechart.min.js')}}"></script>
@endpush
