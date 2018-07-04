<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

  function nav_url($folder,$controller,$url)
  {
    if ($folder == $controller) {
      return $folder.'/'.$url;
    }else{
      return $folder.'/'.$controller.'/'.$url;
    }
  }

  function timestamp_to_ind($timestamp)
  {
    $date = substr($timestamp,0,10);
    $time = substr($timestamp,11,8) ;

    $raw_date = explode("-",$date);
    $date = $raw_date[2].'-'.$raw_date[1].'-'.$raw_date[0];
    return $date.' '.$time;
  }

  function ind_to_date($date)
  {
    $raw = explode("-", $date);
    return $raw[2].'-'.$raw[1].'-'.$raw[0];
  }

  function date_to_ind($date)
  {
    $raw = explode("-", $date);
    return $raw[2].'-'.$raw[1].'-'.$raw[0];
  }

  function month_to_ind($month)
  {
    $raw = explode("-", $month);
    return $raw[1].'-'.$raw[0];
  }

  function ind_to_month($month)
  {
    $raw = explode("-", $month);
    return $raw[1].'-'.$raw[0];
  }

  function month_name_ind($month)
  {
    $month = intval($month);
    switch ($month) {
      case 1:
        return 'Januari';
        break;

      case 2:
        return 'Februari';
        break;

      case 3:
        return 'Maret';
        break;

      case 4:
        return 'April';
        break;

      case 5:
        return 'Mei';
        break;

      case 6:
        return 'Juni';
        break;

      case 7:
        return 'Juli';
        break;

      case 8:
        return 'Agustus';
        break;

      case 9:
        return 'September';
        break;

      case 10:
        return 'Oktober';
        break;

      case 11:
        return 'November';
        break;

      case 12:
        return 'Desember';
        break;
    }
  }

  function day_name_ind($day)
  {
    $day = intval($day);
    switch ($day) {
      case 1:
        return 'Senin';
        break;

      case 2:
        return 'Selasa';
        break;

      case 3:
        return 'Rabu';
        break;

      case 4:
        return 'Kamis';
        break;

      case 5:
        return 'Jumat';
        break;

      case 6:
        return 'Sabtu';
        break;

      case 7:
        return 'Minggu';
        break;
    }
  }

  function price_to_num($v)
  {
    $res = str_replace('.', '', $v);
    return $res;
  }

  function num_to_price($v)
  {
    $res = number_format($v, 2, ",", ".");
    return $res;
  }

  function num_to_idr($v)
  {
    $res = num_to_price($v);
    return 'Rp <span class="pull-right">'.$res.'</span>';
  }
