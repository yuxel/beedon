<?
/*-----------------------
girdi kontrolleri
--------------------------*/


function nicklength($nick){  //en k�sa nick
  $min_nick_length=4;
  //
  if (strlen($nick) < $min_nick_length) 
    return _lang_nicklength_error;
}


function passlength($pass){  //en k�sa �ifre
  $min_pass_length=6;
  //
  if (strlen($pass) < $min_pass_length) 
    return _lang_passlength_error;
}


function email_control($adress) { // foo@bar.com gibi ge�erli bir email adresi kontrol�
  $result = ereg("^[^@ ]+@[^@ ]+\.[^@ \.]+$", $adress);
  if(!$result) 
    return _lang_not_valid_mail;
}


function pass_not_same($pass1,$pass2){  //ayn� �ifre kontrol�
  if($pass1!=$pass2)
    return _lang_passwords_not_same;
}

function nick_exists($search){  //nick veritaban�nda var m�
  $dbprefix=$GLOBALS['dbprefix'];
  $q=@db_query("select nick from ${dbprefix}members where nick='$search'");
  $res=@db_num_rows($q);
  if($res>0) return _lang_nick_exists;
}


function mail_exists($search){  //email veritaban�nda var m�
  $dbprefix=$GLOBALS['dbprefix'];
  $q=@db_query("select mail from ${dbprefix}members where mail='$search'");
  $res=@db_num_rows($q);
  if($res>0) return _lang_mail_exists;

}

function check_for_activation(){ 
//yeni kullan�c� olu�turulurken aktivasyon istensin mi yoksa direkt olarak �ye mi olsun
  $dbprefix=$GLOBALS['dbprefix'];
  $q=@db_query("select want_activation from ${dbprefix}beedon");
  while ($data=@db_fetch_row($q)) $check=$data[0];

  return $check;
}
?>