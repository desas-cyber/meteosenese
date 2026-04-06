<?php
/**
 * Associazione Meteo Senese — Mappa + Tabella dati
 * ─────────────────────────────────────────────────
 * In produzione sostituire $stations con dati letti da DB/API.
 * La tabella è già pronta per essere alimentata da un endpoint JSON:
 * vedi il blocco "AJAX refresh" in fondo al JS.
 *
 * Campi:
 *   windDir  → gradi 0-359
 *   windBft  → Beaufort 0-12
 *   rain12h  → mm pioggia ultime 12h
 *   dotColor → colore pallino condizione cielo
 *   windSpd  → km/h vento medio 10'
 *   pressure → hPa pressione
 *   humidity → % umidità relativa
 *   dewpoint → °C punto di rugiada
 *   tmax / tmaxTime → temp max + orario
 *   tmin / tminTime → temp min + orario
 *   rain1h / rain6h / rain24h → mm
 *   lastData → stringa ultimo aggiornamento
 *   rete     → nome rete
 *   chartUrl → link grafico stazione
 */

$stations = [
  ['id'=>'s1', 'name'=>'Siena Centro',   'rete'=>'AMS',   'elev'=>322,   'lat'=>43.3186,'lng'=>11.3307,
   'temp'=>14.2,'tmax'=>20.1,'tmaxTime'=>'13:22','tmin'=>9.8, 'tminTime'=>'06:14',
   'pressure'=>1018.2,'humidity'=>72,'dewpoint'=>9.3,
   'windSpd'=>8.6, 'windDir'=>220,'windBft'=>3,'windDirLbl'=>'SSO',
   'rain1h'=>0.0,'rain6h'=>0.0,'rain12h'=>0.0,'rain24h'=>0.0,
   'dotColor'=>'#64b5f6','cond'=>'Nuvoloso','lastData'=>'10/03/26 15:45',
   'url'=>'#siena-centro','chartUrl'=>'#chart-s1'],

  ['id'=>'s2', 'name'=>'Simognano',      'rete'=>'Sud-K', 'elev'=>290, 'lat'=>43.2820,'lng'=>11.2650,
   'temp'=>11.8,'tmax'=>18.3,'tmaxTime'=>'13:45','tmin'=>7.2, 'tminTime'=>'05:50',
   'pressure'=>1022.3,'humidity'=>85,'dewpoint'=>9.4,
   'windSpd'=>12.0,'windDir'=>180,'windBft'=>1,'windDirLbl'=>'S',
   'rain1h'=>0.0,'rain6h'=>0.0,'rain12h'=>0.0,'rain24h'=>2.5,
   'dotColor'=>'#81c784','cond'=>'Sereno','lastData'=>'10/03/26 16:30',
   'url'=>'#simognano','chartUrl'=>'#chart-s2'],

  ['id'=>'s3', 'name'=>'Monteriggioni',  'rete'=>'AMS',   'elev'=>274,   'lat'=>43.3906,'lng'=>11.2230,
   'temp'=>12.5,'tmax'=>17.8,'tmaxTime'=>'14:10','tmin'=>8.1, 'tminTime'=>'07:00',
   'pressure'=>1019.8,'humidity'=>78,'dewpoint'=>8.9,
   'windSpd'=>22.0,'windDir'=>270,'windBft'=>5,'windDirLbl'=>'O',
   'rain1h'=>0.2,'rain6h'=>1.2,'rain12h'=>1.2,'rain24h'=>3.4,
   'dotColor'=>'#64b5f6','cond'=>'Coperto','lastData'=>'10/03/26 16:28',
   'url'=>'#monteriggioni','chartUrl'=>'#chart-s3'],

  ['id'=>'s4', 'name'=>'Asciano',        'rete'=>'MetNet','elev'=>200,'lat'=>43.2340,'lng'=>11.5620,
   'temp'=>13.0,'tmax'=>21.4,'tmaxTime'=>'13:00','tmin'=>10.2,'tminTime'=>'07:30',
   'pressure'=>1015.5,'humidity'=>62,'dewpoint'=>5.8,
   'windSpd'=>6.5, 'windDir'=>90, 'windBft'=>2,'windDirLbl'=>'E',
   'rain1h'=>0.0,'rain6h'=>0.0,'rain12h'=>0.0,'rain24h'=>0.0,
   'dotColor'=>'#ffb74d','cond'=>'Soleggiato','lastData'=>'10/03/26 16:25',
   'url'=>'#asciano','chartUrl'=>'#chart-s4'],

  ['id'=>'s5', 'name'=>'Rapolano Terme', 'rete'=>'Sud-K', 'elev'=>322, 'lat'=>43.2820,'lng'=>11.6030,
   'temp'=>13.7,'tmax'=>19.9,'tmaxTime'=>'13:15','tmin'=>9.0, 'tminTime'=>'06:40',
   'pressure'=>1017.1,'humidity'=>68,'dewpoint'=>7.8,
   'windSpd'=>16.2,'windDir'=>135,'windBft'=>4,'windDirLbl'=>'SE',
   'rain1h'=>0.0,'rain6h'=>0.4,'rain12h'=>0.4,'rain24h'=>1.1,
   'dotColor'=>'#81c784','cond'=>'Sereno','lastData'=>'10/03/26 16:29',
   'url'=>'#rapolano','chartUrl'=>'#chart-s5'],

  ['id'=>'s6', 'name'=>'Murlo',          'rete'=>'AMS',   'elev'=>311,   'lat'=>43.1620,'lng'=>11.3870,
   'temp'=>10.9,'tmax'=>15.2,'tmaxTime'=>'12:30','tmin'=>7.8, 'tminTime'=>'05:20',
   'pressure'=>1020.4,'humidity'=>92,'dewpoint'=>9.7,
   'windSpd'=>38.0,'windDir'=>315,'windBft'=>7,'windDirLbl'=>'NO',
   'rain1h'=>4.2,'rain6h'=>12.4,'rain12h'=>18.5,'rain24h'=>22.1,
   'dotColor'=>'#5b9bd5','cond'=>'Pioggia','lastData'=>'10/03/26 16:31',
   'url'=>'#murlo','chartUrl'=>'#chart-s6'],

  ['id'=>'s7', 'name'=>'Sovicille',      'rete'=>'Sud-K', 'elev'=>265, 'lat'=>43.2720,'lng'=>11.2390,
   'temp'=>11.4,'tmax'=>18.3,'tmaxTime'=>'13:45','tmin'=>8.0, 'tminTime'=>'06:05',
   'pressure'=>1021.0,'humidity'=>80,'dewpoint'=>8.2,
   'windSpd'=>10.5,'windDir'=>200,'windBft'=>2,'windDirLbl'=>'SSO',
   'rain1h'=>0.0,'rain6h'=>0.0,'rain12h'=>3.1,'rain24h'=>5.6,
   'dotColor'=>'#90caf9','cond'=>'Nuvoloso','lastData'=>'10/03/26 16:27',
   'url'=>'#sovicille','chartUrl'=>'#chart-s7'],

  ['id'=>'s8', 'name'=>'Montalcino',     'rete'=>'MetNet','elev'=>567,'lat'=>43.0580,'lng'=>11.4890,
   'temp'=>10.2,'tmax'=>16.8,'tmaxTime'=>'13:50','tmin'=>6.4, 'tminTime'=>'06:55',
   'pressure'=>1023.7,'humidity'=>74,'dewpoint'=>6.1,
   'windSpd'=>7.2, 'windDir'=>160,'windBft'=>2,'windDirLbl'=>'SSE',
   'rain1h'=>0.0,'rain6h'=>0.0,'rain12h'=>0.0,'rain24h'=>0.0,
   'dotColor'=>'#81c784','cond'=>'Sereno','lastData'=>'10/03/26 16:26',
   'url'=>'#montalcino','chartUrl'=>'#chart-s8'],

  ['id'=>'s9', 'name'=>'Chianciano',     'rete'=>'AMS',   'elev'=>475,   'lat'=>43.0590,'lng'=>11.8260,
   'temp'=>12.1,'tmax'=>20.5,'tmaxTime'=>'13:05','tmin'=>8.9, 'tminTime'=>'07:10',
   'pressure'=>1016.8,'humidity'=>65,'dewpoint'=>5.9,
   'windSpd'=>9.8, 'windDir'=>100,'windBft'=>3,'windDirLbl'=>'E',
   'rain1h'=>0.0,'rain6h'=>0.0,'rain12h'=>0.0,'rain24h'=>0.0,
   'dotColor'=>'#ffb74d','cond'=>'Soleggiato','lastData'=>'10/03/26 16:24',
   'url'=>'#chianciano','chartUrl'=>'#chart-s9'],

  ['id'=>'s10','name'=>'Poggibonsi',     'rete'=>'Sud-K', 'elev'=>116, 'lat'=>43.4710,'lng'=>11.1520,
   'temp'=>13.4,'tmax'=>19.2,'tmaxTime'=>'14:00','tmin'=>9.5, 'tminTime'=>'06:30',
   'pressure'=>1018.9,'humidity'=>75,'dewpoint'=>9.1,
   'windSpd'=>18.4,'windDir'=>240,'windBft'=>4,'windDirLbl'=>'OSO',
   'rain1h'=>0.0,'rain6h'=>2.2,'rain12h'=>7.8,'rain24h'=>9.3,
   'dotColor'=>'#64b5f6','cond'=>'Nuvoloso','lastData'=>'10/03/26 16:32',
   'url'=>'#poggibonsi','chartUrl'=>'#chart-s10'],
];

