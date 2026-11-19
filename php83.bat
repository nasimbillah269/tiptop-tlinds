@echo off
REM Run any PHP command with PHP 8.3, e.g.:
REM   php83.bat artisan migrate
REM   php83.bat artisan optimize:clear
REM   php83.bat C:\ProgramData\ComposerSetup\bin\composer.phar install
"C:\laragon\bin\php\php-8.3.30-Win32-vs16-x64\php.exe" %*
