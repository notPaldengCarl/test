$src = Split-Path -Parent $MyInvocation.MyCommand.Path
$dst = Join-Path $src 'void-roasters-theme.zip'
$exclude = @('.git', '.DS_Store', 'CLAUDE.md', 'generate-demo-content.sh', '_zip.ps1', 'void-roasters-theme.zip')

if (Test-Path $dst) { Remove-Item $dst -Force }

$files = Get-ChildItem -Path $src -Recurse -File | Where-Object {
    $rel = $_.FullName.Substring($src.Length + 1)
    $skip = $false
    foreach ($ex in $exclude) {
        if ($rel -like "$ex*" -or $_.Name -eq $ex) { $skip = $true; break }
    }
    -not $skip
}

$files | Compress-Archive -DestinationPath $dst -Force
Write-Host "Created: $dst ($($files.Count) files)"