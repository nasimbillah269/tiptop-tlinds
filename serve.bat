@echo off
REM Start the Laravel dev server with PHP 8.3 (this project needs PHP >= 8.3).
REM Usage: serve.bat            -> http://127.0.0.1:8000
REM        serve.bat 8080       -> http://127.0.0.1:8080
REM Run other commands the same way, e.g.:  php83.bat artisan migrate

set "PHP83=C:\laragon\bin\php\php-8.3.30-Win32-vs16-x64\php.exe"
if not exist "%PHP83%" (
    echo PHP 8.3 not found at %PHP83%
    echo Install PHP 8.3 or update the PHP83 path in this file.
    exit /b 1
)

set "PORT=%~1"
if "%PORT%"=="" set "PORT=8000"

cd /d "%~dp0"
"%PHP83%" artisan serve --host=127.0.0.1 --port=%PORT%
