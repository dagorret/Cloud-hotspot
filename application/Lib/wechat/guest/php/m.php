111

<?php

/**

*   ����: mobile

*   ����: �ֻ���Ϣ��

*   ����:

*/

class mobile

{

/**

* ��������: getPhoneNumber

* ��������: ȡ�ֻ���

* �������: none

* ��������ֵ: �ɹ����غ��룬ʧ�ܷ���false

* ����˵��: ˵��

*/

function getPhoneNumber()

{

  if (isset($_SERVER['HTTP_X_NETWORK_INFO']))

  {

    $str1 = $_SERVER['HTTP_X_NETWORK_INFO'];

    $getstr1 = preg_replace('/(.*,)(13[\d]{9})(,.*)/i','\\2',$str1);

    Return $getstr1;

  }

  elseif (isset($_SERVER['HTTP_X_UP_CALLING_LINE_ID']))

  {

    $getstr2 = $_SERVER['HTTP_X_UP_CALLING_LINE_ID'];

    Return $getstr2;

  }

  elseif (isset($_SERVER['HTTP_X_UP_SUBNO']))

  {

    $str3 = $_SERVER['HTTP_X_UP_SUBNO'];

    $getstr3 = preg_replace('/(.*)(13[\d]{9})(.*)/i','\\2',$str3);

    Return $getstr3;

  }

  elseif (isset($_SERVER['DEVICEID']))

  {

    Return $_SERVER['DEVICEID'];

  }

  else

  {

    Return false;

  }

}

/**

* ��������: getHttpHeader

* ��������: ȡͷ��Ϣ

* �������: none

* ��������ֵ: �ɹ����غ��룬ʧ�ܷ���false

* ����˵��: ˵��

*/

function getHttpHeader()

{

  $str = '';

  foreach ($_SERVER as $key=>$val)

  {

    $gstr = str_replace("&","&",$val);

    $str.= "$key -> ".$gstr."\r\n";

  }

  Return $str;

}

/**

* ��������: getUA

* ��������: ȡUA

* �������: none

* ��������ֵ: �ɹ����غ��룬ʧ�ܷ���false

* ����˵��: ˵��

*/

function getUA()

{

  if (isset($_SERVER['HTTP_USER_AGENT']))

  {

    Return $_SERVER['HTTP_USER_AGENT'];

  }

  else

  {

    Return false;

  }

}

/**

* ��������: getPhoneType

* ��������: ȡ���ֻ�����

* �������: none

* ��������ֵ: �ɹ�����string��ʧ�ܷ���false

* ����˵��: ˵��

*/

function getPhoneType()

{

  $ua = $this->getUA();

  if($ua!=false)

  {

    $str = explode(' ',$ua);

    Return $str[0];

  }

  else

  {

    Return false;

  }

}

/**

* ��������: isOpera

* ��������: �ж��Ƿ���opera

* �������: none

* ��������ֵ: �ɹ�����string��ʧ�ܷ���false

* ����˵��: ˵��

*/

function isOpera()

{

  $uainfo = $this->getUA();

  if (preg_match('/.*Opera.*/i',$uainfo))

  {

    Return true;

  }

  else

  {

    Return false;

  }

}

/**

* ��������: isM3gate

* ��������: �ж��Ƿ���m3gate

* �������: none

* ��������ֵ: �ɹ�����string��ʧ�ܷ���false

* ����˵��: ˵��

*/

function isM3gate()

{

  $uainfo = $this->getUA();

  if (preg_match('/M3Gate/i',$uainfo))

  {

    Return true;

  }

  else

  {

    Return false;

  }

}

/**

* ��������: getHttpAccept

* ��������: ȡ��HA

* �������: none

* ��������ֵ: �ɹ�����string��ʧ�ܷ���false

* ����˵��: ˵��

*/

function getHttpAccept()

{

  if (isset($_SERVER['HTTP_ACCEPT']))

  {

    Return $_SERVER['HTTP_ACCEPT'];

  }

  else

  {

    Return false;

  }

}

/**

* ��������: getIP

* ��������: ȡ���ֻ�IP

* �������: none

* ��������ֵ: �ɹ�����string

* ����˵��: ˵��

*/

function getIP()

{

  $ip=getenv('REMOTE_ADDR');

  $ip_ = getenv('HTTP_X_FORWARDED_FOR');

  if (($ip_ != "") && ($ip_ != "unknown"))

  {

    $ip=$ip_;

  }

  return $ip;

}

}

$ioopdnuber = new mobile();

echo $ioopdnuber->getPhoneType();

?>