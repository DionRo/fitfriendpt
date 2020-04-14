@extends('layouts.admin')

@section('content')
    <script src="{{URL::asset("assets/admin/vendor-ex/jquery/jquery.min.js")}}"></script>
    <section class="admin-content ">
        <div class="container-fluid bg-dark m-b-30">
            <div class="row">

                <div class="col-lg-6 my-auto text-white p-t-20 ">

                    <h4 class=""><span class="js-greeting"></span> {{Auth::user()->name}}!</h4>
                    <p class="opacity-75 ">
                        did you know that, “Your body can stand almost anything. It’s your mind that you have to convince.”,<br>
                        besides that “Fitness is like a relationship. You can’t cheat and expect it to work.”. <br>
                        but HEY! “Respect your body. It’s the only one you get.”
                    </p>
                </div>
            </div>
        </div>

        <div class="container-fluid  p m-b-30">
            @if (session('statusS'))
                <br>
                <div class="alert alert-border-success  alert-dismissible fade show" role="alert">
                    <div class="d-flex">
                        <div class="icon">
                            <i class="icon mdi mdi-check-circle-outline"></i>
                        </div>
                        <div class="content">
                            <strong>Holy guacamole!</strong> {{ session('statusS') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    </div>
                </div>
            @endif
            <div class="card m-b-30">
                <div class="card-header">
                    <h5 class="m-b-0">
                    Maak een product
                    </h5>
                </div>
                <div class="card-body ">
                    <form action="{{action('ProductController@store')}}" class="flex flex-column"  method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Productnaam</label>
                            <input class="form-control" name="description" type="text" id="description" required>
                        </div>
                        <div class="form-group">
                            <label for="">Aantal lessen</label>
                            <input class="form-control" name="lessons" type="number" id="lessons" required>
                        </div>
                        <div class="form-group">
                            <label for="">Prijs</label>
                            <input class="form-control" name="price" type="number" step=".01"  id="price" required>
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" value="Opslaan" class="save">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection