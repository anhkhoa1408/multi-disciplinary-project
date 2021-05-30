@echo off
SET cron="%cd%\para-check-cron.bat"
SCHTASKS /CREATE /SC MINUTE /MO 1 /TN "Sprinker\cron\check-time-parameter" /TR %cron%