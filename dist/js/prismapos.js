function ind_to_cur(x) {
  return 'Rp <span class="pull-right">'+x+'</span>';
}

function ind_to_sys(x) {
  x = x.replace(/\./g, "");
  x = x.replace(',','.');
  return x;
}

function sys_to_cur(x){
  return 'Rp <span class="pull-right">'+sys_to_ind(x)+'</span>';
}

function sys_to_prosen(x){
  return '<center><span>'+sys_to_ind(x)+' %</span></center>';
}

function sys_to_ind(bilangan) {
  var negativ = false;

  if (bilangan < 0) {
    bilangan = bilangan*-1;
    negativ = true;
  };

  var	number_string = bilangan.toString(),
  	split	= number_string.split('.'),
  	sisa 	= split[0].length % 3,
  	rupiah 	= split[0].substr(0, sisa),
  	ribuan 	= split[0].substr(sisa).match(/\d{1,3}/gi);

  if (ribuan) {
  	separator = sisa ? '.' : '';
  	rupiah += separator + ribuan.join('.');
  }
  // rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
  // rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;

  // Cetak hasil
  if (negativ == true) {
    rupiah = '-'+rupiah;
  }
  return rupiah;
}

function sys_to_inddec(bilangan) {
  var negativ = false;

  if (bilangan < 0) {
    bilangan = bilangan * -1;
    negativ = true;
  };

  var number_string = bilangan.toString(),
    split = number_string.split('.'),
    sisa = split[0].length % 3,
    rupiah = split[0].substr(0, sisa),
    ribuan = split[0].substr(sisa).match(/\d{1,3}/gi);

  if (ribuan) {
    separator = sisa ? '.' : '';
    rupiah += separator + ribuan.join('.');
  }
  rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
  // rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;

  // Cetak hasil
  if (negativ == true) {
    rupiah = '-' + rupiah;
  }
  return rupiah;
}
