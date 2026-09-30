$fontsDir = "assets\fonts"
$headers = @{
    "User-Agent" = "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36"
}

# 1. Bebas Neue
$bebasResp = Invoke-WebRequest -Uri "https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" -Headers $headers -UseBasicParsing
$bebasContent = $bebasResp.Content
if ($bebasContent -match 'url\((https://[^)]+\.woff2)\)') {
    Invoke-WebRequest -Uri $matches[1] -OutFile "$fontsDir\BebasNeue-Regular.woff2" -Headers $headers
    Write-Host "Downloaded BebasNeue-Regular.woff2"
}

# 2. Inter Tight (weights individually)
$weights = @(
    @{ w = "200"; name = "InterTight-Thin.woff2" },
    @{ w = "300"; name = "InterTight-Light.woff2" },
    @{ w = "400"; name = "InterTight-Regular.woff2" },
    @{ w = "700"; name = "InterTight-Bold.woff2" }
)

foreach ($item in $weights) {
    $w = $item.w
    $resp = Invoke-WebRequest -Uri "https://fonts.googleapis.com/css2?family=Inter+Tight:wght@$w&display=swap" -Headers $headers -UseBasicParsing
    # Match latin subset url
    if ($resp.Content -match 'latin[\s\S]*?url\((https://fonts\.gstatic\.com/[^)]+\.woff2)\)') {
        Invoke-WebRequest -Uri $matches[1] -OutFile "$fontsDir\$($item.name)" -Headers $headers
        Write-Host "Downloaded $($item.name)"
    } elseif ($resp.Content -match 'url\((https://fonts\.gstatic\.com/[^)]+\.woff2)\)') {
        Invoke-WebRequest -Uri $matches[1] -OutFile "$fontsDir\$($item.name)" -Headers $headers
        Write-Host "Downloaded $($item.name)"
    }
}

# 3. Oswald 200
$oswaldResp = Invoke-WebRequest -Uri "https://fonts.googleapis.com/css2?family=Oswald:wght@200&display=swap" -Headers $headers -UseBasicParsing
if ($oswaldResp.Content -match 'latin[\s\S]*?url\((https://fonts\.gstatic\.com/[^)]+\.woff2)\)') {
    Invoke-WebRequest -Uri $matches[1] -OutFile "$fontsDir\Oswald-ExtraLight.woff2" -Headers $headers
    Write-Host "Downloaded Oswald-ExtraLight.woff2"
} elseif ($oswaldResp.Content -match 'url\((https://fonts\.gstatic\.com/[^)]+\.woff2)\)') {
    Invoke-WebRequest -Uri $matches[1] -OutFile "$fontsDir\Oswald-ExtraLight.woff2" -Headers $headers
    Write-Host "Downloaded Oswald-ExtraLight.woff2"
}

Get-ChildItem $fontsDir | Select-Object Name, Length
