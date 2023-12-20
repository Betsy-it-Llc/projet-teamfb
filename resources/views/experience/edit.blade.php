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
        <h2 style="margin-bottom:30px">Edit une Experience</h2>
            <div class="main-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <img src="https://icones.pro/wp-content/uploads/2021/02/facebook-logo-icone.png" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
                                    <div class="mt-3">
                                        <h6> </h6>
                                        <p class="text-secondary mb-1"> </p>
                                        <p class="text-muted font-size-sm"> </p>
                                        <button class="btn btn-primary"><a href="">Follow</a> </button>
                                        <a href="{{ route('experience.show',['id_experience'=>$id_experience,'num_facture'=>$num_facture]) }}"><button class="btn btn-outline-primary">More info</button></a>
                                    </div>
                                </div>
                                <hr class="my-4">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0">ID Experience :</h6>
                                        <span class="text-secondary">{{ $experience->id_experience }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">Nom Experience :</h6>
                                        <span class="text-secondary">{{ $experience->nom_experience }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">Statut :</h6>
                                        <span class="text-secondary">{{ $experience->statut_experience }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">Histoire :</h6>
                                        <span class="text-secondary">{{ $experience->histoire_experience }}</span>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                    <form action="{{ route('experience.update',['id_experience'=>$id_experience,'num_facture'=>$num_facture]) }}" method="POST">
                    @csrf
                    @method('PUT')
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Statut Experience </h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input name="current_stat" type="hidden" value="{{ $experience->id_statut_experience }}">
                                        <select name="exp_stat" id="pet-select" style="margin-left:0px;background-color:white;margin-bottom:20px;width:305px;height:50px;float:left;border-radius:4px;">

                                            @if (is_null(old('exp_stat')))
                                                @foreach ($statuts as $stat)
                                                @if ($stat->id_statut_experience==$experience->id_statut_experience)
                                                    <option value="{{ $stat->id_statut_experience }}"{{old('') == $stat->id_statut_experience ? "selected" : ""}}>{{ $stat->statut_experience }}</option>
                                                @else
                                                    <option value="{{ $stat->id_statut_experience }}"{{old('') == $stat->id_statut_experience ? "selected" : ""}}>{{ $stat->statut_experience }}</option>
                                                @endif
                                                @endforeach
                                            @else
                                                @foreach ($statuts as $stat)
                                                @if ($stat->id_statut_experience==old('exp_stat'))
                                                    <option value="{{ $stat->id_statut_experience }}"{{old('') == $stat->id_statut_experience ? "selected" : ""}}>{{ $stat->statut_experience }}</option>
                                                @else
                                                    <option value="{{ $stat->id_statut_experience }}"{{old('') == $stat->id_statut_experience ? "selected" : ""}}>{{ $stat->statut_experience }}</option>
                                                @endif
                                                @endforeach
                                            @endif

                                        </select>
                                        <input type="submit" class="btn btn-success" value="Save Changes">
                                    </div>
                                </div>
                                </form>
                             
                                <form action="{{route('experience.updatedatereservation')}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input name="id_experience" type="hidden" value="{{ $experience->id_experience }}">
                                    <input name="num_facture" type="hidden" value="{{ $num_facture}}">
                                  

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Date Reservation</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="date" name="date_reservation" value="{{ old('date_reservation') }}" class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Heure Reservation</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input name="current_stat" type="hidden" value="{{ $experience->id_statut_experience }}">
                                        <select name="heure_reservation" id="pet-select" style="margin-left:0px;background-color:white;margin-bottom:20px;width:305px;height:50px;float:left;border-radius:4px;">
                                            <option value="" >Selectionnez une heure</option>
                                           @php
                                               $heure = 8;
                                               $min = 00;
                                           @endphp
                                            @while ($heure<=22)
                                                @if ($heure<10)
                                                    @if ($min==0)
                                                    @php
                                                        $time = "0".$heure.":00:00";
                                                    @endphp
                                                        <option value="{{$time}}" {{ old('heure_reservation') == $time ? 'selected' : '' }}>0{{ $heure }}:00</option>
                                                    @else
                                                    @php
                                                        $time = "0".$heure.":30:00";
                                                    @endphp
                                                        <option value="{{$time}}" {{ old('heure_reservation') == $time ? 'selected' : '' }}>0{{ $heure }}:30</option>
                                                    @endif
                                                @else
                                                    @if ($min==0)
                                                    @php
                                                        $time = "".$heure.":00:00";
                                                    @endphp
                                                        <option value="{{$time}}" {{ old('heure_reservation') == $time ? 'selected' : '' }}>{{ $heure }}:00</option>
                                                    @else
                                                    @php
                                                        $time = "".$heure.":30:00"
                                                    @endphp
                                                        <option value="{{$time}}" {{ old('heure_reservation') == $time ? 'selected' : '' }}>{{ $heure }}:30</option>
                                                    @endif
                                                @endif
                                                @php
                                                    $min+=30;
                                                    if (($heure==22)&&($min>=0))
                                                    {
                                                        break;
                                                    }
                                                    if ($min>=60)
                                                    {
                                                        $min=0;
                                                        $heure+=1;
                                                    }
                                                @endphp
                                            @endwhile

                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Durée Reservation</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input name="current_stat" type="hidden" value="{{ $experience->id_statut_experience }}">
                                        <select name="duree_reservation" id="pet-select" style="margin-left:0px;background-color:white;margin-bottom:20px;width:305px;height:50px;float:left;border-radius:4px;">
    <option value="" selected>Selectionnez une durée</option>
    @php
        $heure = 0;
        $min = 30;
        $selectedValue = ""; // Valeur par défaut
    @endphp
    @while ($heure <= 6)
        @php
            $duree = ($heure < 10 ? '0' : '') . $heure . ":" . ($min === 0 ? '00' : '30') . ":00";
            $isSelected = old('duree_reservation') === $duree ? 'selected' : '';
            if($isSelected===''){
                if ((old('duree_reservation') === $duree) || ($pack_experience->id_pack == 1 && $pack_experience->nb_participants <= 2 && $heure === 1 && $min === 0)) {
                    // Sélection par défaut pour id_pack == 2 et 1 heure
                    $isSelected = 'selected';
                    $selectedValue = $duree; // Mémoriser la valeur sélectionnée
                }
                if ((old('duree_reservation') === $duree) || ($pack_experience->id_pack == 2 && $pack_experience->nb_participants <= 2 && $heure === 1 && $min === 30)) {
                    // Sélection par défaut pour id_pack == 2 et 1 heure
                    $isSelected = 'selected';
                    $selectedValue = $duree; // Mémoriser la valeur sélectionnée
                }
                if ((old('duree_reservation') === $duree) || ($pack_experience->id_pack == 3 && $pack_experience->nb_participants <= 2 && $heure === 2 && $min === 30)) {
                    // Sélection par défaut pour id_pack == 2 et 1 heure
                    $isSelected = 'selected';
                    $selectedValue = $duree; // Mémoriser la valeur sélectionnée
                }
            }
        @endphp

        <option value="{{$duree}}" {{ $isSelected }}>
            @if ($heure === 0 && $min === 30)
                Une demi-heure
            @else
                {{ $heure }} heure{{ $heure > 1 ? 's' : '' }}{{ $min === 30 ? ' et demie' : '' }}
            @endif
        </option>

        @php
            $min += 30;
            if (($heure === 6) && ($min >= 0)) {
                break;
            }
            if ($min >= 60) {
                $min = 0;
                $heure += 1;
            }
        @endphp
    @endwhile
</select>
                                    </div>
                                </div>




                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="submit" class="btn btn-success" value="Save Changes">
                                        <a class="btn btn-primary" href="{{ route('experience.index') }}"> Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>



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
#pageSubmenu10{
visibility:visible;
display:block;
}
#pageSubmenu13{
            visibility:visible;
            display:block;
        }
#pageSubmenu18{
            visibility:visible;
            display:block;
        }
#M50{
background-color: #747474;
}
</style>
@endsection

