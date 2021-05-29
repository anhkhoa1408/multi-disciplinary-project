@echo off
SCHTASKS /Delete /TN "Sprinker\cron" /F
timeout 5