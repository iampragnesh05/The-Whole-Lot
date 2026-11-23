@echo off
echo ========================================================
echo  The Whole Lot - Local Development Server
echo ========================================================
echo  Opening http://localhost:8000 ...
echo  Press Ctrl+C to stop the server.
echo ========================================================

where php >nul 2>nul
if %ERRORLEVEL% equ 0 (
    php -S localhost:8000 router.php
) else (
    if exist "C:\laragon\bin\php\php-8.3.30-Win32-vs16-x64\php.exe" (
        "C:\laragon\bin\php\php-8.3.30-Win32-vs16-x64\php.exe" -S localhost:8000 router.php
    ) else (
        echo [ERROR] PHP executable not found.
        echo Please ensure PHP or Laragon is installed.
        pause
    )
)
