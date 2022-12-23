<?php

?>

<div class="main-sidebar" style="width:250px;">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="">SISPEMAWA</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="nav-item dropdown{{ ' active'|is_active('^index(.*)', page)|safe }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                <ul class="dropdown-menu">
                    <li{{ ' class="active"'|is_active('^index-0.html', page)|safe }}><a class="nav-link" href="index-0.html">General Dashboard</a>
            </li>
            <li{{ ' class="active"'|is_active('^index.html(.*)', page)|safe }}><a class="nav-link" href="index.html">Ecommerce Dashboard</a></li>
        </ul>
    </aside>
</div>