
# Szerveroldali webprogramozás

Ez az oldal összefoglalja a Szerveroldali webprogramozás gyakorlathoz szükséges tudnivalókat.

## Gyakorlat ideje, helye (3-as csoport)
- Hétfő 8:30, Déli épület 00-412 (PC6)

- ![nothing to see here](https://people.inf.elte.hu/totadavid95/images/email.png)


## A gyakorlat tematikája

- Függvénykönyvtárak használata
- PHP MVC: Laravel
- REST API: Node.js
- GraphQL
- Websockets

## Követelmények
- Kötelező előadás részvétel
- Kötelező gyakorlat részvétel
- PHP MVC-s beadandó, 1. fázis (Laravel1, 30 pont)
- PHP MVC-s beadandó, 2. fázis (Laravel2, 30 pont)
- REST API csoport ZH/pótZH (30 pont)
- Évfolyam ZH/pótZH (30 pont)

## Jegyszerzés feltételei
- Nincs jegy, ha
  - nincs elegendő részvétel
  - nincs meg az összes számonkérés
- Elégséges
  - Minden részből legalább 40% elérve
- Szumma 120 pont
- Jegyhatárok
  - 2: 40% (48 pont)
  - 3: 55% (66 pont)
  - 4: 70% (84 pont)
  - 5: 85% (102 pont)

## Lokális környezet beállítása

A labor gépeken be kell állítani egy lokális környezetet (egy felhasználónak egy gépnél elég ezt egyszer elvégeznie), mivel alapból nincs feltelepítve a PHP és a Composer. Ennek a menetét ez a fejezet részletezi.

### Automatikus telepítővel (Windows)

A telepítő script letölthető innen: [szerveroldali-webprogramozas.exe](https://github.com/totadavid95/elte/blob/master/SzerveroldaliWebprogramozas/Installer/szerveroldali-webprogramozas.exe?raw=true)

Csak futtatni kell, és a telepítő automatikusan végrehajtja a következő pontban kifejtett lépéseket, így azokat optimális esetben nem szükséges kézzel megcsinálni. A telepítő futtatható a programok frissítéshez is, vagy rossz telepítés javítására.

A telepítő mérete azért ekkora, mivel maga a telepítő egy Python script, ami a Python interpreterrel, modulokkal együtt be lett csomagolva egy fájlba PyInstaller segítségével.

### Telepítés kézzel (Windows)

#### PHP telepítése
- A [https://windows.php.net/download](https://windows.php.net/download) oldalról a legfrissebb PHP kiadás __x64 Non Thread Safe__ verzióját kell letölteni, majd kicsomagolni.
- A __php.ini-development__ fájlról készítsünk egy másolatot, amit nevezzünk el __php.ini__-nek.
- Nyissuk meg a __php.ini__ fájlt, és hajtsuk végre a következő módosításokat:
  - Keressünk rá a következő sorra:  `;extension_dir = "ext"`, és "kommentezzük ki", vagyis hagyjuk el a pontosvesszőt az elejéről. Erre azért van szükség, hogy a PHP a saját mappájában keresse majd a kiegészítőket (mivel lokálisan telepítjük, és alapból nem jó helyen keresné).
  - Most pedig engedélyeznünk kell néhány kiegészítőt. A következő sorokat is élesítenünk kell (ezek kb. egy blokkban vannak):
     ```ini
    ;extension=mbstring
    ;extension=openssl
    ;extension=pdo_mysql
    ;extension=pdo_sqlite
    ```
- Ha kész vagyunk, mentsük el a __php.ini__ fájlt.
- Az egész mappa tartalmát másoljuk át ide: 
  `%LOCALAPPDATA%\Programs\php` (ha még nincs a Programs mappában php mappa, létre kell hozni).

Hint: Fájlkezelő címsorába másoljuk be, hogy `%LOCALAPPDATA%\Programs`

#### XDebug kiegészítő telepítése a PHP-hoz
- A [https://xdebug.org/download](https://xdebug.org/download) oldalról a __Windows binaries__ részből válasszuk ki a telepített PHP verziónak megfelelőt (a TS a Thread Safe-t jelenti a végén, az aktuális PHP verziónkat pedig a `php -v` parancs adja meg).
- Ha sikerült, mentsük el __php_xdebug.dll__ néven.
- Másoljuk be a PHP __ext__ mappájába a __php_xdebug.dll__ fájlt.
- Nyissuk meg a __php.ini__ fájlt, és írjuk az alábbiakat a fájl legaljára:
  ```ini
  [XDebug]
  xdebug.remote_enable = 1
  xdebug.remote_autostart = 1
  zend_extension=xdebug
  ```
- Mentsük el a __php.ini__ fájlt.
- Ha van futó PHP szerverünk, azt újra kell indítani, hogy betöltse ezt a kiegészítőt is.

#### Composer telepítése
- A [https://getcomposer.org/composer-stable.phar](https://getcomposer.org/composer-stable.phar) linkre kattintva töltsük le a legfrissebb Composer kiadást.
- A letöltött fájlt `composer.phar` néven bemásoljuk a következő mappába: `%LOCALAPPDATA%\Programs\composer` (ha még nincs a Programs mappában composer mappa, létre kell hozni).
- Szintén ebben a __composer__ mappában csinálunk egy `composer.bat` fájlt, aminek a tartalma a következő egy sor legyen: 
 `@php "%~dp0composer.phar" %*`

#### Hozzáadás a Path környezeti változóhoz
Ahhoz, hogy parancssorból meg tudjuk hívni a php, illetve a composer parancsokat, hozzá kell az előbb elkészített két mappát adni a Path környezeti változóhoz.

Ez a legegyszerűbben úgy tehető meg, hogy beírjuk a Start menü keresőbe, hogy "Fiókhoz tartozó környezeti változók szerkesztése", vagy angol Windowson "Edit environment variables for your account". Alternatív lehetőség a Win+R, majd `rundll32 sysdm.cpl,EditEnvironmentVariables` parancs kiadása.

Itt fontos, hogy a megjelenő ablak fenti részében dolgozzunk, mivel az vonatkozik a __felhasználó__ környezeti változóira, és a labor gépeken nem lehet módosítani a rendszerhez tartozó tulajdonságokat.

#### Telepítés tesztelése
Ha minden fent ismertetett műveletet sikeresen elvégeztünk, a parancssorban elérhetővé válik a php és a composer (a már megnyitott parancssorokban nem, azokat újra meg kell nyitni), ezt így próbálhatjuk ki:
`php -v` és `composer -V`
Mindkét esetben ki kell írja a telepített verzió adatait.

## Visual Studio Code beállítása

Ez a default szerkesztőnk, de nyugodtan lehet bármi mást használni, ha valakinek az szimpatikusabb, vagy azt szokta meg. Labor gépeken Asztalon kint van az ikonja.

 Az alábbi kiegészítőket ajánlott telepíteni:
- [PHP Intelephense](https://marketplace.visualstudio.com/items?itemName=bmewburn.vscode-intelephense-client)
- [PHP Debug](https://marketplace.visualstudio.com/items?itemName=felixfbecker.php-debug)

A PHP Debug működéséhez szükség van az XDebug-ra is (az automatikus telepítő script felrakja, de le van írva a kézi telepítés menete is)

## Új Laravel projekt készítése

Az alábbi parancsot kell kiadnunk, és a projektünk megadott nevével létrejön egy mappa, benne egy default laravel projekttel:

`composer create-project --prefer-dist laravel/laravel projekt-neve`

Ez egy kicsit hosszabb, pár perces folyamat is lehet, mire minden szükséges modul letöltődik.

### Laravel projekt elindítása
A projekt mappájában kell kiadni az alábbi parancsot:
`php artisan serve`

## Egyéb

A tárggyal kapcsolatos további információk a [https://canvas.elte.hu/](https://canvas.elte.hu/) oldalon találhatók.
