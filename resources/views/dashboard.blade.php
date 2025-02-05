@extends('layouts.default')
@extends('includes.head')

@section('topnav')
<!-- You can override the topnav section here -->
@parent
@endsection

@section('leftmenu')
<!-- You can override the leftmenu section here -->
@parent
@endsection

@section('content')
<div class="container-fluid">
    <h1>HYBE Fashion Shop</h1><br>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4"><br>
                    <a href="{{ route('fashion.index') }}" class="text-decoration-none">
                        <div class="d-flex align-items-center">
                            <div class="icon-container">
                                <i class="fas fa-film fa-5x text-primary"></i>
                            </div>
                            <div class="content-container">
                                <h5>Data Fashion</h5>
                                <p>View and manage data Fashion</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
<!-- You can override the footer section here -->
@parent
@endsection