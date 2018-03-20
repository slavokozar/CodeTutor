@extends('layouts.propagation')

@section('content')
    <div class="content">
        <section>
            <div class="container">
                <div class="col-md-12">
                    <h1>Chceme Ťa!</h1>
                    <p>CodeLeague stojí na tíme ľudí.</p>

                    <p>Zapojiť sa doň znamená posunúť programovanie v školách na vyššiu úroveň.</p>
                    <p>Zatiaľ je nás zopár, ale viac ľudí dokáže väčšie veci.</p>
                    <p>Aby CodeLeague mohlo rásť, musí rásť aj tento tím.</p>
                    <p>Pripoj sa k nám a podieľaj sa s nami, na niečom veľkom.</p>

                    <p>
                        Hľadáme hlavne programátorov, autorov úloh a článkov nie len o programovaní.<br/>
                        Ak nie si programátor, nevadí, sú aj ďalšie možnosti, ako priložiť ruku k dielu.
                    </p>
                    <p>
                        Čo ti môžeme ponúknuť?
                    <ul>
                        <li>Parádny riadok do CV - dobrovoľnícka činnosť, priamo v IT odbore je veľmi cenená</li>
                        <li>Skúsenosti a kontakty s našimi partnermi</li>
                        <li>Dobrý pocit z toho, že pomôžeš celej spoločnosti.</li>
                    </ul>
                    </p>





                </div>

                <div class="col-md-12">
                    <h2>Napíš nám</h2>
                </div>
                <div class="col-md-6 col-md-offset-3 text-center">
                    <div data-form-alert="true"></div>
                    <form action="https://mobirise.com/" method="post" data-form-title="CONTACT FORM">
                        <div class="form-group">
                            <input type="text" class="form-control" name="name" required="" placeholder="Meno*">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" required="" placeholder="Email*">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="message" placeholder="Správa" rows="7"></textarea>
                        </div>
                        <div class="mbr-buttons mbr-buttons--right">
                            <button type="submit" class="btn btn-lg btn-warning">ODOSLAŤ</button>
                        </div>
                    </form>
                </div>

            </div>
        </section>
    </div>
@endsection