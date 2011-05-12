#!/usr/bin/perl -w
use strict;
use Cwd;
use File::Spec;
use Net::SMTP;

# Author: Greg Brandt
# Purpose: Runs SharingMedia test suite
# Comments:
#  - assumes that script is in REPOS/tools directory

# vars
my $APP_NAME = 'sharingmedia';
my $LOG_DIR_NAME = 'logs';
my $EMAIL_RECIPIENT = 'weiting.t.lu@gmail.com';
my $TOOL_DIR = 'tools';

# check args
die "Usage: run_test.pl [-a|-f] [file]" if @ARGV != 1 && @ARGV != 2;

# check current directory
die "Wrong directory: move to REPOS/$TOOL_DIR" if Cwd::cwd() !~ /($TOOL_DIR)$/;

# determine what to test
my $fname;
my $all = 0;

# run all tests
if ($ARGV[0] eq '-a') {
  $all = 1;
}
# run subset of tests
elsif ($ARGV[0] eq '-f') {
  die "Usage: no filename specified" if !defined($ARGV[1]);
  open TESTS, "<$ARGV[1]" or die "Couldn't open $ARGV[1]";
}
# incorrect usage
else {
  die "Usage: $ARGV[0] invalid flag";
}

# build test log filename
my ($min,$hour,$mday,$mon,$year) = (localtime)[1,2,3,4,5];
my $time = ($mon+1) . '-' . ($mday) . '-' . ($year+1900) . '_' . $hour . '-' . $min;

# create log directory if it doesn't exist
my $log_dir = File::Spec->catfile(File::Spec->updir(), $LOG_DIR_NAME);
mkdir $log_dir if (! -d $log_dir);

# open time-stamped log file for running tests
open LOG, '>' . File::Spec->catfile($log_dir, $time) . '.log';

# change to appropriate directory to run tests
chdir File::Spec->catfile(File::Spec->updir(), $APP_NAME, 'app');

# build test command
my $cmd = File::Spec->catfile(File::Spec->updir(), 'cake', 'console', 'cake');
if ($all) {
  $cmd .= ' testsuite app all';
} else {			# subset
  $cmd .= ' testsuite app case';
}

# run tests and write to log
my $msg;
my $output;
if ($all) {
  $output = `$cmd`;
  $msg .= $output;
  print LOG $output;
} else {
  while (<TESTS>) {
    chomp;
    if (!/^#/ && !/^\s*$/) {	# not comment or blank line
      $output = `$cmd $_` . '\n';
      $msg .= $output;
      print LOG $output;
    }
  }
}
close LOG;

# send mail
my $smtp = Net::SMTP->new('localhost');
$smtp->mail('noreply');
$smtp->to($EMAIL_RECIPIENT);

$smtp->data();
$smtp->datasend($msg);
$smtp->dataend();

$smtp->quit;
