Set WshShell = WScript.CreateObject("WScript.Shell")
WshShell.Run """" & WScript.Arguments(0) & """", 0, False