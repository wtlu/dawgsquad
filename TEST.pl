#!/usr/bin/perl -w

# This program runs all tests and stores them in a log file
# whose name is the day and time that the tests were run
use strict;
use File::Spec;

# build test log filename (without spaces)
my ($min,$hour,$mday,$mon,$year) = (localtime)[1,2,3,4,5];
my $time = ($mon+1) . '-' . ($mday) . '-' . ($year+1900) . "_" . $hour . '-' . $min;
my $log_file = File::Spec->catfile(File::Spec->curdir(), 'TEST_LOGS', $time);
open LOG, ">$log_file";

# get test cases
my @tests = ();
open TEST_CASES, "<TEST_CASES.txt"
  or die "couldn't open TEST_CASES.txt";

# build the test command
my $test_cmd = File::Spec->catfile(File::Spec->updir(), 'cake', 'console', 'cake');
chdir File::Spec->catfile('sharingmedia', 'app');

# run all tests and write to log file
if ($ARGV[0] eq '-a') {		# run all
  my $output = `$test_cmd testsuite app all`;
  print LOG $output;
} else {
  while (<TEST_CASES>) {
    chomp;
    if (!/^\#/ && !/^\s*$/) {	# not comment or blank line
      # run the test
      my $output = `$test_cmd testsuite app case $_`;
      print LOG $output;
    }
  }
}

close LOG;
