@echo off
SET cron="%cd%\insert-db-cron.bat"
SCHTASKS /CREATE /ST 06:00 /SC HOURLY /MO 1 /TN "Sprinker\cron\insert-database" /TR %cron%