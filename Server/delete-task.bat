@echo off
SCHTASKS /Delete /TN "Sprinker\cron\check-time-parameter" /F
SCHTASKS /Delete /TN "Sprinker\cron\insert-database" /F