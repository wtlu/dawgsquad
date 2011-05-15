#!/usr/bin/perl -w
#
# Author	: Greg Brandt
# Purpose	: Modifies httpd.conf file to allow overrides for
#                 SymLinks (which happens to be the first instance
#                 of AllowOverride... i.e. this is a hack)

use strict;

$^I = '.bak';
my $has_been_done = 0;
while (<>) {
  # replaces first occurrence (at L290)
  if (/AllowOverride None/ && !$has_been_done) {
    s/AllowOverride None/AllowOverride All/g;
    $has_been_done = 1;
  }
  print;
}
