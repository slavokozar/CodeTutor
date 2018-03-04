@extends('layout_full')

@section('content')
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-home" aria-hidden="true"></i></a>
        <li class="active">Pravidlá</li>
    </ol>

    <h1>Pravidlá</h1>

    @if($articleObj == null)
        <p class="text-center text-danger">
            Práve tu nie su žiadne pravidlá.<br/>
            <i class="fa fa-4x fa-meh-o" aria-hidden="true"></i><br/>
        </p>
    @else
        @if(Auth::check() && Auth::user()->isAdmin())
            <div class="row">
                <div class="col-md-12">
                    <ul id="content-nav-tabs" class="nav nav-tabs">
                        <li role="presentation">
                            <a href="{{action('Articles\ArticleController@edit',[$articleObj->code])}}" class="btn">Upraviť</a>
                        </li>
                    </ul>
                </div>
            </div>
        @endif

        <section id="assignments">
            {!! $content !!}
        </section>
    @endif
@endsection

{{--@section('content')--}}
    {{--$articles = Article::where('id','>',1);--}}
    {{--return view('articles.index', compact(['articles']));--}}

    {{--<h1>Pravidlá súťaže CodeLeague 2017</h1>--}}

    {{--<h2>Všeobecné</h2>--}}
    {{--<p>--}}
        {{--CodeLeague je súťaž v programovaní jednotlivcov.--}}
        {{--Súťažiacim sa môže stať každý žiak základnej, alebo strednej školy, ktorý vypní formulár na tejto stránke.--}}
        {{--Súťažiaci budú v priebehu súťaže samostane vytvárať programy - riešenia zadaní zverejnených na tejto webovej stránke. V prípade zistenia nesamostatného riešenia zadaní - objavení plagiátov v riešení zadania bude všetkým dotknutým súťažiacim priradený nulový počet bodov.--}}
    {{--</p>--}}
    {{--<p>--}}
        {{--Na stránke bude umiestnená výsledková tabuľka, ktorá sa bude aktualizovať po každom ohodnotení riešenia. Súťažiaci budu v tabuľke vystupovať pod svojim unikátnym kódom, ktorý im bol pridelený pri registrácii.--}}
    {{--</p>--}}
    {{--<p>--}}
        {{--V prípade dostatočného záujmu budú súťažiaci rozdelený do vekových kategórii, ktoré budú vyhodnocované samostatne.--}}
    {{--</p>--}}
    {{--<p>--}}
        {{--Na konci súťaže budú najúspešnejší riešitelia v každej kategórii ocenení vecnými cenami, ktoré venovali partnerské firmy.--}}
    {{--</p>--}}



    {{--<h2>Zadania</h2>--}}
    {{--<p>--}}
        {{--Zadania budú zverejnované na tomto webe, bude Vám zaslané emailom aj propagované na facebook-u súťaže.--}}
    {{--</p>--}}
    {{--<p>--}}
        {{--Každé zadanie pozostáva z <strong>viacerých úloh(taskov)</strong>. Každé zadanie bude mať pevne určený termín, do kedy je možné odovzdávať riešenia. Po tomto termíne nebude monžné odovzdať žiadne ďalšie riešenie tohot zadania.--}}
    {{--</p>--}}
    {{--<h3>Bodovanie zadaní</h3>--}}
    {{--<p>--}}
        {{--Plný počet bodov za funkčnosť získa súťažiaci za úlohu, ktorá bude poskytovať korektné výstupy na všetkých testovacích vstupoch. V prípade, že na jednom zo vstupov riešenie neposkytne valídne riešenie, alebo fungovať nebude, súťažiaci statí adektvátnu časť bodov za túto úlohu.--}}
    {{--</p>--}}
    {{--<p>--}}
        {{--Na základe kvality riešenia súťažiaceho riešenia bude CL tím udeľovať <strong>bonusové body</strong>. Tieto budú pridelené na základe vopred stanovených  kritérii, ku ktorým môžu pribudnúť dodatočné kritéria v prípade špecifického zadania.--}}
    {{--</p>--}}
    {{--<h4><strong>Kritéria</strong></h4>--}}
    {{--<ul style="list-style-type:disc">--}}
        {{--<li>Vhodné názvy premenných a funkcií - stručné, no dostatočne výstižné</li>--}}
        {{--<li>Čistota a kvalita kódu - komentáre, formátovanie, použitie komplexných riešení</li>--}}
        {{--<li>Použitie angličiny - angličtina je jazyk programátorov, budete odmenení za používanie angličtiny v názvoch a komentároch</li>--}}
    {{--</ul>--}}



    {{--<h2>Programovacie jazyky</h2>--}}
    {{--<p>--}}
        {{--CodeLeague v súčasnosti podporuje jazyky <strong>C</strong>, <strong>C++</strong> a <strong>Java</strong>. Súťažiaci si môže vybrať ktorýkoľvek z týchto jazykov pre vytvorenie riešenia.--}}
    {{--</p>--}}
    {{--<p>--}}
        {{--Ak v zadaní nebude spomenuté inak, môžu súťažiaci používať iba <strong>štandardné knižnice</strong>. Je zakázané používať akékoľvek knižnice, ktoré nie sú obsiahnuté v štandardnej inštalácii kompilátora (testovací systém ich nebude obsahovať a kód súťažiaceho nebude možné skompilovať, čo znamená 0 bodov za danú úlohu).--}}
    {{--</p>--}}


    {{--<h2>Riešenia</h2>--}}
    {{--<h3>Vstupy</h3>--}}
    {{--<p>--}}
        {{--Všetky vstupy do programu budú (v prípade, že nebude v zadaní uvedené inak) načítavané zo štandardného konzolového vstupu.--}}
    {{--</p>--}}
    {{--<p>--}}
        {{--Vstupy (okrem prípadov, kedy to bude uvedené inak) budú celé čísla vo veľkosti, ktorá sa vojde do dátového typu integer (v prípade aspoň 32b počítača), znaky, alebo reálne čísla vo formáte na 3 desatinné miesta.--}}
    {{--</p>--}}
    {{--<p>--}}
        {{--Vstupy budú vždy korektné a spĺňajúce rozsahy vstupných dát uvedených v zadaní(nie je teda nutná kontrola správnosti vstupných dát). <strong>Ak sa rozhodneme použiť aj nekorektné vstupy, budete na to určite upozornený</strong>.--}}
    {{--</p>--}}

    {{--<h3>Výstupy</h3>--}}
    {{--<p>--}}
        {{--Všetky výstupy z programu budú (v prípade, že nebude v zadaní uvedené inak) vypisované do štandardného konzolového vstupu.--}}
    {{--</p>--}}
    {{--<p>--}}
        {{--Výstupy (okrem prípadov, kedy to bude uvedené inak) budú celé čísla vo veľkosti, ktorá sa vojde do dátového typu integer (v prípade aspoň 32b počítača), znaky, alebo reálne čísla vo formáte na 3 desatinné miesta.--}}
    {{--</p>--}}
    {{--<p>--}}
        {{--Zadania budu kontrolované a hodnotené automatickým softvérom. Súťažiaci preto musia presne doržiavať zadaný formát výstupu. V prípade, že sa výstup riešenia bude akokoľvek líšiť od zadaného formátu, test Vaše výsledky vyhodnotí ako nesprávne.--}}
    {{--</p>--}}
    {{--<p>--}}
        {{--Každé zadanie sa bude skladať z niekoľkých úloh. Tie je nutné rozlišovať, aby ich testovací systém dokázal právne vyhodnotiť.--}}
        {{--Pre oddelenie výstupov jednotlivých úloh zadania sa používa špeciálny reťazec <strong>##TASKn</strong>, kde <strong>n</strong> je číslo úlohy. Tento rozlišovací reťazec sa musí nachádzať na samostatnom riadku. Viď. nasledjúcu ukážku:--}}
    {{--<pre>--}}
{{--##TASK1--}}
{{--{riesenie ulohy 1}--}}
{{--##TASK2--}}
{{--{riesenie ulohy 2}--}}
{{--</pre>--}}
    {{--Akékoľvek nedodržania formátu bude viesť k prideleniu 0b za danú úlohu, alebo zadanie.--}}
    {{--</p>--}}
    {{--<p>--}}
        {{--V prípade, že súťažiaci nevypracuje niektorú z úloh zadania, ale vypracuje ďalšie, vynechá vo výstupe len riešenie tejto úlohy. Napríklad v nasledujúcom prípade súťažiaci získa 0 bodov za úlohu 2, ktorá nebola vypracovaná. Za úlohy 1,3,4 môže ale získať plný počet bodov.--}}
    {{--<pre>--}}
{{--##TASK1--}}
{{--{riesenie ulohy 1}--}}
{{--##TASK3--}}
{{--{riesenie ulohy 3}--}}
{{--##TASK4--}}
{{--{riesenie ulohy 4}--}}
{{--</pre>--}}
    {{--</p>--}}
    {{--<p>--}}
        {{--Riešenie úlohy(tasku) môže mať viac riadkov. Viď. nasledujúci príklad:--}}
    {{--<pre>--}}
{{--##TASK1--}}
{{--1--}}
{{--2--}}
{{--##TASK3--}}
{{--3--}}
{{--4--}}
{{--</pre>--}}
    {{--V prípade že súťažiaci nie je schopný vyriešiť celú úlohu, je tiež možné odovzdať iba časť riešenie úlohy. V takom prípade budú výstupy úlohy vyhodnocované po výstup, ktorý sa líši od očakávaného výstupu.--}}

    {{--V prípade, očakávaného výstupu:--}}
    {{--<pre>--}}
{{--##TASK1--}}
{{--1--}}
{{--2--}}
{{--3--}}
{{--4--}}
{{--</pre>--}}

    {{--a nasledujúceho riešenia súťažiaceho:--}}
    {{--<pre>--}}
{{--##TASK1--}}
{{--1--}}
{{--2--}}
{{--3--}}
{{--13--}}
{{--</pre>--}}
    {{--budú súťažiacemu pridelené body za prvé tri výstupy úlohy.--}}
    {{--Pri rovnakom očakávanom vstupe a nasledujúcom riešení súťažiaceho:--}}
    {{--<pre>--}}
{{--##TASK1--}}
{{--13--}}
{{--2--}}
{{--3--}}
{{--</pre>--}}
    {{--bude súťažiacemu udelených 0 bodov za danú úlohu.--}}
    {{--</p>--}}



    {{--<h2>Odovzdávanie riešení</h2>--}}
    {{--<p>--}}
        {{--Riešenia budú súťažiaci odovzdávať na tejto webovej stránke. V závislosti od toho, aký programovací jazyk si súťažiaci vyberie, uploadne súbor s príponou <strong>.c</strong>, <strong>.cpp</strong>, <strong>.java</strong>, alebo archív <strong>.zip</strong>.--}}
    {{--</p>--}}
    {{--<p>--}}
        {{--Je <strong>zakázané</strong> uploadovať akékoľvek súbory, ktoré neboli vytvorené pri riešení zadania tejto súťaže (knižnice tretích strán a pod.) ak k tomu súťažiaci nebudú vyzvaní.--}}
    {{--</p>--}}
    {{--<p>--}}
        {{--Riešenia súťažiacich budú spúšťané na operačnom systéme <strong>Linux</strong> - Debian.--}}
        {{--Súťažiaci by pret nemali používať žiadne čisto windowsové prvky alebo iné platformovo závislé prvky. Riešenia budú spúšťané s <strong>časovým obmedzením</strong>. V prípade, že program súťažiaceho prekročí určený časový limit, samostatne určený pre každý test alebo akokoľvek predčasne skončí svoje vykonávanie (exception, error, warning ...) jeho vykonávanie bude ukončené. Za daný test získa súťažiaci adekvátny počet bodov, podľa toho aké výstupy riešenie poskytlo pred ukončením.--}}
    {{--</p>--}}
    {{--<p>--}}
        {{--Špeciálne upozorňujeme, že pri kompilácii jazykov C a C++ budú použité parametre--}}
    {{--<pre>-Wall -pedantic</pre>--}}
    {{--Tie spôsobia, že kompilátor upozorní na neštandardné časti kódu(napr. deklarovaná ale nepoužitá premenná) vo forme warningov. Je to jeden z nástrojov k písaniu kvalitného kódu.--}}
    {{--Aj v prípade warningov, ktoré sa budú považovať za chyby bude test pokračovať a výsledky budú vyhodnotené, ale body budú udelené len riešeniam ktorých kompilácia a vykonanie prebehne bez warningov a chýb.--}}
    {{--</p>--}}

    {{--<h3>Príklady vstupov a výstupov</h3>--}}
    {{--Nižsie sú uvedené základné kódy čítania a vypisovania jednotlivých dátových typov zo štandardného vstupu a do štandardného výstupu:--}}
    {{--<h4>C</h4>--}}
    {{--<pre>--}}
{{--/* Funkcia main             */--}}
{{--/* parametre : void         */--}}
{{--/* navratova hodnota: int(errno)    */--}}

{{--int main(void{--}}
                    {{--//definície premenných--}}
    {{--int     a;      //celočíselná premenná--}}
    {{--float   b;      //číslo s plávajúcou desatinnou čiarkou (floating point)--}}
    {{--char    c;      //8-bitová premenná ASCII znaku--}}

    {{--scanf("%d \n", &a)  //do premennej a ulož číslo z nasledujúceho riadka štandardného vstupu--}}
    {{--scanf("%f \n", &b)  //do premennej b ulož číslo z nasledujúceho riadka štandardného vstupu--}}
    {{--c = getch();        //prečítaj zo štandardného vstupu jeden znak a ulož ho do premennej c--}}

    {{--a = 2;--}}
    {{--b = 1.5;--}}
    {{--c = 'f';--}}

    {{--printf("%d \n",a);  //vypis do riadka premennu a (vypise "2 \n")--}}
    {{--printf("%.3f \n",b) //vypis do riadka premennu b (vypise "1.500 \n")--}}
    {{--putch(c);           //vypis do standardneho vystupu znak c (vypise "f")--}}

    {{--return 0;           //ukončenie hlavnej funkcie--}}
{{--}--}}
                        {{--</pre>--}}


    {{--<h4>C++</h4>--}}
    {{--<pre>--}}
{{--//namespace je v C++ dolezita vec--}}
{{--//odporúčame Vám používať štandardný namespace std, ktorý do programu vložíte následovným riadkom--}}
{{--using namespace std;--}}
{{--//ak ho nevlozite, musite potom vsade ku kazdej importovanej meody pridať "std::"--}}
{{--//napr std::cout << ...--}}


{{--/* Funkcia main             */--}}
{{--/* parametre : void         */--}}
{{--/* navratova hodnota: int(errno)    */--}}

{{--int main(void){--}}
                    {{--//definície premenných--}}
    {{--int     a;      //celočíselná premenná--}}
    {{--float   b;      //číslo s plávajúcou desatinnou čiarkou (floating point)--}}
    {{--char    c;      //8-bitová premenná ASCII znaku--}}

    {{--cin >> a;--}}
    {{--cin >> b;--}}
    {{--cin >> c;--}}

    {{--a = 2;--}}
    {{--b = 1.5;--}}
    {{--c = 'f';--}}

    {{--cout << a << endl;--}}



    {{--cout << fixed;      //tento prikaz zapina fixne formatovanie vystupu.--}}
                        {{--//pri vypise cisla s presnosťou na 3 desatinné čísla--}}
                        {{--//sa v prípade potreby číslo na výstupe dolní nulami--}}
                        {{--//napriklad namiesto cisla 1.5 sa vypise 1.500--}}

    {{--cout << setprecision(3) << b << endl;--}}

    {{--cout << c;--}}

{{--}--}}
                        {{--</pre>--}}



    {{--<h4>Java</h4>--}}
    {{--<p>--}}
        {{--V prípade, že sa súťažiaci rozhodne realizovať riešene v jazyku Java jeho metóda main sa musí nachádzať v súbore <strong>Main.java</strong>, ktorý sa musí nachádzať v balíku (package) <strong>Main</strong>.--}}
    {{--</p>--}}
    {{--<p>--}}

        {{--Na načítavanie zo štandardného vstupu je <strong>zakázané</strong> používať triedu <strong>Scanner</strong>!!!!, obsahuje množstvo chýb, a nepresností. Je odporúčané používať trie <strong>BufferedReader</strong>, ako je vidieť v následujúcej ukážke.--}}
    {{--</p>--}}

    {{--<pre>--}}
{{--/* Funkcia main             */--}}
{{--/* parametre : void         */--}}
{{--/* navratova hodnota: int(errno)    */--}}

{{--package Main;--}}
{{--import java.io.BufferedReader;--}}
{{--import java.io.InputStreamReader;--}}
{{--import java.io.IOException;--}}

{{--/**--}}
 {{--* @author slavo--}}
 {{--*/--}}
{{--public class Main {--}}

{{--/**--}}
 {{--* @param args the command line arguments--}}
 {{--*/--}}
    {{--public static void main(String[]du args) {--}}
    {{--BufferedReader sc = new BufferedReader(new InputStreamReader(System.in));--}}


                    {{--//definície premenných--}}
    {{--int     a;      //celočíselná premenná--}}
    {{--double  b;      //číslo s plávajúcou desatinnou čiarkou (floating point)--}}
    {{--String  c;      //8-bitová premenná ASCII znaku--}}

    {{--try {--}}

        {{--a = Integer.parseInt(sc.readLine());        //nasledujúce celé číslo zo vstupu--}}
        {{--b = double.parseDouble(sc.readLine());      //nasledujúce desatinné číslo zo vstupu--}}
        {{--c = sc.readLine();                          //jeden riadok--}}

    {{--} catch(IOException e) {--}}
            {{--e.printStackTrace();--}}
        {{--}--}}

    {{--a = 2;--}}
    {{--b = 1.5;--}}
    {{--c = 'f';--}}

    {{--System.out.println(a);          //vypis do riadka premennu a (vypise "2 \n")--}}
    {{--System.out.format("%.3f%n", b); //vypis do riadka premennu b (vypise "1.500 \n")--}}
    {{--System.out.print(c);            //vypis do standardneho vystupu retazec c (vypise "f")--}}
    {{--}--}}
{{--}--}}
{{--</pre>--}}