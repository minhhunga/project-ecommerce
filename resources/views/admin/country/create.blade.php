@extends('admin.layout.master')
@section('content')

    <div class="container-fluid">
        <h2>Create Country</h2>
        <div class="row">
            <div class="col-lg-8 col-xlg-9 col-md-7">
                <div class="card">
                    <div class="card-body">
                        
                        <form action="{{ route('country.store') }}" method="POST" class="form-horizontal form-material">
                            @csrf
                            
                            <div class="form-group"> 
                                <label class="col-md-12">Name</label>
                                <div class="col-md-12">
                                    <input type="text" name="name" class="form-control">
                                </div>
                            </div>
                           
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-success">Create country</button>
                                </div>
                            </div> 

                        </form>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection