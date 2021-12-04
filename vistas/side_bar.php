 <?php
 $cat_usuario = $_SESSION["categoria"];
 ?>
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a class="brand-link">
    </a>
     <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <li class="nav-item">
            <a href='orden.php'class="nav-link" style="color: white">
              <i class="nav-icon fas fa-file"></i>
              <p>Ordenes</p>
            </a>
          </li>
          
          <?php if($cat_usuario==1 or $cat_usuario==3){ ?>
          <li class="nav-item">
            <a href='inventarios.php' class="nav-link" style="color: white">
              <i class="nav-icon fas fa-file"></i>
              <p>Inventarios</p>
            </a>
          </li>
          <?php } ?>

          <?php if($cat_usuario==1){ ?>
          <li class="nav-item">
            <a href='envios_ord.php' class="nav-link" style="color: white">
              <i class="nav-icon  fas fa-exchange-alt"></i>
              <p>Gestionar Lentes</p>
            </a>
          </li>


          <li class="nav-item">
            <a href='lenses.php'class="nav-link" style="color: white">
              <i class="nav-icon fab fa-tripadvisor"></i>
              <p>Lenses</p>
            </a>
          </li>

          <li class="nav-item">
            <a href='orders.php'class="nav-link" style="color: white">
              <i class="nav-icon fas fa-glasses"></i>
              <p>Aros</p>
            </a>
          </li>
          <?php } ?>
         <?php if($cat_usuario==1 or $cat_usuario==4){ ?>
          <li class="nav-item">
            <a href='laboratorios.php' class="nav-link" style="color: white">
              <i class="nav-icon fas fa-file"></i>
              <p>Laboratorio</p>
            </a>
          </li>
          <?php } ?>

        </ul>
          
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>