@extends('layouts.main')


@section('breadcrumb')
<div class="page-title-right">
    <ol class="breadcrumb p-0 m-0">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
</div>
@endsection




@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header py-3 bg-transparent">
                <div class="card-widgets">
                    <!--<a href="javascript:;" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>-->
                    <a data-toggle="collapse" href="#cardMapCollpase" role="button" aria-expanded="false" aria-controls="cardMapCollpase"><i class="mdi mdi-minus"></i></a>
                </div>
                <h5 class="header-title mb-0">Main Map Display</h5>
            </div>

            <div id="cardMapCollpase" class="collapsed show">
                <div class="card-body">
                    <div id="map" style="min-height: 600px;"></div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection