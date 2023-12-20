@extends('layouts.navadmin')

@section('content')
    <div class="row">

        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Liste des segmentations</h2>
            </div>
            <!-- Recherche multicritère -->
    <section class="search-sec" style="margin : 20px ; font-size : 13px">
        <div class="container">
            <h6>Recherche multicritère</h6>
            <form action="{{ url('/segementations') }}" method="get" novalidate="novalidate">
            <div class="row">
                    <div class="col-lg-50">
                        <div class="row">
                            <div class="">
                                <input class="form-control" type="text" name="multisearchid" id="ID" placeholder="ID">
                            </div>
                            <div class="">
                                <input class="form-control" type="text" name="multisearchnom" id="nom" placeholder="Nom">
                            </div>
                            <div class="">
                                <select data-trigger="" name="multisearchetat" class="form-control" >
                                    <option disabled selected>Critère </option>
                                    <option>avec ambassadeur</option>
                                    <option>sans ambassadeur</option>
                                    <option>Non filtré</option>
                                </select>
                            </div>

                            <div class="">
                                <button type="submit" class="btn btn-success wrn-btn" style="margin-left : 5px">Search</button>
                                <button type="button" class="btn btn-danger wrn-btn"><a href="{/{ route('segementations.index') }}">Reset</a></button>
                            </div>

                        </div>
                    </div>

            </div>
            <div  style="margin-top : 20px">
                        <label for="perPage" style="font-size : 14px; font-weight : 500">Nombre de Lignes</label>
                        <select data-trigger="" name="perPage" id="perPage" style="width : 50px"  onchange="this.form.submit()">
                            <option value="10" {{ Request::get('perPage') == '10' ? 'selected' : '' }}>10</option>
                            <option value="25" {{ Request::get('perPage') == '25' ? 'selected' : '' }}>25</option>
                            <option value="50" {{ Request::get('perPage') == '50' ? 'selected' : '' }}>50</option>
                            <option value="100" {{ Request::get('perPage') == '100' ? 'selected' : '' }}>100</option>
                            <option value="250" {{ Request::get('perPage') == '250' ? 'selected' : '' }}>250</option>
                            <option value="9000000" {{ Request::get('perPage') == '9000000' ? 'selected' : '' }}>All</option>
                        </select>
            </div>
            </form>
        </div>
    </section>
    <!-- Recherche Multicritères FIN -->

            <!-- Filtres groupes -->
            <div class="container" style="font-size : 12px ; margin-top : 35px ; margin-bottom : 20px">
                <div class="row">
                <ul class="ds-btn" style="list-style : none ; display : flex">
                    <li style="margin-right : 15px ">

                        <a class="btn btn-lg btn-dark" href="{{ route('groupesanssegments.index') }}"  style=" font-size : 15px">
                        <i class="glyphicon glyphicon-dashboard pull-left"></i>
                                <span>Groupe sans segments<br><small>
                                <?php
                                use Illuminate\Support\Facades\DB;
                                $countt=DB::connection('mysql')->table('groupes')
                                    ->select('groupes.nom')
                                    ->leftjoin('ambassadeur_groupe','groupes.id_groupe' , '=' , 'ambassadeur_groupe.id_groupe')
                                    ->leftjoin('utilisateur','ambassadeur_groupe.id_ambassadeur' , '=' , 'utilisateur.id_utilisateur')
                                    ->leftjoin('segment_groupe','groupes.id_groupe' , '=' , 'segment_groupe.id_groupe')
                                    ->leftjoin('segements','segment_groupe.id_segment' , '=' , 'segements.id_segment')
                                    ->whereNull('segements.id_segment')->distinct()-> count('groupes.id_groupe');
                                echo ($countt);
                            ?>   Groupes
                                </small></span>
                        </a>
                    </li>
                </ul>
                </div>
            </div>
            <!-- Filtres FIN -->
            <button type="submit" formaction="/deleteall_c" class="btn btn-danger" style="margin-bottom : 14px"  onclick="return confirm('Are you sure you want to delete ?')"><i class="fas fa-trash" style="margin-right : 10px"></i><i class="fas fa-arrow-down"></i></button>
            <a class="btn btn-info" href="{{ route('segementations.create') }}"  style="margin-bottom : 14px "> Ajouter</a>
            <br>
            <p> Il y'a : <?php $countt = DB::connection('mysql')->table('segementations')
                    ->count('segementations.id_segmentation'); echo "".$countt; ?> segementations
            </p>

        </div>
    </div>
   <br><br>
    @if ($message = Session::get('success'))S
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="table">
        <table class="table">
            <thead class="thead" style="background:#bfbfbf">
            <tr>
                <th scope="col"><input type="checkbox" class="selectall"></th>
                <th>N°</th>
                <th scope="col">ID</th>
                <th scope="col">Nom</th>
                <th scope="col">Critères</th>
                <th scope="col">Description</th>
                <th scope="col">Groupe</th>
                <th>Actions</th>
                <th width="150px"></th>
            </tr>
            </thead>
            @foreach ($segementations as $segementation)

            <tbody>
            <tr>
                <th scope="row"><input type="checkbox" name="ids[]" class="selectbox"
                    value="{{ $segementation->id_segmentation}}">
                </th>
                <td>{{ $loop->index + 1 }}</td>
                <th  scope="row">{{ $segementation->id_segmentation }}</th>
                <td>{{ $segementation->nom_segmentation }}</td>
                <td>{{ $segementation->criteres }}</td>
                <td>
                    <pre style="white-space: pre-line; text-align:left; margin:0">{{ $segementation->description }}</pre>
                </td>
                <td> <?php
                        $aaaa = $segementation->nom_segmentation;
                        $countt = DB::connection('mysql')->table('groupes')
                            ->leftJoin('ambassadeur_groupe', 'groupes.id_groupe',
                            '=', 'ambassadeur_groupe.id_groupe')
                            ->leftJoin('utilisateur', 'ambassadeur_groupe.id_ambassadeur',
                                '=', 'utilisateur.id_utilisateur')
                            ->leftJoin('segment_groupe', 'groupes.id_groupe',
                                '=', 'segment_groupe.id_groupe')
                            ->leftJoin('segements', 'segment_groupe.id_segment',
                                '=', 'segements.id_segment')
                            ->leftJoin('segementations', 'segements.nom_segmentation',
                                '=', 'segementations.nom_segmentation')
                            ->where('segementations.nom_segmentation', $aaaa)
                            ->count('groupes.id_groupe');
                        echo $countt;
                    ?>
                </td>
                <td>
                    <a style="background-color : #fff ; border : #fff" class="btn btn-primary" href="{{ route('segementations.edit', $segementation->id_segmentation) }} "><i style="color : #e6ac00"  class="fas fa-edit"></i></a>
                    <button formaction="{{ route('segementations.destroy',$segementation->id_segmentation) }}"  style="background-color : #fff ; border : #fff"  type="submit" class="btn btn-danger" onclick="return confirm('Etes-vous sur de vouloir supprimmer ?')"><i style="color : #cc3300"   class="fas fa-trash"></i></button>
                    <a style="background-color : #fff ; border : #fff" class="btn btn-info" id="road" href="{{ route('segementations.show',$segementation->id_segmentation) }}"><i style="color : #4d94ff" class="fas fa-info"></i></a>
                </td>

            </tr>
            </tbody>
            @endforeach
        </table>
    </div>


    <script type="text/javascript">
        $('.selectall').click(function(){
            $('.selectbox').prop('checked',$(this).prop('checked'));
            $('.selectall2').prop('checked',$(this).prop('checked'));
        })
        $('.selectall2').click(function(){
            $('.selectbox').prop('checked',$(this).prop('checked'));
            $('.selectall').prop('checked',$(this).prop('checked'));
        })
        $('.selectbox').change(function(){
            var total = $('.selectbox').length;
            var number = $('.selectbox:checked').length;
            if(total == number){
                $('.selectall').prop('checked',true);
                $('.selectall2').prop('checked',true);
            } else {
                $('.selectall').prop('checked',false);
                $('.selectall2').prop('checked',false);

            }
        })
        </script>
        <style>
#pageSubmenu5{
visibility:visible;
display:block;
}
#pageSubmenu20{
    visibility:visible;
    display:block;
}
#M30{
background-color: #747474;
}
</style>
    @endsection


