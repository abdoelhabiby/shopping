@extends('layouts.dashboard')


@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">


                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Multiple Files Upload</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="close"><i class="ft-x"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">

                            <div class="repeater-default">


                                <form class="form ">

                                    <div data-repeater-list="attribute">

                                        <div data-repeater-item="" style="">

                                            <div class="row">

                                                <div class="form-group mb-1 col-sm-12 col-md-2">
                                                    <label for="email-addr">Email address</label>
                                                    <br>
                                                    <input type="email" class="form-control" id="email-addr"
                                                        placeholder="Enter email">
                                                </div>
                                                <div class="form-group mb-1 col-sm-12 col-md-2">
                                                    <label for="pass">Password</label>
                                                    <br>
                                                    <input type="password" class="form-control" id="pass"
                                                        placeholder="Password">
                                                </div>
                                                <div class="form-group mb-1 col-sm-12 col-md-2">
                                                    <label for="bio" class="cursor-pointer">Bio</label>
                                                    <br>
                                                    <textarea class="form-control" id="bio" rows="2"></textarea>
                                                </div>
                                                <div class="skin skin-flat form-group mb-1 col-sm-12 col-md-2">
                                                    <label for="tel-input">Gender</label>
                                                    <br>
                                                    <input class="form-control" type="tel" value="1-(555)-555-5555"
                                                        id="tel-input">
                                                </div>
                                                <div class="form-group mb-1 col-sm-12 col-md-2">
                                                    <label for="profession">Profession</label>
                                                    <br>
                                                    <select class="form-control" id="profession">
                                                        <option>Select Option</option>
                                                        <option>Option 1</option>
                                                        <option>Option 2</option>
                                                        <option>Option 3</option>
                                                        <option>Option 4</option>
                                                        <option>Option 5</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-sm-12 col-md-2 text-center mt-2">
                                                    <button type="button" class="btn btn-danger" data-repeater-delete=""> <i
                                                            class="ft-x"></i> Delete</button>
                                                </div>

                                                <hr>
                                            </div>
                                        </div>

                                    </div>
                                </form>

                                <div class="form-group overflow-hidden">
                                    <div class="col-12">
                                        <button data-repeater-create="" class="btn btn-primary">
                                            <i class="ft-plus"></i> Add
                                        </button>
                                    </div>
                                </div>
                            </div>




                        </div>
                    </div>
                </div>

            </div>


        </div>
    </div>

@endsection


