#!/usr/bin/perl
use strict;
use Cwd;
use File::Spec;
use Mail::Sendmail;

# Author: Greg Brandt
# Purpose: Runs SharingMedia test suite

# vars
my $RECIPIENT = 'brandt.greg@gmail.com';

# build timestamped test log filename
my ($min,$hour,$mday,$mon,$year) = (localtime)[1,2,3,4,5];
my $fname = ($mon+1) . '-' . ($mday) . '-' . ($year+1900) 
  . '_' . $hour . '-' . $min . '.log';

# build test command (specific to AWS)
my $cmd = '/var/www/html/dawgsquad/sharingmedia/cake/console/cake testsuite app all'; # needs cake in the path

# run tests
my $output = "[$fname]\n\n"
  . "Team D.A.W.G Squad\n"
  . "SharingMedia\n\n"
  . `$cmd 2>&1 1>/dev/null`;	# outputs STDERR; discards STDOUT

# email errors
my %mail = (
  To => $RECIPIENT,
  From => 'noreply@ec2-50-18-34-181.us-west-1.compute.amazonaws.com',
  Message => $output,
);

if ($ARGV[0] eq '-e') {
  sendmail(%mail) or die $Mail::Sendmail::error;
}

print $output, "\n";
