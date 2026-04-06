<?php
/**
 * Associazione Meteo Senese — Mappa interattiva
 * 
 * Metti questo file nella root del tuo sito/virtual host.
 * Il logo (logookpianojoomla3.png) deve stare nella stessa cartella.
 * 
 * Le stazioni sono definite nell'array $stations qui sotto:
 * aggiornale manualmente oppure leggi i dati da un DB/API PHP.
 */

// ── DATI STAZIONI ─────────────────────────────────────────────────────────────
// Ogni stazione:
//   id        → identificativo univoco
//   name      → nome visualizzato
//   lat/lng   → coordinate WGS84
//   temp      → temperatura °C (float)
//   dotColor  → colore pallino condizione (#hex)
//   cond      → testo condizione (es. "Sereno", "Pioggia")
//   windDir   → direzione vento in gradi (0=N, 90=E, 180=S, 270=O)
//   windBft   → forza vento scala Beaufort (int 0-12)
//   url       → link pagina stazione
// ─────────────────────────────────────────────────────────────────────────────
$stations = [
    [
        'id'       => 's1',
        'name'     => 'Siena Centro',
        'lat'      => 43.3186,
        'lng'      => 11.3307,
        'temp'     => 14.2,
        'dotColor' => '#64b5f6',
        'cond'     => 'Nuvoloso',
        'windDir'  => 220,
        'windBft'  => 3,
        'url'      => 'https://meteostazioni.example.it/siena-centro',
    ],
    [
        'id'       => 's2',
        'name'     => 'Simognano',
        'lat'      => 43.2820,
        'lng'      => 11.2650,
        'temp'     => 11.8,
        'dotColor' => '#81c784',
        'cond'     => 'Sereno',
        'windDir'  => 180,
        'windBft'  => 1,
        'url'      => 'https://meteostazioni.example.it/simognano',
    ],
    [
        'id'       => 's3',
        'name'     => 'Monteriggioni',
        'lat'      => 43.3906,
        'lng'      => 11.2230,
        'temp'     => 12.5,
        'dotColor' => '#64b5f6',
        'cond'     => 'Coperto',
        'windDir'  => 270,
        'windBft'  => 5,
        'url'      => 'https://meteostazioni.example.it/monteriggioni',
    ],
    [
        'id'       => 's4',
        'name'     => 'Asciano',
        'lat'      => 43.2340,
        'lng'      => 11.5620,
        'temp'     => 13.0,
        'dotColor' => '#ffb74d',
        'cond'     => 'Soleggiato',
        'windDir'  => 90,
        'windBft'  => 2,
        'url'      => 'https://meteostazioni.example.it/asciano',
    ],
    [
        'id'       => 's5',
        'name'     => 'Rapolano Terme',
        'lat'      => 43.2820,
        'lng'      => 11.6030,
        'temp'     => 13.7,
        'dotColor' => '#81c784',
        'cond'     => 'Sereno',
        'windDir'  => 135,
        'windBft'  => 4,
        'url'      => 'https://meteostazioni.example.it/rapolano',
    ],
    [
        'id'       => 's6',
        'name'     => 'Murlo',
        'lat'      => 43.1620,
        'lng'      => 11.3870,
        'temp'     => 10.9,
        'dotColor' => '#64b5f6',
        'cond'     => 'Pioggia',
        'windDir'  => 315,
        'windBft'  => 7,
        'url'      => 'https://meteostazioni.example.it/murlo',
    ],
    [
        'id'       => 's7',
        'name'     => 'Sovicille',
        'lat'      => 43.2720,
        'lng'      => 11.2390,
        'temp'     => 11.4,
        'dotColor' => '#90caf9',
        'cond'     => 'Nuvoloso',
        'windDir'  => 200,
        'windBft'  => 2,
        'url'      => 'https://meteostazioni.example.it/sovicille',
    ],
];

// Passa i dati PHP → JavaScript come JSON
$stationsJson = json_encode($stations, JSON_PRETTY_PRINT);

