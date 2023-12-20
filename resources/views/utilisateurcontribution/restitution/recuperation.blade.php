@extends('layouts.app')

@section('content')

<div
style="
  display: flex;
  flex-direction: column;
  width: 100%;
"
>
<!-- -----------------------------------navbar------------------------------------- -->

<!-- ---------------------------section title-------------------------------------- -->
<div style="align-items: end; display: flex; width: 100%; height: 50px;">       
 <a href="#" style="text-decoration: none; display: flex; justify-content: center; align-items: center; margin-left: 2%; font-size: 20px; color: black; background: rgb(202, 200, 200); height: 50px; width: 50px; border-radius: 50%;"> <i class="fa fa-arrow-left" style=" font-size: 20px;"></i></a>      
</div>
<div
  style="
    display: flex;
    justify-content: center;
    background: #ffff;
    width: 100%;
    height: 100px;
    align-items: end;
  "
>
<h1 style="font-weight: bolder">L’option n’est pas encore disponible</h1>



@endsection
