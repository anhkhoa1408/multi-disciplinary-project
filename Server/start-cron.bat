@echo off
set cron1="wscript.exe %cd%\invis.vbs %cd%\insert-db-cron.bat"
SCHTASKS /CREATE /SC MINUTE /MO 1 /TN "Sprinker\cron\insert-and-check" /TR %cron1%