// Timestamp aggiornamento
$lastUpdate = date('d/m/Y H:i');
?>
<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>Associazione Meteo Senese — Mappa</title>
<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;600;800&family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<style>
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  :root {
    --accent2: #5db8e8;
    --card-bg: rgba(10, 22, 38, 0.90);
    --card-border: rgba(93,184,232,0.28);
  }

  html, body {
    width: 100%; height: 100%;
    overflow: hidden;
    font-family: 'Raleway', sans-serif;
    color: #d0e8f5;
  }

  #map { position: fixed; inset: 0; z-index: 0; }
  .leaflet-tile { filter: brightness(0.92) saturate(0.85); }

  /* ── HEADER ── */
  #header {
    position: fixed;
    top: 0; left: 50%; transform: translateX(-50%);
    z-index: 800;
    width: 50%; min-width: 260px; max-width: 660px;
    margin-top: 12px;
    background: rgba(6,15,28,0.78);
    border: 1px solid var(--card-border);
    border-radius: 14px;
    padding: 10px 22px 5px;
    display: flex; flex-direction: column; align-items: center;
    backdrop-filter: blur(14px);
    box-shadow: 0 8px 36px rgba(0,0,0,.65);
    pointer-events: none;
  }
  #header img {
    width: 100%; height: auto;
    transform: scaleY(0.82); transform-origin: center;
    filter: drop-shadow(0 0 12px rgba(58,143,196,.5));
    display: block;
  }
  #header .subtitle {
    font-size: .6rem; letter-spacing: .2em; text-transform: uppercase;
    color: rgba(93,184,232,.5); font-weight: 300;
    margin-top: -2px; margin-bottom: 3px;
  }
  #header .update-time {
    font-size: .55rem; color: rgba(93,184,232,.35);
    letter-spacing: .1em; margin-bottom: 2px;
  }

  /* ── LEGEND ── */
  #legend {
    position: fixed;
    bottom: 22px; left: 14px;
    z-index: 800;
    background: var(--card-bg);
    border: 1px solid var(--card-border);
    border-radius: 10px;
    padding: 9px 13px;
    backdrop-filter: blur(10px);
    font-size: .62rem; letter-spacing: .05em; line-height: 2;
    box-shadow: 0 4px 20px rgba(0,0,0,.5);
  }
  #legend .leg-title {
    font-size: .57rem; letter-spacing: .15em; text-transform: uppercase;
    color: rgba(93,184,232,.55); margin-bottom: 3px;
  }
  .leg-row { display: flex; align-items: center; gap: 7px; }
  .leg-dot  { width: 11px; height: 11px; border-radius: 50%; border: 1.5px solid rgba(255,255,255,.2); flex-shrink: 0; }

  /* ── DETAIL PANEL ── */
  #panel {
    position: fixed;
    bottom: 22px; right: 14px;
    z-index: 900;
    width: 220px;
    background: var(--card-bg);
    border: 1px solid var(--card-border);
    border-radius: 12px;
    padding: 14px 16px 12px;
    backdrop-filter: blur(16px);
    box-shadow: 0 8px 32px rgba(0,0,0,.65);
    transform: translateY(16px);
    opacity: 0; pointer-events: none;
    transition: opacity .22s ease, transform .22s ease;
  }
  #panel.visible { opacity:1; transform:translateY(0); pointer-events:all; }

  #panel .p-name {
    font-size: .73rem; font-weight: 800; letter-spacing: .1em;
    text-transform: uppercase; color: var(--accent2);
    margin-bottom: 8px;
    border-bottom: 1px solid rgba(93,184,232,.2);
    padding-bottom: 6px;
  }
  #panel .p-row {
    display: flex; justify-content: space-between; align-items: baseline;
    font-size: .7rem; margin-bottom: 5px;
  }
  #panel .p-label { color: rgba(200,230,255,.45); font-size: .6rem; letter-spacing: .05em; }
  #panel .p-value { font-family: 'JetBrains Mono', monospace; font-weight: 700; font-size: .72rem; }
  #panel .p-link {
    display: block; margin-top: 10px; text-align: center;
    font-size: .6rem; letter-spacing: .1em; text-transform: uppercase;
    color: var(--accent2); text-decoration: none;
    border: 1px solid var(--card-border); border-radius: 6px;
    padding: 5px 8px; transition: background .18s;
  }
  #panel .p-link:hover { background: rgba(93,184,232,.12); }
  #panel .p-close {
    position: absolute; top: 8px; right: 10px;
    font-size: .78rem; cursor: pointer;
    color: rgba(200,230,255,.35); background: none;
    border: none; padding: 3px 6px; line-height: 1;
    transition: color .15s;
  }
  #panel .p-close:hover { color: #fff; }

  /* ── MARKERS ── */
  .wx-icon {
    display: flex; flex-direction: column; align-items: center;
    cursor: pointer; touch-action: manipulation;
    user-select: none; -webkit-user-select: none;
  }
  .wx-temp-label {
    background: rgba(6,15,28,0.88);
    border: 1.5px solid var(--accent2);
    border-radius: 5px; padding: 1px 7px;
    font-family: 'JetBrains Mono', monospace;
    font-size: 11px; font-weight: 700; color: #fff;
    white-space: nowrap; margin-bottom: 3px;
    box-shadow: 0 2px 8px rgba(0,0,0,.6);
    transition: background .2s, border-color .2s, box-shadow .2s;
  }
  .wx-dot-wrap { position: relative; width: 26px; height: 26px; }
  .wx-dot {
    position: absolute; inset: 5px;
    border-radius: 50%; border: 2px solid rgba(255,255,255,.28);
    transition: box-shadow .2s;
  }
  .wx-arrow {
    position: absolute; inset: 0;
    display: flex; align-items: center; justify-content: center;
  }
  .wx-station-name {
    font-family: 'Raleway', sans-serif;
    font-size: 9px; color: rgba(210,235,255,.75);
    text-align: center; max-width: 72px;
    line-height: 1.15; margin-top: 2px;
    text-shadow: 0 1px 5px rgba(0,0,0,.95);
  }
  .wx-icon.selected .wx-temp-label {
    border-color: #fff; background: rgba(58,143,196,.82);
    box-shadow: 0 0 14px rgba(93,184,232,.75);
  }
  .wx-icon.selected .wx-dot {
    border-color: rgba(255,255,255,.8);
    box-shadow: 0 0 12px 3px rgba(255,255,255,.35);
  }

  /* Leaflet skin */
  .leaflet-control-attribution {
    background: rgba(6,15,28,0.65) !important;
    color: rgba(180,210,230,.35) !important; font-size: 8px !important;
  }
  .leaflet-control-attribution a { color: rgba(93,184,232,.45) !important; }
  .leaflet-control-zoom a {
    background: rgba(6,15,28,0.82) !important;
    color: var(--accent2) !important;
    border-color: var(--card-border) !important;
    backdrop-filter: blur(8px); font-size: 16px !important;
  }
  .leaflet-control-zoom a:hover { background: rgba(58,143,196,.25) !important; }
  .leaflet-bar { border: 1px solid var(--card-border) !important; box-shadow: 0 4px 16px rgba(0,0,0,.5) !important; }

  @media (max-width: 600px) {
    #header { width: 82%; margin-top: 8px; padding: 8px 14px 4px; }
    #legend  { font-size: .58rem; padding: 7px 10px; bottom: 14px; left: 10px; }
    #panel   { width: calc(100vw - 24px); right: 12px; bottom: 14px; }
  }
