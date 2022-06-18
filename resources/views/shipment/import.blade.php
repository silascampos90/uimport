@include('templates/head');
@include('templates/menu');

<!--CONTAINER -->
<div class="page-wrapper">
    <div class="page-content">
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0">CSV Shipment cost file :</h6>
                            </div>
                            <div>

                            </div>
                        </div>
                        <form id="fileUploadForm" method="POST" action="{{ route('import.shipment.file') }}" enctype="multipart/form-data">
                            <div class="d-flex j-center">

                                <div class=" col-7">
                                    <input class="form-control mb-3" id="importCsvFile" name="importCsvFile" type="file" required>
                                </div>

                                <div class="col-2" style="margin-left: 10px;">
                                    <button type="submit" id="importCsv" class="btn btn-primary px-5"><i class="bx bx-send mr-1"></i>Submit</button>
                                </div>

                            </div>
                            <div id="progressBar" style="display:none;" class="form-group">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


<!--CONTAINER -->

@include('templates/footer');


<script src="{{route('home')}}/assets/js/import.js"></script>