@echo off
SET cron="%cd%\cron.bat"
SCHTASKS /CREATE /SC MINUTE /MO 1 /TN "Sprinker\cron" /TR %cron%
timeout 5