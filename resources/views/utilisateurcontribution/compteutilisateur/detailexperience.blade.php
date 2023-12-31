@extends('layouts.appwithtailwind')

@section('content')


      
<main>
    <header>
        <div class="flex justify-start ml-12 telL:ml-28">
            <p class="text-3xl md:text-3xl text-black">
                détail
            </p>
        </div>
        <h1 class="h1-maj header-maj">
            mes experiences
        </h1>
        <div class="flex justify-center">
            <p class="text-2xl text-black">
                Pour la Vie
            </p>
        </div>
        <div class="text-right">
            <span class="somme-cagnotte-disponible">
                {{ $montantTotalDisponible }}€
            </span>
            <span class="text-montant-disponible">
                Montant disponible
            </span>
            <span>
                <h4 class="text-montant-disponible font-bold"> {{$nombreTotalContributions}} </h4>
                <p class="text-montant-disponible">Contributions </p>
            </span>
        </div>
    </header>
    <div class="grid grid-cols-1 grid-rows-2 gap-0 ml-10 mt-10">
        <div class="flex items-center space-x-2">
            <svg width="40" height="40" viewBox="0 0 58 58" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M44.4306 30.2083H39.0391C38.6959 30.2083 38.4091 30.0923 38.1787 29.8603C37.9467 29.6283 37.8307 29.3407 37.8307 28.9976C37.8307 28.6544 37.9467 28.3676 38.1787 28.1372C38.4091 27.9068 38.6959 27.7916 39.0391 27.7916H44.4282C44.7714 27.7916 45.059 27.9076 45.291 28.1396C45.523 28.3716 45.639 28.6592 45.639 29.0024C45.639 29.3456 45.523 29.6323 45.291 29.8627C45.059 30.0931 44.7722 30.2083 44.4306 30.2083ZM34.9573 40.1819C35.1748 39.8967 35.4431 39.7292 35.7621 39.6792C36.0811 39.6309 36.3831 39.7147 36.6683 39.9306L40.9531 43.1568C41.2382 43.3727 41.4058 43.6401 41.4557 43.9591C41.5041 44.2781 41.4203 44.5802 41.2044 44.8654C40.9869 45.1506 40.7186 45.3181 40.3996 45.3681C40.0806 45.4164 39.7786 45.3326 39.4934 45.1167L35.2086 41.8929C34.9235 41.6754 34.7567 41.4071 34.7084 41.0881C34.6584 40.7691 34.7414 40.4671 34.9573 40.1819ZM40.7694 14.6571L36.4822 17.8833C36.1971 18.1008 35.895 18.1846 35.576 18.1346C35.257 18.0863 34.9887 17.9188 34.7712 17.632C34.5553 17.3468 34.4724 17.0447 34.5223 16.7257C34.5706 16.4067 34.7374 16.1385 35.0226 15.921L39.3073 12.6971C39.5925 12.4796 39.8946 12.3959 40.2136 12.4458C40.5326 12.4941 40.8008 12.6617 41.0183 12.9485C41.2358 13.2336 41.3196 13.5357 41.2696 13.8547C41.2213 14.1737 41.0537 14.4412 40.767 14.6571H40.7694ZM18.2219 33.8333H11.895C11.3424 33.8333 10.8792 33.6464 10.5055 33.2726C10.1301 32.8989 9.94238 32.4349 9.94238 31.8806V26.1193C9.94238 25.5651 10.1301 25.1011 10.5055 24.7273C10.8809 24.3535 11.3449 24.1666 11.8975 24.1666H18.2171L24.7058 17.6779C25.0989 17.2848 25.5565 17.1946 26.0785 17.4072C26.6005 17.6199 26.8615 18.0001 26.8615 18.5479V39.4521C26.8615 39.9998 26.6005 40.3801 26.0785 40.5927C25.5565 40.8054 25.0989 40.7152 24.7058 40.3221L18.2171 33.8333H18.2219ZM24.4472 21.3875L19.249 26.5833H12.3615V31.4166H19.249L24.4448 36.6125V21.3875H24.4472Z" fill="black"/>
            </svg>
            <a href="#" class="text-xl font-sans text-slate-800">Ajouter une actualité</a>
        </div>
        <div class="flex items-center space-x-2">
            <svg width="40" height="40" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M16.1992 21C17.8561 21 19.1992 19.6569 19.1992 18C19.1992 16.3431 17.8561 15 16.1992 15C14.5424 15 13.1992 16.3431 13.1992 18C13.1992 19.6569 14.5424 21 16.1992 21Z" stroke="black"/>
                <path d="M6.29791 8.82002L6.67291 8.16902C6.52568 8.08389 6.35389 8.05133 6.18573 8.07668C6.01756 8.10203 5.86301 8.18378 5.74741 8.30852L6.29791 8.82002ZM3.29941 14.016L2.58241 13.794C2.5325 13.9563 2.53916 14.1308 2.60129 14.2888C2.66341 14.4469 2.77733 14.5791 2.92441 14.664L3.29941 14.016ZM3.29641 21.9825L2.92141 21.333C2.77402 21.418 2.65988 21.5505 2.59773 21.7089C2.53559 21.8672 2.52913 22.042 2.57941 22.2045L3.29641 21.9825ZM6.29641 27.1785L5.74591 27.6885C5.86151 27.8133 6.01606 27.895 6.18423 27.9203C6.3524 27.9457 6.52418 27.9131 6.67141 27.828L6.29641 27.1785ZM13.1964 31.161H12.4464C12.4463 31.3313 12.5042 31.4966 12.6105 31.6296C12.7168 31.7627 12.8653 31.8555 13.0314 31.893L13.1964 31.161ZM19.1979 31.164L19.3644 31.896C19.5303 31.8583 19.6784 31.7652 19.7844 31.6322C19.8904 31.4992 19.9481 31.3341 19.9479 31.164H19.1994H19.1979ZM26.0994 27.18L25.7244 27.8295C25.8716 27.9146 26.0434 27.9472 26.2116 27.9218C26.3798 27.8965 26.5343 27.8148 26.6499 27.69L26.0994 27.18ZM29.0964 21.981L29.8134 22.203C29.8633 22.0407 29.8567 21.8663 29.7945 21.7082C29.7324 21.5502 29.6185 21.4179 29.4714 21.333L29.0964 21.981ZM29.0994 14.0145L29.4744 14.664C29.6218 14.5791 29.7359 14.4465 29.7981 14.2882C29.8602 14.1298 29.8667 13.955 29.8164 13.7925L29.0994 14.0145ZM26.0994 8.81701L26.6499 8.30702C26.5343 8.18228 26.3798 8.10053 26.2116 8.07518C26.0434 8.04983 25.8716 8.08239 25.7244 8.16752L26.0994 8.81701ZM19.1994 4.83752H19.9494C19.9492 4.66767 19.8914 4.50292 19.7854 4.37022C19.6794 4.23752 19.5315 4.14472 19.3659 4.10702L19.1994 4.83752ZM13.1994 4.83452L13.0329 4.10252C12.8668 4.13998 12.7183 4.23287 12.612 4.36591C12.5057 4.49895 12.4478 4.66421 12.4479 4.83452H13.1979H13.1994ZM4.01641 14.238C4.5792 12.4097 5.54665 10.7317 6.84691 9.32852L5.74741 8.30852C4.2937 9.87659 3.21192 11.7505 2.58241 13.794L4.01641 14.238ZM5.15641 24.375C4.67971 23.5493 4.29683 22.6728 4.01491 21.762L2.58091 22.206C2.89691 23.2236 3.32557 24.2026 3.85891 25.125L5.15641 24.375ZM6.84841 26.67C6.20119 25.9704 5.63267 25.2006 5.15641 24.375L3.85891 25.125C4.39087 26.0477 5.0243 26.9081 5.74741 27.69L6.84841 26.67ZM19.0329 30.435C17.1677 30.8597 15.2307 30.8586 13.3659 30.432L13.0329 31.893C15.1168 32.37 17.2813 32.3715 19.3659 31.8975L19.0329 30.435ZM28.3824 21.762C27.8196 23.5903 26.8522 25.2684 25.5519 26.6715L26.6514 27.6915C28.1051 26.1234 29.1869 24.248 29.8164 22.2045L28.3824 21.762ZM27.2424 11.625C27.7284 12.4695 28.1079 13.3455 28.3854 14.238L29.8179 13.794C29.502 12.7764 29.0734 11.7973 28.5399 10.875L27.2424 11.625ZM25.5504 9.33001C26.1981 10.0293 26.7667 10.7991 27.2424 11.625L28.5399 10.875C28.008 9.95229 27.3746 9.09195 26.6514 8.31002L25.5504 9.33001ZM13.3659 5.56502C15.2312 5.14037 17.1681 5.1414 19.0329 5.56801L19.3659 4.10702C17.282 3.63 15.1175 3.62846 13.0329 4.10252L13.3659 5.56502ZM13.9494 7.60802V4.83302H12.4494V7.60802H13.9494ZM9.07441 9.55502L6.67291 8.16902L5.92291 9.46652L8.32291 10.854L9.07441 9.55502ZM5.32441 19.947L2.92141 21.333L3.67291 22.632L6.07291 21.246L5.32441 19.947ZM6.07441 14.751L3.67441 13.3665L2.92441 14.6655L5.32441 16.05L6.07441 14.751ZM13.9494 31.161V28.3905H12.4494V31.161H13.9494ZM8.32441 25.143L5.92291 26.529L6.67291 27.828L9.07291 26.442L8.32441 25.143ZM26.4759 26.5305L24.0744 25.143L23.3244 26.4435L25.7244 27.8295L26.4759 26.5305ZM19.9494 31.1655V28.3905H18.4494V31.1655H19.9494ZM28.7259 13.365L26.3244 14.751L27.0744 16.05L29.4744 14.664L28.7259 13.365ZM29.4729 21.3315L27.0744 19.95L26.3244 21.249L28.7244 22.6335L29.4744 21.3345L29.4729 21.3315ZM19.9494 7.60802V4.83752H18.4494V7.60802H19.9494ZM25.7259 8.16902L23.3244 9.55651L24.0744 10.8555L26.4759 9.46801L25.7259 8.16902ZM18.4494 7.60802C18.4494 10.494 21.5739 12.2985 24.0744 10.8555L23.3244 9.55651C22.9823 9.75406 22.5941 9.85802 22.1991 9.85796C21.804 9.85789 21.4159 9.7538 21.0738 9.55615C20.7317 9.3585 20.4477 9.07427 20.2503 8.73202C20.0529 8.38978 19.9492 8.0031 19.9494 7.60802H18.4494ZM26.3244 14.7525C23.8239 16.1955 23.8239 19.8045 26.3244 21.2475L27.0744 19.9485C26.7324 19.751 26.4484 19.467 26.2509 19.125C26.0535 18.7829 25.9495 18.395 25.9495 18C25.9495 17.6051 26.0535 17.2171 26.2509 16.8751C26.4484 16.533 26.7324 16.249 27.0744 16.0515L26.3244 14.7525ZM24.0744 25.1445C21.5739 23.7015 18.4494 25.503 18.4494 28.3905H19.9494C19.9494 27.9956 20.0534 27.6091 20.2509 27.267C20.4484 26.925 20.7324 26.641 21.0744 26.4435C21.4165 26.246 21.8045 26.1421 22.1994 26.1421C22.5944 26.1421 22.9824 26.246 23.3244 26.4435L24.0744 25.1445ZM13.9494 28.3905C13.9494 25.5045 10.8249 23.7015 8.32441 25.1445L9.07441 26.4435C9.41656 26.246 9.80469 26.142 10.1998 26.1421C10.5949 26.1421 10.9829 26.2462 11.325 26.4439C11.6671 26.6415 11.9511 26.9258 12.1485 27.268C12.3459 27.6103 12.4497 27.9984 12.4494 28.3935H13.9494V28.3905ZM6.07441 21.2475C8.57491 19.8045 8.57491 16.1955 6.07441 14.7525L5.32441 16.0515C6.82441 16.917 6.82441 19.08 5.32441 19.947L6.07441 21.2475ZM12.4494 7.60802C12.4491 8.00284 12.345 8.39064 12.1474 8.73247C11.9498 9.0743 11.6657 9.35811 11.3237 9.5554C10.9817 9.7527 10.5938 9.85653 10.199 9.85646C9.8042 9.85639 9.41634 9.75243 9.07441 9.55502L8.32441 10.8555C10.8249 12.2985 13.9494 10.4955 13.9494 7.60802H12.4494Z" fill="black"/>
            </svg>
            <a href="#" class="text-xl font-sans text-slate-800">Éditer les paramètres</a>
        </div>
    </div>
    <div class="pt-5 pb-10 flex justify-center">
        <div class="bg-slate-50 w-4/5 h-48 telL:w-96 telxl:w-10/12 relative tel:left-0 telL:left-0 telxl:left-0 2xl:left-2">
            <div class="bg-gray-200 rounded-lg w-5/6 h-40 tel:w-72 telL:w-80 tel:h-32 telxl:w-96 telxl:h-32 md:w-96 md:h-32 lg:w-11/12 lg:h-40 relative tel:left-5 telL:left-6 telL:top-6 2xl:left-10 2xl:top-4">
                <div class="bg-gray-100 float-right w-16 h-20 tel:w-16 tel:h-20 relative tel:top-5 tel:right-2 lg:top-8 2xl:top-8 2xl:right-2">
                    <p class="text-base font-sans text-slate-800 text-center"><a href="{{route('contributions', ['idExperience' => $experience->id_experience])}}" >Voir</a></p>
                    <p class="text-xs font-sans text-slate-800 text-left relative left-3">70</p>
                    <button id="heartButton" class="relative focus:outline-none float-right right-3 bottom-7">
                        <span class="heart text-3xl text-gray-400 transition duration-300 transform hover:scale-110 active:text-red-500 active:scale-100">&hearts;</span>
                    </button>
                    <p class="text-xs font-sans text-slate-800 text-left relative left-3 top-1">{{$nombreTotalContributions}} Cont</p>
                    <p class="text-xs font-sans text-slate-800 text-left relative left-3 top-1">14 %</p>
                    <script>
                        const heartButton = document.getElementById('heartButton');
                        const heart = heartButton.querySelector('.heart');
                        let isFilled = false;

                        heartButton.addEventListener('click', () => {
                            isFilled = !isFilled;
                            if (isFilled) {
                                heart.classList.add('heart-filled');
                            } else {
                                heart.classList.remove('heart-filled');
                            }
                        });
                    </script>
                </div>
                <div class="bg-gray-50 w-44 h-28 tel:w-20 tel:h-20 telxl:w-28 md:w-36 lg:w-48 lg:h-28 relative tel:left-2 tel:top-5 2xl:top-5 2xl:left-3"></div>
                <div class="relative tel:left-24 tel:bottom-16 telL:bottom-16 telL:left-24 telxl:left-36 telxl:bottom-16 sm:bottom-16 sm:left-32 md:left-40 md:bottom-20 lg:bottom-24 lg:left-52 2xl:left-52">
                    @foreach ($experience->contents_experiences as $contentExperience)
                    @if ($contentExperience->type === 'storytelling')
                        @foreach ($contentExperience->storytelling->tag_storytellings as $tagStoryTelling)
                            @if ($tagStoryTelling->tag_story->tag === 'titre chanson')
                                <h2 class="text-2xl tel:text-xl font-sans font-extrabold text-slate-800 text-left relative 2xl:bottom-3">
                                    {{ $contentExperience->storytelling->description }}
                                </h2>
                            @endif
                        @endforeach
                    @endif
                @endforeach
                    <p class="text-xl tel:text-base font-sans text-slate-800 text-left relative 2xl:bottom-3">{{$montantTotalContributions}}€ Récoltés</p>
                    <p class="text-xs tel:text-xs font-sans text-slate-800 text-left relative 2xl:bottom-3">{{ $experience->projet->date_creation->format('d-m-Y') }}</p>
                    <p class="text-xl tel:text-base font-sans text-slate-800 text-left relative md:top-3 2xl:top-2">Type: {{$experience->projet->types_projet->valeur}}</p>
                </div>
            </div>
        </div>
    </div>
    @foreach ($experience->projet->cagnottes as $cagnotte)
    <div class="flex flex-wrap gap-2  mb-5">
        <div class="div-cadre ">
            <p class="nombre-cadre">3</p>
            <p class="text-cadre">Partage</p>
        </div>
        <div class="div-cadre">
            <p class="nombre-cadre">240</p>
            <p class="text-cadre">Nombre de j'aime</p>
        </div>
        <div class="div-cadre">
            <p class="nombre-cadre">245</p>
            <p class="text-cadre">Nombre de commentaire</p>
        </div>
        <div class="div-cadre ">
            <a href="{{route ('utilisateur.contributeur.cagnotte',[ 'id_cagnotte' => $cagnotte->id_cagnotte ])}}">
            <p class="text-cadre mt-8">Voir les Contributeur</p>
            </a>
        </div>
        <div class="div-cadre">
            <a href="{{ route('utilisateur.contribution',  ['idCagnotte' => $cagnotte->id_cagnotte]) }}">
            <p class="text-cadre mt-8">Voir les Contribution</p>
            </a>
        </div>
        <div class="div-cadre">
            <p class="text-cadre mt-8">Voir la Cagnotte</p>
        </div>
    </div>
    <div class="flex flex-wrap text-center ml-10">
        <div class="pr-2 pt-2 pb-2w-28">
            <div class="div-kpi-detail ">
                <h2 class="nombre-kpi-detail">{{$montantTotalContributions}}</h2>
                <p class="text-kpi-detail ">Total Cagnotte</p>
            </div>
        </div>
        <div class="p-2 w-28  ">
            <div class="div-kpi-detail">
                <h2 class="nombre-kpi-detail">125</h2>
                <p class="text-xs text-black text-center mr-4">100%</p>
                <p class="text-xs italic text-right text-gray-400 relative bottom-3">Droit</p>
                <p class="text-xs whitespace-nowrap text-gray-400 text-left relative bottom-4">Réel Cagnotte</p>
            </div>
        </div>
        <div class="p-2 w-28">
            <div class="div-kpi-detail">
                <h2 class="nombre-kpi-detail">125</h2>
                <p class="text-kpi-detail">Total Droit: 100%</p>
            </div>
        </div>
        <div class="p-2 w-28">
            <div class="div-kpi-detail">
                <h2 class="nombre-kpi-detail">10</h2>
                <p class="text-kpi-detail">Total Retrait</p>
            </div>
        </div>
        <div class="p-2 w-28">
            <div class="div-kpi-detail ">
                <h2 class="nombre-kpi-detail">{{$nombreTotalContributions}}</h2>
                <p class="text-kpi-detail">Contributions</p>
                <a href="{{route ('utilisateur.contribution',[ 'idCagnotte' => $cagnotte->id_cagnotte ])}}" class="text-xs font-sans text-gray-400 relative bottom-2">Voir</a>
            </div>
        </div>
        <div class="p-2 w-28">
            <div class="div-kpi-detail ">
                <h2 class="nombre-kpi-detail">{{$nombreTotalContributeurs}}</h2>
                <p class="text-kpi-detail">Contributeurs</p>
                <a href="{{route ('utilisateur.contributeur.cagnotte',[ 'id_cagnotte' => $cagnotte->id_cagnotte ])}}" class="text-xs font-sans text-gray-400 relative bottom-2">Voir</a>
            </div>
        </div>
    </div>
    @endforeach
</main>


@endsection


