# Async Save Random user
Celem aplikacji jest pobranie danych o użytkowniku ze strony https://randomuser.me/, przetworzenie ich oraz zapisanie danych w bazie danych.

## Inicjalizacja projektu
Pobieramy kod lokalnie na swój komputer:

    git clone https://github.com/ThePatrykOOO/async_save_randomuser


Przechodzimy do katalogu projektu:

    cd async_save_randomuser

Instalujemy zależności laravela:

    composer install


Kopiujemy plik konfiguracyjny:

    cp .env.example .env


Generujemy klucz aplikacji:

    php artisan key:generate

Ustalamy odpowiednie dane do logowania bazy danych:

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=laravel
    DB_USERNAME=root
    DB_PASSWORD=

Wykonujemy migrację:

    php artisan migrate

Uruchamiamy aplikację

    php artisan serve



## ENDPOINTY
**Pobranie listy użytkowników**
```
curl --location --request GET 'http://127.0.0.1:8000/api/users' \
--header 'Authorization: Basic dXNlcjp0ZXN0'
```

## Komendy konsolowe
**Wygenerowanie użytkownika wrzucenie procesu na kolejkę**

```php artisan user:random-generator```

**Odpalenie kolejki która pobierze dane z api i zapisze je w bazie danych**

```php artisan user:random-generator```

**Odpalenie komendy która co określony czas wykona zaplanowane zadania**

```php artisan schedule:run```
