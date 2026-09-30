$imgDir = "assets\img"
New-Item -ItemType Directory -Force -Path "$imgDir\home", "$imgDir\services", "$imgDir\ground-signal", "$imgDir\work", "$imgDir\og" | Out-Null

Copy-Item -Path "_kit\home\*" -Destination "$imgDir\home" -Recurse -Force
Copy-Item -Path "_kit\services\*" -Destination "$imgDir\services" -Recurse -Force
Copy-Item -Path "_kit\ground-signal\*" -Destination "$imgDir\ground-signal" -Recurse -Force

if (Test-Path "_kit\services\services-hero-bg-1920.jpg") {
    Copy-Item "_kit\services\services-hero-bg-1920.jpg" "$imgDir\og\og-image.jpg" -Force
}

Get-ChildItem -Recurse $imgDir | Select-Object Name
