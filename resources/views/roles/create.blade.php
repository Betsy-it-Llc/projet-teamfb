@extends('layouts.navadmin')
@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container">
        <div class="row gutters">
        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
        <div class="card h-100">
            <div class="card-body">
                <div class="account-settings">
                    <div class="role-profile">
                        <div class="role-avatar">
                            <img src="https://icon-library.com/images/persona-icon/persona-icon-26.jpg" alt="Maxwell Admin">
                        </div>
                        <h5 class="role-name">Nouveau role</h5>
                        <h6 class="role-email">Date de création : <?php echo $date = date('d-m-y h:i:s');?></h6>
                    </div>
                    <div class="about">
                        <h5>Info</h5>
                        <p>En appuyant sur 'Ajouter', le groupe va ....</p>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
        <div class="card h-100">
            <div class="card-body">
            <form action="{{ route('roles.store') }}" method="POST">
            @csrf

                <div class="row gutters">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <h5 class="mb-2 text-primary">Information</h5>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="name"style="  color:red; font-style: italic;font-weight: bold;">Nom*(obligatoire)</label>
                            <input type="text" name="name" class="form-control" placeholder="Nom">
                        </div>
                    </div>
                    
                </div>

                <div class="row gutters">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="text-right">
                            <button type="submit" class="btn btn-success">Save</button>
                            <a class="btn btn-secondary" href="{{ route('roles.index') }}"> Back</a>
                        </div>
                    </div>
                </div>
                </form>

            </div>
        </div>
        </div>
        </div>
        </div>



<style>

body {
    margin: 0;
    color: #2e323c;
    background: #f5f6fa;
    position: relative;
    height: 100%;
    width : 100%;
}
.account-settings .role-profile {
    margin: 0 0 1rem 0;
    padding-bottom: 1rem;
    text-align: center;
}
.account-settings .role-profile .role-avatar {
    margin: 0 0 1rem 0;
}
.account-settings .role-profile .role-avatar img {
    width: 90px;
    height: 90px;
    -webkit-border-radius: 100px;
    -moz-border-radius: 100px;
    border-radius: 100px;
}
.account-settings .role-profile h5.role-name {
    margin: 0 0 0.5rem 0;
}
.account-settings .role-profile h6.role-email {
    margin: 0;
    font-size: 0.8rem;
    font-weight: 400;
    color: #9fa8b9;
}
.account-settings .about {
    margin: 2rem 0 0 0;
    text-align: center;
}
.account-settings .about h5 {
    margin: 0 0 15px 0;
    color: #007ae1;
}
.account-settings .about p {
    font-size: 0.825rem;
}
.form-control {
    border: 1px solid #cfd1d8;
    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
    border-radius: 2px;
    font-size: .825rem;
    background: #ffffff;
    color: #2e323c;
}

.card {
    background: #ffffff;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
    border: 0;
    margin-bottom: 1rem;
}

</style>
<style>
#pageSubmenu7{
visibility:visible;
display:block;
}
#pageSubmenu19{
visibility:visible;
display:block;
}
#M35{
background-color: #747474;
}
</style>
@endsection
