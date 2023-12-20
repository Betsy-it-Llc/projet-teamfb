
@extends('layouts.navadmin')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Team</h2>
            </div>
            {{-- <section class="search-sec" style="margin : 20px ; font-size : 13px">
                <div class="container">
                    <h6>Recherche multicritère</h6>
                    <form action="/searchuser" method="get" novalidate="novalidate">
                        <div class="row">
                            <div class="col-lg-50">
                                <div class="row">
                                    <div class="">
                                        <input class="form-control" type="text" name="search" id="name"
                                            placeholder="name">
                                    </div>
                                    <div class="">
                                        <button type="submit" class="btn btn-success wrn-btn"
                                            style="margin-left : 5px">Search</button>
                                        {{--  <button type="button" class="btn btn-danger wrn-btn"><a
                                                href="{{ route('campagnes.index') }}">Reset</a></button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </section> --}}
        </div>
    </div>

    <br><br>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="table" style="margin : 20px">


        <form method="post">
            @csrf
            @method('DELETE')
            <button type="submit" formaction="/deleteall" class="btn btn-danger" style="margin-bottom : 14px"
                onclick="return confirm('Are you sure you want to delete ?')"><i class="fas fa-trash"
                    style="margin-right : 10px"></i><i class="fas fa-arrow-down"></i></button>
            <a class="btn btn-success" href="{{ route('permissions.create') }}" style="margin-bottom : 14px "> Ajouter</a>
            <br><br>
            <p> Il y'a :<?php
            use Illuminate\Support\Facades\DB; 
            $countt = DB::connection('mysql')->table('permissions')
            ->count('permissions.id');
            echo $countt;
            ?> permissions

            <table class="table">
                <thead class="thead" style="background: #c1f0f0">
                    <tr>
                        <th scope="col"><input type="checkbox" class="selectall"></th>
                        <th scope="col">N°</th>
                        <th>Nom</th>
                        <th>Action</th>
                    </tr>
                </thead>
                @foreach ($data as $key => $value)
                    <tr style="font-size : 12px">
                        <th scope="row"><input type="checkbox" name="ids[]" class="selectbox"
                                value="{{ $value->id }}"></th>
                        <td>{{ ++$i }}</td>

                        <td>{{ $value->name }}</td>

                        <td>
                            <a style="background-color : #fff ; border : #fff" class="btn btn-info"
                                href="{{ route('permissions.show', $value->id) }}"><i style="color : #4d94ff"
                                    class="fas fa-info"></i></a>
                            <a style="background-color : #fff ; border : #fff" class="btn btn-primary"
                                href="{{ route('permissions.edit', $value->id) }}"><i style="color : #e6ac00"
                                    class="fas fa-edit"></i></a>
                            <button formaction="{{ route('permissions.destroy', $value->id) }}"
                                style="background-color : #fff ; border : #fff" type="submit" class="btn btn-danger"
                                onclick="return confirm('Are you sure you want to delete ?')"><i style="color : #cc3300"
                                    class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                @endforeach

            </table>
        </form>

        <script type="text/javascript">
            $('.selectall').click(function() {
                $('.selectbox').prop('checked', $(this).prop('checked'));
                $('.selectall2').prop('checked', $(this).prop('checked'));
            })
            $('.selectall2').click(function() {
                $('.selectbox').prop('checked', $(this).prop('checked'));
                $('.selectall').prop('checked', $(this).prop('checked'));
            })
            $('.selectbox').change(function() {
                var total = $('.selectbox').length;
                var number = $('.selectbox:checked').length;
                if (total == number) {
                    $('.selectall').prop('checked', true);
                    $('.selectall2').prop('checked', true);
                } else {
                    $('.selectall').prop('checked', false);
                    $('.selectall2').prop('checked', false);

                }
            })
        </script>
        <style>
#pageSubmenu7{
visibility:visible;
display:block;
}
#M35{
background-color: #747474;
}
</style>
    @endsection
