Implementuj zadání jak nejlépe umíš :-)

1. ČÁST
Vytvoř vstupní soubor, který bude vypadat takto:

Každý pacient je na samostatném řádku. Každý řádek obsahuje číselné
id pacienta, jméno, přijímení, pohlaví (M/Z) a datum narození ve formátu dd.mm.yyyy.
Oddělovač údajů o pacientovi je středník. Kódování souboru je UTF-8.

Příklad (csv soubor):
123;Michal;Nový;M;01.11.1962
3457;Petra;Veverková;Z;13.09.1993
34;Lukáš;Neznámý;M;20.12.2011
57;Jana;Nováková;Z;17.1.2010
37;Alena;"Nováková Přibylová";Z;16.2.1999
37;Karel;Skočdopole;M;15.3.1920

Implementuj třídu Patient (pacient).

Obecné požadavky:
- pacient má tyto informace:
	- jedinečné číselné ID
	- jméno
	- příjmení
	- pohlaví M/Z
	- datum narození
PS: Tyto informace lze z instance třídy získat, ale nelze je již měnit
(možnost změny pohlaví a přejmenování neuvažujeme).

Operace pro Patient (pacient):
- získání délky života pacienta ve dnech

Implementuj třídu Mankind (lidstvo), která pracuje s instancemi třídy Pacient (pacient).

Obecné požadavky:
- v jednom okamžiku může existovat pouze jedna instance třídy Mankind (marťané nejsou lidstvo...)
- s třídou musí být možné pracovat jako s polem (klíče jsou ID pacientů) a procházet ji vhodným cyklem

Požadované operace třídy Mankind:
- načtení hodnot ze vstupního souboru
- získání pacienta dle ID
- získání procentuálního zastoupení mužů v lidstvu
- získání průměrného věku mužů

Předpokládej, že velikost souboru je v řádech stovkách MB a takto s tím pracuj.

Kritéria splnění:
1) Vytvořený soubor s lidstvem dle examplu
2) Implementována třída Mankind podle obecných požadavků
3) Implementována třída Pacient podle obecných požadavků s definovanými parametry
4) Implementovány další operace pro Pacient i Mankind, které půjdou kdykoliv samostatně zavolat
	- tyto metody pracují s pacienty, které načteme ze vstupního souboru
5) Zašli nám/přines výsledné php se vstupním souborem

2. ČÁST
Navrhni a implementuj (vytvoř sql migraci) nejlépe jak umíš SQL DB model, který
bude umožňovat vytvoření a perzistenci otázek pro dynamické formuláře.

Typicky v administraci si chci vyklikat formulář, který se mi následně zobrazí na webu, kde
jej může uživatel vyplnit a odeslat. Po odeslání se jeho vyplněná data zaznamenají do DB.

Formulář umožňuje mít typy inputů:
1) Text
2) Textarea
3) Checkbox, Multiple checkbox
4) Radio button
5) Select, Multiple select

Všechny výše uvedené typy mohou/nemusí mít Název, placeholder případně tooltip.

Kritéria splnění:
1) Vytvoření funkčního migračního skriptu/ů
2) Splňuje požadavky viz výše
