<!-- Sidebar Holder -->
<nav id="sidebar">
  <div class="sidebar-header">
    <h5>Prisma Point of Sales</h5>
  </div>
  <ul class="list-unstyled components">
    <?php foreach ($sidenav as $lvl1): ?>
      <li>
        <a <?php if(count($lvl1['child']) > 0){echo 'href="#'.$lvl1['module_name'].'" data-toggle="collapse" aria-expanded="false"';}else{echo 'href="'.base_url().$lvl1['module_controller'].'/'.$lvl1['module_url'].'"';}?>>
          <i class="fa fa-<?=$lvl1['module_icon']?>"></i><?=$lvl1['module_name']?>
        </a>
      </li>
      <?php if (count($lvl1['child']) > 0): ?>
        <ul class="collapse list-unstyled" id="<?=$lvl1['module_name']?>">
          <?php foreach ($lvl1['child'] as $lvl2): ?>
            <li><a href="<?=base_url().nav_url($lvl2['module_folder'],$lvl2['module_controller'],$lvl2['module_url'])?>"><?=$lvl2['module_name']?></a></li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
    <?php endforeach; ?>
  </ul>
  <div class="sidebar-footer">
    <h5>Prisma POS</h5>
  </div>
</nav>
