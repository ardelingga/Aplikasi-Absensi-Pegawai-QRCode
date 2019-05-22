

<li <?php echo $web['modul'] == 'depan' ? 'class="active"' : ''; ?>>
	<a href="<?php echo BASE_URL;?>/?m=depan"><i class="fa fa-home"></i> <span>Home</span></a>
</li>

<li <?php echo $web['modul'] == 'kehadiran' ? 'class="active"' : ''; ?>>
	<a href="<?php echo BASE_URL;?>/?m=kehadiran"><i class="fa fa-check-square-o"></i> <span>Kehadiran</span></a>
</li>

<?php
$seting_absen_arr = array('waktu','periode','absen');
if(in_array($web['modul'], $seting_absen_arr)) {
	$menu_seting_absen_active = 'active';
	$menu_seting_absen_open = 'menu-open';
} else {
	$menu_seting_absen_active = '';
	$menu_seting_absen_open = '';
}
?>

<?php
$master_data_arr = array('pengguna','personal','departemen');
if(in_array($web['modul'], $master_data_arr)) {
	$menu_master_data_active = 'active';
	$menu_master_data_open = 'menu-open';
} else {
	$menu_master_data_active = '';
	$menu_master_data_open = '';
}
?>
<li class="treeview <?php echo $menu_master_data_active;?>">
	<a href="#"><i class="fa fa-folder"></i> <span>Master Data</span> <i class="fa fa-angle-left pull-right"></i></a>
	<ul class="treeview-menu <?php echo $menu_master_data_open;?>">
		<li <?php echo $web['modul'] == 'pengguna' ? 'class="active"' : ''; ?>>
			<a href="<?php echo BASE_URL;?>/?m=pengguna"><i class="fa fa-user"></i>Data Pengguna</a>
		</li>
		<li <?php echo $web['modul'] == 'personal' ? 'class="active"' : ''; ?>>
			<a href="<?php echo BASE_URL;?>/?m=personal"><i class="fa fa-users"></i>Data Personal</a>
		</li>
		<li <?php echo $web['modul'] == 'departemen' ? 'class="active"' : ''; ?>>
			<a href="<?php echo BASE_URL;?>/?m=departemen"><i class="fa fa-reorder"></i>Data Departemen</a>
		</li>
	</ul>
</li>
<li class="treeview <?php echo $menu_seting_absen_active;?>">
	<a href="#"><i class="fa fa-gear "></i> <span>Seting Absen</span> <i class="fa fa-angle-left pull-right"></i></a>
	<ul class="treeview-menu <?php echo $menu_seting_absen_open;?>">
			<li <?php echo $web['modul'] == 'waktu' ? 'class="active"' : ''; ?>>
			<a href="<?php echo BASE_URL;?>/?m=waktu"><i class="fa fa-clock-o"></i>Pengaturan Waktu</a>
		</li>
		<li <?php echo $web['modul'] == 'periode' ? 'class="active"' : ''; ?>>
			<a href="<?php echo BASE_URL;?>/?m=periode"><i class="fa fa-calendar"></i>Pengaturan Periode</a>
		</li>
		<li <?php echo $web['modul'] == 'absen' ? 'class="active"' : ''; ?>>
			<a href="<?php echo BASE_URL;?>/?m=absen"><i class="fa fa-calendar-check-o"></i>Pengaturan Absensi</a>
		</li>
	</ul>
</li>
<!-- <li class="treeview <?php echo $menu_master_data_active;?>">
<li class="treeview <?php echo $menu_seting_absen_active;?>">
	<a href="<?php echo BASE_URL;?>/?m=laporan_kehadiran"><i class="fa  fa-file-text-o"></i> <span>Laporan Kehadiran</span></a> -->

<li <?php echo $web['modul'] == 'laporan_kehadiran' ? 'class="active"' : ''; ?>>
	<a href="<?php echo BASE_URL;?>/?m=laporan_kehadiran"><i class="fa  fa-file-text-o"></i> <span>Laporan Kehadiran</span></a>
</li>