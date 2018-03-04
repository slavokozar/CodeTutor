##Všeobecné
CodeLeague je programovacia súťaž pre jednotlivcov. Jej účastníkom sa môže stať každý žiak základnej alebo študent strednej školy, ktorý sa zaregistruje na tejto stránke. Súťažiaci budú v priebehu súťaže samostatne vytvárať programy - riešenia zadaní zverejnených na tejto webovej stránke. V prípade zistenia nesamostatného riešenia zadaní ( objavenia plagiátov v riešení zadania) bude týmto súťažiacim priradený nulový počet bodov.
Na stránke bude umiestnená výsledková tabuľka, ktorá sa bude aktualizovať po každom ohodnotení riešenia. Súťažiaci budú v tabuľke vystupovať pod svojim unikátnym kódom, ktorý im bude pridelený pri registrácii.
V prípade dostatočného záujmu budú súťažiaci rozdelení do vekových kategórii, ktoré budú vyhodnocované samostatne.
Na konci súťaže budú najúspešnejší riešitelia v každej kategórii ocenení vecnými cenami, ktoré venovali partnerské firmy.
##Zadania
Zadania budú zverejňované na tomto webe, budú Vám zaslané emailom aj propagované na facebook-u súťaže.
Každé zadanie bude pozostávať z viacerých úloh (taskov). Bude mať pevne určený termín, do kedy je možné odovzdávať riešenia. Po tomto termíne nebude možné odovzdať žiadne ďalšie riešenie tohto zadania.

##Bodovanie zadaní
Plný počet bodov za funkčnosť získa súťažiaci za úlohu, ktorá bude poskytovať korektné výstupy na všetkých testovacích vstupoch. V prípade, že na jednom zo vstupov riešenie neposkytne valídne riešenie, alebo fungovať nebude, súťažiaci stratí adekvátnu časť bodov za túto úlohu.
Na základe kvality riešenia súťažiaceho  bude CL tím udeľovať bonusové body. Tieto budú pridelené na základe vopred stanovených kritérii, ku ktorým môžu pribudnúť dodatočné kritéria v prípade špecifického zadania.
###Kritéria
* Vhodné názvy premenných a funkcií - stručné, no dostatočne výstižné.
* Čistota a kvalita kódu - komentáre, formátovanie, použitie komplexných riešení.
* Použitie angličiny - angličtina je jazyk programátorov, budete odmenení za používanie angličtiny v názvoch a komentároch.

###Programovacie jazyky
CodeLeague v súčasnosti podporuje jazyky C, C++ a Java. Súťažiaci si môže vybrať ktorýkoľvek z týchto jazykov pre vytvorenie riešenia.
Ak v zadaní nebude spomenuté inak, môžu súťažiaci používať iba štandardné knižnice. Je zakázané používať akékoľvek knižnice, ktoré nie sú obsiahnuté v štandardnej inštalácii kompilátora (testovací systém ich nebude obsahovať a kód súťažiaceho nebude možné skompilovať, čo znamená 0 bodov za danú úlohu).
##Riešenia
###Vstupy
Všetky vstupy do programu budú (v prípade, že nebude v zadaní uvedené inak) načítavané zo štandardného konzolového vstupu.
Vstupy (okrem prípadov, kedy to bude uvedené inak) budú celé čísla vo veľkosti, ktorá sa vojde do dátového typu integer (v prípade aspoň 32b počítača), znaky, alebo reálne čísla vo formáte na 3 desatinné miesta.
Vstupy budú vždy korektné a spĺňajuce rozsahy vstupných dát uvedených v zadaní(nie je teda nutná kontrola správnosti vstupných dát). Ak sa CL tím rozhodne použiť aj nekorektné vstupy, súťažiaci budú na to určite upozornení
###Výstupy
Všetky výstupy z programu budú (v prípade, že nebude v zadaní uvedené inak) vypisované do štandardného konzolového vstupu.
Výstupy (okrem prípadov, kedy to bude uvedené inak) budú celé čísla vo veľkosti, ktorá sa vojde do dátového typu integer (v prípade aspoň 32b počítača), znaky, alebo reálne čísla vo formáte na 3 desatinné miesta.
Zadania budu kontrolované a hodnotené automatickým softvérom. Súťažiaci preto musia presne doržiavať zadaný formát výstupu. V prípade, že sa výstup riešenia bude akokoľvek líšiť od zadaného formátu, test Vaše výsledky vyhodnotí ako nesprávne.
Každé zadanie sa bude skladať z niekoľkých úloh. Tie je nutné rozlišovať, aby ich testovací systém dokázal správne vyhodnotiť. Pre oddelenie výstupov jednotlivých úloh zadania sa používa špeciálny reťazec ##TASKn, kde n je číslo úlohy. Tento rozlišovací reťazec sa
musí nachádzať na samostatnom riadku. Viď. nasledjúcu ukážku:

