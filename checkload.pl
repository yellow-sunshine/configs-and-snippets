#!/usr/bin/perl
# Checks the load of and restarts a service if load is too high

my $service = $ARGV[0];
my $loadThreshold = $ARGV[1];

my $content;
open(my $fh, '<', '/proc/loadavg') or die "cannot open file /proc/loadavg";{local $/; $content = <$fh>;}close($fh);

# Split up the contents of the read file by spaces
my @words = split / /, $content;
my $load = $words[0];

if($load > $loadThreshold){
        print "Load too high, restarting $service";
        system("/etc/init.d/$service restart");
}

if(`/bin/ps -ef | grep -v grep | grep $service | wc -l` < 1) {
    print "$service is not running, starting it now...";
    system("/etc/init.d/$service start");
}
