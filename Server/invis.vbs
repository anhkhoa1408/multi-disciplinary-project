Set WshShell = WScript.CreateObject("WScript.Shell")
WshShell.CurrentDirectory = WScript.Arguments(1)
WshShell.Run """" & WScript.Arguments(0) & """", 0, False