</style>
</head>
<body>

<div id="map"></div>

<div id="header">
  <img src="logookpianojoomla3.png" alt="Associazione Meteo Senese">
  <p class="subtitle">Rete stazioni · Siena</p>
  <p class="update-time">Aggiornato: <?= htmlspecialchars($lastUpdate) ?></p>
</div>

<div id="legend">
  <div class="leg-title">Forza vento</div>
  <div class="leg-row"><div class="leg-dot" style="background:#4caf50"></div>Calma (0–2 Bft)</div>
  <div class="leg-row"><div class="leg-dot" style="background:#8bc34a"></div>Leggero (3–4 Bft)</div>
  <div class="leg-row"><div class="leg-dot" style="background:#ffeb3b"></div>Moderato (5–6 Bft)</div>
  <div class="leg-row"><div class="leg-dot" style="background:#ff9800"></div>Forte (7–8 Bft)</div>
  <div class="leg-row"><div class="leg-dot" style="background:#f44336"></div>Burrasca (9+ Bft)</div>
</div>

<div id="panel">
  <button class="p-close" id="panelClose">✕</button>
  <div class="p-name"  id="pName">—</div>
  <div class="p-row"><span class="p-label">Temperatura</span><span class="p-value" id="pTemp">—</span></div>
  <div class="p-row"><span class="p-label">Condizione</span> <span class="p-value" id="pCond">—</span></div>
  <div class="p-row"><span class="p-label">Dir. vento</span> <span class="p-value" id="pWindDir">—</span></div>
  <div class="p-row"><span class="p-label">Forza vento</span><span class="p-value" id="pWindBft">—</span></div>
  <a href="#" class="p-link" id="pLink" target="_blank">→ Apri stazione</a>
</div>

<script>
// ── Dati stazioni iniettati da PHP ──────────────────────────────────────────
const stations = <?= $stationsJson ?>;

