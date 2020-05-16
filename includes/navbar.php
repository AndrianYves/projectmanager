<!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block <?php if($current == 'dashboard') {echo 'active';} ?>">
        <a href="index.php" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="messages.php" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="messages.php" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="messages.php" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="messages.php" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <!-- <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li> -->
      <li class="nav-item">
        <a class="nav-link" href="logout.php"><i class="nav-icon fas fa-sign-out-alt"></i> Sign-out</a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Project Manager</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">

      <?php if(!empty($_SESSION['picture'])){?>
        <div class="image">
          <img src="<?php echo $_SESSION['picture']?>" class="img-circle elevation-2" alt="User Image" style="height: 40px; width: 40px;">
        </div>
      <?php }else{?>
        <div class="image">
          <img <?php if($user['image'] == 'avatar.png'){ echo 'src="dist/img/avatar.png"';} else { echo 'src="dist/img/'.$id.'.'.pathinfo($user["image"], PATHINFO_EXTENSION).'"';} ?> class="img-circle elevation-2" alt="User Image" style="height: 40px; width: 40px;">
        </div>
      <?php }?>

        <div class="info">
          <a href="index.php" class="d-block"><?php echo ucfirst($user['firstname']). ' '.ucfirst($user['lastname']); ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="index.php" class="nav-link <?php if($current == 'dashboard') {echo 'active';} ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="messages.php" class="nav-link <?php if($current == 'messages') {echo 'active';} ?>">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Messages
              </p>
            </a>
          </li>
          <?php if($current != 'messages') {?>
          <li class="nav-item">
            <a href="projects.php" class="nav-link <?php if($current == 'projects') {echo 'active';} ?>">
              <i class="nav-icon fas fa-scroll"></i>
              <p>
                Projects
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="teams.php" class="nav-link <?php if($current == 'teams') {echo 'active';} ?>">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Teams
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="settings.php" class="nav-link <?php if($current == 'settings') {echo 'active';} ?>">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Settings
              </p>
            </a>
          </li>
          <?php if($user['usedtologin'] == '1'):?>
          <li class="nav-item">
            <a href="register.php" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Register a User
              </p>
            </a>
          </li>
          <?php endif;?>
        <?php } else {?>
          <li class="nav-header">Contacts</li>
           <?php
            $contacts = mysqli_query($conn, "SELECT *, users.id as contactID from users join aboutme on users.id = aboutme.userID where users.id != '$id'");
            while ($rowcontacts = mysqli_fetch_array($contacts)) {
          ?>

          <li class="nav-item">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
               <?php if(file_exists('dist/img/'.$rowcontacts['contactID'].'.'.pathinfo($rowcontacts['image'], PATHINFO_EXTENSION)) || $rowcontacts['image'] == 'avatar.png'){?>
                 <img <?php if($rowcontacts['image'] == 'avatar.png'){ echo 'src="dist/img/avatar.png"';} else { echo 'src="dist/img/'.$rowcontacts['contactID'].'.'.pathinfo($rowcontacts["image"], PATHINFO_EXTENSION).'"';} ?> class="img-circle elevation-2" alt="User Image" style="height: 40px; width: 40px;">
              <?php }else{?>
                
                  <img src="<?php echo $rowcontacts['image']; ?>" class="img-circle elevation-2" alt="User Image" style="height: 40px; width: 40px;">
              <?php }?>

               </div>
      

              <div class="info">
                <a href='messages.php?id=<?php echo $rowcontacts['contactID']; ?>' class="d-block"><?php echo ucwords($rowcontacts['firstname']);?> <?php echo ucwords($rowcontacts['lastname']);?></i></a>
              </div>
            </div>
          </li>

        <?php } }?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->


  </aside>