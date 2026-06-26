<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa - UAS PBO</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        
        .container {
            max-width: 1400px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        
        h1 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 10px;
            font-size: 2.5em;
        }
        
        .subtitle {
            text-align: center;
            color: #7f8c8d;
            margin-bottom: 30px;
            font-size: 1.1em;
        }
        
        .nav-tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 30px;
            border-bottom: 2px solid #ecf0f1;
            padding-bottom: 10px;
        }
        
        .nav-tab {
            padding: 12px 30px;
            background: #ecf0f1;
            border: none;
            border-radius: 8px 8px 0 0;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            color: #34495e;
            transition: all 0.3s;
            text-decoration: none;
        }
        
        .nav-tab:hover {
            background: #d5dbdb;
            transform: translateY(-2px);
        }
        
        .nav-tab.active {
            background: #3498db;
            color: white;
        }
        
        .nav-tab.mandiri { border-left: 4px solid #e74c3c; }
        .nav-tab.bidikmisi { border-left: 4px solid #f39c12; }
        .nav-tab.prestasi { border-left: 4px solid #2ecc71; }
        
        .content {
            display: none;
            animation: fadeIn 0.5s;
        }
        
        .content.active {
            display: block;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .table-container {
            overflow-x: auto;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }
        
        thead {
            background: linear-gradient(135deg, #34495e, #2c3e50);
            color: white;
        }
        
        th {
            padding: 15px 12px;
            text-align: left;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
        }
        
        td {
            padding: 12px;
            border-bottom: 1px solid #ecf0f1;
        }
        
        tbody tr:hover {
            background: #f8f9fa;
            transition: background 0.3s;
        }
        
        .badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
        }
        
        .badge-mandiri { background: #e74c3c; color: white; }
        .badge-bidikmisi { background: #f39c12; color: white; }
        .badge-prestasi { background: #2ecc71; color: white; }
        
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }
        
        .stat-card .number {
            font-size: 2em;
            font-weight: 700;
            color: #2c3e50;
        }
        
        .stat-card .label {
            color: #7f8c8d;
            font-size: 14px;
            margin-top: 5px;
        }
        
        .stat-card.mandiri { border-left: 4px solid #e74c3c; }
        .stat-card.bidikmisi { border-left: 4px solid #f39c12; }
        .stat-card.prestasi { border-left: 4px solid #2ecc71; }
        
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #ecf0f1;
            color: #7f8c8d;
            font-size: 14px;
        }
        
        @media (max-width: 768px) {
            .container { padding: 15px; }
            h1 { font-size: 1.8em; }
            .nav-tabs { flex-wrap: wrap; }
            .nav-tab { flex: 1; text-align: center; font-size: 14px; padding: 10px; }
            table { font-size: 12px; }
            th, td { padding: 8px; }
            .stats { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>📊 Data Mahasiswa</h1>
        <p class="subtitle">Sistem Informasi Pembiayaan UKT - UAS PBO</p>
        
        <div class="nav-tabs">
            <a href="?tab=mandiri" class="nav-tab mandiri <?php echo ($_GET['tab'] ?? 'mandiri') == 'mandiri' ? 'active' : ''; ?>">
                🟥 Mandiri
            </a>
            <a href="?tab=bidikmisi" class="nav-tab bidikmisi <?php echo ($_GET['tab'] ?? 'mandiri') == 'bidikmisi' ? 'active' : ''; ?>">
                🟧 Bidikmisi
            </a>
            <a href="?tab=prestasi" class="nav-tab prestasi <?php echo ($_GET['tab'] ?? 'mandiri') == 'prestasi' ? 'active' : ''; ?>">
                🟩 Prestasi
            </a>
        </div>