$stationsJson = json_encode($stations);
$lastUpdate   = date('d/m/Y H:i');
?>
<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Associazione Meteo Senese — Mappa & Dati</title>
<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;600;800&family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<style>
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  :root {
    --accent2: #5db8e8;
    --card-bg: rgba(10, 22, 38, 0.95);
    --card-border: rgba(93,184,232,0.28);
    --row-hover: rgba(58,143,196,0.10);
    --row-sel:   rgba(58,143,196,0.22);
  }

  html { scroll-behavior: smooth; }

  body {
    min-height: 100vh;
    background: #0a1520;
    font-family: 'Raleway', sans-serif;
    color: #d0e8f5;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 16px 14px 40px;
    gap: 14px;
  }

  /* ══════════════════════════════════
     MAPPA 16:9
  ══════════════════════════════════ */
  .map-outer {
    width: 100%;
    max-width: 1280px;
    position: relative;
  }

  .map-ratio {
    position: relative;
    width: 100%;
    padding-top: 56.25%;
    border-radius: 14px;
    overflow: hidden;
    border: 1px solid var(--card-border);
    box-shadow: 0 12px 48px rgba(0,0,0,.7);
  }

  #map {
    position: absolute;
    inset: 0; width: 100%; height: 100%;
    border-radius: 14px;
  }

  /* logo overlay — fluido, spazio minimo sotto */
  .logo-overlay {
    position: absolute;
    top: 12px; left: 50%; transform: translateX(-50%);
    z-index: 800;
    width: clamp(110px, 42%, 480px);
    background: rgba(6,14,26,0.22);
    border: 1px solid rgba(93,184,232,0.10);
    border-radius: 12px;
    padding: 5px 12px 1px;
    display: flex; flex-direction: column; align-items: center;
    backdrop-filter: blur(3px); -webkit-backdrop-filter: blur(3px);
    pointer-events: none;
    overflow: hidden;
  }
  .logo-overlay img {
    width: 100%; height: auto;
    transform: scaleY(0.82); transform-origin: center;
    filter: drop-shadow(0 0 8px rgba(58,143,196,.3)) blur(0.4px);
    opacity: 0.82; display: block;
    vertical-align: bottom;
    margin-bottom: -4px;
  }
  .logo-overlay .subtitle {
    font-size: clamp(.32rem, 1.1vw, .54rem);
    letter-spacing: .18em; text-transform: uppercase;
    color: rgba(93,184,232,.42); font-weight: 300;
    margin-top: 0; margin-bottom: 0; line-height: 1.6;
  }
  .logo-overlay .update-time {
    font-size: clamp(.28rem, 0.9vw, .46rem);
    color: rgba(93,184,232,.26); letter-spacing:.1em;
    margin-bottom: 1px; line-height: 1.4;
  }

  /* mobile: spazio sotto logo ridotto al minimo */
  @media (max-width: 600px) {
    .logo-overlay .subtitle   { line-height: 0.9; margin-bottom: 0; }
    .logo-overlay .update-time{ line-height: 0.9; margin-bottom: 0; }
    .logo-overlay { padding-bottom: 0px; }
  }

  /* pannello dettaglio */
  #panel {
    position: absolute; bottom: 14px; right: 14px; z-index: 900;
    width: 215px;
    background: var(--card-bg);
    border: 1px solid var(--card-border);
    border-radius: 12px; padding: 13px 15px 11px;
    backdrop-filter: blur(16px);
    box-shadow: 0 8px 28px rgba(0,0,0,.65);
    transform: translateY(12px); opacity: 0; pointer-events: none;
    transition: opacity .22s ease, transform .22s ease;
  }
  #panel.visible { opacity:1; transform:translateY(0); pointer-events:all; }
  #panel .p-name {
    font-size:.7rem; font-weight:800; letter-spacing:.1em;
    text-transform:uppercase; color:var(--accent2);
    margin-bottom:8px; border-bottom:1px solid rgba(93,184,232,.2); padding-bottom:5px;
  }
  #panel .p-row { display:flex; justify-content:space-between; align-items:baseline; margin-bottom:4px; }
  #panel .p-label { color:rgba(200,230,255,.42); font-size:.58rem; letter-spacing:.04em; }
  #panel .p-value { font-family:'JetBrains Mono',monospace; font-weight:700; font-size:.7rem; }
  #panel .p-link {
    display:block; margin-top:9px; text-align:center;
    font-size:.58rem; letter-spacing:.1em; text-transform:uppercase;
    color:var(--accent2); text-decoration:none;
    border:1px solid var(--card-border); border-radius:6px;
    padding:4px 8px; transition:background .18s;
  }
  #panel .p-link:hover { background:rgba(93,184,232,.12); }
  #panel .p-close {
    position:absolute; top:7px; right:9px; font-size:.75rem; cursor:pointer;
    color:rgba(200,230,255,.32); background:none; border:none; padding:3px 5px;
    line-height:1; transition:color .15s;
  }
  #panel .p-close:hover { color:#fff; }

  /* ── MARKER — desktop ── */
  .wx-icon {
    display: flex; flex-direction: column; align-items: center;
    cursor: pointer; touch-action: manipulation;
    user-select: none; -webkit-user-select: none;
    filter: drop-shadow(0 2px 6px rgba(0,0,0,.7));
  }
  .wx-row {
    display: flex; align-items: center; gap: 0;
    background: rgba(6,15,28,0.86);
    border: 1.5px solid rgba(93,184,232,0.5);
    border-radius: 7px; overflow: hidden;
    transition: border-color .2s, box-shadow .2s;
  }
  .wx-wind {
    display:flex; align-items:center; justify-content:center;
    width:13px; padding:3px 1px;
    border-right:1px solid rgba(93,184,232,0.2); flex-shrink:0;
  }
  .wx-temp {
    font-family:'JetBrains Mono',monospace; font-size:11px; font-weight:700;
    color:#fff; padding:3px 4px; white-space:nowrap; flex-shrink:0;
  }
  .wx-rain {
    display:flex; align-items:center; justify-content:center;
    width:13px; padding:3px 1px;
    border-left:1px solid rgba(93,184,232,0.2); flex-shrink:0;
  }
  .wx-name {
    font-size:9px; color:rgba(210,235,255,.72);
    text-align:center; max-width:90px; line-height:1.2; margin-top:2px;
    text-shadow:0 1px 5px rgba(0,0,0,.95); white-space:nowrap;
  }
  .wx-icon.selected .wx-row {
    border-color:#fff;
    box-shadow:
      0 0 0 2px rgba(93,184,232,.9),
      0 0 16px 4px rgba(93,184,232,.7),
      0 0 30px 6px rgba(93,184,232,.35);
  }
  .wx-icon.selected .wx-temp { color:#7dd4f8; }

  /* ── MARKER — mobile: tutto proporzionalmente ridotto ── */
  @media (max-width: 600px) {
    .wx-row    { border-radius: 3px; border-width: 1px; }
    .wx-wind   { width: 6px;  padding: 1px 0px; }
    .wx-rain   { width: 6px;  padding: 1px 0px; }
    .wx-temp   { font-size: 5.5px; padding: 1px 2px; }
    .wx-name   { font-size: 4.5px; max-width: 44px; margin-top: 1px; }
  }

  /* Leaflet skin */
  .leaflet-control-attribution {
    background:rgba(6,15,28,0.6)!important;
    color:rgba(180,210,230,.35)!important; font-size:8px!important;
  }
  .leaflet-control-attribution a { color:rgba(93,184,232,.45)!important; }
  .leaflet-control-zoom a {
    background:rgba(6,15,28,0.85)!important; color:var(--accent2)!important;
    border-color:var(--card-border)!important; font-size:16px!important;
  }
  .leaflet-control-zoom a:hover { background:rgba(58,143,196,.25)!important; }
  .leaflet-bar { border:1px solid var(--card-border)!important; box-shadow:0 4px 14px rgba(0,0,0,.5)!important; }

  /* ══════════════════════════════════
     TABELLA — stesso footprint della mappa
  ══════════════════════════════════ */
  .table-outer {
    width: 100%;
    max-width: 1280px;
  }

  .table-wrap {
    width: 100%;
    background: var(--card-bg);
    border: 1px solid var(--card-border);
    border-radius: 14px;
    overflow-x: auto;
    box-shadow: 0 8px 32px rgba(0,0,0,.55);
    /* stessa altezza della mappa 16:9 — calcolata via JS al resize */
  }

  table {
    width: 100%;
    border-collapse: collapse;
    font-size: .58rem;
    white-space: nowrap;
  }

  thead th {
    position: sticky; top: 0; z-index: 2;
    background: rgba(6,15,30,0.97);
    color: rgba(93,184,232,.7);
    font-size: .50rem; font-weight: 600;
    letter-spacing: .08em; text-transform: uppercase;
    padding: 7px 8px 6px;
    border-bottom: 1px solid var(--card-border);
    cursor: pointer;
    user-select: none;
    white-space: nowrap;
    transition: color .15s;
  }
  thead th:hover { color: #fff; }

  /* sort indicator */
  thead th::after { content: ' ⇅'; opacity: .3; font-size: .55rem; }
  thead th.asc::after  { content: ' ▲'; opacity: .9; }
  thead th.desc::after { content: ' ▼'; opacity: .9; }

  tbody tr {
    border-bottom: 1px solid rgba(93,184,232,0.07);
    transition: background .15s;
    cursor: pointer;
  }
  tbody tr:hover   { background: var(--row-hover); }
  tbody tr.selected{ background: var(--row-sel); }
  tbody tr.selected td { color: #fff; }

  /* separatore visivo tra selezionate e resto */
  tbody tr.sel-last-row td {
    border-bottom: 2px solid rgba(93,184,232,0.5);
  }

  td {
    padding: 5px 7px;
    color: rgba(210,235,255,.75);
    font-family: 'JetBrains Mono', monospace;
    font-size: .56rem;
    vertical-align: middle;
  }

  /* prima colonna — nome stazione */
  td.td-elev {
    font-family: 'JetBrains Mono', monospace;
    font-size: .62rem;
    color: rgba(180,210,200,.6);
  }

  td.td-name {
    font-family: 'Raleway', sans-serif;
    font-weight: 600; font-size: .58rem;
    color: rgba(210,235,255,.9);
    min-width: 110px;
  }

  td.td-rete {
    font-family: 'Raleway', sans-serif;
    font-size: .52rem;
    color: rgba(93,184,232,.6);
  }

  /* temperatura attuale in evidenza */
  td.td-temp { color: #fff; font-weight: 700; }

  /* pioggia — colorata se > 0 */
  td.rain-trace { color: #81d4fa; }
  td.rain-low   { color: #29b6f6; }
  td.rain-mod   { color: #0288d1; }
  td.rain-high  { color: #e040fb; font-weight:700; }

  /* icona grafico */
  td.td-chart a {
    color: var(--accent2); text-decoration: none;
    font-size: .75rem;
    padding: 2px 6px;
    border: 1px solid rgba(93,184,232,.25);
    border-radius: 4px;
    transition: background .15s;
  }
  td.td-chart a:hover { background: rgba(93,184,232,.15); }

  /* legenda */
  .legend-bar {
    width: 100%; max-width: 1280px;
    display: flex; align-items: center; gap: 4px; flex-wrap: wrap;
    background: var(--card-bg); border:1px solid var(--card-border);
    border-radius:10px; padding:7px 14px; font-size:.6rem; letter-spacing:.04em; row-gap:6px;
  }
  .leg-section { display:flex; align-items:center; gap:4px; flex-wrap:wrap; }
  .leg-divider { width:1px; height:18px; background:rgba(93,184,232,.18); margin:0 10px; flex-shrink:0; }
  .leg-title { font-size:.55rem; letter-spacing:.14em; text-transform:uppercase; color:rgba(93,184,232,.5); margin-right:6px; white-space:nowrap; }
  .leg-item { display:flex; align-items:center; gap:5px; white-space:nowrap; margin-right:8px; }
  .leg-dot  { width:10px; height:10px; border-radius:50%; border:1.5px solid rgba(255,255,255,.18); flex-shrink:0; }
  .leg-drop { width:9px; height:12px; flex-shrink:0; border-radius:50% 50% 50% 50%/60% 60% 40% 40%; border:1.5px solid rgba(255,255,255,.18); }

  @media (max-width: 640px) {
    body { padding:10px 8px 28px; gap: 8px; }
    #panel { display: none !important; }
    /* logo overlay su mobile: più compatto, top ridotto */
    .logo-overlay { top: 6px; padding: 3px 8px 1px; border-radius: 8px; }
    /* legenda mobile: tutto più piccolo, padding minimo */
    .legend-bar {
      padding: 4px 8px;
      row-gap: 3px;
      gap: 3px;
      border-radius: 8px;
    }
    .leg-title  { font-size: .42rem; letter-spacing: .08em; margin-right: 3px; }
    .leg-item   { font-size: .42rem; gap: 3px; margin-right: 4px; }
    .leg-dot    { width: 7px; height: 7px; border-width: 1px; }
    .leg-drop   { width: 6px; height: 8px; border-width: 1px; }
    .leg-divider{ height: 12px; margin: 0 5px; }
  }
</style>
</head>
<body>

<!-- ══════ MAPPA 16:9 ══════ -->
<div class="map-outer">
  <div class="map-ratio" id="mapRatio">
    <div id="map"></div>

    <div class="logo-overlay">
      <img src="logookpianojoomla3.png" alt="Associazione Meteo Senese">
      <p class="subtitle">Rete stazioni · Provincia di Siena</p>
      <p class="update-time">Aggiornato: <?= htmlspecialchars($lastUpdate) ?></p>
    </div>

    <div id="panel">
      <button class="p-close" id="panelClose">✕</button>
      <div class="p-name"  id="pName">—</div>
      <div class="p-row"><span class="p-label">Temperatura</span> <span class="p-value" id="pTemp">—</span></div>
      <div class="p-row"><span class="p-label">Condizione</span>  <span class="p-value" id="pCond">—</span></div>
      <div class="p-row"><span class="p-label">Dir. vento</span>  <span class="p-value" id="pWindDir">—</span></div>
      <div class="p-row"><span class="p-label">Forza vento</span> <span class="p-value" id="pWindBft">—</span></div>
      <div class="p-row"><span class="p-label">Pioggia 12h</span> <span class="p-value" id="pRain">—</span></div>
      <a href="#" class="p-link" id="pLink" target="_blank">→ Apri stazione</a>
    </div>
  </div>
</div>

<!-- ══════ LEGENDA ══════ -->
<div class="legend-bar">
  <div class="leg-section">
    <span class="leg-title">▲ Vento</span>
    <div class="leg-item"><div class="leg-dot" style="background:#4caf50"></div>Calma 0–2</div>
    <div class="leg-item"><div class="leg-dot" style="background:#8bc34a"></div>Leggero 3–4</div>
    <div class="leg-item"><div class="leg-dot" style="background:#ffeb3b"></div>Moderato 5–6</div>
    <div class="leg-item"><div class="leg-dot" style="background:#ff9800"></div>Forte 7–8</div>
    <div class="leg-item"><div class="leg-dot" style="background:#f44336"></div>Burrasca 9+</div>
  </div>
  <div class="leg-divider"></div>
  <div class="leg-section">
    <span class="leg-title">💧 Pioggia 12h</span>
    <div class="leg-item"><div class="leg-drop" style="background:#b0bec5"></div>Nessuna</div>
    <div class="leg-item"><div class="leg-drop" style="background:#81d4fa"></div>Tracce &lt;1mm</div>
    <div class="leg-item"><div class="leg-drop" style="background:#29b6f6"></div>Lieve 1–5mm</div>
    <div class="leg-item"><div class="leg-drop" style="background:#0288d1"></div>Moderata 5–20mm</div>
    <div class="leg-item"><div class="leg-drop" style="background:#e040fb"></div>Forte &gt;20mm</div>
  </div>
</div>

<!-- ══════ TABELLA DATI ══════ -->
<div class="table-outer">
  <div class="table-wrap" id="tableWrap">
    <table id="stationsTable">
      <thead>
        <tr>
          <th data-col="name"     data-type="str">Stazione</th>
          <th data-col="rete"     data-type="str">Rete</th>
          <th data-col="elev"     data-type="num">Alt. slm</th>
          <th data-col="temp"     data-type="num">T att.</th>
          <th data-col="tmax"     data-type="num">Max</th>
          <th data-col="tmin"     data-type="num">Min</th>
          <th data-col="pressure" data-type="num">P</th>
          <th data-col="humidity" data-type="num">HR</th>
          <th data-col="dewpoint" data-type="num">DP</th>
          <th data-col="windSpd"  data-type="num">Vento 10'</th>
          <th data-col="windDirLbl" data-type="str">Dir.</th>
          <th data-col="rain1h"   data-type="num">Pioggia 1h</th>
          <th data-col="rain6h"   data-type="num">Pioggia 6h</th>
          <th data-col="rain12h"  data-type="num">Pioggia 12h</th>
          <th data-col="rain24h"  data-type="num">Pioggia 24h</th>
          <th data-col="lastData" data-type="str">Ultimo dato</th>
          <th data-col="chart"    data-type="none">Grafico</th>
        </tr>
      </thead>
      <tbody id="tableBody"></tbody>
    </table>
  </div>
</div>

<script>
/* ═══════════════════════════════════════════════════
   DATI (iniettati da PHP)
═══════════════════════════════════════════════════ */
const stations = <?= $stationsJson ?>;

/* ── Helpers ── */
const bftToColor = b => b<=2?'#4caf50': b<=4?'#8bc34a': b<=6?'#ffeb3b': b<=8?'#ff9800':'#f44336';
const dirLabel   = d => ['N','NNE','NE','ENE','E','ESE','SE','SSE','S','SSO','SO','OSO','O','ONO','NO','NNO'][Math.round(d/22.5)%16];
const bftLabel   = b => ['Calma','Bava','Brezza leggera','Brezza tesa','Vento mod.','Vento teso',
                         'Vento fresco','Forte','Burrasca mod.','Burrasca','Tempesta','Tempesta v.','Uragano'][Math.min(b,12)];

function rainColor(mm) {
  if (mm <= 0) return '#b0bec5';
  if (mm <  1) return '#81d4fa';
  if (mm <  5) return '#29b6f6';
  if (mm < 20) return '#0288d1';
  return '#e040fb';
}
function rainClass(mm) {
  if (mm <= 0) return '';
  if (mm <  1) return 'rain-trace';
  if (mm <  5) return 'rain-low';
  if (mm < 20) return 'rain-mod';
  return 'rain-high';
}

function windArrowSVG(deg, bft) {
  const c = bftToColor(bft);
  return `<svg width="10" height="10" viewBox="0 0 16 16"
    style="transform:rotate(${deg}deg);transform-origin:center;display:block;overflow:visible;">
    <polygon points="8,1 12,13 8,10 4,13" fill="${c}" stroke="rgba(0,0,0,.35)" stroke-width=".6"/>
  </svg>`;
}
function rainDropSVG(mm) {
  const c = rainColor(mm);
  return `<svg width="8" height="11" viewBox="0 0 12 16" style="display:block;overflow:visible;">
    <path d="M6,1 C6,1 1,7 1,10.5 A5,5 0 0 0 11,10.5 C11,7 6,1 6,1 Z"
      fill="${c}" stroke="rgba(0,0,0,.3)" stroke-width=".7"/>
  </svg>`;
}

function makeHTML(st, sel) {
  const sign = st.temp >= 0 ? '+' : '';
  return `<div class="wx-icon${sel?' selected':''}">
    <div class="wx-row">
      <div class="wx-wind">${windArrowSVG(st.windDir, st.windBft)}</div>
      <div class="wx-temp">${sign}${parseFloat(st.temp).toFixed(1)}°</div>
      <div class="wx-rain">${rainDropSVG(st.rain12h)}</div>
    </div>
    <div class="wx-name">${st.name}</div>
  </div>`;
}

function makeIcon(st, sel) {
  // su mobile icone più piccole proporzionate allo schermo
  const mob = window.innerWidth <= 600;
  const w = mob ? 34 : 70;
  const h = mob ? 18 : 36;
  return L.divIcon({ className:'', html:makeHTML(st,sel), iconSize:[w,h], iconAnchor:[w/2, mob?6:11] });
}

/* ═══════════════════════════════════════════════════
   MAPPA
═══════════════════════════════════════════════════ */
// zoom adattivo: su mobile zoom 9 per vedere tutta la provincia
const isMobile = window.innerWidth <= 600;
const map = L.map('map', { center:[43.15,11.45], zoom: isMobile ? 9 : 10, tap:true, tapTolerance:18 });
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
  attribution:'© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap contributors</a>',
  subdomains:'abc', maxZoom:19,
}).addTo(map);

/* ═══════════════════════════════════════════════════
   SELEZIONE MULTIPLA (condivisa mappa + tabella)
═══════════════════════════════════════════════════ */
const selectedIds   = new Set();
const selectionOrder = [];   // mantiene l'ordine di selezione
let   lastSelectedId = null;
const lMarkers = {};

function openPanel(st) {
  document.getElementById('pName').textContent    = st.name;
  document.getElementById('pTemp').textContent    = (st.temp>=0?'+':'') + parseFloat(st.temp).toFixed(1) + ' °C';
  document.getElementById('pCond').textContent    = st.cond;
  document.getElementById('pWindDir').textContent = st.windDirLbl + ' (' + st.windDir + '°)';
  document.getElementById('pWindBft').textContent = st.windBft + ' Bft — ' + bftLabel(st.windBft);
  document.getElementById('pRain').textContent    = parseFloat(st.rain12h).toFixed(1) + ' mm';
  document.getElementById('pLink').href           = st.url;
  document.getElementById('panel').classList.add('visible');
}

function closePanel() {
  document.getElementById('panel').classList.remove('visible');
  lastSelectedId = null;
}

function deselectAll() {
  selectedIds.forEach(id => {
    const s = stations.find(s => s.id === id);
    if (s) lMarkers[id].setIcon(makeIcon(s, false));
  });
  selectedIds.clear();
  selectionOrder.length = 0;
  // deseleziona righe tabella
  document.querySelectorAll('#tableBody tr.selected').forEach(r => r.classList.remove('selected'));
  closePanel();
}

/* seleziona/deseleziona una stazione — aggiorna marker + riga tabella + pannello */
function toggleStation(id) {
  const st = stations.find(s => s.id === id);
  if (!st) return;

  if (selectedIds.has(id)) {
    /* deseleziona */
    selectedIds.delete(id);
    const idx = selectionOrder.indexOf(id);
    if (idx !== -1) selectionOrder.splice(idx, 1);
    lMarkers[id].setIcon(makeIcon(st, false));
    document.querySelector(`#tableBody tr[data-id="${id}"]`)?.classList.remove('selected');

    if (lastSelectedId === id) {
      if (selectedIds.size > 0) {
        const fallbackId = [...selectedIds].at(-1);
        lastSelectedId   = fallbackId;
        openPanel(stations.find(s => s.id === fallbackId));
      } else {
        closePanel();
      }
    }
    renderTable();
  } else {
    /* seleziona */
    selectedIds.add(id);
    selectionOrder.push(id);
    lMarkers[id].setIcon(makeIcon(st, true));
    lastSelectedId = id;
    openPanel(st);
    renderTable();
  }
}

/* ── Markers mappa ── */
stations.forEach(st => {
  const m = L.marker([st.lat, st.lng], { icon:makeIcon(st,false), interactive:true }).addTo(map);
  m.on('click', e => { L.DomEvent.stopPropagation(e); toggleStation(st.id); });
  lMarkers[st.id] = m;
});

map.on('click', deselectAll);

['click','touchend'].forEach(ev =>
  document.getElementById('panelClose').addEventListener(ev, e => {
    e.preventDefault(); e.stopPropagation(); deselectAll();
  })
);

/* ═══════════════════════════════════════════════════
   TABELLA ORDINABILE
═══════════════════════════════════════════════════ */
let sortCol = 'name';
let sortDir = 'asc';

function fmt(v, dec=1) {
  if (v === null || v === undefined) return '—';
  return parseFloat(v).toFixed(dec);
}

function rainCell(mm) {
  const cls = rainClass(mm);
  const val = mm <= 0 ? '0' : fmt(mm);
  return `<td class="${cls}">${val}</td>`;
}

function renderTable() {
  // ordinamento base
  const baseSorted = [...stations].sort((a, b) => {
    let va = a[sortCol], vb = b[sortCol];
    if (va === undefined) va = ''; if (vb === undefined) vb = '';
    const num = typeof va === 'number';
    let cmp = num ? va - vb : String(va).localeCompare(String(vb), 'it');
    return sortDir === 'asc' ? cmp : -cmp;
  });

  // selezionate in cima ordinate come le altre, poi le non selezionate
  const selSet = new Set(selectionOrder);
  const selectedRows   = baseSorted.filter(s => selSet.has(s.id));
  const unselectedRows = baseSorted.filter(s => !selSet.has(s.id));
  const sorted = [...selectedRows, ...unselectedRows];

  const tbody = document.getElementById('tableBody');
  // separatore = ultima riga del gruppo selezionato dopo il sort (non l'ultima cliccata)
  const lastSelId = selectedRows.length > 0 ? selectedRows.at(-1).id : null;
  tbody.innerHTML = sorted.map(st => {
    let cls = selectedIds.has(st.id) ? 'selected' : '';
    if (st.id === lastSelId) cls += ' sel-last-row';
    return `<tr class="${cls}" data-id="${st.id}">
      <td class="td-name">${st.name}</td>
      <td class="td-rete">${st.rete}</td>
      <td class="td-elev">${st.elev != null ? st.elev + ' m' : '—'}</td>
      <td class="td-temp">${fmt(st.temp)}°C</td>
      <td>${fmt(st.tmax)}°C <span style="opacity:.38;font-size:.42rem">${st.tmaxTime}</span></td>
      <td>${fmt(st.tmin)}°C <span style="opacity:.38;font-size:.42rem">${st.tminTime}</span></td>
      <td>${fmt(st.pressure,1)} hPa</td>
      <td>${st.humidity}%</td>
      <td>${fmt(st.dewpoint)}°C</td>
      <td>${fmt(st.windSpd,1)} km/h</td>
      <td>${st.windDirLbl}</td>
      ${rainCell(st.rain1h)}
      ${rainCell(st.rain6h)}
      ${rainCell(st.rain12h)}
      ${rainCell(st.rain24h)}
      <td style="opacity:.6;font-size:.52rem">${st.lastData}</td>
      <td class="td-chart"><a href="${st.chartUrl}" target="_blank" title="Grafico ${st.name}">📈</a></td>
    </tr>`;
  }).join('');

  /* ricollega click righe */
  tbody.querySelectorAll('tr').forEach(row => {
    row.addEventListener('click', () => toggleStation(row.dataset.id));
  });

  /* se c'è almeno una riga selezionata, scrolla la tabella in cima */
  if (selectionOrder.length > 0) {
    const wrap = document.getElementById('tableWrap');
    wrap.scrollTo({ top: 0, behavior: 'smooth' });
  }
}

/* intestazioni — sort al click */
document.querySelectorAll('#stationsTable thead th').forEach(th => {
  th.addEventListener('click', () => {
    const col  = th.dataset.col;
    const type = th.dataset.type;
    if (type === 'none') return;   // colonna Grafico non ordinabile

    if (sortCol === col) {
      sortDir = sortDir === 'asc' ? 'desc' : 'asc';
    } else {
      sortCol = col;
      sortDir = 'asc';
    }

    /* aggiorna classe visiva su tutte le th */
    document.querySelectorAll('#stationsTable thead th').forEach(h => {
      h.classList.remove('asc','desc');
    });
    th.classList.add(sortDir);

    renderTable();
  });
});

/* match altezza tabella = altezza mappa */
function syncTableHeight() {
  const mapH = document.getElementById('mapRatio').offsetHeight;
  document.getElementById('tableWrap').style.height = mapH + 'px';
  document.getElementById('tableWrap').style.overflowY = 'auto';
}
window.addEventListener('resize', syncTableHeight);
syncTableHeight();

/* prima render */
renderTable();

/*
  ── AGGIORNAMENTO AJAX ogni 60s ─────────────────────────────────────────────
  Crea stazioni.php con:  echo json_encode($stations);
  Poi decommenta:

  async function refresh() {
    const data = await (await fetch('stazioni.php')).json();
    data.forEach(d => {
      const s = stations.find(s => s.id === d.id);
      if (!s) return;
      Object.assign(s, d);
      lMarkers[s.id].setIcon(makeIcon(s, selectedIds.has(s.id)));
      if (lastSelectedId === s.id) openPanel(s);
    });
    renderTable();
  }
  setInterval(refresh, 60_000);
  ─────────────────────────────────────────────────────────────────────────── */
</script>
</body>
</html><?php
/**
 * Associazione Meteo Senese — Mappa + Tabella dati
 * ─────────────────────────────────────────────────
 * In produzione sostituire $stations con dati letti da DB/API.
 * La tabella è già pronta per essere alimentata da un endpoint JSON:
 * vedi il blocco "AJAX refresh" in fondo al JS.
 *
 * Campi:
 *   windDir  → gradi 0-359
 *   windBft  → Beaufort 0-12
 *   rain12h  → mm pioggia ultime 12h
 *   dotColor → colore pallino condizione cielo
 *   windSpd  → km/h vento medio 10'
 *   pressure → hPa pressione
 *   humidity → % umidità relativa
 *   dewpoint → °C punto di rugiada
 *   tmax / tmaxTime → temp max + orario
 *   tmin / tminTime → temp min + orario
 *   rain1h / rain6h / rain24h → mm
 *   lastData → stringa ultimo aggiornamento
 *   rete     → nome rete
 *   chartUrl → link grafico stazione
 */

$stations = [
  ['id'=>'s1', 'name'=>'Siena Centro',   'rete'=>'AMS',   'elev'=>322,   'lat'=>43.3186,'lng'=>11.3307,
   'temp'=>14.2,'tmax'=>20.1,'tmaxTime'=>'13:22','tmin'=>9.8, 'tminTime'=>'06:14',
   'pressure'=>1018.2,'humidity'=>72,'dewpoint'=>9.3,
   'windSpd'=>8.6, 'windDir'=>220,'windBft'=>3,'windDirLbl'=>'SSO',
   'rain1h'=>0.0,'rain6h'=>0.0,'rain12h'=>0.0,'rain24h'=>0.0,
   'dotColor'=>'#64b5f6','cond'=>'Nuvoloso','lastData'=>'10/03/26 15:45',
   'url'=>'#siena-centro','chartUrl'=>'#chart-s1'],

  ['id'=>'s2', 'name'=>'Simognano',      'rete'=>'Sud-K', 'elev'=>290, 'lat'=>43.2820,'lng'=>11.2650,
   'temp'=>11.8,'tmax'=>18.3,'tmaxTime'=>'13:45','tmin'=>7.2, 'tminTime'=>'05:50',
   'pressure'=>1022.3,'humidity'=>85,'dewpoint'=>9.4,
   'windSpd'=>12.0,'windDir'=>180,'windBft'=>1,'windDirLbl'=>'S',
   'rain1h'=>0.0,'rain6h'=>0.0,'rain12h'=>0.0,'rain24h'=>2.5,
   'dotColor'=>'#81c784','cond'=>'Sereno','lastData'=>'10/03/26 16:30',
   'url'=>'#simognano','chartUrl'=>'#chart-s2'],

  ['id'=>'s3', 'name'=>'Monteriggioni',  'rete'=>'AMS',   'elev'=>274,   'lat'=>43.3906,'lng'=>11.2230,
   'temp'=>12.5,'tmax'=>17.8,'tmaxTime'=>'14:10','tmin'=>8.1, 'tminTime'=>'07:00',
   'pressure'=>1019.8,'humidity'=>78,'dewpoint'=>8.9,
   'windSpd'=>22.0,'windDir'=>270,'windBft'=>5,'windDirLbl'=>'O',
   'rain1h'=>0.2,'rain6h'=>1.2,'rain12h'=>1.2,'rain24h'=>3.4,
   'dotColor'=>'#64b5f6','cond'=>'Coperto','lastData'=>'10/03/26 16:28',
   'url'=>'#monteriggioni','chartUrl'=>'#chart-s3'],

  ['id'=>'s4', 'name'=>'Asciano',        'rete'=>'MetNet','elev'=>200,'lat'=>43.2340,'lng'=>11.5620,
   'temp'=>13.0,'tmax'=>21.4,'tmaxTime'=>'13:00','tmin'=>10.2,'tminTime'=>'07:30',
   'pressure'=>1015.5,'humidity'=>62,'dewpoint'=>5.8,
   'windSpd'=>6.5, 'windDir'=>90, 'windBft'=>2,'windDirLbl'=>'E',
   'rain1h'=>0.0,'rain6h'=>0.0,'rain12h'=>0.0,'rain24h'=>0.0,
   'dotColor'=>'#ffb74d','cond'=>'Soleggiato','lastData'=>'10/03/26 16:25',
   'url'=>'#asciano','chartUrl'=>'#chart-s4'],

  ['id'=>'s5', 'name'=>'Rapolano Terme', 'rete'=>'Sud-K', 'elev'=>322, 'lat'=>43.2820,'lng'=>11.6030,
   'temp'=>13.7,'tmax'=>19.9,'tmaxTime'=>'13:15','tmin'=>9.0, 'tminTime'=>'06:40',
   'pressure'=>1017.1,'humidity'=>68,'dewpoint'=>7.8,
   'windSpd'=>16.2,'windDir'=>135,'windBft'=>4,'windDirLbl'=>'SE',
   'rain1h'=>0.0,'rain6h'=>0.4,'rain12h'=>0.4,'rain24h'=>1.1,
   'dotColor'=>'#81c784','cond'=>'Sereno','lastData'=>'10/03/26 16:29',
   'url'=>'#rapolano','chartUrl'=>'#chart-s5'],

  ['id'=>'s6', 'name'=>'Murlo',          'rete'=>'AMS',   'elev'=>311,   'lat'=>43.1620,'lng'=>11.3870,
   'temp'=>10.9,'tmax'=>15.2,'tmaxTime'=>'12:30','tmin'=>7.8, 'tminTime'=>'05:20',
   'pressure'=>1020.4,'humidity'=>92,'dewpoint'=>9.7,
   'windSpd'=>38.0,'windDir'=>315,'windBft'=>7,'windDirLbl'=>'NO',
   'rain1h'=>4.2,'rain6h'=>12.4,'rain12h'=>18.5,'rain24h'=>22.1,
   'dotColor'=>'#5b9bd5','cond'=>'Pioggia','lastData'=>'10/03/26 16:31',
   'url'=>'#murlo','chartUrl'=>'#chart-s6'],

  ['id'=>'s7', 'name'=>'Sovicille',      'rete'=>'Sud-K', 'elev'=>265, 'lat'=>43.2720,'lng'=>11.2390,
   'temp'=>11.4,'tmax'=>18.3,'tmaxTime'=>'13:45','tmin'=>8.0, 'tminTime'=>'06:05',
   'pressure'=>1021.0,'humidity'=>80,'dewpoint'=>8.2,
   'windSpd'=>10.5,'windDir'=>200,'windBft'=>2,'windDirLbl'=>'SSO',
   'rain1h'=>0.0,'rain6h'=>0.0,'rain12h'=>3.1,'rain24h'=>5.6,
   'dotColor'=>'#90caf9','cond'=>'Nuvoloso','lastData'=>'10/03/26 16:27',
   'url'=>'#sovicille','chartUrl'=>'#chart-s7'],

  ['id'=>'s8', 'name'=>'Montalcino',     'rete'=>'MetNet','elev'=>567,'lat'=>43.0580,'lng'=>11.4890,
   'temp'=>10.2,'tmax'=>16.8,'tmaxTime'=>'13:50','tmin'=>6.4, 'tminTime'=>'06:55',
   'pressure'=>1023.7,'humidity'=>74,'dewpoint'=>6.1,
   'windSpd'=>7.2, 'windDir'=>160,'windBft'=>2,'windDirLbl'=>'SSE',
   'rain1h'=>0.0,'rain6h'=>0.0,'rain12h'=>0.0,'rain24h'=>0.0,
   'dotColor'=>'#81c784','cond'=>'Sereno','lastData'=>'10/03/26 16:26',
   'url'=>'#montalcino','chartUrl'=>'#chart-s8'],

  ['id'=>'s9', 'name'=>'Chianciano',     'rete'=>'AMS',   'elev'=>475,   'lat'=>43.0590,'lng'=>11.8260,
   'temp'=>12.1,'tmax'=>20.5,'tmaxTime'=>'13:05','tmin'=>8.9, 'tminTime'=>'07:10',
   'pressure'=>1016.8,'humidity'=>65,'dewpoint'=>5.9,
   'windSpd'=>9.8, 'windDir'=>100,'windBft'=>3,'windDirLbl'=>'E',
   'rain1h'=>0.0,'rain6h'=>0.0,'rain12h'=>0.0,'rain24h'=>0.0,
   'dotColor'=>'#ffb74d','cond'=>'Soleggiato','lastData'=>'10/03/26 16:24',
   'url'=>'#chianciano','chartUrl'=>'#chart-s9'],

  ['id'=>'s10','name'=>'Poggibonsi',     'rete'=>'Sud-K', 'elev'=>116, 'lat'=>43.4710,'lng'=>11.1520,
   'temp'=>13.4,'tmax'=>19.2,'tmaxTime'=>'14:00','tmin'=>9.5, 'tminTime'=>'06:30',
   'pressure'=>1018.9,'humidity'=>75,'dewpoint'=>9.1,
   'windSpd'=>18.4,'windDir'=>240,'windBft'=>4,'windDirLbl'=>'OSO',
   'rain1h'=>0.0,'rain6h'=>2.2,'rain12h'=>7.8,'rain24h'=>9.3,
   'dotColor'=>'#64b5f6','cond'=>'Nuvoloso','lastData'=>'10/03/26 16:32',
   'url'=>'#poggibonsi','chartUrl'=>'#chart-s10'],
];

$stationsJson = json_encode($stations);
$lastUpdate   = date('d/m/Y H:i');
?>
<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Associazione Meteo Senese — Mappa & Dati</title>
<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;600;800&family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<style>
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  :root {
    --accent2: #5db8e8;
    --card-bg: rgba(10, 22, 38, 0.95);
    --card-border: rgba(93,184,232,0.28);
    --row-hover: rgba(58,143,196,0.10);
    --row-sel:   rgba(58,143,196,0.22);
  }

  html { scroll-behavior: smooth; }

  body {
    min-height: 100vh;
    background: #0a1520;
    font-family: 'Raleway', sans-serif;
    color: #d0e8f5;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 16px 14px 40px;
    gap: 14px;
  }

  /* ══════════════════════════════════
     MAPPA 16:9
  ══════════════════════════════════ */
  .map-outer {
    width: 100%;
    max-width: 1280px;
    position: relative;
  }

  .map-ratio {
    position: relative;
    width: 100%;
    padding-top: 56.25%;
    border-radius: 14px;
    overflow: hidden;
    border: 1px solid var(--card-border);
    box-shadow: 0 12px 48px rgba(0,0,0,.7);
  }

  #map {
    position: absolute;
    inset: 0; width: 100%; height: 100%;
    border-radius: 14px;
  }

  /* logo overlay — fluido, spazio minimo sotto */
  .logo-overlay {
    position: absolute;
    top: 12px; left: 50%; transform: translateX(-50%);
    z-index: 800;
    width: clamp(110px, 42%, 480px);
    background: rgba(6,14,26,0.22);
    border: 1px solid rgba(93,184,232,0.10);
    border-radius: 12px;
    padding: 5px 12px 1px;
    display: flex; flex-direction: column; align-items: center;
    backdrop-filter: blur(3px); -webkit-backdrop-filter: blur(3px);
    pointer-events: none;
    overflow: hidden;
  }
  .logo-overlay img {
    width: 100%; height: auto;
    transform: scaleY(0.82); transform-origin: center;
    filter: drop-shadow(0 0 8px rgba(58,143,196,.3)) blur(0.4px);
    opacity: 0.82; display: block;
    vertical-align: bottom;
    margin-bottom: -4px;
  }
  .logo-overlay .subtitle {
    font-size: clamp(.32rem, 1.1vw, .54rem);
    letter-spacing: .18em; text-transform: uppercase;
    color: rgba(93,184,232,.42); font-weight: 300;
    margin-top: 0; margin-bottom: 0; line-height: 1.6;
  }
  .logo-overlay .update-time {
    font-size: clamp(.28rem, 0.9vw, .46rem);
    color: rgba(93,184,232,.26); letter-spacing:.1em;
    margin-bottom: 1px; line-height: 1.4;
  }

  /* mobile: spazio sotto logo ridotto al minimo */
  @media (max-width: 600px) {
    .logo-overlay .subtitle   { line-height: 0.9; margin-bottom: 0; }
    .logo-overlay .update-time{ line-height: 0.9; margin-bottom: 0; }
    .logo-overlay { padding-bottom: 0px; }
  }

  /* pannello dettaglio */
  #panel {
    position: absolute; bottom: 14px; right: 14px; z-index: 900;
    width: 215px;
    background: var(--card-bg);
    border: 1px solid var(--card-border);
    border-radius: 12px; padding: 13px 15px 11px;
    backdrop-filter: blur(16px);
    box-shadow: 0 8px 28px rgba(0,0,0,.65);
    transform: translateY(12px); opacity: 0; pointer-events: none;
    transition: opacity .22s ease, transform .22s ease;
  }
  #panel.visible { opacity:1; transform:translateY(0); pointer-events:all; }
  #panel .p-name {
    font-size:.7rem; font-weight:800; letter-spacing:.1em;
    text-transform:uppercase; color:var(--accent2);
    margin-bottom:8px; border-bottom:1px solid rgba(93,184,232,.2); padding-bottom:5px;
  }
  #panel .p-row { display:flex; justify-content:space-between; align-items:baseline; margin-bottom:4px; }
  #panel .p-label { color:rgba(200,230,255,.42); font-size:.58rem; letter-spacing:.04em; }
  #panel .p-value { font-family:'JetBrains Mono',monospace; font-weight:700; font-size:.7rem; }
  #panel .p-link {
    display:block; margin-top:9px; text-align:center;
    font-size:.58rem; letter-spacing:.1em; text-transform:uppercase;
    color:var(--accent2); text-decoration:none;
    border:1px solid var(--card-border); border-radius:6px;
    padding:4px 8px; transition:background .18s;
  }
  #panel .p-link:hover { background:rgba(93,184,232,.12); }
  #panel .p-close {
    position:absolute; top:7px; right:9px; font-size:.75rem; cursor:pointer;
    color:rgba(200,230,255,.32); background:none; border:none; padding:3px 5px;
    line-height:1; transition:color .15s;
  }
  #panel .p-close:hover { color:#fff; }

  /* ── MARKER — desktop ── */
  .wx-icon {
    display: flex; flex-direction: column; align-items: center;
    cursor: pointer; touch-action: manipulation;
    user-select: none; -webkit-user-select: none;
    filter: drop-shadow(0 2px 6px rgba(0,0,0,.7));
  }
  .wx-row {
    display: flex; align-items: center; gap: 0;
    background: rgba(6,15,28,0.86);
    border: 1.5px solid rgba(93,184,232,0.5);
    border-radius: 7px; overflow: hidden;
    transition: border-color .2s, box-shadow .2s;
  }
  .wx-wind {
    display:flex; align-items:center; justify-content:center;
    width:13px; padding:3px 1px;
    border-right:1px solid rgba(93,184,232,0.2); flex-shrink:0;
  }
  .wx-temp {
    font-family:'JetBrains Mono',monospace; font-size:11px; font-weight:700;
    color:#fff; padding:3px 4px; white-space:nowrap; flex-shrink:0;
  }
  .wx-rain {
    display:flex; align-items:center; justify-content:center;
    width:13px; padding:3px 1px;
    border-left:1px solid rgba(93,184,232,0.2); flex-shrink:0;
  }
  .wx-name {
    font-size:9px; color:rgba(210,235,255,.72);
    text-align:center; max-width:90px; line-height:1.2; margin-top:2px;
    text-shadow:0 1px 5px rgba(0,0,0,.95); white-space:nowrap;
  }
  .wx-icon.selected .wx-row {
    border-color:#fff;
    box-shadow:
      0 0 0 2px rgba(93,184,232,.9),
      0 0 16px 4px rgba(93,184,232,.7),
      0 0 30px 6px rgba(93,184,232,.35);
  }
  .wx-icon.selected .wx-temp { color:#7dd4f8; }

  /* ── MARKER — mobile: tutto proporzionalmente ridotto ── */
  @media (max-width: 600px) {
    .wx-row    { border-radius: 3px; border-width: 1px; }
    .wx-wind   { width: 6px;  padding: 1px 0px; }
    .wx-rain   { width: 6px;  padding: 1px 0px; }
    .wx-temp   { font-size: 5.5px; padding: 1px 2px; }
    .wx-name   { font-size: 4.5px; max-width: 44px; margin-top: 1px; }
  }

  /* Leaflet skin */
  .leaflet-control-attribution {
    background:rgba(6,15,28,0.6)!important;
    color:rgba(180,210,230,.35)!important; font-size:8px!important;
  }
  .leaflet-control-attribution a { color:rgba(93,184,232,.45)!important; }
  .leaflet-control-zoom a {
    background:rgba(6,15,28,0.85)!important; color:var(--accent2)!important;
    border-color:var(--card-border)!important; font-size:16px!important;
  }
  .leaflet-control-zoom a:hover { background:rgba(58,143,196,.25)!important; }
  .leaflet-bar { border:1px solid var(--card-border)!important; box-shadow:0 4px 14px rgba(0,0,0,.5)!important; }

  /* ══════════════════════════════════
     TABELLA — stesso footprint della mappa
  ══════════════════════════════════ */
  .table-outer {
    width: 100%;
    max-width: 1280px;
  }

  .table-wrap {
    width: 100%;
    background: var(--card-bg);
    border: 1px solid var(--card-border);
    border-radius: 14px;
    overflow-x: auto;
    box-shadow: 0 8px 32px rgba(0,0,0,.55);
    /* stessa altezza della mappa 16:9 — calcolata via JS al resize */
  }

  table {
    width: 100%;
    border-collapse: collapse;
    font-size: .58rem;
    white-space: nowrap;
  }

  thead th {
    position: sticky; top: 0; z-index: 2;
    background: rgba(6,15,30,0.97);
    color: rgba(93,184,232,.7);
    font-size: .50rem; font-weight: 600;
    letter-spacing: .08em; text-transform: uppercase;
    padding: 7px 8px 6px;
    border-bottom: 1px solid var(--card-border);
    cursor: pointer;
    user-select: none;
    white-space: nowrap;
    transition: color .15s;
  }
  thead th:hover { color: #fff; }

  /* sort indicator */
  thead th::after { content: ' ⇅'; opacity: .3; font-size: .55rem; }
  thead th.asc::after  { content: ' ▲'; opacity: .9; }
  thead th.desc::after { content: ' ▼'; opacity: .9; }

  tbody tr {
    border-bottom: 1px solid rgba(93,184,232,0.07);
    transition: background .15s;
    cursor: pointer;
  }
  tbody tr:hover   { background: var(--row-hover); }
  tbody tr.selected{ background: var(--row-sel); }
  tbody tr.selected td { color: #fff; }

  /* separatore visivo tra selezionate e resto */
  tbody tr.sel-last-row td {
    border-bottom: 2px solid rgba(93,184,232,0.5);
  }

  td {
    padding: 5px 7px;
    color: rgba(210,235,255,.75);
    font-family: 'JetBrains Mono', monospace;
    font-size: .56rem;
    vertical-align: middle;
  }

  /* prima colonna — nome stazione */
  td.td-elev {
    font-family: 'JetBrains Mono', monospace;
    font-size: .62rem;
    color: rgba(180,210,200,.6);
  }

  td.td-name {
    font-family: 'Raleway', sans-serif;
    font-weight: 600; font-size: .58rem;
    color: rgba(210,235,255,.9);
    min-width: 110px;
  }

  td.td-rete {
    font-family: 'Raleway', sans-serif;
    font-size: .52rem;
    color: rgba(93,184,232,.6);
  }

  /* temperatura attuale in evidenza */
  td.td-temp { color: #fff; font-weight: 700; }

  /* pioggia — colorata se > 0 */
  td.rain-trace { color: #81d4fa; }
  td.rain-low   { color: #29b6f6; }
  td.rain-mod   { color: #0288d1; }
  td.rain-high  { color: #e040fb; font-weight:700; }

  /* icona grafico */
  td.td-chart a {
    color: var(--accent2); text-decoration: none;
    font-size: .75rem;
    padding: 2px 6px;
    border: 1px solid rgba(93,184,232,.25);
    border-radius: 4px;
    transition: background .15s;
  }
  td.td-chart a:hover { background: rgba(93,184,232,.15); }

  /* legenda */
  .legend-bar {
    width: 100%; max-width: 1280px;
    display: flex; align-items: center; gap: 4px; flex-wrap: wrap;
    background: var(--card-bg); border:1px solid var(--card-border);
    border-radius:10px; padding:7px 14px; font-size:.6rem; letter-spacing:.04em; row-gap:6px;
  }
  .leg-section { display:flex; align-items:center; gap:4px; flex-wrap:wrap; }
  .leg-divider { width:1px; height:18px; background:rgba(93,184,232,.18); margin:0 10px; flex-shrink:0; }
  .leg-title { font-size:.55rem; letter-spacing:.14em; text-transform:uppercase; color:rgba(93,184,232,.5); margin-right:6px; white-space:nowrap; }
  .leg-item { display:flex; align-items:center; gap:5px; white-space:nowrap; margin-right:8px; }
  .leg-dot  { width:10px; height:10px; border-radius:50%; border:1.5px solid rgba(255,255,255,.18); flex-shrink:0; }
  .leg-drop { width:9px; height:12px; flex-shrink:0; border-radius:50% 50% 50% 50%/60% 60% 40% 40%; border:1.5px solid rgba(255,255,255,.18); }

  @media (max-width: 640px) {
    body { padding:10px 8px 28px; gap: 8px; }
    #panel { display: none !important; }
    /* logo overlay su mobile: più compatto, top ridotto */
    .logo-overlay { top: 6px; padding: 3px 8px 1px; border-radius: 8px; }
    /* legenda mobile: tutto più piccolo, padding minimo */
    .legend-bar {
      padding: 4px 8px;
      row-gap: 3px;
      gap: 3px;
      border-radius: 8px;
    }
    .leg-title  { font-size: .42rem; letter-spacing: .08em; margin-right: 3px; }
    .leg-item   { font-size: .42rem; gap: 3px; margin-right: 4px; }
    .leg-dot    { width: 7px; height: 7px; border-width: 1px; }
    .leg-drop   { width: 6px; height: 8px; border-width: 1px; }
    .leg-divider{ height: 12px; margin: 0 5px; }
  }
</style>
</head>
<body>

<!-- ══════ MAPPA 16:9 ══════ -->
<div class="map-outer">
  <div class="map-ratio" id="mapRatio">
    <div id="map"></div>

    <div class="logo-overlay">
      <img src="logookpianojoomla3.png" alt="Associazione Meteo Senese">
      <p class="subtitle">Rete stazioni · Provincia di Siena</p>
      <p class="update-time">Aggiornato: <?= htmlspecialchars($lastUpdate) ?></p>
    </div>

    <div id="panel">
      <button class="p-close" id="panelClose">✕</button>
      <div class="p-name"  id="pName">—</div>
      <div class="p-row"><span class="p-label">Temperatura</span> <span class="p-value" id="pTemp">—</span></div>
      <div class="p-row"><span class="p-label">Condizione</span>  <span class="p-value" id="pCond">—</span></div>
      <div class="p-row"><span class="p-label">Dir. vento</span>  <span class="p-value" id="pWindDir">—</span></div>
      <div class="p-row"><span class="p-label">Forza vento</span> <span class="p-value" id="pWindBft">—</span></div>
      <div class="p-row"><span class="p-label">Pioggia 12h</span> <span class="p-value" id="pRain">—</span></div>
      <a href="#" class="p-link" id="pLink" target="_blank">→ Apri stazione</a>
    </div>
  </div>
</div>

<!-- ══════ LEGENDA ══════ -->
<div class="legend-bar">
  <div class="leg-section">
    <span class="leg-title">▲ Vento</span>
    <div class="leg-item"><div class="leg-dot" style="background:#4caf50"></div>Calma 0–2</div>
    <div class="leg-item"><div class="leg-dot" style="background:#8bc34a"></div>Leggero 3–4</div>
    <div class="leg-item"><div class="leg-dot" style="background:#ffeb3b"></div>Moderato 5–6</div>
    <div class="leg-item"><div class="leg-dot" style="background:#ff9800"></div>Forte 7–8</div>
    <div class="leg-item"><div class="leg-dot" style="background:#f44336"></div>Burrasca 9+</div>
  </div>
  <div class="leg-divider"></div>
  <div class="leg-section">
    <span class="leg-title">💧 Pioggia 12h</span>
    <div class="leg-item"><div class="leg-drop" style="background:#b0bec5"></div>Nessuna</div>
    <div class="leg-item"><div class="leg-drop" style="background:#81d4fa"></div>Tracce &lt;1mm</div>
    <div class="leg-item"><div class="leg-drop" style="background:#29b6f6"></div>Lieve 1–5mm</div>
    <div class="leg-item"><div class="leg-drop" style="background:#0288d1"></div>Moderata 5–20mm</div>
    <div class="leg-item"><div class="leg-drop" style="background:#e040fb"></div>Forte &gt;20mm</div>
  </div>
</div>

<!-- ══════ TABELLA DATI ══════ -->
<div class="table-outer">
  <div class="table-wrap" id="tableWrap">
    <table id="stationsTable">
      <thead>
        <tr>
          <th data-col="name"     data-type="str">Stazione</th>
          <th data-col="rete"     data-type="str">Rete</th>
          <th data-col="elev"     data-type="num">Alt. slm</th>
          <th data-col="temp"     data-type="num">T att.</th>
          <th data-col="tmax"     data-type="num">Max</th>
          <th data-col="tmin"     data-type="num">Min</th>
          <th data-col="pressure" data-type="num">P</th>
          <th data-col="humidity" data-type="num">HR</th>
          <th data-col="dewpoint" data-type="num">DP</th>
          <th data-col="windSpd"  data-type="num">Vento 10'</th>
          <th data-col="windDirLbl" data-type="str">Dir.</th>
          <th data-col="rain1h"   data-type="num">Pioggia 1h</th>
          <th data-col="rain6h"   data-type="num">Pioggia 6h</th>
          <th data-col="rain12h"  data-type="num">Pioggia 12h</th>
          <th data-col="rain24h"  data-type="num">Pioggia 24h</th>
          <th data-col="lastData" data-type="str">Ultimo dato</th>
          <th data-col="chart"    data-type="none">Grafico</th>
        </tr>
      </thead>
      <tbody id="tableBody"></tbody>
    </table>
  </div>
</div>

<script>
/* ═══════════════════════════════════════════════════
   DATI (iniettati da PHP)
═══════════════════════════════════════════════════ */
const stations = <?= $stationsJson ?>;

/* ── Helpers ── */
const bftToColor = b => b<=2?'#4caf50': b<=4?'#8bc34a': b<=6?'#ffeb3b': b<=8?'#ff9800':'#f44336';
const dirLabel   = d => ['N','NNE','NE','ENE','E','ESE','SE','SSE','S','SSO','SO','OSO','O','ONO','NO','NNO'][Math.round(d/22.5)%16];
const bftLabel   = b => ['Calma','Bava','Brezza leggera','Brezza tesa','Vento mod.','Vento teso',
                         'Vento fresco','Forte','Burrasca mod.','Burrasca','Tempesta','Tempesta v.','Uragano'][Math.min(b,12)];

function rainColor(mm) {
  if (mm <= 0) return '#b0bec5';
  if (mm <  1) return '#81d4fa';
  if (mm <  5) return '#29b6f6';
  if (mm < 20) return '#0288d1';
  return '#e040fb';
}
function rainClass(mm) {
  if (mm <= 0) return '';
  if (mm <  1) return 'rain-trace';
  if (mm <  5) return 'rain-low';
  if (mm < 20) return 'rain-mod';
  return 'rain-high';
}

function windArrowSVG(deg, bft) {
  const c = bftToColor(bft);
  return `<svg width="10" height="10" viewBox="0 0 16 16"
    style="transform:rotate(${deg}deg);transform-origin:center;display:block;overflow:visible;">
    <polygon points="8,1 12,13 8,10 4,13" fill="${c}" stroke="rgba(0,0,0,.35)" stroke-width=".6"/>
  </svg>`;
}
function rainDropSVG(mm) {
  const c = rainColor(mm);
  return `<svg width="8" height="11" viewBox="0 0 12 16" style="display:block;overflow:visible;">
    <path d="M6,1 C6,1 1,7 1,10.5 A5,5 0 0 0 11,10.5 C11,7 6,1 6,1 Z"
      fill="${c}" stroke="rgba(0,0,0,.3)" stroke-width=".7"/>
  </svg>`;
}

function makeHTML(st, sel) {
  const sign = st.temp >= 0 ? '+' : '';
  return `<div class="wx-icon${sel?' selected':''}">
    <div class="wx-row">
      <div class="wx-wind">${windArrowSVG(st.windDir, st.windBft)}</div>
      <div class="wx-temp">${sign}${parseFloat(st.temp).toFixed(1)}°</div>
      <div class="wx-rain">${rainDropSVG(st.rain12h)}</div>
    </div>
    <div class="wx-name">${st.name}</div>
  </div>`;
}

function makeIcon(st, sel) {
  // su mobile icone più piccole proporzionate allo schermo
  const mob = window.innerWidth <= 600;
  const w = mob ? 34 : 70;
  const h = mob ? 18 : 36;
  return L.divIcon({ className:'', html:makeHTML(st,sel), iconSize:[w,h], iconAnchor:[w/2, mob?6:11] });
}

/* ═══════════════════════════════════════════════════
   MAPPA
═══════════════════════════════════════════════════ */
// zoom adattivo: su mobile zoom 9 per vedere tutta la provincia
const isMobile = window.innerWidth <= 600;
const map = L.map('map', { center:[43.15,11.45], zoom: isMobile ? 9 : 10, tap:true, tapTolerance:18 });
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
  attribution:'© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap contributors</a>',
  subdomains:'abc', maxZoom:19,
}).addTo(map);

/* ═══════════════════════════════════════════════════
   SELEZIONE MULTIPLA (condivisa mappa + tabella)
═══════════════════════════════════════════════════ */
const selectedIds   = new Set();
const selectionOrder = [];   // mantiene l'ordine di selezione
let   lastSelectedId = null;
const lMarkers = {};

function openPanel(st) {
  document.getElementById('pName').textContent    = st.name;
  document.getElementById('pTemp').textContent    = (st.temp>=0?'+':'') + parseFloat(st.temp).toFixed(1) + ' °C';
  document.getElementById('pCond').textContent    = st.cond;
  document.getElementById('pWindDir').textContent = st.windDirLbl + ' (' + st.windDir + '°)';
  document.getElementById('pWindBft').textContent = st.windBft + ' Bft — ' + bftLabel(st.windBft);
  document.getElementById('pRain').textContent    = parseFloat(st.rain12h).toFixed(1) + ' mm';
  document.getElementById('pLink').href           = st.url;
  document.getElementById('panel').classList.add('visible');
}

function closePanel() {
  document.getElementById('panel').classList.remove('visible');
  lastSelectedId = null;
}

function deselectAll() {
  selectedIds.forEach(id => {
    const s = stations.find(s => s.id === id);
    if (s) lMarkers[id].setIcon(makeIcon(s, false));
  });
  selectedIds.clear();
  selectionOrder.length = 0;
  // deseleziona righe tabella
  document.querySelectorAll('#tableBody tr.selected').forEach(r => r.classList.remove('selected'));
  closePanel();
}

/* seleziona/deseleziona una stazione — aggiorna marker + riga tabella + pannello */
function toggleStation(id) {
  const st = stations.find(s => s.id === id);
  if (!st) return;

  if (selectedIds.has(id)) {
    /* deseleziona */
    selectedIds.delete(id);
    const idx = selectionOrder.indexOf(id);
    if (idx !== -1) selectionOrder.splice(idx, 1);
    lMarkers[id].setIcon(makeIcon(st, false));
    document.querySelector(`#tableBody tr[data-id="${id}"]`)?.classList.remove('selected');

    if (lastSelectedId === id) {
      if (selectedIds.size > 0) {
        const fallbackId = [...selectedIds].at(-1);
        lastSelectedId   = fallbackId;
        openPanel(stations.find(s => s.id === fallbackId));
      } else {
        closePanel();
      }
    }
    renderTable();
  } else {
    /* seleziona */
    selectedIds.add(id);
    selectionOrder.push(id);
    lMarkers[id].setIcon(makeIcon(st, true));
    lastSelectedId = id;
    openPanel(st);
    renderTable();
  }
}

/* ── Markers mappa ── */
stations.forEach(st => {
  const m = L.marker([st.lat, st.lng], { icon:makeIcon(st,false), interactive:true }).addTo(map);
  m.on('click', e => { L.DomEvent.stopPropagation(e); toggleStation(st.id); });
  lMarkers[st.id] = m;
});

map.on('click', deselectAll);

['click','touchend'].forEach(ev =>
  document.getElementById('panelClose').addEventListener(ev, e => {
    e.preventDefault(); e.stopPropagation(); deselectAll();
  })
);

/* ═══════════════════════════════════════════════════
   TABELLA ORDINABILE
═══════════════════════════════════════════════════ */
let sortCol = 'name';
let sortDir = 'asc';

function fmt(v, dec=1) {
  if (v === null || v === undefined) return '—';
  return parseFloat(v).toFixed(dec);
}

function rainCell(mm) {
  const cls = rainClass(mm);
  const val = mm <= 0 ? '0' : fmt(mm);
  return `<td class="${cls}">${val}</td>`;
}

function renderTable() {
  // ordinamento base
  const baseSorted = [...stations].sort((a, b) => {
    let va = a[sortCol], vb = b[sortCol];
    if (va === undefined) va = ''; if (vb === undefined) vb = '';
    const num = typeof va === 'number';
    let cmp = num ? va - vb : String(va).localeCompare(String(vb), 'it');
    return sortDir === 'asc' ? cmp : -cmp;
  });

  // selezionate in cima ordinate come le altre, poi le non selezionate
  const selSet = new Set(selectionOrder);
  const selectedRows   = baseSorted.filter(s => selSet.has(s.id));
  const unselectedRows = baseSorted.filter(s => !selSet.has(s.id));
  const sorted = [...selectedRows, ...unselectedRows];

  const tbody = document.getElementById('tableBody');
  // separatore = ultima riga del gruppo selezionato dopo il sort (non l'ultima cliccata)
  const lastSelId = selectedRows.length > 0 ? selectedRows.at(-1).id : null;
  tbody.innerHTML = sorted.map(st => {
    let cls = selectedIds.has(st.id) ? 'selected' : '';
    if (st.id === lastSelId) cls += ' sel-last-row';
    return `<tr class="${cls}" data-id="${st.id}">
      <td class="td-name">${st.name}</td>
      <td class="td-rete">${st.rete}</td>
      <td class="td-elev">${st.elev != null ? st.elev + ' m' : '—'}</td>
      <td class="td-temp">${fmt(st.temp)}°C</td>
      <td>${fmt(st.tmax)}°C <span style="opacity:.38;font-size:.42rem">${st.tmaxTime}</span></td>
      <td>${fmt(st.tmin)}°C <span style="opacity:.38;font-size:.42rem">${st.tminTime}</span></td>
      <td>${fmt(st.pressure,1)} hPa</td>
      <td>${st.humidity}%</td>
      <td>${fmt(st.dewpoint)}°C</td>
      <td>${fmt(st.windSpd,1)} km/h</td>
      <td>${st.windDirLbl}</td>
      ${rainCell(st.rain1h)}
      ${rainCell(st.rain6h)}
      ${rainCell(st.rain12h)}
      ${rainCell(st.rain24h)}
      <td style="opacity:.6;font-size:.52rem">${st.lastData}</td>
      <td class="td-chart"><a href="${st.chartUrl}" target="_blank" title="Grafico ${st.name}">📈</a></td>
    </tr>`;
  }).join('');

  /* ricollega click righe */
  tbody.querySelectorAll('tr').forEach(row => {
    row.addEventListener('click', () => toggleStation(row.dataset.id));
  });

  /* se c'è almeno una riga selezionata, scrolla la tabella in cima */
  if (selectionOrder.length > 0) {
    const wrap = document.getElementById('tableWrap');
    wrap.scrollTo({ top: 0, behavior: 'smooth' });
  }
}

/* intestazioni — sort al click */
document.querySelectorAll('#stationsTable thead th').forEach(th => {
  th.addEventListener('click', () => {
    const col  = th.dataset.col;
    const type = th.dataset.type;
    if (type === 'none') return;   // colonna Grafico non ordinabile

    if (sortCol === col) {
      sortDir = sortDir === 'asc' ? 'desc' : 'asc';
    } else {
      sortCol = col;
      sortDir = 'asc';
    }

    /* aggiorna classe visiva su tutte le th */
    document.querySelectorAll('#stationsTable thead th').forEach(h => {
      h.classList.remove('asc','desc');
    });
    th.classList.add(sortDir);

    renderTable();
  });
});

/* match altezza tabella = altezza mappa */
function syncTableHeight() {
  const mapH = document.getElementById('mapRatio').offsetHeight;
  document.getElementById('tableWrap').style.height = mapH + 'px';
  document.getElementById('tableWrap').style.overflowY = 'auto';
}
window.addEventListener('resize', syncTableHeight);
syncTableHeight();

/* prima render */
renderTable();

/*
  ── AGGIORNAMENTO AJAX ogni 60s ─────────────────────────────────────────────
  Crea stazioni.php con:  echo json_encode($stations);
  Poi decommenta:

  async function refresh() {
    const data = await (await fetch('stazioni.php')).json();
    data.forEach(d => {
      const s = stations.find(s => s.id === d.id);
      if (!s) return;
      Object.assign(s, d);
      lMarkers[s.id].setIcon(makeIcon(s, selectedIds.has(s.id)));
      if (lastSelectedId === s.id) openPanel(s);
    });
    renderTable();
  }
  setInterval(refresh, 60_000);
  ─────────────────────────────────────────────────────────────────────────── */
</script>
</body>
</html>