```
##TASK1
{riesenie ulohy 1}
##TASK2
{riesenie ulohy 2}
```

Akékoľvek nedodržania formátu bude viesť k prideleniu 0b za danú úlohu, alebo zadanie.
V prípade, že súťažiaci nevypracuje niektorú z úloh zadania, ale vypracuje ďalšie, vynechá vo výstupe len riešenie tejto úlohy. Napríklad v nasledujúcom prípade súťažiaci získa 0 bodov za úlohu 2, ktorá nebola vypracovaná. Za úlohy 1,3,4 môže ale získať plný počet bodov.

```
##TASK1
{riesenie ulohy 1}
##TASK3
{riesenie ulohy 3}
##TASK4
{riesenie ulohy 4}
```

Riešenie úlohy (tasku) môže mať viac riadkov. Viď. nasledujúci príklad:

```
##TASK1
1
2
##TASK3
3
4
```

V prípade, že súťažiaci nie je schopný vyriešiť celú úlohu, je tiež možné odovzdať iba časť riešenie úlohy. V takom prípade budú výstupy úlohy vyhodnocované po výstup, ktorý sa líši od očakávaného výstupu. V prípade očakávaného výstupu:

```
##TASK1
1
2
3
4
```

a nasledujúceho riešenia súťažiaceho:

```
##TASK1
1
2
3
13
```


budú súťažiacemu pridelené body za prvé tri výstupy úlohy. Pri rovnakom očakávanom vstupe a nasledujúcom riešení súťažiaceho:

```
##TASK1
13
2
3
```


bude súťažiacemu udelených 0 bodov za danú úlohu.
##Odovzdávanie riešení
Riešenia budú súťažiaci odovzdávať na tejto webovej stránke. V závislosti od toho, aký programovací jazyk si súťažiaci vyberie, uploadne súbor s príponou .c, .cpp, .java, alebo archív .zip.
Je zakázané uploadovať akékoľvek súbory, ktoré neboli vytvorené pri riešení zadania tejto súťaže (knižnice tretích strán a pod.), ak k tomu súťažiaci nebudú vyzvaní.
Riešenia súťažiacich budú spúšťané na operačnom systéme Linux - Debian. Súťažiaci by preto nemali používať žiadne čiste windowsové prvky alebo iné platformovo závislé prvky. Riešenia budú spúšťané s časovým obmedzením. V prípade, že program súťažiaceho prekročí určený časový limit samostatne určený pre každý test, alebo akokoľvek predčasne skončí svoje vykonávanie (exception, error, warning ...), jeho vykonávanie bude ukončené. Za daný test získa súťažiaci adekvátny počet bodov, podľa toho, aké výstupy riešenie poskytlo pred ukončením.
Špeciálne upozorňujeme, že pri kompilácii jazykov C a C++ budú použité parametre
`-Wall -pedantic`
Tie spôsobia, že kompilátor upozorní na neštandardné časti kódu (napr. deklarovaná ale nepoužitá premenná) vo forme warningov. Je to jeden z nástrojov k písaniu kvalitného kódu. Aj v prípade warningov, ktoré sa budú považovať za chyby, bude test pokračovať a výsledky budú vyhodnotené. Body ale budú udelené len riešeniam, ktorých kompilácia a vykonanie prebehne bez warningov a chýb.
Príklady vstupov a výstupov
Nižšie sú uvedené základné kódy čítania a vypisovania jednotlivých dátových typov zo štandardného vstupu a do štandardného výstupu:
###C