// ── Helpers ─────────────────────────────────────────────────────────────────
const bftToColor = b => b<=2?'#4caf50': b<=4?'#8bc34a': b<=6?'#ffeb3b': b<=8?'#ff9800':'#f44336';
const dirLabel   = d => ['N','NNE','NE','ENE','E','ESE','SE','SSE','S','SSO','SO','OSO','O','ONO','NO','NNO'][Math.round(d/22.5)%16];
const bftLabel   = b => ['Calma','Bava','Brezza leggera','Brezza tesa','Vento mod.','Vento teso',
                          'Vento fresco','Forte','Burrasca mod.','Burrasca','Tempesta','Tempesta v.','Uragano'][Math.min(b,12)];

function arrowSVG(deg, bft) {
  const c = bftToColor(bft);
  return `<svg width="26" height="26" viewBox="0 0 26 26"
    style="transform:rotate(${deg}deg);transform-origin:center;display:block;">
    <polygon points="13,1 17,13 13,10 9,13" fill="${c}" opacity=".95"/>
    <line x1="13" y1="10" x2="13" y2="23" stroke="${c}" stroke-width="2.2" stroke-linecap="round"/>
  </svg>`;
}

function makeHTML(st, sel) {
  const sign = st.temp >= 0 ? '+' : '';
  return `<div class="wx-icon${sel?' selected':''}">
    <div class="wx-temp-label">${sign}${parseFloat(st.temp).toFixed(1)}°C</div>
    <div class="wx-dot-wrap">
      <div class="wx-dot" style="background:${st.dotColor};"></div>
      <div class="wx-arrow">${arrowSVG(st.windDir, st.windBft)}</div>
    </div>
    <div class="wx-station-name">${st.name}</div>
  </div>`;
}

function makeIcon(st, sel) {
  return L.divIcon({ className:'', html:makeHTML(st,sel), iconSize:[82,66], iconAnchor:[41,11] });
}

// ── Mappa ────────────────────────────────────────────────────────────────────
const map = L.map('map', { center:[43.29,11.37], zoom:11, tap:true, tapTolerance:18 });

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
  attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap contributors</a>',
  subdomains: 'abc',
  maxZoom: 19,
}).addTo(map);

// ── Segnaposto ───────────────────────────────────────────────────────────────
let selectedId = null;
const lMarkers = {};

function openPanel(st) {
  document.getElementById('pName').textContent    = st.name;
  document.getElementById('pTemp').textContent    = (st.temp>=0?'+':'') + parseFloat(st.temp).toFixed(1) + ' °C';
  document.getElementById('pCond').textContent    = st.cond;
  document.getElementById('pWindDir').textContent = dirLabel(st.windDir) + ' (' + st.windDir + '°)';
  document.getElementById('pWindBft').textContent = st.windBft + ' Bft — ' + bftLabel(st.windBft);
  document.getElementById('pLink').href           = st.url;
  document.getElementById('panel').classList.add('visible');
}

function closePanel() {
  document.getElementById('panel').classList.remove('visible');
  if (selectedId) {
    const prev = stations.find(s => s.id === selectedId);
    if (prev) lMarkers[prev.id].setIcon(makeIcon(prev, false));
    selectedId = null;
  }
}

stations.forEach(st => {
  const m = L.marker([st.lat, st.lng], { icon:makeIcon(st,false), interactive:true }).addTo(map);
  m.on('click', e => {
    L.DomEvent.stopPropagation(e);
    if (selectedId === st.id) {
      closePanel();
    } else {
      if (selectedId) {
        const prev = stations.find(s => s.id === selectedId);
        if (prev) lMarkers[prev.id].setIcon(makeIcon(prev, false));
      }
      selectedId = st.id;
      m.setIcon(makeIcon(st, true));
      openPanel(st);
    }
  });
  lMarkers[st.id] = m;
});

map.on('click', closePanel);

['click','touchend'].forEach(ev =>
  document.getElementById('panelClose').addEventListener(ev, e => {
    e.preventDefault(); e.stopPropagation(); closePanel();
  })
);

/*
  ── AGGIORNAMENTO AJAX (opzionale) ──────────────────────────────────────────
  Crea un file stazioni.php che restituisce JSON con lo stesso formato
  dell'array $stations e decommentaa questo blocco:

  async function refresh() {
    const data = await (await fetch('stazioni.php')).json();
    data.forEach(d => {
      const s = stations.find(s => s.id === d.id);
      if (!s) return;
      Object.assign(s, d);
      lMarkers[s.id].setIcon(makeIcon(s, selectedId === s.id));
      if (selectedId === s.id) openPanel(s);
    });
  }
  setInterval(refresh, 60_000);   // ogni 60 secondi
  ─────────────────────────────────────────────────────────────────────────── */
</script>
</body>
</html>