<?php
/*
 Shows a list of Bind9 dhcp leases
*/
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

print "DHCP Leases<br />";
#$lease_data = parse_ini_file('/var/www/html/dhcpd.leases',true);

#print_r($lease_data);

$fh=fopen("/var/www/html/dhcpd.leases","r");
$leases = array();
while ($dat=fgets($fh))
{
        if (preg_match("/lease/",$dat))
        {
                $active=false;
                $ip = preg_split("/ /",$dat);$ip=$ip[1];
                $dat=fgets($fh);
                while (!preg_match("/hardware ethernet/",$dat))
                {
                        if (preg_match("/binding state active/",$dat))
                        {
                                $active=true;
                        }
                        $dat=fgets($fh);
                }
                $mac = preg_split("/ |;/",$dat); $mac=$mac[4];
                if ($active)
                {
                        //print $ip." - ".$mac."<br />\n";
                        $leases[$ip]['ip']=$ip;
                        $leases[$ip]['mac']=$mac;
                }
        }
}

sort($leases);
foreach($leases as $key=>$val){
        print "IP:".$val['ip']." MAC:".$val['mac']."<br />";
}
?>
