<li class="active"><a href="#"><i class="fa fa-dashboard"></i> <span>Dashboard Staff Pimpinan</span></a></li>

<li class="treeview">
	<a href="#"><i class="fa fa-link"></i> <span>Surat Tugas</span>
	  <span class="pull-right-container">
		  <i class="fa fa-angle-left pull-right"></i>
		</span>
	</a>
	<ul class="treeview-menu">
	  <li><a href="{{ route('staffpim.index') }}">Menunggu Verifikasi</a></li>
	  <li><a href="{{ route('staffpim.sp.read') }}">Lihat Semua</a></li>
	</ul>	
</li>