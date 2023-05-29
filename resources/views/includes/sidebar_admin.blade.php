
            <li {{$pages=='dashboard' ? 'class=active' : ''}}><a class="nav-link" href="{{route('dashboard')}}"><i class="fas fa-home"></i> <span>Dashboard</span></a></li>
            <li class="nav-item dropdown {{$pages=='users' || $pages=='tapel' || $pages=='siswa' || $pages=='guru'|| $pages=='kelas' || $pages=='guru' || $pages=='mapel' ? 'active' : ''}}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-dumpster"></i>  <span>Manajemen Data</span></a>
                <ul class="dropdown-menu">

                    <li {{$pages=='siswa' ? 'class=active' : ''}}><a class="nav-link" href="{{route('siswa')}}"><i class="fas fa-user-graduate"></i><span>Siswa</span></a></li>
                    <li {{$pages=='kelas' ? 'class=active' : ''}}><a class="nav-link" href="{{route('kelas')}}"><i class="fas fa-school"></i><span>Kelas</span></a></li>
                    <li {{$pages=='tapel' ? 'class=active' : ''}}><a class="nav-link" href="{{route('tapel')}}"><i class="fas fa-passport"></i> <span>Tahun Pelajaran</span></a></li>
                    <li {{$pages=='users' ? 'class=active' : ''}}><a class="nav-link" href="{{route('users')}}"><i class="fas fa-building"></i> <span>User</span></a></li>
                </ul>
            </li>
            <li class="nav-item dropdown  {{$pages=='absensi' || $pages=='laporan'  ? 'active' : ''}}">
                <a href="#" class="nav-link has-dropdown {{$pages=='absensi' || $pages=='laporan'  ? 'active' : ''}}" data-toggle="dropdown"><i class="fas fa-id-card-alt"></i>  <span>Absensi</span></a>
                <ul class="dropdown-menu">

                    <li {{$pages=='absensi' ? 'class=active' : ''}}><a class="nav-link" href="{{route('absensi')}}"><i class="fas fa-id-card-alt"></i><span>Absensi</span></a></li>
                    <li {{$pages=='laporan' ? 'class=active' : ''}}><a class="nav-link" href="{{route('laporan')}}"><i class="far fa-calendar-plus"></i><span>Laporan Absensi</span></a></li>
                </ul>
            </li>