```
/* Funkcia main             */
/* parametre : void         */
/* navratova hodnota: int(errno)    */

int main(void{
                    //definície premenných
    int     a;      //celočíselná premenná
    float   b;      //číslo s plávajúcou desatinnou čiarkou (floating point)
    char    c;      //8-bitová premenná ASCII znaku

    scanf("%d \n", &a)  //do premennej a ulož číslo z nasledujúceho riadka štandardného vstupu
    scanf("%f \n", &b)  //do premennej b ulož číslo z nasledujúceho riadka štandardného vstupu
    c = getch();        //prečítaj zo štandardného vstupu jeden znak a ulož ho do premennej c

    a = 2;
    b = 1.5;
    c = 'f';

    printf("%d \n",a);  //vypis do riadka premennu a (vypise "2 \n")
    printf("%.3f \n",b) //vypis do riadka premennu b (vypise "1.500 \n")
    putch(c);           //vypis do standardneho vystupu znak c (vypise "f")

    return 0;           //ukončenie hlavnej funkcie
}
```
###C++

```
//namespace je v C++ dolezita vec
//odporúčame Vám používať štandardný namespace std, ktorý do programu vložíte následovným riadkom
using namespace std;
//ak ho nevlozite, musite potom vsade ku kazdej importovanej meody pridať "std::"
//napr std::cout << ...


/* Funkcia main             */
/* parametre : void         */
/* navratova hodnota: int(errno)    */

int main(void){
                    //definície premenných
    int     a;      //celočíselná premenná
    float   b;      //číslo s plávajúcou desatinnou čiarkou (floating point)
    char    c;      //8-bitová premenná ASCII znaku

    cin >> a;
    cin >> b;
    cin >> c;

    a = 2;
    b = 1.5;
    c = 'f';

    cout << a << endl;



    cout << fixed;      //tento prikaz zapina fixne formatovanie vystupu.
                        //pri vypise cisla s presnosťou na 3 desatinné čísla
                        //sa v prípade potreby číslo na výstupe dolní nulami
                        //napriklad namiesto cisla 1.5 sa vypise 1.500

    cout << setprecision(3) << b << endl;

    cout << c;

}
```

###Java
V prípade, že sa súťažiaci rozhodne realizovať riešenie v jazyku Java, jeho metóda main sa musí nachádzať v súbore Main.java, ktorý sa musí nachádzať v balíku (package) Main.
Na načítavanie zo štandardného vstupu je zakázané používať triedu Scanner!!!!, obsahuje množstvo chýb, a nepresností. Je odporúčané používať triedu BufferedReader, ako je vidieť v následujúcej ukážke.

```
/* Funkcia main				*/
/* parametre : void			*/
/* navratova hodnota: int(errno)	*/

package Main;
import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.io.IOException;

/**
 * @author slavo
 */
public class Main {

/**
 * @param args the command line arguments
 */
    public static void main(String[] args) {
    BufferedReader sc = new BufferedReader(new InputStreamReader(System.in));


					//definície premenných
	int 	a;		//celočíselná premenná
	double	b; 		//číslo s plávajúcou desatinnou čiarkou (floating point)
	String	c;		//8-bitová premenná ASCII znaku

	try {

		a = Integer.parseInt(sc.readLine()); 		//nasledujúce celé číslo zo vstupu
		b = double.parseDouble(sc.readLine()); 		//nasledujúce desatinné číslo zo vstupu
		c = sc.readLine(); 				//jeden riadok

	} catch(IOException e) {
       		e.printStackTrace();
    	}

	a = 2;
	b = 1.5;
	c = 'f';

	System.out.println(a);			//vypis do riadka premennu a (vypise "2 \n")
   	System.out.format("%.3f%n", b);	//vypis do riadka premennu b (vypise "1.500 \n")
   	System.out.print(c);			//vypis do standardneho vystupu retazec c (vypise "f")
    }
}
```