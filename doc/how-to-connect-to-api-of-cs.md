# Česká spořitelna: Příručka API

## Obsah

1. Úvod
2. Jak se připojit k API České spořitelny
3. Povolení aplikace do produkční fáze
4. Kdo se může připojit k našemu API
5. Informace pro vývojáře
6. Definice

## Úvod

Děkujeme, že jste si vybrali API České spořitelny. Tento text vám poskytne základní informace o práci s naším API. Česká spořitelna vyvinula API nejen pro ty, kteří mají licenci od České národní banky (ČNB), ale také pro ty, kteří chtějí používat API jako další způsob přístupu ke svým bankovním účtům. Pro více informací nás kontaktujte na emailu: <api@csas.cz>.

## Jak se připojit k API České spořitelny

Než se připojíte k našemu API, prozkoumejte svět ČS API a kontaktujte tým ČS API na emailu: <api@csas.cz>. Poté postupujte následovně:

1. Registrujte se na Erste Developer Portal (EDP)
2. Vytvořte aplikaci a vyberte API České spořitelny
3. Generujte testovací API klíč na Sandboxu (testovací prostředí)
4. Vyvíjejte a testujte aplikaci pomocí Sandboxu
5. Požádejte o přístup do produkčního prostředí pro vaši aplikaci

## Povolení aplikace do produkční fáze

Pro povolení aplikace do produkční fáze je třeba projít několika kroky, které se mohou lišit podle API a účelu připojení. Tým ČS API vás provede celým procesem.

## Kdo se může připojit k našemu API

Nabízíme API širokému spektru zákazníků pro různé účely. Rozdělujeme je do dvou základních kategorií:

- Poskytovatelé třetích stran (TPP)
- Koneční uživatelé API (FAC)

## Informace pro vývojáře

### Dokumentace API

Po registraci a interním schválení bankou získáte vzdálený přístup k dokumentaci API. Dokumentace API může obsahovat technické informace o API.

### Testovací prostředí vývojáře

Po získání přístupu k dokumentaci API získáte přístup k našemu Sandboxu, který podporuje až 10 testovacích účtů pro testovací účely.

### Produkční prostředí vývojáře

Prostřednictvím produkčního API může uživatel přistupovat k obsahu a po autentizaci klienta k datům klienta. Produkční API používá jinou sadu přihlašovacích údajů než testovací prostředí API.

## Definice

- API: webové aplikační programovací rozhraní dostupné registrovaným vývojářům.
- API Call: požadavek uživatele prostřednictvím aplikace na API.
- API dokumentace: jakákoli dokumentace související s API poskytovaná bankou.
- API nástroje: API, API dokumentace a další nástroje a informace o API poskytované bankou.
- Aplikace: softwarová aplikace, webová stránka nebo produkt, který vytvoříte, vlastníte nebo provozujete pro interakci s API.
- Autentizace: autentizace klienta prostřednictvím aplikace pro ověření oprávnění k přístupu k datům klienta nebo provádění určitých funkcí.
- Banka: Česká spořitelna, a.s.
- Klient: uživatel, který uzavřel smlouvu o poskytování služeb s bankou nebo členem skupiny banky.
- Data klienta: jakákoli data o klientovi zpracovávaná bankou.
- Obsah: jakákoli veřejně dostupná data nebo obsah z našich stránek nebo data, která zpřístupňujeme pro použití vaší aplikací prostřednictvím API.
- Přihlašovací údaje: nezbytné bezpečnostní klíče, hesla a další přihlašovací údaje pro přístup k API, obsahu nebo datům klienta.
- Konečný uživatel API (FAC): firemní nebo maloobchodní klient nebo neklient, který se chce připojit k našemu API za účelem přístupu ke svým bankovním účtům nebo veřejně dostupným informacím poskytovaným bankou.
- Poskytovatel třetích stran (TPP): firemní klient nebo neklient, který chce umožnit svým klientům přístup k jejich bankovním účtům v České spořitelně prostřednictvím aplikace TPP.
- Tokeny: přihlašovací údaje používané k ověření, že klient může přistupovat k datům klienta prostřednictvím aplikace.
- Uživatel: koncový uživatel vaší aplikace.
