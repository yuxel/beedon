<?
$effect=$_GET['effect'];
$effect2=$_GET['effect2'];




if($auth!=4)
{ echo "<center>Bu ayarlarý sadece yönetici deðiþtirebilir</center>";}
else{



  ?>
 <center><h2 align="center"> Kullanýcý Ayarlarý </h2><br>
    <a class="buton" href="?module=admin&a_module=users&effect=add"> Yeni Kullanýcý Ekle </a>&nbsp
    <a class="buton" href="?module=admin&a_module=users&effect=edit"> Kullanýcýlarý Düzenle/Sill </a><br></center><br>
    <?
    if($effect=="add") {
      ?>
      <center> Kullanýcý bilgilerini girin <br>
      <form action="?module=admin&a_module=users&effect=add&effect2=add_new" method="post">
      <table class="buton" align="center">
      <tr><td> Rumuz </td><td><input type="text" name="y_nick"></td>
      <tr><td> E-posta </td><td><input type="text" name="y_mail"></td>
      <tr><td> Þifre </td><td> <input type="password" name="y_pass"></td>
      <tr><td>Þifre Tekrar </td><td><input type="password" name="y_pass2"></td>
      <tr><td colspan=2 style="text-align:center"><small>E-posta adresini diðer<br> kullanýcýlar görebilsin mi? <input type="checkbox" name="mail_on"></small></td>
      </table>
      <input type="radio" name="y_auth" value=2 checked> Normal <input type="radio" name="y_auth" value=3> Editör<input type="radio" name="y_auth" value=4> Yönetici<br>
      <input type="submit" class="buton" value="Gönder"></center>
      </form>

      <?


      if($effect2=="add_new") {
          $y_nick=$_POST['y_nick'];
          $y_mail=$_POST['y_mail'];
          $y_pass=$_POST['y_pass'];
          $y_pass2=$_POST['y_pass2'];
          $mail_on=$_POST['mail_on'];
          $y_auth=$_POST['y_auth'];




          $xnick=htmlspecialchars($y_nick);
          $xposta=htmlspecialchars($y_mail);
          $xsif=htmlspecialchars($y_pass);
          $xsif2=htmlspecialchars($y_pass2);
          $mail_on=htmlspecialchars($mail_on);
          $y_auth=htmlspecialchars($y_auth);



          if($mail_on=="on") {$ymail_on=1;}
          else $ymail_on=0;

          $email_control=email_control($xposta);
          $email_exists=mail_exists($xposta);
          $user_exists=user_exists($xnick);

          $pcontrol=0;  /* eposta controlü için */
          $scontrol=0;  /* þifre controlü için */

          if($user_exists!=0) { echo "<li><center>Bu nick, kullanýcýlarýn birine ait.</center></li>";
          $pcontrol++;
          }
          if(strlen($xnick)<=3) { echo "<li><center>Rumuz en az 4 karakter olmalýdýr</center></li>";
          $pcontrol++
          ;}

          if($email_control!=0) { echo "<li><center>Düzgün bir eposta adresi girin</center></li>";
          $pcontrol++;
          }
          if($email_exists!=0) { echo "<li><center>Bu eposta, kullanýcýlardan birine ait</center></li>";
          $pcontrol++;
          }
          if((!$xsif) AND (!$xsif2)) {$yeni_pass=$bee_pass_hash;}
          else {

              if($xsif!=$xsif2) { echo "<li><center>Þifreler uyuþmuyor</center></li>";
              $scontrol++;
              }
              elseif(strlen($xsif)<=5) {echo "<li><center>Þifre en az 6 karakter olmalýdýr</center></li>";
              $scontrol++;}

              elseif((!$xsif) AND (!$xsif2)) {$yeni_pass=$bee_pass_hash;}
              else {$yeni_pass=substr(md5($xsif),0,15);}
          }

          if(($pcontrol==0) AND ($scontrol==0)) {  /* eger hic hata olmadiysa -> guncelle */
          @db_query("insert into ${dbprefix}members (nick,password,auth,theme,mail,language,mail_on) values('$xnick','$yeni_pass','$y_auth','default','$xposta','tr','$ymail_on')");

          echo "<br><center>Kullanýcý addndi</center>";
          }










      }  /* effect2 = add_new */
    } /* effect = add */
    if($effect=="edit"){


        $sonuc = @db_query("SELECT nick,mail,auth,mail_on,language,theme,password from ${dbprefix}members");
     ?><br>
	  <table border=1 class="buton" align="center">
	  <?
	  while ($sorgu_verisi = @db_fetch_row($sonuc)) {
	      if($sorgu_verisi[0] != "beeman")
	      {
	      ?>
	      <tr><td><? echo $sorgu_verisi[0] ; ?></td><td><? echo $sorgu_verisi[1]; ?></td><td>
	      <form action="?module=admin&a_module=users&effect=delete_user" method="post" >
	      <input type="hidden" name="knick" value="<?echo $sorgu_verisi[0]; ?>">
	      <input type="image" src="image/delete.png" border="0" />
	      </form></td><td>
	      <form action="?module=admin&a_module=users&effect=edit_user" method="post" >
	      <input type="hidden" name="kmail" value="<?echo $sorgu_verisi[1]; ?>">
	      <input type="hidden" name="knick" value="<?echo $sorgu_verisi[0]; ?>">
	      <input type="hidden" name="kauth" value="<?echo $sorgu_verisi[2]; ?>">
	      <input type="hidden" name="kmail_on" value="<?echo $sorgu_verisi[3]; ?>">
	      <input type="hidden" name="klanguage" value="<?echo $sorgu_verisi[4]; ?>">
	      <input type="hidden" name="ktheme" value="<?echo $sorgu_verisi[5]; ?>">
	      <input type="hidden" name="kpass" value="<?echo $sorgu_verisi[6]; ?>">
	      <input type="image" src="image/edit.png" border="0" />
	      </form></td>



	      <?
	      }
	  }
       ?>
	  </table>
	      <?
    }
    if($effect=="delete_user")
    {
        $knick=$_POST['knick'];

       ?>
       <center><?

       @db_query("DELETE FROM ${dbprefix}members where nick='$knick'");
       echo " kullanýcýsý silindi";

       /* eðer kullanýcý kendini siliyorsa, öntanýmlý kullanýcýya dön */
       if ($bee_isim==$knick) {
           forward(".",1);
           $bee_isim="beeman";
           $bee_pass_hash="";

       }

       else forward("?module=admin&a_module=users&effect=edit",2);
       ?>
			      <center>
				 <?


    }

    if($effect=="edit_user")
    {
        $knick=$_POST['knick'];
        $kmail=$_POST['kmail'];
        $kauth=$_POST['kauth'];
        $kmail_on=$_POST['kmail_on'];
        $klanguage=$_POST['klanguage'];
        $ktheme=$_POST['ktheme'];
        $kpass=$_POST['kpass'];


       ?>
       <center> Þifreyi deðiþtirmek istemiyorsanýz boþ býrakýn 
	  <form method="post" action="?module=admin&a_module=users&effect=check_edit">
	  <table align="center" class="buton">
	  <tr><td> Rumuz </td><td><input type="text" name="xnick" onfocus="this.blur()" value="<?echo $knick; ?>"></td>
	  <tr><td> E-posta </td><td><input type="text" name="xposta" value="<? echo $kmail; ?>"></td>
	  <tr><td>Þifre </td><td><input type="password" name="xsif"></td>
	  <tr><td>Þifre </td><td><input type="password" name="xsif2"></td>
	  <tr><td></td><td><input type="hidden" name="kpass2" value="<? echo $kpass;?>"></td>

	  <tr><td>Tema </td><td><input type="hidden" name="xtema" value="<? echo $ktheme;?>"><? echo $ktheme;?></td>

														   <tr><td></td><td><input type="hidden" name="eskimail" value="<? echo $kmail; ?>"></td>
														   <tr><td style="text-align:center" colspan=2>E-posta adresini diðer<br> kullanýcýlar görebilsin mi? <input type="checkbox" name="mail_on" <? if($kmail_on==1) {echo "checked";  };?>></td>

																																					   <tr><td style="text-align:center" colspan=2>Dil <select name="xlanguage">
																																					   <option value="tr" <? if($klanguage=="tr") echo "selected"?>>Türkçe
														<option value="en" <? if($klanguage=="en") echo "selected"?>>Ýngilizce
				     </select><br>
				     <input type="radio" name="y_auth" value=2 <? if($kauth==2) echo "checked";?>> Normal <input type="radio" name="y_auth" value=3 <? if($kauth==3) echo "checked";?>> Editör<input type="radio" name="y_auth" value=4 <? if($kauth==4) echo "checked";?>> Yönetici<br>
			      </td>
					      </table>
					      <input type="submit" class="buton" value="Gönder">
				      </form>
				      </center>

					      <?

    }




    if($effect=="check_edit")
    {
        $xnick=$_POST['xnick'];
        $xsif=$_POST['xsif'];
        $xsif2=$_POST['xsif2'];
        $xposta=$_POST['xposta'];
        $eskimail=$_POST['eskimail'];
        $mail_on=$_POST['mail_on'];
        $y_auth=$_POST['y_auth'];
        $xtema=$_POST['xtema'];
        $xlanguage=$_POST['xlanguage'];



        $xnick=htmlspecialchars($xnick);
        $xsif=htmlspecialchars($xsif);
        $xsif2=htmlspecialchars($xsif2);
        $xposta=htmlspecialchars($xposta);
        $eskimail=htmlspecialchars($eskimail);
        $mail_on=htmlspecialchars($mail_on);
        $y_auth=htmlspecialchars($y_auth);
        $xtema=htmlspecialchars($xtema);

        if($mail_on=="on") {$ymail_on=1;}
        else $ymail_on=0;

        $email_control=email_control($xposta);
        $email_exists=mail_exists($xposta);
        $user_exists=user_exists($xnick);

        $pcontrol=0;  /* eposta controlü için */
        $scontrol=0;  /* þifre controlü için */

        if(strlen($xnick)<=3) { echo "<li><center>Rumuz en az 4 karakter olmalýdýr</center></li>";
        $pcontrol++
        ;}

        if($email_control!=0) { echo "<li><center>Düzgün bir eposta adresi girin</center></li>";
        $pcontrol++;
        }
        if($email_exists!=0) {
            if($xposta!=$eskimail) {echo "<li><center>Bu eposta, kullanýcýlardan birine ait</center></li>";
            $pcontrol++;
            }
        }

        if((!$xsif) AND (!$xsif2)) {$yeni_pass=$kpass2;}
        else {

            if($xsif!=$xsif2) { echo "<li><center>Þifreler uyuþmuyor</center></li>";
            $scontrol++;
            }
            elseif(strlen($xsif)<=5) {echo "<li><center>Þifre en az 6 karakter olmalýdýr</center></li>";
            $scontrol++;}

            elseif((!$xsif) AND (!$xsif2)) {$yeni_pass=$kpass2;}
            else {$yeni_pass=substr(md5($xsif),0,15);}
        }

        if(($pcontrol==0) AND ($scontrol==0)) {  /* eger hic hata olmadiysa -> guncelle */



        @db_query("update ${dbprefix}members set nick='$xnick', password='$yeni_pass', auth='$y_auth',theme='$xtema',mail='$xposta', language='$xlanguage', mail_on='$ymail_on' where nick='$xnick'");


        echo "<br><center>Güncellendi</center>";
        }

    } /* effect==check_edit */


}
?>