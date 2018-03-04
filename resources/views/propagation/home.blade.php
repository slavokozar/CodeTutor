@extends('wrapper')


@section('wrapper')
    <section id="landing" class="propagation  text-center">
        <div class="container">
            <h1>Buď cool... programuj!</h1>
            @if(Auth::check())
                <a href="{{action('Assignments\AssignmentController@index')}}"
                   class="btn btn-lg btn-danger">začni s nami</a>
            @else
                <a href="/login" class="btn btn-lg btn-danger">začni s nami</a>
            @endif

            <div id="banner-carousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                @if($carousel->count() > 1)
                    <ol class="carousel-indicators">
                        @for($i = 0; $i < 5; $i++)
                            <li data-target="#banner-carousel" data-slide-to="{{$i}}"
                                @if($i == 0)class="active"@endif></li>
                        @endfor
                    </ol>
                @endif

            <!-- Wrapper for slides -->
                @if($carousel->count() > 1)
                    <div class="carousel-inner" role="listbox">
                        @for($i = 0; $i < 5; $i++)
                            <?php $item = $carousel->get(0); ?>

                            <div class="item{{ $i == 0 ? ' active' : '' }}">
                                <h3>{{$item->name}}</h3>

                                <p>{{$item->description}}</p>
                                @if($item instanceof \App\Models\Article)
                                    <a href="{{action('Articles\ArticleController@show',$item->code)}}">viac...</a>
                                @elseif($item instanceof \App\Models\Assignment)
                                    <a href="{{action('Assignments\AssignmentController@show',$item->code)}}">viac...</a>
                                @endif

                            </div>
                        @endfor
                    </div>
                @endif
            </div>
        </div>

        <div class="partners">
            <a href="">
                <img src="img/spse-logo.png"/>
            </a>
        </div>

    </section>

    <section id="how-cl-works" class="propagation dark">
        <div class="container">
            <div class="row">
                <div class="col-md-60 text-center">
                    <h2>Ako CodeLeague funguje</h2>

                    <p>kostrou CodeLeague je náš vlastný systém odovzdávania a testovania kódov</p>
                </div>

                <div class="col-md-40 col-md-offset-10 block">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <i class="fa fa-tasks" aria-hidden="true"></i>
                        </div>
                        <div class="col-md-48">
                            autor vytvorí úlohy, vzorové vstupy a výstupy a zverejní zadanie
                        </div>
                    </div>
                </div>
                <div class="col-md-40 col-md-offset-10 block">
                    <div class="row">
                        <div class="col-md-48">
                            riešitelia vytvoria kód, uploadnu ho a sledujú ako ich riešenie spĺňa testy
                        </div>
                        <div class="col-md-12 text-center">
                            <i class="fa fa-cloud-upload" aria-hidden="true"></i>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>

    {{--<section id="bio">--}}
    {{--<div class="container">--}}
    {{--<div class="row">--}}
    {{--<div class="col-md-12 text-center">--}}
    {{--<h2>CodeLeague Bio</h2>--}}
    {{--</div>--}}
    {{--<div class="col-md-12">--}}
    {{--<p>Programovanie by v 21. storočí malo mať v školách podobné postavenie ako matematika v tom--}}
    {{--minulom. Každý by mal vedieť programovať počítač, pretože Vás to naučí rozmýšlať (Steve Jobs).--}}
    {{--IT a špeciálne programovanie sa rozvíja najrýchlejšie zo všetkých odvetví. Bohužiaľ školstvo na--}}
    {{--tieto trendy nestíha reagovať. V západnej európe a za morom je štandard, že kde zaostáva verejný--}}
    {{--sektor preberajú žezlo dobrovoľníci a podnikateľská sféra. Práve preto sme tu my.</p>--}}

    {{--<p>CodeLeague vznikla z iniciatívy nás, absolventov, v roku 2014 na našej alma máter SPŠE v Prešove--}}
    {{--ako súťaž, ktorej cieľom bolo dlhodobo pripravovať študentov na stredoškolské súťaže v--}}
    {{--programovaní. Prvý rok sme prestrelili úroveň a po jednom zadaní bez úspešných riešiteľov sme--}}
    {{--sa začali pripravovať na ďalší ročník. Do neho sa zapojili desiatky riešiteľov v dvoch etapách a--}}
    {{--dokonca--}}
    {{--aj niekoľko učiteľov programovania.</p>--}}

    {{--<p>Po roku prevádzky na SPŠE v Prešove dávame šancu Vám všetkým zapojiť sa do tohto inovačného--}}
    {{--procesu. Naše zadania sú stavané podobne ako zadania z už etablovaných programátorských--}}
    {{--súťaží, ale obsahujú témy z programátorskej praxe a akademického prostredia. Zapoj sa do--}}
    {{--súťaže, preštuduj si naše tutoriály a články a posuň sa na ďalší level.</p>--}}

    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</section>--}}


    {{--</section>--}}
    <section id="schools" class="propagation dark">
        <div class="container">
            <div class="row">
                <div class="col-md-60 text-center">
                    <h2>CodeLeague pre Vašu školu</h2>
                    <h3>Náš systém - pomôcka pre Vašich učiteľov</h3>

                    <p>Systém primárne určený pre súťaž môže aj Vaša škola využiť pre modernizáciu výučby.</p>
                </div>
            </div>
            <div class="row">

                <div class="col-md-20 block">
                    <i class="ion-document-text" aria-hidden="true"></i>

                    vytvorte si zadanie, zadefinujte vstupy a výstupy a bodové hodnotenia

                </div>
                <div class="col-md-20 block">
                    <i class="ion-ios-people" aria-hidden="true"></i>

                    nechajte žiakov odovzdávať, hneď po odovzdaní uvidia ich úspešnosť


                </div>
                <div class="col-md-20 block">

                    <i class="fa fa-commenting-o fa-2x" aria-hidden="true"></i>

                    prezrite si odovzdané kódy, manuálne ich skontrolujte a okomentujte

                </div>
            </div>
            <div class="row">
                <div class="col-md-60 text-center">
                    <h4>pozdvihnite úroveň programovania na Vašej škole...</h4>
                </div>
                <div class="col-md-20 col-md-offset-20 text-center">
                    <a href="#contact" class="btn btn-lg btn-danger">kontaktujte nás</a>
                </div>


            </div>
        </div>
        </div>
    </section>
    {{--<section id="languages">--}}
    {{--<div class="container">--}}
    {{--<div class="row">--}}
    {{--<div class="col-md-12 text-center">--}}
    {{--<h2>Podporované jazyky</h2>--}}
    {{--</div>--}}
    {{--<div class="col-md-4 text-center">--}}
    {{--<img src="img/cpp.png" style="height:100px"/>--}}

    {{--<p>C/C++</p>--}}
    {{--</div>--}}
    {{--<div class="col-md-4 text-center">--}}
    {{--<img src="img/java.png" style="height:100px"/>--}}

    {{--<p>Java</p>--}}
    {{--</div>--}}
    {{--<div class="col-md-4 text-center" style="height:100%">--}}
    {{--<img src="img/soon.png" style="height:100px"/>--}}

    {{--<p style="opacity:.3">Python/ ruby/ Go</p>--}}
    {{--</div>--}}


    {{--</div>--}}
    {{--</div>--}}
    {{--</section>--}}

    {{--<section id="support" class="dark">--}}
    {{--<div class="container">--}}
    {{--<div class="row">--}}
    {{--<div class="col-md-12 text-center">--}}
    {{--<h2>Podporte CodeLeague</h2>--}}
    {{--</div>--}}
    {{--<div class="col-md-12 text-center">--}}
    {{--<h3>Ak si myslíte, že naša myšlienka stojí za jej ďalšiu realizáciu, podporte nás.</h3>--}}

    {{--<p>V prípade, že by ste nás chceli podporit vecnými cenami do súťaže, finančne alebo odborne ...</p>--}}
    {{--</div>--}}

    {{--<div class="col-md-12 text-center">--}}
    {{--<a href="#" class="btn btn-lg btn-danger">kontaktujte nás</a>--}}

    {{--<a href="#contact" class="btn btn-lg btn-warning">kontaktujte nás</a>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</section>--}}

    {{--<section id="team">--}}
    {{--<div class="container">--}}
    {{--<div class="row">--}}
    {{--<div class="col-md-12 text-center">--}}
    {{--<h2>Kto je CodeLeague</h2>--}}
    {{--</div>--}}

    {{--<div class="col-md-4 text-center">--}}
    {{--<a href="">--}}
    {{--<img src="img/avatar-kamil.png"/>--}}

    {{--<p>Kamil Triščík</p>--}}

    {{--<p class="text-muted">Zakladateľ, autor test systému, code-reviewer<br/>viac ...</p>--}}
    {{--</a>--}}
    {{--</div>--}}
    {{--<div class="col-md-4 text-center">--}}
    {{--<a href="">--}}
    {{--<img src="img/avatar-paly.png"/>--}}

    {{--<p>Pavol Vargovčík</p>--}}

    {{--<p class="text-muted">Zakladateľ, autor zadania<br/>viac ...</p>--}}
    {{--</a>--}}
    {{--</div>--}}
    {{--<div class="col-md-4 text-center">--}}
    {{--<a href="">--}}
    {{--<img src="img/avatar-slavo.png"/>--}}

    {{--<p>Slavomír Kožár</p>--}}

    {{--<p class="text-muted">Zakladateľ, autor zadaní, webu a upload systému<br/>viac ...</p>--}}
    {{--</a>--}}
    {{--</div>--}}
    {{--<div class="col-md-4 col-md-offset-2 text-center">--}}
    {{--<a href="">--}}
    {{--<img src="img/avatar-tomas.png"/>--}}

    {{--<p>Tomáš Blanárik</p>--}}

    {{--<p class="text-muted">Autor zadania, systému spúštania testov<br/>viac ...</p>--}}
    {{--</a>--}}
    {{--</div>--}}
    {{--<div class="col-md-4 text-center">--}}
    {{--<a href="">--}}
    {{--<img src="img/avatar-lukas.png"/>--}}

    {{--<p>Lukáš Figura</p>--}}

    {{--<p class="text-muted">Spoluautor upload systému, systému spúšťania testov<br/>viac ...</p>--}}
    {{--</a>--}}

    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</section>--}}

    {{--<section id="contact" class="dark">--}}
    {{--<div class="container">--}}
    {{--<div class="row">--}}
    {{--<div class="col-md-12 text-center">--}}
    {{--<h2>Napíšte nám</h2>--}}
    {{--</div>--}}
    {{--<div class="col-md-6 col-md-offset-3 text-center">--}}

    {{--<div data-form-alert="true"></div>--}}
    {{--<form action="https://mobirise.com/" method="post" data-form-title="CONTACT FORM">--}}
    {{--<div class="form-group">--}}
    {{--<input type="text" class="form-control" name="name" required="" placeholder="Meno*">--}}
    {{--</div>--}}
    {{--<div class="form-group">--}}
    {{--<input type="email" class="form-control" name="email" required="" placeholder="Email*">--}}
    {{--</div>--}}
    {{--<div class="form-group">--}}
    {{--<textarea class="form-control" name="message" placeholder="Správa" rows="7"></textarea>--}}
    {{--</div>--}}
    {{--<div class="mbr-buttons mbr-buttons--right">--}}
    {{--<button type="submit" class="btn btn-lg btn-warning">ODOSLAŤ</button>--}}
    {{--</div>--}}
    {{--</form>--}}
    {{--</div>--}}

    {{--</div>--}}
    {{--</div>--}}
    {{--</section>--}}
@endsection