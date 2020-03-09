
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

## Alapvető git ismeretek
[https://git-scm.com/docs/gittutorial](https://git-scm.com/docs/gittutorial)

## Laravel projektekhez szükséges ismeretek

### Projekt létrehozása

Az alábbi parancsot kell kiadnunk, és a projektünk megadott nevével létrejön egy mappa, benne egy default laravel projekttel:

`composer create-project --prefer-dist laravel/laravel PROJEKT NEVE`

Ez egy kicsit hosszabb, pár perces folyamat is lehet, mire minden szükséges modul letöltődik.

### Projekt elindítása
A projekt mappájában kell kiadni az alábbi parancsot: `php artisan serve`
Ha minden rendben ment, a projektünk elérhető lesz a [http://127.0.0.1:8000 ](http://127.0.0.1:8000) (vagy, ha jobban tetszik, a [http://localhost:8000 ](http://localhost:8000)) címen keresztül.

### Projekt beállítása git-ről való letöltés után
1. Composer csomagok telepítése: `composer install`
2. npm csomagok telepítése, ha vannak: `npm install`
3. **.env** fájl készítése (az **.env** fájl biztonsági okok miatt a Laravel beállításai alapján nem kerül a repoba, csak az **.env.example**, így azt kell másolni): 
    - Windowson:
  `copy .env.example .env`
    - Linuxon:
  `cp .env.example .env`
4. Titkosítási kulcs generálása: `php artisan key:generate` (**.env** fájlunkon belül az `APP_KEY=...`)
5. Projekt indítása: `php artisan serve`

### SQLite adatbázis beállítása
- Az **.env** fájlban a **DB_** kezdetű sorok törlése, vagy kommentezése
- A projekt **database** mappájában létre kell hozni a **database.sqlite** állományt (csak egy üres fájlt ezzel a névvel)
- A **config/database.php** fájlban a **default** értékének az **sqlite**-ot kell megadni

### Tinker
A Tinker egy hasznos eszköz, mert parancssoron keresztül széles hozzáférést biztosít az alkalmazásunkhoz. A következő paranccsal hívható elő: `php artisan tinker`

### Egyéb parancsok

Az Artisan rengeteg parancsot tartalmaz, amit tudunk használni a projektünk fejlesztése során. A teljesség igénye nélkül néhány fontosabb, gyakorlatokon is használt parancs:

- Új controller készítése: `php artisan make:controller NÉV`
- Új modell készítése:  `php artisan make:model NÉV`
- Új migration generálása: `php artisan make:migration NÉV`
  - Bővebben: [https://laravel.com/docs/7.x/migrations#generating-migrations](https://laravel.com/docs/7.x/migrations#generating-migrations)
- Migration: `php artisan migrate`

Az összes Artisan parancs előhívható a `php artisan list` kiadásával, illetve a hozzá tartozó dokumentáció elolvasható ezen a linken: [https://laravel.com/docs/7.x/artisan](https://laravel.com/docs/7.x/artisan)

### Fontosabb mappák, fájlok

A teljesség igénye nélkül pár fontosabb mappa vagy fájl.

- Models: **./app/**
- Controllers: **./app/http/controllers/**
- Views: **./resources/views/** 
- Routes: **./routes/web.php** 
- Adatbázis / Database: **./database/database.sqlite** 
- Migrations: **./database/migrations/** 
- Seeds: **./database/seeds/** 
- Composer csomagok: **./vendor/**
- npm csomagok: **./node_modules/**

A teljes projektszerkezet: [https://laravel.com/docs/7.x/structure](https://laravel.com/docs/7.x/structure)

## DB Browser for SQLite

Hasznos segédprogram az SQLite adatbázis kezeléséhez. Letölthető a következő linkről Windowsra és Linuxra is egyaránt: [https://sqlitebrowser.org/dl/](https://sqlitebrowser.org/dl/)

Ha nem akarod telepíteni, választ a **.zip (no installer)** verziót. Windowson a **DB Browser for SQLite.exe** alkalmazást kell elindítani, miután kicsomagoltad.

## Dokumentációk

Ezeket a dokumentációkat érdemes használni.

- Laravel dokumentáció: [https://laravel.com/docs](https://laravel.com/docs)
- Bootstrap dokumentáció: [https://getbootstrap.com/docs](https://getbootstrap.com/docs)  

## Canvas

A tárggyal kapcsolatos további információk a [https://canvas.elte.hu/](https://canvas.elte.hu/) oldalon találhatók.
