@echo off
title The Whole Lot - Local PHP Server
cd /d "%~dp0"
echo ========================================================
echo   Starting The Whole Lot Local PHP Server
echo   Opening http://localhost:8000
echo   Press Ctrl+C to stop the server
echo ========================================================
start http://localhost:8000
"%USERPROFILE%\.php8\php.exe" -S localhost:8000
