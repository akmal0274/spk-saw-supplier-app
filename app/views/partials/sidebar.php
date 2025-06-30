<?php
function is_active($controller, $method = '') {
    $currentController = App::$currentController ?: 'Dashboard';
    $currentMethod = App::$currentMethod ?: 'index';
    $isActive = ($currentController == $controller);
    if ($method !== '') {
        $isActive = $isActive && ($currentMethod == $method);
    }
    return $isActive ? 'active' : '';
}
?>

<ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">
    <div class="sidebar-brand d-flex align-items-center justify-content-center">
        <div class="sidebar-brand-text mx-3">SPK Supplier Dengan SAW</div>
    </div>
    <hr class="sidebar-divider my-0">

    <li class="nav-item <?= is_active('Dashboard') ?>">
        <a class="nav-link" href="/spk-saw-supplier/dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <li class="nav-item <?= is_active('Supplier') ?>">
        <a class="nav-link" href="/spk-saw-supplier/supplier">
            <i class="fas fa-list"></i>
            <span>Kelola Supplier</span>
        </a>
    </li>

    <li class="nav-item <?= is_active('Kriteria') ?>">
        <a class="nav-link" href="/spk-saw-supplier/kriteria">
            <i class="fas fa-tags"></i>
            <span>Kelola Kriteria</span>
        </a>
    </li>

    <li class="nav-item <?= is_active('Subkriteria') ?>">
        <a class="nav-link" href="/spk-saw-supplier/subkriteria">
            <i class="fas fa-certificate"></i>
            <span>Kelola Sub Kriteria</span>
        </a>
    </li>

    <li class="nav-item <?= is_active('Alternatif') ?>">
        <a class="nav-link" href="/spk-saw-supplier/alternatif">
            <i class="fas fa-balance-scale"></i>
            <span>Data Alternatif</span>
        </a>
    </li>

    <li class="nav-item <?= is_active('Saw') ?>">
        <a class="nav-link" href="/spk-saw-supplier/saw">
            <i class="fas fa-calculator"></i>
            <span>Perhitungan SAW</span>
        </a>
    </li>

    <li class="nav-item <?= is_active('RankingAkhir') ?>">
        <a class="nav-link" href="/spk-saw-supplier/rankingakhir">
            <i class="fas fa-medal"></i>
            <span>Ranking Akhir</span>
        </a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
