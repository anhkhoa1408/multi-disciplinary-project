@echo off & setlocal
@REM For %%G in ("%path:;=" "%") do (
@REM   echo.%%~G | findstr /C:"php" 1>nul
@REM   if not errorlevel 1 set phpPath=%%~G
@REM )
@REM %phpPath%\php.exe %cd%\insert-db-cron.bat

set cron1="wscript.exe %cd%\invis.vbs %cd%\insert-db-cron.bat %cd%"
SCHTASKS /CREATE /SC MINUTE /MO 1 /TN "Sprinker\cron\insert-and-check" /TR %cron1%