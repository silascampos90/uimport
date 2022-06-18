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
                                <h6 class="mb-0">Csv file list/Status</h6>
                            </div>
                            <div>

                            </div>
                        </div>
                        <div class="d-flex j-center">
                            <div class="card-body">
                                <table class="table mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">Id</th>
                                            <th scope="col">File Name</th>
                                            <th scope="col">Upload Datetime</th>
                                            <th scope="col">Status</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <th></th>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <a type="button" href="detalhes/{{$e->cep}}" target="" class="btn btn-sm btn-warning"><i class="bx bx-detail mr-1"></i>Detalhar</a>
                                            </td>
                                        </tr>
                                        

                                    </tbody>
                                </table>
                            </div>


                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div>
</div>


<!--CONTAINER -->

@include('templates/footer');


<script src="assets/js/listar.js"></script>