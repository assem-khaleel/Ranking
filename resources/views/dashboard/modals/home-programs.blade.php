<div class="modal fade " id="home-programs" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div  class="modal-header">
                <h4 class="modal-title" id="title-home-progress">{{trans('home.programs')}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <table id="progress" class="tablesaw table-bordered table-hover table"
                                   data-tablesaw-mode="swipe"
                                   data-tablesaw-sortable data-tablesaw-sortable-switch data-tablesaw-minimap
                                   data-tablesaw-mode-switch>

                                <tbody>

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <div class="col-md-offset-12 col-md-12">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"
                            aria-hidden="true">{{trans('settings.close')}}</button>
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>

