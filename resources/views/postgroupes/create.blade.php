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
                    <div class="user-profile">
                        <div class="user-avatar">
                            <img src="https://icones.pro/wp-content/uploads/2021/02/facebook-logo-icone.png" alt="Maxwell Admin">
                        </div>
                        <h5 class="user-name">Post groupe</h5>
                        <h6 class="user-email">Date de création : <?php echo $date = date('d-m-y h:i:s');?></h6>
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
            <form action="{{ route('postgroupes.store') }}" method="POST">
            @csrf

                <div class="row gutters">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <h5 class="mb-2 text-primary">Information du post</h5>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="id_post"style="  color:red; font-style: italic;font-weight: bold;">ID Post*(Auto-incrémenté)</label>
                            <input type="text" name="id_post" class="form-control" placeholder="ID post">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="id_campagne"style="  color:red; font-style: italic;font-weight: bold;">ID campagne*(obligatoire)</label>
                            <input type="text" name="id_campagne" class="form-control" placeholder="ID campagne">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="url_post">URL</label>
                            <input type="text" name="url_post" class="form-control" placeholder="URL de post">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="statut_scrappe">Statut scrappé</label>
                            <input type="text" name="statut_scrappe" class="form-control" placeholder="Statut scrappé">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="titre">Titre</label>
                            <input type="text" name="titre" class="form-control" placeholder="Titre">
                        </div>
                    </div>
                </div>
                <div class="row gutters">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <h5 class="mt-3 mb-2 text-primary">Plus</h5>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="type_media">Type média</label>
                            <input type="text" name="type_media" class="form-control" placeholder="Type média">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="legende">Légende</label>
                            <input type="text" name="legende" class="form-control" placeholder="Légende">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="hashtag">Hashtag</label>
                            <input type="text" name="hashtag" class="form-control" placeholder="Hashtag">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="portee">Porte </label>
                            <input type="text" name="portee" class="form-control" placeholder="Porte">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="interaction">Interaction</label>
                            <input type="text" name="interaction" class="form-control" placeholder="Interaction">
                        </div>
                    </div>
                </div>
                <div class="row gutters">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="text-right">
                            <button type="submit" class="btn btn-success">Save</button>
                            <a class="btn btn-secondary" href="{{ route('postgroupes.index') }}"> Back</a>
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
.account-settings .user-profile {
    margin: 0 0 1rem 0;
    padding-bottom: 1rem;
    text-align: center;
}
.account-settings .user-profile .user-avatar {
    margin: 0 0 1rem 0;
}
.account-settings .user-profile .user-avatar img {
    width: 90px;
    height: 90px;
    -webkit-border-radius: 100px;
    -moz-border-radius: 100px;
    border-radius: 100px;
}
.account-settings .user-profile h5.user-name {
    margin: 0 0 0.5rem 0;
}
.account-settings .user-profile h6.user-email {
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
#pageSubmenu1{
visibility:visible;
display:block;
}
#pageSubmenu21{
    visibility:visible;
    display:block;
}
#M14{
background-color: #747474;
}
</style>
@endsection
