# Dokumentacja Aplikacji Lista Zadań (To-Do List)

## Spis treści
1. [Wstęp](#wstęp)
2. [Wymagania](#wymagania)
3. [Instalacja](#instalacja)
4. [Konfiguracja](#konfiguracja)
5. [Funkcje Aplikacji](#funkcje-aplikacji)
6. [Dane Testowe](#dane-testowe)
7. [Wsparcie](#wsparcie)

## Wstęp
Aplikacja Lista Zadań (To-Do List) jest prostym systemem do zarządzania zadaniami. Umożliwia użytkownikom tworzenie, przeglądanie i zarządzanie ich osobistymi listami zadań.

## Wymagania
- Serwer WWW z PHP (preferowana wersja PHP 7.0 lub nowsza).
- Serwer baz danych MySQL.
- Klient WWW obsługujący HTML5 i JavaScript.

## Instalacja
1. Skopiuj pliki projektu na serwer WWW.
2. Upewnij się, że katalogi `php` i `script` są dostępne na serwerze.

## Konfiguracja
### Baza Danych
1. Utwórz bazę danych w MySQL.
2. Zaimportuj schemat bazy danych z katalogu `DataBaseImport`.
3. Skonfiguruj plik `db_connect.php` z odpowiednimi danymi dostępowymi:
   ```php
   $db_url = "[adres-serwera-bazy-danych]";
   $db_user = "[nazwa-użytkownika]";
   $db_password = "[hasło]";
   $db_name = "[nazwa-bazy-danych]";
   ```

### Konfiguracja Aplikacji
- W razie potrzeby dostosuj pliki w katalogach `css` i `img` do zmiany wyglądu aplikacji.

## Funkcje Aplikacji
- **Logowanie/Uwierzytelnianie**: Pozwala na logowanie się do systemu.
- **Zarządzanie Zadaniami**: Użytkownicy mogą dodawać, edytować i usuwać zadania.
- **Profil Użytkownika**: Umożliwia przeglądanie i edycję danych profilowych.
- **Wyszukiwanie Zadań**: Umożliwia szybkie odnajdywanie konkretnych zadań.

## Dane Testowe
- Użytkownicy testowi i ich hasła powinny być zdefiniowane w bazie danych. Przykładowe dane:
  ```
  Użytkownik: test@test.com
  Hasło: test
  ```
