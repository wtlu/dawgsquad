#!/usr/bin/perl
use strict;
use Cwd;
use File::Spec;
use Mail::Sendmail;

# Author: Greg Brandt
# Purpose: Runs SharingMedia test suite

# vars
my $TOOLDIR = 'tools';
my $RECIPIENT = 'brandt.greg@gmail.com';

# check current directory
if Cwd::cwd() !~ /($TOOLDIR)/
  die "Wrong directory: move to dawgsquad/$TOOLDIR";

# build timestamped test log filename
my ($min,$hour,$mday,$mon,$year) = (localtime)[1,2,3,4,5];
my $fname = ($mon+1) . '-' . ($mday) . '-' . ($year+1900) 
  . '_' . $hour . '-' . $min . '.log';

# build test command
my $cmd = File::Spec->catfile(File::Spec->updir(), 'cake', 'console', 'cake')
  . ' testsuite app all';

# redirect STDERR
my $output;
close STDERR;
open STDERR, '>', \$output
  or die "Can't open STDERR: $!";

# run tests
`$cmd`;

# email errors
my %mail = (
  To => $RECIPIENT,
  From => 'noreply@ec2-50-18-34-181.us-west-1.compute.amazonaws.com',
  Message => $output,
);
